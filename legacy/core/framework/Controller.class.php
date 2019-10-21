<?php
require_once FRAMEWORK_PATH . 'Object.class.php';
class Controller extends Object
{
	var $tpl;
	
	var $js = array();
	
	var $css = array();
	
	var $default_user = 'admin_user';
	
	var $default_language = 'language';
	
	var $salt = '3E_!j^@#';
	
	var $layout = 'default';
	
	var $templatePath = null;
	
	var $template = null;

	var $isAjax = false;
	
	var $isDemo = false;
	
	var $_controller = 'Front';
	
	var $_action = 'index';
	
	function Controller()
	{
		
	}
	
	function beforeFilter()
	{
		
	}
	
	function beforeRender()
	{
		
	}
	
	function afterFilter()
	{
		
	}
	
	function afterRender()
	{
		
	}
	
	function index()
	{
		
	}
	
	function isAjax()
    {
    	return $this->isAjax;
    }
    
    function setController($controller) {
    	$this->_controller = $controller;
    }
    
    function setAction($action) {
    	$this->_action = $action;
    }
    
    function getController() {
    	return $this->_controller;
    }
    
 	function getAction() {
    	return $this->_action;
    }
    
    function getLayout()
    {
    	return $this->layout;
    }
    
    function getTemplatePath()
    {
    	return $this->templatePath;
    }
    
	function getTemplate()
    {
    	return $this->template;
    }
    
	function getLanguage()
    {
    	return (!empty($_SESSION[$this->default_language])) ? $_SESSION[$this->default_language] : 'en';
    }
    
	function getUserId()
    {
    	return isset($_SESSION[$this->default_user]) && array_key_exists('id', $_SESSION[$this->default_user]) ? $_SESSION[$this->default_user]['id'] : false;
    }
    
    function getRoleId()
    {
    	return isset($_SESSION[$this->default_user]) && array_key_exists('role_id', $_SESSION[$this->default_user]) ? $_SESSION[$this->default_user]['role_id'] : false;
    }
	
	function isLoged()
    {
        if (isset($_SESSION[$this->default_user]) && count($_SESSION[$this->default_user]) > 0)
        {
            return true;
	    }
	    return false;
    }
    
	function isAdmin()
    {
   		return $this->getRoleId() == 1;
    }
    
	function isDemo()
    {
   		return $this->isDemo;
    }

	function getFileExtension($str)
    {
    	$arrSegments = explode('.', $str); // may contain multiple dots
        $strExtension = $arrSegments[count($arrSegments) - 1];
        $strExtension = strtolower($strExtension);
        return $strExtension;
    }
    
    function isXHR()
    {
		return @$_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }
    
	function download($data, $name, $mimetype='', $filesize=false)
	{
	    // File size not set?
	    if ($filesize == false || !is_numeric($filesize))
	    {
	        $filesize = strlen($data);
	    }
	
	    // Mimetype not set?
	    if (empty($mimetype))
	    {
	        $mimetype = 'application/octet-stream';
	        //$mimetype = 'application/force-download';
	    }
		
	    // Start sending headers
	    header("Pragma: public"); // required
	    header("Expires: 0"); // no cache
	    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	    header("Cache-Control: private",false); // required for certain browsers
	    header("Content-Transfer-Encoding: binary");
	    header("Content-Type: " . $mimetype);
	    header("Content-Length: " . $filesize);
	    header("Content-Disposition: attachment; filename=\"" . $name . "\";" );
	
		// download
		echo $data;
		//die();
	}
	
	function getRandomPassword($n = 6, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890')
	{
		//TODO remove return to generate random password
		//return '3333';
		
		srand((double)microtime()*1000000);
		$m = strlen($chars);
		$randPassword = "";
		while($n--)
		{
			$randPassword .= substr($chars,rand()%$m,1);
		}
		
		return $randPassword;
	}
}
?>