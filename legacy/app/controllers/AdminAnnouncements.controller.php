<?php
require_once CONTROLLERS_PATH . 'Admin.controller.php';

class AdminAnnouncements extends Admin
{
	function uploadPicture() {
		# Profile image upload
		require_once COMPONENTS_PATH . 'Upload.component.php';
		$uploadData = array('error' => true, 'filename' => false);
		$filename = false;
		
		if (!empty($_FILES['image']['name'])) {
			$handle = new Upload($_FILES['image']);

			if ($handle->uploaded) {
				$filename = md5(uniqid(rand(), true));

				# RESIZE
				$handle->allowed = array('image/*');
				$handle->mime_check = true;
				$handle->file_new_name_body = $filename;
				$handle->image_convert = 'jpg';
				$handle->jpeg_quality = 75;
				$handle->image_resize = true;
				$handle->image_x = ANNOUNCEMENTS_IMAGE_MAX_WIDTH;
				$handle->image_y = ANNOUNCEMENTS_IMAGE_MAX_WIDTH;
				$handle->image_ratio_y = true;
				$handle->process(ANNOUNCEMENTS_IMAGE_PATH);
				
				# THUMB
				$handle->allowed = array('image/*');
				$handle->mime_check = true;
				$handle->file_new_name_body = $filename;
				$handle->image_convert = 'jpg';
				$handle->jpeg_quality = 75;
				$handle->image_resize = true;
				$handle->image_x = ANNOUNCEMENTS_IMAGE_THUMB_MAX_WIDTH;
				$handle->image_y = ANNOUNCEMENTS_IMAGE_THUMB_MAX_WIDTH;
				$handle->image_ratio_y = true;
				$handle->process(ANNOUNCEMENTS_IMAGE_PATH . '_thumbs/');

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
				if (isset($_POST['announcement_create']))
				{
					Object::import('Model', 'Announcement');
					$AnnouncementModel = new AnnouncementModel();
						
					$data = array();
					$data['date_added'] = date('Y-m-d H:i:s', time());
					$data['date_updated'] = date('Y-m-d H:i:s', time());
					
					$uploadData = $this->uploadPicture();

					if ($uploadData['filename'] !== false) {
						$data['ann_image'] = $uploadData['filename'];
					}

					$id = $AnnouncementModel->save(array_merge($_POST, $data));

					if ($id !== false && (int) $id > 0)
					{
						if (!empty($_REQUEST['send_to_players']) && intval($_REQUEST['send_to_players']) == 1) {
							Object::import('Model', array('User'));
							$userModel = new UserModel();
														
							$search = array(
								'{ANNOUNCEMENT_URL}'
							);
							
							$replace = array(
								ROOT_URL . 'Announcements/view/' . $id
							);
							
							Object::import('Component', 'Email');
							$Email = new Email();
							
							$message = str_replace($search, $replace, $this->option_arr['email_new_annoucement_body']);
							
							# Send to clients
							$opts = array();
							$opts['t1.role_id'] = 2;
							$players = $userModel->getAll(array_merge($opts, array('col_name' => 't1.name', 'direction' => 'ASC')));
							
							foreach ($players as $p) {
								$Email->send($p['email'], $this->option_arr['email_new_annoucement_subject'], $message, $this->option_arr['system_email']);
							}
						}
						
						header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminAnnouncements&action=index&message=" . ($uploadData['error'] === false ? 17 : 18));
						exit;
					}
				}
				
				Object::import('Model', 'AnnouncementCategory');
				$AnnouncementCategoryModel = new AnnouncementCategoryModel();
				$arr = $AnnouncementCategoryModel->getAll();
				
				$this->tpl['ann_categories'] = $arr;
				
				$this->js[] = array('file' => 'jquery.validate.min.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
				$this->js[] = array('file' => 'tiny_mce.js', 'path' => JS_PATH . 'tiny_mce/');
				$this->js[] = array('file' => 'adminAnnouncements.js', 'path' => JS_PATH);
			} else {
				$this->tpl['error'] = 2;
			}
		} else {
			$this->tpl['error'] = 3;
		}
	}

	function createCategory () {
		if ($this->isLoged())
		{
			if ($this->isAdmin())
			{
				if (isset($_POST['announcement_create_category']))
				{
					Object::import('Model', 'AnnouncementCategory');
					$AnnouncementCategoryModel = new AnnouncementCategoryModel();

					$data = array();
					
					$data['date_added'] = date('Y-m-d H:i:s');
					$data['date_updated'] = date('Y-m-d H:i:s');
					
					$id = $AnnouncementCategoryModel->save(array_merge($_POST, $data));

					if ($id !== false && (int) $id > 0)
					{
						header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminAnnouncements&action=indexCategories&message=13");
						exit;
					}
				}

				$this->js[] = array('file' => 'jquery.validate.min.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
				$this->js[] = array('file' => 'tiny_mce.js', 'path' => JS_PATH . 'tiny_mce/');
				$this->js[] = array('file' => 'adminAnnouncements.js', 'path' => JS_PATH);
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
				Object::import('Model', 'Announcement');
				$AnnouncementModel = new AnnouncementModel();

				$arr = $AnnouncementModel->get($id);
				if (count($arr) == 0)
				{
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminAnnouncements&action=index&error=42");
					exit;
				}

				if ($AnnouncementModel->delete($id))
				{
					if (!empty($arr['image']) && is_file(PROFILE_IMAGES_PATH . $arr['image'])) {
						unlink(ANNOUNCEMENTS_IMAGE_PATH . $arr['ann_image']);
						unlink(ANNOUNCEMENTS_IMAGE_PATH . '_thumbs/' . $arr['ann_image']);				
					}
					
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminAnnouncements&action=index&message=41");
					exit;
                } else {
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminAnnouncements&action=index&error=43");
					exit;
				}
			} else {
				$this->tpl['error'] = 2;
			}
		} else {
			$this->tpl['error'] = 3;
		}
	}
	
	function deleteCategory($id)
	{
		if ($this->isLoged())
		{
			if ($this->isAdmin())
			{
				Object::import('Model', 'AnnouncementCategory');
				$AnnouncementCategory = new AnnouncementCategoryModel();

				$arr = $AnnouncementCategory->get($id);
				if (count($arr) == 0)
				{
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminAnnouncements&action=indexCategories&error=10");
					exit;
				}

				if ($AnnouncementCategory->delete($id))
				{
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminAnnouncements&action=indexCategories&message=16");
					exit;
				} else {
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminAnnouncements&action=indexCategories&error=11");
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
				Object::import('Model', array('Announcement', 'AnnouncementCategory'));
				$AnnouncementModel = new AnnouncementModel();
				$AnnouncementCategoryModel = new AnnouncementCategoryModel();

				$opts = array();
				
				if (!empty($_REQUEST['q'])) {
					$opts['t1.ann_title'] = array("'%" . $_REQUEST['q'] . "%'", 'LIKE', 'null');
				}
				
				$page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
				$count = $AnnouncementModel->getCount($opts);
				$row_count = 20;
				$pages = ceil($count / $row_count);
				$offset = ((int) $page - 1) * $row_count;
				
				$AnnouncementModel->addJoin($AnnouncementModel->joins, $AnnouncementCategoryModel->getTable(), 'AC', array('AC.id' => 't1.ann_category_id'), array('AC.ann_category_title'));
				$arr = $AnnouncementModel->getAll(array_merge($opts, array('offset' => $offset, 'row_count' => $row_count, 'col_name' => 't1.date_added', 'direction' => 'desc')));

				$this->tpl['arr'] = $arr;
				$this->tpl['paginator'] = array('pages' => $pages);
                $this->css[] = array('file' => 'admin-common.css', 'path' => CSS_PATH);
				$this->js[] = array('file' => 'adminAnnouncements.js', 'path' => JS_PATH);
			} else {
				$this->tpl['error'] = 2;
			}
		} else {
			$this->tpl['error'] = 3;
		}
	}

	function indexCategories()
	{
		if ($this->isLoged())
		{
			if ($this->isAdmin())
			{
				Object::import('Model', 'AnnouncementCategory');
				$AnnouncementCategoryModel = new AnnouncementCategoryModel();

				$opts = array();

				if (!empty($_REQUEST['q'])) {
					$opts['t1.ann_category_title'] = array("'%" . $_REQUEST['q'] . "%'", 'LIKE', 'null');
				}

				$page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
				$count = $AnnouncementCategoryModel->getCount($opts);
				$row_count = 20;
				$pages = ceil($count / $row_count);
				$offset = ((int) $page - 1) * $row_count;

				$arr = $AnnouncementCategoryModel->getAll($opts);

				$this->tpl['arr'] = $arr;
				$this->tpl['paginator'] = array('pages' => $pages);

				$this->js[] = array('file' => 'adminAnnouncements.js', 'path' => JS_PATH);
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
				Object::import('Model', 'Announcement');
				$AnnouncementModel = new AnnouncementModel();

				if (isset($_POST['announcement_update']))
				{
					$data = array();
					$data['date_updated'] = date('Y-m-d H:i:s', time());
					
					$uploadData = $this->uploadPicture();

					if ($uploadData['filename'] !== false) {
						$data['ann_image'] = $uploadData['filename'];
					}
					
					$AnnouncementModel->update(array_merge($_POST, $data));
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminAnnouncements&action=index&message=" . ($uploadData['error'] === false ? 19 : 20));
					exit;

				} else {
					Object::import('Model', 'AnnouncementCategory');
					$AnnouncementCategoryModel = new AnnouncementCategoryModel();
					$categories = $AnnouncementCategoryModel->getAll();
					$this->tpl['ann_categories'] = $categories;
					
					$arr = $AnnouncementModel->get($id);
					$this->tpl['announcement'] = $arr;
						
					$this->js[] = array('file' => 'jquery.validate.min.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
					$this->js[] = array('file' => 'tiny_mce.js', 'path' => JS_PATH . 'tiny_mce/');
					$this->js[] = array('file' => 'adminAnnouncements.js', 'path' => JS_PATH);
				}
			} else {
				$this->tpl['error'] = 2;
			}
		} else {
			$this->tpl['error'] = 3;
		}
	}
	
	function updateCategory($id=null)
	{
		if ($this->isLoged())
		{
			if ($this->isAdmin())
			{
				Object::import('Model', 'AnnouncementCategory');
				$AnnouncementCategoryModel = new AnnouncementCategoryModel();

				if (isset($_POST['announcement_update_category']))
				{
					$data = array();
					$data['date_updated'] = date('Y-m-d H:i:s', time());
					
					$AnnouncementCategoryModel->update(array_merge($_POST, $data));
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminAnnouncements&action=indexCategories&message=15");
					exit;

				} else {
					$arr = $AnnouncementCategoryModel->get($id);
											
					$this->tpl['arr'] = $arr;

					$this->js[] = array('file' => 'jquery.validate.min.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
					$this->js[] = array('file' => 'tiny_mce.js', 'path' => JS_PATH . 'tiny_mce/');
					$this->js[] = array('file' => 'adminAnnouncements.js', 'path' => JS_PATH);
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
				Object::import('Model', 'Announcement');
				$AnnouncementModel = new AnnouncementModel();

				$arr = $AnnouncementModel->get($_GET['id']);
				if (count($arr) == 0)
				{
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminAnnouncements&action=index&error=12");
					exit;
				}

				$data['id'] = intval($_GET['id']);
				$data['ann_image'] = '';
				$AnnouncementModel->update($data);
				
				if (!empty($arr['ann_image']) && is_file(ANNOUNCEMENTS_IMAGE_PATH . $arr['ann_image'])) {
					unlink(ANNOUNCEMENTS_IMAGE_PATH . '_thumbs/' . $arr['ann_image']);
					
					if (unlink(ANNOUNCEMENTS_IMAGE_PATH . $arr['ann_image']) == true) {
						header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminAnnouncements&action=update&id=".intval($arr['id'])."&message=21");
					} else {
						header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminAnnouncements&action=update&id=".intval($arr['id'])."&error=22");
					}
				}
					
				//header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminAnnouncement&action=index");
				exit;
			} else {
				$this->tpl['error'] = 2;
			}
		} else {
			$this->tpl['error'] = 3;
		}
	}
}