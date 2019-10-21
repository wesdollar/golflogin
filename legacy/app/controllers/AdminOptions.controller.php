<?php
require_once CONTROLLERS_PATH . 'Admin.controller.php';
class AdminOptions extends Admin
{
	function index()
	{
		if ($this->isLoged())
		{
			if ($this->isAdmin())
			{
				Object::import('Model', array('Option'));
				$OptionModel = new OptionModel();
				
				$this->tpl['options'] = $OptionModel->getAll();
			} else {
				$this->tpl['status'] = 2;
			}
		} else {
			$this->tpl['status'] = 1;
		}
	}

	function email()
	{
		if ($this->isLoged())
		{
			if ($this->isAdmin())
			{
				Object::import('Model', array('Option'));
				$OptionModel = new OptionModel();

				$this->tpl['options'] = $OptionModel->getAll();
			} else {
				$this->tpl['status'] = 2;
			}
		} else {
			$this->tpl['status'] = 1;
		}
	}
	
	function update()
	{
		if ($this->isLoged())
		{
			if ($this->isAdmin())
			{
				if (isset($_POST['options_update']))
				{
					Object::import('Model', array('Option'));
					$OptionModel = new OptionModel();

					$options = $OptionModel->getAll();
					$OptionModel->update(array_merge($options, $_POST));
					
					$actionsArr = array('index', 'email', 'ranking');
					
					if (!empty($_REQUEST['refferer']) && in_array($_REQUEST['refferer'], $actionsArr)) {
						header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminOptions&action=".$_REQUEST['refferer']."&message=29");
					} else {
						header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminOptions&action=index&message=29");
					}
					
					exit;
				}
			} else {
				$this->tpl['status'] = 2;
			}
		} else {
			$this->tpl['status'] = 1;
		}
	}

	function ranking () {
		if ($this->isLoged())
		{
			if ($this->isAdmin())
			{
				Object::import('Model', array('Option'));
				$OptionModel = new OptionModel();

				$this->tpl['options'] = $OptionModel->getAll();
			} else {
				$this->tpl['status'] = 2;
			}
		} else {
			$this->tpl['status'] = 1;
		}
	}
}