<?php
require_once CONTROLLERS_PATH . 'Front.controller.php';

class News extends Front
{
	
	function index() {
		Object::import('Model', array('News'));
		$newsModel = new NewsModel;
		
		$this->tpl['news'] = $newsModel->getAll(array('col_name' => 't1.date_added', 'direction' => 'desc'));
	}
	
	function view() {
		Object::import('Model', array('News'));
		$newsModel = new NewsModel();
		
		$this->tpl['news'] = $newsModel->get(intval($_GET['id']));
	}
}