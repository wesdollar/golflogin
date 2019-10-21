<?php
require_once CONTROLLERS_PATH . 'Admin.controller.php';

class AdminPlayers extends Admin
{
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

	function create()
	{
		if ($this->isLoged())
		{
			if ($this->isAdmin())
			{
				if (isset($_POST['user_create']))
				{
					Object::import('Model', 'User');
					$UserModel = new UserModel();
					
					if (!$UserModel->isUserExists($_POST['username'])) {
						$data = array();
						$_tempPass = !empty($_POST['password']) ? $_POST['password'] : $this->getRandomPassword(6);
						$data['password'] = sha1($_tempPass . $this->salt);
						$data['role_id'] = 2;
						
						$data['birth'] = '';
						if (!empty($_POST['dob_day']) && !empty($_POST['dob_month']) && !empty($_POST['dob_year'])) {
							$data['birth'] = date('Y-m-d', mktime(0, 0, 0, intval($_POST['dob_month']), intval($_POST['dob_day']), intval($_POST['dob_year'])));
						}
						
						$uploadData = $this->uploadProfilePicture();
						
						if ($uploadData['filename'] !== false) {
							$data['image'] = $uploadData['filename'];
						}
						
						$id = $UserModel->save(array_merge($_POST, $data));
						
						if ($id !== false && (int) $id > 0)
						{
							// Send email to player with his user details
							$emailData = array_merge($_POST, $data);

							$search = array(
								'{USERNAME}',
								'{PASSWORD}',
								'{NAME}',
								'{EMAIL}',
								'{DOB}',
								'{CLASS}',
								'{TOWN}',
								'{DEXTERITY}',
								'{PHONE}',
								'{SHIRT_SIZE}',
								'{PANT_SIZE_WAIST}',
								'{PANT_SIZE_LENGTH}',
								'{SHOE_SIZE}',
								'{GLOVE_SIZE}',
							);
							
							$replace = array(
								$emailData['username'], 
								$_tempPass, 
								$emailData['name'], 
								$emailData['email'], 
								$emailData['birth'], 
								!empty($emailData['classification']) ? $emailData['classification'] : '',
								$emailData['town'], 
								$emailData['dexterity'], 
								$emailData['phone'], 
								$emailData['shirt_size'], 
								$emailData['pant_size_waist'], 
								$emailData['pant_size_length'], 
								$emailData['shoe_size'], 
								$emailData['glove_size']
							);
							
							Object::import('Component', 'Email');
							$Email = new Email();

                            Object::import('Model', 'System');
                            $systemModel = new SystemModel();
                            $settings = $systemModel->getSettings();
                            $settings = $settings[0];
							
							# Prep message
                            $message = 'You\'ve been added as a Golf Login player for ' . $settings['pageTitle'] . '. Your credentials are below along with a message from your coach. Use this link to login:' . "\n\n" . SCHOOL_URL . "\n\n";
							$message .= str_replace($search, $replace, $this->option_arr['email_user_added_body']);

							# Send to PLAYER
							if (!empty($emailData['email'])) {
								$Email->send($emailData['email'], $this->option_arr['email_user_added_subject'], $message, $emailData['email']);
							}
							
							Object::import('Model', 'Rank');
							$rankModel = new RankModel();
							
							$rankModel->save(array('user_id' => $id));
														
							header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminPlayers&action=index&message=" . ($uploadData['error'] === false ? 1 : 9));
							exit;
						}
					} else {
						$_GET['error'] = 1;
					}
				}

				$this->js[] = array('file' => 'jquery.validate.min.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
				$this->js[] = array('file' => 'adminPlayers.js', 'path' => JS_PATH);
			} else {
				$this->tpl['error'] = 2;
			}
		} else {
			$this->tpl['error'] = 3;
		}
	}

	function delete($id)
	{
		if ($this->isLoged())
		{
			if ($this->isAdmin())
			{
				Object::import('Model', 'User');
				$UserModel = new UserModel();

				$arr = $UserModel->get($id);
				if (count($arr) == 0)
				{
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminPlayers&action=index&error=4");
					exit;
				}

				if ($UserModel->delete($id))
				{
					if (!empty($arr['image']) && is_file(PROFILE_IMAGES_PATH . $arr['image'])) {
						unlink(PROFILE_IMAGES_PATH . $arr['image']);					
					}
					
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminPlayers&action=index&message=2");
					exit;
				} else {
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminPlayers&action=index&error=5");
					exit;
				}
			} else {
				$this->tpl['error'] = 2;
			}
		} else {
			$this->tpl['error'] = 3;
		}
	}

	function index()
	{
		if ($this->isLoged())
		{
			if ($this->isAdmin())
			{
				Object::import('Model', 'User');
				$UserModel = new UserModel();

				Object::import('Model', 'Role');
				$RoleModel = new RoleModel();

				$opts = array();
				$opts['t1.role_id'] = 2;
				
				if (!empty($_REQUEST['q'])) {
					$opts['t1.name'] = array("'%" . $_REQUEST['q'] . "%'", 'LIKE', 'null');
				}
				
				$page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
				$count = $UserModel->getCount($opts);
				$row_count = 20;
				$pages = ceil($count / $row_count);
				$offset = ((int) $page - 1) * $row_count;

				$UserModel->addJoin($UserModel->joins, $RoleModel->getTable(), 'TR', array('TR.id' => 't1.role_id'), array('TR.role'));
				$arr = $UserModel->getAll(array_merge($opts, array('offset' => $offset, 'row_count' => $row_count, 'col_name' => 't1.id', 'direction' => 'desc')));

				$this->tpl['arr'] = $arr;
				$this->tpl['paginator'] = array('pages' => $pages);
				$this->tpl['role_arr'] = $RoleModel->getAll(array('t1.id' => 2));

				$this->js[] = array('file' => 'jquery.jeditable.min.js', 'path' => JS_PATH);
				$this->js[] = array('file' => 'adminPlayers.js', 'path' => JS_PATH);
                $this->css[] = array('file' => 'admin-common.css', 'path' => CSS_PATH);
			} else {
				$this->tpl['error'] = 2;
			}
		} else {
			$this->tpl['error'] = 3;
		}
	}

	function update($id=null)
	{
		if ($this->isLoged())
		{
			if ($this->isAdmin())
			{
				Object::import('Model', 'User');
				$UserModel = new UserModel();

				if (isset($_POST['user_update']))
				{
					$data = array();
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
						
					$UserModel->update(array_merge($_POST, $data));
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminPlayers&action=index&message=" . ($uploadData['error'] === false ? 3 : 11));
					exit;

				} else {
					$arr = $UserModel->get($id);
					
					if (!empty($arr['birth']) && $arr['birth'] != '0000-00-00') {
						$arr['dob_day'] = (int) date('d', strtotime($arr['birth']));
						$arr['dob_month'] = (int) date('m', strtotime($arr['birth']));
						$arr['dob_year'] = (int) date('Y', strtotime($arr['birth']));
					}
					
					$this->tpl['arr'] = $arr;
						
					$this->js[] = array('file' => 'jquery.validate.min.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
					$this->js[] = array('file' => 'adminPlayers.js', 'path' => JS_PATH);
				}
			} else {
				$this->tpl['error'] = 2;
			}
		} else {
			$this->tpl['error'] = 3;
		}
	}
	
	function inlineUpdate($id=null)
	{
		$this->isAjax = true;
		
		if ($this->isLoged())
		{
			if ($this->isAdmin())
			{
				if ($this->isXHR())
				{
					require_once LOCALE_PATH . $this->getLanguage() . '.php';
					
					Object::import('Model', 'User');
					$UserModel = new UserModel();
					
					list($field, $id) = explode('::', $_POST['id']);
					$value = $_POST['value'];
					
					if (!empty($field) && !empty($id) && !empty($value)) {
						$data[$field] = $value;
						$data['id'] = intval($id);
						
						if ($UserModel->update($data)) {
							if ($field == 'shirt_size') {
								echo $GTM_LANG['shirt_size'][intval($value)];
							} elseif ($field == 'glove_size') {
								echo $GTM_LANG['glove_size'][intval($value)];
							} else {
								echo $value;
							}
						}
					}
					
					exit;
				}
			} else {
				$this->tpl['error'] = 2;
			}
		} else {
			$this->tpl['error'] = 3;
		}
	}
	
	function deleteImage() {
		if ($this->isLoged())
		{
			if ($this->isAdmin())
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
						header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminPlayers&action=update&id=".intval($arr['id'])."&message=10");
					} else {
						header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminPlayers&action=update&id=".intval($arr['id'])."&error=9");
					}
				}
					
				//header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminPlayers&action=index");
				exit;
			} else {
				$this->tpl['error'] = 2;
			}
		} else {
			$this->tpl['error'] = 3;
		}
	}
}