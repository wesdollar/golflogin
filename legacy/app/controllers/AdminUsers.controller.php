<?php
require_once CONTROLLERS_PATH . 'Admin.controller.php';

class AdminUsers extends Admin
{
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
						$data['password']   = sha1($_POST['password'] . $this->salt);
							
						$id = $UserModel->save(array_merge($_POST, $data));
							
						if ($id !== false && (int) $id > 0)
						{
							header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminUsers&action=index&message=5");
							exit;
						}
					} else {
						$_GET['error'] = 1;
					}
				}

				Object::import('Model', array('Role'));
				$RoleModel = new RoleModel();
				$this->tpl['role_arr'] = $RoleModel->getAll(array('t1.id' => array('(1, 3)', 'IN', 'null')));

				$this->js[] = array('file' => 'jquery.validate.min.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
				$this->js[] = array('file' => 'adminUsers.js', 'path' => JS_PATH);
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
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminUsers&action=index&error=7");
					exit;
				}

				if ($UserModel->delete($id))
				{
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminUsers&action=index&message=6");
					exit;
				} else {
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminUsers&action=index&error=8");
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
				
				if (!empty($_GET['role_id'])) {
					$opts['t1.role_id'] = @$_GET['role_id'];
				} else {
					$opts['t1.role_id'] = array('(1, 3)', 'IN', 'null');
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
				$this->tpl['role_arr'] = $RoleModel->getAll(array('t1.id' => array('(1, 3)', 'IN', 'null')));

				$this->js[] = array('file' => 'adminUsers.js', 'path' => JS_PATH);
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
						
					$UserModel->update(array_merge($_POST, $data));
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminUsers&action=index&message=7");
					exit;

				} else {
					$arr = $UserModel->get($id);
					$this->tpl['arr'] = $arr;
						
					Object::import('Model', array('Role'));
					$RoleModel = new RoleModel();
					$this->tpl['role_arr'] = $RoleModel->getAll(array('t1.id' => array('(1, 3)', 'IN', 'null')));
						
					$this->js[] = array('file' => 'jquery.validate.min.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
					$this->js[] = array('file' => 'adminUsers.js', 'path' => JS_PATH);
				}
			} else {
				$this->tpl['error'] = 2;
			}
		} else {
			$this->tpl['error'] = 3;
		}
	}
}