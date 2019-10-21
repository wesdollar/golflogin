<?php
require_once CONTROLLERS_PATH . 'Front.controller.php';

class Rounds extends Front
{

	function index() {
	}

	function view() {
	}

	function create() {
		if ($this->isLoged()) {
			
			Object::import('Model', array('Round'));
			$roundModel = new RoundModel();
						
			if (!empty($_POST['round_create'])) {
				# insert round
				
				$data = $this->buildSaveData($_POST);
				
				$id = $roundModel->save($data);

				if ($id !== false && (int) $id > 0) {
					include LOCALE_PATH . 'Rounds_en.php';
					
					Object::import('Model', array('Course', 'User', 'Option'));
					$courseModel = new CourseModel();
					$userModel = new UserModel();

					$course = $courseModel->get($data['course_id']);

                    // todo: remove if unused. Why is this here?
					$emailData = array_merge($_POST, $data);
					
					$search = array(
						'{USERNAME}',
						'{NAME}',
						'{STATS}',
						'{COURSE}',
						'{TOURNAMENT}',
						'{DATE_PLAYED}'
					);
					
					$replace = array(
						$_SESSION[$this->default_user]['username'],
						$_SESSION[$this->default_user]['name'], 
						$GTM_LANG['Rounds']['create']['round_types'][$data['type']],
						$course['course_title'], 
						$data['is_tournament'] == 'T' ? 'Yes' : 'No',
						$data['date_played']
					);
					
					Object::import('Component', 'Email');
					$Email = new Email();

                    Object::import('Model', 'Option');
                    $OptionModel = new OptionModel();
                    $options = $OptionModel->getAll();

                    $message = str_replace($search, $replace, $this->option_arr['email_new_round_added_body']);

					# Send to ADMIN
                    if ($options['new_round_admin_notify'] === 'T') {
                        // todo: loop through admins instead of sending to default system email address.
                        $Email->send($this->option_arr['system_email'], $this->option_arr['email_new_round_added_subject'], $message, $this->option_arr['system_email']);
                    }

					# Send to PLAYERS
					if ($options['new_round_player_notify'] === 'T') {
                        $opts = array();
                        $opts['t1.role_id'] = 2;
                        $players = $userModel->getAll(array_merge($opts, array('col_name' => 't1.name', 'direction' => 'ASC')));

                        foreach ($players as $p) {
                            $Email->send($p['email'], $this->option_arr['email_new_round_added_subject'], $message, $this->option_arr['system_email']);
                        }
                    }

					# Update Rank
					Object::import('Model', array('Rank'));
					$rankModel = new RankModel();
					
					//$rankModel->debug = 1;
					$rankModel->update(intval($_SESSION[$this->default_user]['id']));

					redirect('Rounds/viewCard/'. $id .'/round_created_success');
					exit;
				}
			}

			Object::import('Model', array('Course'));
			$courseModel = new CourseModel();
			
			$this->tpl['courses'] = $courseModel->getAll();
			
			$this->js[] = array('file' => 'jquery.ui.widget.min.js', 'path' => LIBS_PATH . 'jquery/ui/js/');
			$this->js[] = array('file' => 'jquery.validate.min.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
			$this->js[] = array('file' => 'rounds.js', 'path' => JS_PATH);
		} else {
			redirect('Front/login/not_logged_in');
		}
	}
	
	function update() {
		if ($this->isLoged()) {
			
			Object::import('Model', array('RoundData'));
			$roundDataModel = new RoundDataModel();
						
			if (!empty($_POST['round_update'])) {
				# insert round
				
				$data = $this->buildUpdateData($_POST);
				
				if ($roundDataModel->update($data['hole_data'])) {
					Object::import('Model', array('Rank'));
					$rankModel = new RankModel();
					
					//$rankModel->debug = 1;
					$rankModel->update(intval($_SESSION[$this->default_user]['id']));
					
					redirect('Rounds/update/' . intval($_REQUEST['round_id']) . '/round_update_success');
					exit;
				}

				redirect('Rounds/update/' . intval($_REQUEST['round_id']) . '/round_update_success_error');
				exit;
			}
			
			Object::import('Model', array('Round', 'Course', 'CourseHole', 'RoundData', 'User'));
			$roundModel = new RoundModel();
			$courseModel = new CourseModel();
			$courseHoleModel = new CourseHoleModel();
			$roundDataModel = new RoundDataModel();
			$playerModel = new UserModel();

			$this->tpl['round'] = $roundModel->get($_GET['id']);
			$this->tpl['player'] = $playerModel->get($this->tpl['round']['user_id']);
			$this->tpl['course'] = $courseModel->get($this->tpl['round']['course_id']);
			$this->tpl['holes'] = $courseHoleModel->getCourseHoles($this->tpl['round']['course_id'], true);
			$this->tpl['rholes'] = $roundDataModel->getAll(array('round_id' => $this->tpl['round']['id'], 'col_name' => 't1.hole_id', 'direction' => 'desc'));
			$this->tpl['owner_flag'] = intval($this->tpl['round']['user_id']) == intval($_SESSION[$this->default_user]['id']) ? true : false;
		} else {
			redirect('Front/login/not_logged_in');
		}
	}

    function delete() {
		if ($this->isLoged()) {

			Object::import('Model', array('RoundData', 'Round'));
            $roundModel = new RoundModel();

            $this->tpl['round'] = $roundModel->get($_GET['id']);
            $round = $this->tpl['round'];

            if ($round != null) {
                
                // die(print_r($round['user_id'])); // round user_id

                // compare user_ids
                $current = array();
                $current['user_id'] = intval($_SESSION[$this->default_user]['id']);

                // die(print_r($current['user_id'])); // session user

                if ($current['user_id'] != $round['user_id']) {
                    // Players/viewRounds/70
                    redirect('Front/index/round_no_access');
                    exit;
                }

                // delete the round ($round = round ID)
                $roundModel->delete($round);

                // delete round data based on round ID
                $roundDataModel = new RoundDataModel();
                $roundDataModel->delete($round);

                // update player rankings
                Object::import('Model', array('Rank'));
                $rankModel = new RankModel();

                // todo: create error message if return false
                $rankModel->update(intval($_SESSION[$this->default_user]['id']));

                redirect('Front/index/round_delete_success');
                exit;
            }

            else {
                redirect('Rounds/update/' . intval($round) . '/round_update_success_error');
                exit;
            }


			/*Object::import('Model', array('Round', 'Course', 'CourseHole', 'RoundData', 'User'));
			$roundModel = new RoundModel();
			$courseModel = new CourseModel();
			$courseHoleModel = new CourseHoleModel();
			$roundDataModel = new RoundDataModel();
			$playerModel = new UserModel();

			$this->tpl['round'] = $roundModel->get($_GET['id']);
			$this->tpl['player'] = $playerModel->get($this->tpl['round']['user_id']);
			$this->tpl['course'] = $courseModel->get($this->tpl['round']['course_id']);
			$this->tpl['holes'] = $courseHoleModel->getCourseHoles($this->tpl['round']['course_id'], true);
			$this->tpl['rholes'] = $roundDataModel->getAll(array('round_id' => $this->tpl['round']['id'], 'col_name' => 't1.hole_id', 'direction' => 'desc'));
			$this->tpl['owner_flag'] = intval($this->tpl['round']['user_id']) == intval($_SESSION[$this->default_user]['id']) ? true : false;*/
		} else {
			redirect('Front/login/not_logged_in');
		}
	}
	
	function card() {
		$this->isAjax = true;
		if (($this->isLoged()) || (intval($_POST['admin']) == 1)) {
			if ($this->isXHR()) {
				if (!empty($_POST['course_id'])) {
					Object::import('Model', array('Course'));
					$courseModel = new CourseModel();
						
					$this->tpl['course'] = $courseModel->get(intval($_POST['course_id']));

					if ($this->tpl['course']) {
						Object::import('Model', array('CourseHole'));
						$courseHoleModel = new CourseHoleModel();
						
						$this->tpl['holes'] = $courseHoleModel->getCourseHoles($this->tpl['course']['id']);
					}
				}
				
				$this->tpl['number_holes'] 	= $_POST['type'] == '18_STATS' || $_POST['type'] == '18_NO_STATS' ? 18 : 9;
				$this->tpl['show_stats'] 	= $_POST['type'] == '18_STATS' || $_POST['type'] == '9_STATS' ? true : false;

                return true;
			}
		} else {
			die('You must be logged in to view a scorecard.');
		}
        die('Direct access is not allowed.');
	}
	
	function buildSaveData($rowData) {
		$data = array();
		
		$data['user_id'] = intval($_SESSION[$this->default_user]['id']);
		$data['course_id'] = intval($rowData['course_id']);
		$data['type'] = $rowData['type'];
		$data['is_tournament'] = $rowData['is_tournament'];
		$data['nine_start'] = @$rowData['nine_start'];
		
		if (!empty($rowData['date_played_month']) && !empty($rowData['date_played_day']) && !empty($rowData['date_played_year'])) {
			$data['date_played'] = date('Y-m-d', mktime(0, 0, 0, intval($rowData['date_played_month']), intval($rowData['date_played_day']), intval($rowData['date_played_year'])));
		}
		
		foreach ($rowData['strokes'] as $hole_id => $hole_data) {
			$data['hole_data']['strokes'][$hole_id] = $hole_data;
		}
		
		foreach ($data['hole_data']['strokes'] as $hole_id => $hole_data) {
			if (!empty($rowData['putts']) && is_array($rowData['putts']) && array_key_exists($hole_id, $rowData['putts'])) {
				$data['hole_data']['putts'][$hole_id] = $rowData['putts'][$hole_id];
			} else {
				$data['hole_data']['putts'][$hole_id] = 0;
			}
			
			if (!empty($rowData['gir']) && is_array($rowData['gir']) && array_key_exists($hole_id, $rowData['gir'])) {
				$data['hole_data']['gir'][$hole_id] = $rowData['gir'][$hole_id];
			} else {
				$data['hole_data']['gir'][$hole_id] = 'NA';
			}
			
			if (!empty($rowData['fir']) && is_array($rowData['fir']) && array_key_exists($hole_id, $rowData['fir'])) {
				$data['hole_data']['fir'][$hole_id] = $rowData['fir'][$hole_id];
			} else {
				$data['hole_data']['fir'][$hole_id] = 'NA';
			}
			
			if (!empty($rowData['up_and_down']) && is_array($rowData['up_and_down']) && array_key_exists($hole_id, $rowData['up_and_down'])) {
				$data['hole_data']['up_and_down'][$hole_id] = $rowData['up_and_down'][$hole_id];
			} else {
				$data['hole_data']['up_and_down'][$hole_id] = 'NA';
			}
			
			if (!empty($rowData['sand_save']) && is_array($rowData['sand_save']) && array_key_exists($hole_id, $rowData['sand_save'])) {
				$data['hole_data']['sand_save'][$hole_id] = $rowData['sand_save'][$hole_id];
			} else {
				$data['hole_data']['sand_save'][$hole_id] = 'NA';
			}
			
			if (!empty($rowData['penalty_shots']) && is_array($rowData['penalty_shots']) && array_key_exists($hole_id, $rowData['penalty_shots'])) {
				$data['hole_data']['penalty_shots'][$hole_id] = intval($rowData['penalty_shots'][$hole_id]);
			} else {
				$data['hole_data']['penalty_shots'][$hole_id] = 0;
			}
		}
		
		return $data;
	}
	
	function buildUpdateData($rowData) {
		$data = array();
		
		foreach ($rowData['strokes'] as $key => $hole_data) {
			list($id, $round_id, $hole_id) = explode('-', $key);
			
			$data['hole_data'][$id]['id'] = intval($id);
			$data['hole_data'][$id]['round_id'] = intval($round_id);
			$data['hole_data'][$id]['hole_id'] = intval($hole_id);
			
			$data['hole_data'][$id]['strokes'] = $hole_data;
		}
		
		foreach ($data['hole_data'] as $key => $hole_data) {
			$_key = $hole_data['id'].'-'.$hole_data['round_id'].'-'.$hole_data['hole_id'];
			
			if (!empty($rowData['putts']) && is_array($rowData['putts']) && array_key_exists($_key, $rowData['putts'])) {
				$data['hole_data'][$key]['putts'] = $rowData['putts'][$_key];
			} else {
				$data['hole_data'][$key]['putts'] = 0;
			}
			
			if (!empty($rowData['gir']) && is_array($rowData['gir']) && array_key_exists($_key, $rowData['gir'])) {
				$data['hole_data'][$key]['gir'] = $rowData['gir'][$_key];
			} else {
				$data['hole_data'][$key]['gir'] = 'NA';
			}
			
			if (!empty($rowData['fir']) && is_array($rowData['fir']) && array_key_exists($_key, $rowData['fir'])) {
				$data['hole_data'][$key]['fir'] = $rowData['fir'][$_key];
			} else {
				$data['hole_data'][$key]['fir'] = 'NA';
			}
			
			if (!empty($rowData['up_and_down']) && is_array($rowData['up_and_down']) && array_key_exists($_key, $rowData['up_and_down'])) {
				$data['hole_data'][$key]['up_and_down'] = $rowData['up_and_down'][$_key];
			} else {
				$data['hole_data'][$key]['up_and_down'] = 'NA';
			}
			
			if (!empty($rowData['sand_save']) && is_array($rowData['sand_save']) && array_key_exists($_key, $rowData['sand_save'])) {
				$data['hole_data'][$key]['sand_save'] = $rowData['sand_save'][$_key];
			} else {
				$data['hole_data'][$key]['sand_save'] = 'NA';
			}
			
			if (!empty($rowData['penalty_shots']) && is_array($rowData['penalty_shots']) && array_key_exists($_key, $rowData['penalty_shots'])) {
				$data['hole_data'][$key]['penalty_shots'] = intval($rowData['penalty_shots'][$_key]);
			} else {
				$data['hole_data'][$key]['penalty_shots'] = 0;
			}
		}
		
		return $data;
	}
	
	function viewCard() {
		Object::import('Model', array('Round', 'Course', 'CourseHole', 'RoundData', 'User'));
		$roundModel = new RoundModel();
		$courseModel = new CourseModel();
		$courseHoleModel = new CourseHoleModel();
		$roundDataModel = new RoundDataModel();
		$playerModel = new UserModel();
		
		$this->tpl['round'] = $roundModel->get($_GET['id']);
		$this->tpl['player'] = $playerModel->get($this->tpl['round']['user_id']);
		$this->tpl['course'] = $courseModel->get($this->tpl['round']['course_id']);
		$this->tpl['holes'] = $courseHoleModel->getCourseHoles($this->tpl['round']['course_id'], true);
		$this->tpl['rholes'] = $roundDataModel->getAll(array('round_id' => $this->tpl['round']['id'], 'col_name' => 't1.hole_id', 'direction' => 'desc'));
		$this->tpl['owner_flag'] = !empty($_SESSION[$this->default_user]['id']) && intval($this->tpl['round']['user_id']) == intval($_SESSION[$this->default_user]['id']) ? true : false;
	}
}