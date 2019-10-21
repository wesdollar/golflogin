<?php
require_once MODELS_PATH . 'App.model.php';

class AnnouncementCategoryModel extends AppModel
{
	var $primaryKey = 'id';
	
	var $table = 'gtm_announcement_categories';
	
	var $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'ann_category_title', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'ann_category_description', 'type' => 'text', 'default' => ':NULL'),
		array('name' => 'date_added', 'type' => 'timestamp', 'default' => ':NULL'),
		array('name' => 'date_updated', 'type' => 'timestamp', 'default' => ':NULL')
	);
}
?>