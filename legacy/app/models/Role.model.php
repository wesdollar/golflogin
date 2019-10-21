<?php
require_once MODELS_PATH . 'App.model.php';
class RoleModel extends AppModel
{
	var $primaryKey = 'id';
	
	var $table = 'gtm_roles';
	
	var $schema = array(
		array('name' => 'id', 'type' => 'tinyint', 'default' => ':NULL'),
		array('name' => 'role', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'status', 'type' => 'enum', 'default' => 'T')
	);
}