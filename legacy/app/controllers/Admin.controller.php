<?php
require_once CONTROLLERS_PATH . 'App.controller.php';
class Admin extends AppController
{
	var $layout             = 'admin';
	var $default_user       = 'admin_user';
	var $default_language   = 'admin_language';
	var $require_login      = true;
	
	function Admin($require_login=null)
	{
		if (!is_null($require_login) && is_bool($require_login))
		{
			$this->require_login = $require_login;
		}
		
		if ($this->require_login)
		{
			if (!$this->isLoged() && @$_GET['action'] != 'login')
			{
				header("Location: " . $_SERVER['PHP_SELF'] . "?controller=Admin&action=login");
				exit;
			}
		}
	}
	
	function beforeFilter()
	{
		$this->js[] = array('file' => 'jquery-1.5.2.min.js', 'path' => LIBS_PATH . 'jquery/');
		$this->css[] = array('file' => 'theme.css', 'path' => CSS_PATH);
		$this->css[] = array('file' => 'style.css', 'path' => CSS_PATH);
		
		Object::import('Model', 'Option');
		$OptionModel = new OptionModel();
		$this->models['Option'] = $OptionModel;
		$this->option_arr = $OptionModel->getAll();
		$this->tpl['option_arr'] = $this->option_arr;
	}
	
	function beforeRender()
	{
		
	}
	
	function index()
	{
		if ($this->isLoged())
		{
			if ($this->isAdmin())
			{
				header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminPlayers");
				exit;
			} else {
				$this->tpl['status'] = 2;
			}
		} else {
			$this->tpl['status'] = 1;
		}
	}
	
	function login()
	{
		$this->layout = 'admin_login';
		
		if (isset($_POST['login_user']))
		{
			Object::import('Model', array('User'));
			$UserModel = new UserModel();

			$opts['username'] = $_POST['login_username'];
			$opts['password'] = sha1($_POST['login_password'] . $this->salt);

			$user = $UserModel->getAll($opts);

			if (count($user) != 1)
			{
				# Login failed
				header("Location: " . $_SERVER['PHP_SELF'] . "?controller=Admin&action=login&err=1");
				exit;
			} else {
				$user = $user[0];
				unset($user['password']);
															
				if (!in_array($user['role_id'], array(1,2,3)))
				{
					# Login denied
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=Admin&action=login&err=2");
					exit;
				}
				
				if ($user['status'] != 'T')
				{
					# Login forbidden
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=Admin&action=login&err=3");
					exit;
				}
					
				# Login succeed
    			$_SESSION[$this->default_user] = $user;
    			
    			# Update
    			$data['id'] = $user['id'];
    			$data['last_login'] = date("Y-m-d H:i:s");
    			$UserModel->update($data);

    			if ($this->isAdmin())
    			{
	    			header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminPlayers&action=index");
	            	exit;
    			}
			}
		}
		$this->js[] = array('file' => 'jquery.validate.min.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
		$this->js[] = array('file' => 'admin.js', 'path' => JS_PATH);
		return false;
	}
	
	function logout()
	{
		if ($this->isLoged())
        {
        	unset($_SESSION[$this->default_user]);
        	header("Location: " . $_SERVER['PHP_SELF'] . "?controller=Admin&action=login");
            exit;
        } else {
        	header("Location: " . $_SERVER['PHP_SELF'] . "?controller=Admin&action=login");
            exit;
        }
	}
	
	function local($iso)
	{
		if (in_array(strtolower($iso), array('en')))
		{
			$_SESSION[$this->default_language] = $iso;
		}
				
		header("Location: " . $_SESSION['PHP_SELF'] . "?controller=Admin&action=index");
		exit;
	}
}