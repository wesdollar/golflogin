<?php
require_once MODELS_PATH . 'App.model.php';

class SystemModel extends AppModel
{
	var $primaryKey = 'id';
	
	var $table = 'gtm_settings';
	
	var $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'pageTitle', 'type' => 'varchar', 'default' => ':NULL'),
	);
	
	function getSettings() {
		return $this->getAll(array('offset' => 0, 'col_name' => 't1.pageTitle', 'direction' => 'desc'));
	}
}
?>