<?php
require_once MODELS_PATH . 'App.model.php';

class UserModel extends AppModel
{
	var $primaryKey = 'id';
	
	var $table = 'gtm_users';
	
	var $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'role_id', 'type' => 'int', 'default' => 2),
		array('name' => 'username', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'password', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'name', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'email', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'birth', 'type' => 'date', 'default' => ':NULL'),
		array('name' => 'classification', 'type' => 'enum', 'default' => 'RS Freshman'),
		array('name' => 'town', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'dexterity', 'type' => 'enum', 'default' => 'R'),
		array('name' => 'phone', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'shirt_size', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'pant_size_waist', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'pant_size_length', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'shoe_size', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'glove_size', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'image', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'created', 'type' => 'datetime', 'default' => ':NOW()'),
		array('name' => 'last_login', 'type' => 'datetime', 'default' => ':NULL'),
		array('name' => 'status', 'type' => 'enum', 'default' => 'T')
	);

	function __construct() {
		parent::__construct();
	}
	
	function isUserExists($username) {
		$data['username'] = mysqli_real_escape_string($this->link, $username);
		$count = $this->getCount($data);
		
		if ($count <= 0) {
			return false;
		}
		
		return true;
	}
}
?>