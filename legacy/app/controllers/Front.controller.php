<?php
require_once CONTROLLERS_PATH . 'App.controller.php';

class Front extends AppController
{
	var $layout             = 'front';
	var $default_user       = 'front_user';
	var $default_language   = 'front_language';
	var $require_login      = true;

	function beforeFilter() {

		$this->js[] = array('file' => 'jquery-1.5.2.min.js', 'path' => LIBS_PATH . 'jquery/');
        $this->js[] = array('file' => 'latestRounds.js', 'path' => JS_PATH);
        $this->css[] = array('file' => 'latestRounds.css', 'path' => CSS_PATH);
		$this->css[] = array('file' => '_screen.css', 'path' => CSS_PATH);

		
		Object::import('Model', 'Option');
		$OptionModel = new OptionModel();
		$this->models['Option'] = $OptionModel;
		$this->option_arr = $OptionModel->getAll();
		
		if ($this->getController() == 'Front' && $this->getAction() == 'login') {

		}
        elseif ((isset($_POST)) && (isset($_POST['admin'])) && ($_POST['admin'] == 1)) {

        }
        elseif ($this->option_arr['required_front_login'] == 'T' && !$this->isLoged()) {
			redirect('Front/login/not_logged_in');
		}
		
		$this->tpl['option_arr'] = $this->option_arr;
		$this->tpl['is_logged'] = $this->isLoged();
	}
	
	function beforeRender() {
		
	}
	
	function index() {
		Object::import('Model', array('Round', 'Announcement'));
		$roundModel = new RoundModel();
		$annModel = new AnnouncementModel();

		$this->tpl['ranking'] = $this->getRanking('10');
		$this->tpl['latest_rounds'] = $roundModel->getLatest();
		$this->tpl['latest_ann'] = $annModel->getLatest();
	}

	function uploadProfilePicture() {
		# Profile image upload
		require_once COMPONENTS_PATH . 'Upload.component.php';
		$uploadData = array('error' => true, 'filename' => false);
		$filename = false;

		if (!empty($_FILES['profile_picture']['name'])) {
			$handle = new Upload($_FILES['profile_picture']);

			if ($handle->uploaded) {
				$filename = md5(uniqid(rand(), true));

				# RESIZE
				$handle->allowed = array('image/*');
				$handle->mime_check = true;
				$handle->file_new_name_body = $filename;
				$handle->image_convert = 'jpg';
				$handle->jpeg_quality = 75;
				$handle->image_resize = true;
				$handle->image_x = PROFILE_IMAGES_MAX_WIDTH;
				$handle->image_y = PROFILE_IMAGES_MAX_HEIGHT;
				$handle->image_ratio_y = true;
				$handle->process(PROFILE_IMAGES_PATH);

				if ($handle->processed) {
					$filename = $handle->file_dst_name;
					$uploadData['error'] = false;
				}
			} else {
				$uploadData['error'] = true;
			}
		} else {
			$uploadData['error'] = false;
		}

		if ($uploadData['error'] === false && $filename !== false) {
			$uploadData['filename'] = $filename;
		}

		return $uploadData;
	}
	
	function deleteProfileImage() {
		if ($this->isLoged())
		{
			Object::import('Model', 'User');
			$UserModel = new UserModel();

			$arr = $UserModel->get($_GET['id']);
			if (count($arr) == 0)
			{
				header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminPlayers&action=index&error=4");
				exit;
			}

			$data['id'] = intval($_GET['id']);
			$data['image'] = '';
			$UserModel->update($data);

			if (!empty($arr['image']) && is_file(PROFILE_IMAGES_PATH . $arr['image'])) {
				if (unlink(PROFILE_IMAGES_PATH . $arr['image']) == true) {
					redirect('Front/profile/profile_image_delete_success');
				} else {
					redirect('Front/profile/profile_image_delete_error');
				}
			}
			exit;
		} else {
			redirect('Front/login/not_logged_in');
		}
	}
	
	function profile() {
		if ($this->isLoged()) {
			Object::import('Model', array('User'));
			$userModel = new UserModel();
			
			if (!empty($_POST['profile_update'])) {

				$data = array();
				
				$data['id'] = intval($_SESSION[$this->default_user]['id']);
				
				if (!empty($_POST['password']) && $_POST['password'] != 'password')
				{
					$data['password'] = sha1($_POST['password'] . $this->salt);
				} else {
					unset($_POST['password']);
				}
					
				if (!empty($_POST['dob_day']) && !empty($_POST['dob_month']) && !empty($_POST['dob_year'])) {
					$data['birth'] = date('Y-m-d', mktime(0, 0, 0, intval($_POST['dob_month']), intval($_POST['dob_day']), intval($_POST['dob_year'])));
				}

				$uploadData = $this->uploadProfilePicture();

				if ($uploadData['filename'] !== false) {
					$data['image'] = $uploadData['filename'];
				}
				
				$userModel->update(array_merge($_POST, $data));
				redirect('Front/profile/' . ($uploadData['error'] === false ? 'profile_update_success' : 'profile_update_upload_error') );
				exit;
			}
			
			$this->tpl['user'] = $userModel->get($_SESSION[$this->default_user]['id']);
			
			$this->tpl['user']['dob_day'] = date('d', strtotime($this->tpl['user']['birth']));
			$this->tpl['user']['dob_month'] = date('m', strtotime($this->tpl['user']['birth']));
			$this->tpl['user']['dob_year'] = date('Y', strtotime($this->tpl['user']['birth']));
			
			$this->js[] = array('file' => 'jquery.validate.min.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
			$this->js[] = array('file' => 'front.js', 'path' => JS_PATH);
		} else {
			redirect('Front/login/not_logged_in');
		}
	}
	
	function login() {
		if (isset($_POST['login_user'])) {
			Object::import('Model', array('User'));
			$UserModel = new UserModel();

			$opts['username'] = $_POST['login_username'];
			$opts['password'] = sha1($_POST['login_password'] . $this->salt);
						
			$user = $UserModel->getAll($opts);

			if (count($user) != 1) {
				# Login failed
				redirect('Front/login/login_failed');
				exit;
			} else {
				$user = $user[0];
				unset($user['password']);
															
				if (!in_array($user['role_id'], array(1, 2, 3))) {
					# Login denied
					redirect('Front/login/login_denied');
					exit;
				}
				
				if ($user['status'] != 'T') {
					# Login forbidden
					redirect('Front/login/login_forbiden');
					exit;
				}
					
				# Login succeed
    			$_SESSION[$this->default_user] = $user;
    			
    			# Update
    			$data['id'] = $user['id'];
    			$data['last_login'] = date("Y-m-d H:i:s");
    			$UserModel->update($data);

    			redirect('Players/view/'.$user['id']);
			}
		}
		
		$this->js[] = array('file' => 'jquery.validate.min.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
		$this->js[] = array('file' => 'front.js', 'path' => JS_PATH);
		
		return false;
	}
	
	function logout() {
		if ($this->isLoged())
        {
        	unset($_SESSION[$this->default_user]);
        	redirect('Front/login');
            exit;
        } else {
        	redirect('Front/login');
            exit;
        }
	}
	
	function rankings() {
		$this->tpl['ranking'] = $this->getRanking('30');
	}
	
	function local($iso) {
		if (in_array(strtolower($iso), array('en')))
		{
			$_SESSION[$this->default_language] = $iso;
		}
				
		header("Location: " . $_SESSION['PHP_SELF'] . "?controller=Front&action=index");
		exit;
	}
	
	function getRanking($limit='') {
		Object::import('Model', array('Rank', 'Option'));
		$rankModel = new RankModel();
		$optionModel = new OptionModel();
		
		$options = $optionModel->getAll();
		$ranking = array();
		
		if ($options['show_overall'] == 'T') {
			$ranking['overall'] = $rankModel->getOverallStat($limit);
		}

		if ($options['show_18TAvg'] == 'T') {
			$ranking['18_tournament_avg'] = $rankModel->get18TAvgStat($limit);
		}

		if ($options['show_18Anv'] == 'T') {
			$ranking['18_avg'] = $rankModel->get18AvgStat($limit);
		}

		if ($options['show_9Avg'] == 'T') {
			$ranking['9_avg'] = $rankModel->get9AvgStat($limit);
		}
		
		if ($options['show_handicap'] == 'T') {
			$ranking['handicap_index'] = $rankModel->getHandicapStat($limit);
		}

		if ($options['show_fir'] == 'T') {
			$ranking['fir'] = $rankModel->getFirStat($limit);
		}

		if ($options['show_gir'] == 'T') {
			$ranking['gir'] = $rankModel->getGirStat($limit);
		}

		if ($options['show_ppg'] == 'T') {
			$ranking['ppg'] = $rankModel->getPpgStat($limit);
		}

		if ($options['show_ppr'] == 'T') {
			$ranking['ppr'] = $rankModel->getPprStat($limit);
		}

		if ($options['show_ups'] == 'T') {
			$ranking['up_and_down'] = $rankModel->getUpStat($limit);
		}

		if ($options['show_sand_save'] == 'T') {
			$ranking['sand_saves'] = $rankModel->getSandSavesStat($limit);
		}

		if ($options['show_par_or_better'] == 'T') {
			$ranking['par_or_better'] = $rankModel->getParOrBetterStat($limit);
		}

		if ($options['show_par_breakers'] == 'T') {
			$ranking['par_breakers'] = $rankModel->getParBreakersStat($limit);
		}
		
		if ($options['show_pspr'] == 'T') {
			$ranking['pspr'] = $rankModel->getPsprStat($limit);
		}

		if ($options['show_par3avg'] == 'T') {
			$ranking['par_three_avg'] = $rankModel->getPar3Stat($limit);
		}

		if ($options['show_par4avg'] == 'T') {
			$ranking['par_four_avg'] = $rankModel->getPar4Stat($limit);
		}

		if ($options['show_par5avg'] == 'T') {
			$ranking['par_five_avg'] = $rankModel->getPar5Stat($limit);
		}
		
		return $ranking;
	}
}