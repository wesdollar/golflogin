<?php
require_once CONTROLLERS_PATH . 'Front.controller.php';

class Announcements extends Front
{
	
	function index() {
		Object::import('Model', array('AnnouncementCategory'));
		$annCategoryModel = new AnnouncementCategoryModel;
		
		$this->tpl['categories'] = $annCategoryModel->getAll(array('col_name' => 't1.date_added', 'direction' => 'desc'));
	}
	
	function category() {
		Object::import('Model', array('Announcement'));
		$annModel = new AnnouncementModel();
		
		$this->tpl['announcements'] = $annModel->getAll(array('ann_category_id' => $_GET['id'], 'col_name' => 't1.date_added', 'direction' => 'desc'));
	}
	
	function view() {
		Object::import('Model', array('Announcement'));
		$annModel = new AnnouncementModel();
		
		$this->tpl['announcement'] = $annModel->get(intval($_GET['id']));
	}
}