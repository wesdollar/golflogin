<?php
require_once MODELS_PATH . 'App.model.php';

class AnnouncementModel extends AppModel
{
	var $primaryKey = 'id';
	
	var $table = 'gtm_announcements';
	
	var $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'ann_category_id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'ann_title', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'ann_body', 'type' => 'text', 'default' => ':NULL'),
		array('name' => 'ann_image', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'date_added', 'type' => 'timestamp', 'default' => ':NULL'),
		array('name' => 'date_updated', 'type' => 'timestamp', 'default' => ':NULL')
	);
	
	function getLatest() {
		return $this->getAll(array('offset' => 0, 'row_count' => 3, 'col_name' => 't1.date_added', 'direction' => 'desc'));
	}
}
?>