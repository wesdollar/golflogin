<?php
require_once CONTROLLERS_PATH . 'Admin.controller.php';

class AdminNews extends Admin
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
				$handle->image_x = NEWS_IMAGE_MAX_WIDTH;
				$handle->image_y = NEWS_IMAGE_MAX_WIDTH;
				$handle->image_ratio_y = true;
				$handle->process(NEWS_IMAGE_PATH);
				
				# THUMB
				$handle->allowed = array('image/*');
				$handle->mime_check = true;
				$handle->file_new_name_body = $filename;
				$handle->image_convert = 'jpg';
				$handle->jpeg_quality = 75;
				$handle->image_resize = true;
				$handle->image_x = NEWS_IMAGE_THUMB_MAX_WIDTH;
				$handle->image_y = NEWS_IMAGE_THUMB_MAX_WIDTH;
				$handle->image_ratio_y = true;
				$handle->process(NEWS_IMAGE_PATH . '_thumbs/');

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
				if (isset($_POST['news_create']))
				{
					Object::import('Model', 'News');
					$NewsModel = new NewsModel();
						
					$data = array();
					$data['date_added'] = date('Y-m-d H:i:s', time());
					$data['date_updated'] = date('Y-m-d H:i:s', time());
					
					$uploadData = $this->uploadPicture();

					if ($uploadData['filename'] !== false) {
						$data['news_image'] = $uploadData['filename'];
					}

					$id = $NewsModel->save(array_merge($_POST, $data));

					if ($id !== false && (int) $id > 0)
					{
						header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminNews&action=index&message=" . ($uploadData['error'] === false ? 24 : 25));
						exit;
					}
				}
				
				$this->js[] = array('file' => 'jquery.validate.min.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
				$this->js[] = array('file' => 'tiny_mce.js', 'path' => JS_PATH . 'tiny_mce/');
				$this->js[] = array('file' => 'adminNews.js', 'path' => JS_PATH);
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
				Object::import('Model', 'News');
				$NewsModel = new NewsModel();

				$arr = $NewsModel->get($id);
				if (count($arr) == 0)
				{
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminNews&action=index&error=13");
					exit;
				}

				if ($NewsModel->delete($id))
				{
					if (!empty($arr['image']) && is_file(PROFILE_IMAGES_PATH . $arr['image'])) {
						unlink(NEWS_IMAGE_PATH . $arr['news_image']);
						unlink(NEWS_IMAGE_PATH . '_thumbs/' . $arr['news_image']);				
					}
					
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminNews&action=index&message=26");
					exit;
				} else {
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminNews&action=index&error=14");
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
				Object::import('Model', array('News'));
				$NewsModel = new NewsModel();

				$opts = array();
				
				if (!empty($_REQUEST['q'])) {
					$opts['t1.news_title'] = array("'%" . $_REQUEST['q'] . "%'", 'LIKE', 'null');
				}
				
				$page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
				$count = $NewsModel->getCount($opts);
				$row_count = 20;
				$pages = ceil($count / $row_count);
				$offset = ((int) $page - 1) * $row_count;
				
				$arr = $NewsModel->getAll(array_merge($opts, array('offset' => $offset, 'row_count' => $row_count, 'col_name' => 't1.date_added', 'direction' => 'desc')));

				$this->tpl['arr'] = $arr;
				$this->tpl['paginator'] = array('pages' => $pages);
				
				$this->js[] = array('file' => 'adminNews.js', 'path' => JS_PATH);
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
				Object::import('Model', 'News');
				$NewsModel = new NewsModel();

				if (isset($_POST['news_update']))
				{
					$data = array();
					$data['date_updated'] = date('Y-m-d H:i:s', time());
					
					$uploadData = $this->uploadPicture();

					if ($uploadData['filename'] !== false) {
						$data['news_image'] = $uploadData['filename'];
					}
					
					$NewsModel->update(array_merge($_POST, $data));
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminNews&action=index&message=" . ($uploadData['error'] === false ? 27 : 28));
					exit;

				} else {
					$arr = $NewsModel->get($id);
					$this->tpl['news'] = $arr;
						
					$this->js[] = array('file' => 'jquery.validate.min.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
					$this->js[] = array('file' => 'tiny_mce.js', 'path' => JS_PATH . 'tiny_mce/');
					$this->js[] = array('file' => 'adminNews.js', 'path' => JS_PATH);
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
				Object::import('Model', 'News');
				$NewsModel = new NewsModel();

				$arr = $NewsModel->get($_GET['id']);
				if (count($arr) == 0)
				{
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminNews&action=index&error=13");
					exit;
				}

				$data['id'] = intval($_GET['id']);
				$data['news_image'] = '';
				$NewsModel->update($data);
				
				if (!empty($arr['news_image']) && is_file(NEWS_IMAGE_PATH . $arr['news_image'])) {
					unlink(NEWS_IMAGE_PATH . '_thumbs/' . $arr['news_image']);
					
					if (unlink(NEWS_IMAGE_PATH . $arr['news_image']) == true) {
						header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminNews&action=update&id=".intval($arr['id'])."&message=21");
					} else {
						header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminNews&action=update&id=".intval($arr['id'])."&error=22");
					}
				}
					
				//header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminNews&action=index");
				exit;
			} else {
				$this->tpl['error'] = 2;
			}
		} else {
			$this->tpl['error'] = 3;
		}
	}
}