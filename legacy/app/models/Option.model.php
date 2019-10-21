<?php
require_once MODELS_PATH . 'App.model.php';

class OptionModel extends AppModel
{
	var $primaryKey = 'id';
	
	var $table = 'gtm_options';
	
	var $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ''),
		array('name' => 'key', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'value', 'type' => 'varchar', 'default' => ':NULL')
	);
	
	var $fields = array(
		'system_email', 
		'required_front_login', 
		'new_round_admin_notify',
		'new_round_player_notify',
		'email_user_added_subject',
		'email_user_added_body',
		'email_new_round_added_subject',
		'email_new_round_added_body',
		'email_new_annoucement_subject',
		'email_new_annoucement_body',
		'show_overall', 
		'show_18TAvg', 
		'show_18Anv', 
		'show_9Avg', 
		'show_handicap', 
		'show_fir', 
		'show_gir', 
		'show_ppg', 
		'show_ppr', 
		'show_ups', 
		'show_sand_save', 
		'show_par_or_better', 
		'show_par_breakers', 
		'show_pspr', 
		'show_par3avg', 
		'show_par4avg', 
		'show_par5avg', 
		'show_total_rounds', 
		'show_eagles', 
		'show_birdies', 
		'show_pars', 
		'show_bogies', 
		'show_2xbogies', 
		'show_3xbogies'
	
	);
	
	function __construct() {
		parent::__construct();
	}
	
	function update($data) {
		if (!empty($data) && count($data) > 0 && count($data) >= count($this->fields)) {
			// remove old options
			$query = "DELETE FROM `".$this->table."`";
		    if ($this->debug) echo '<pre>'.$query.'</pre>';
			mysqli_query($this->link, $query) or die(mysqli_error($this->link));
			
			$sqlAdd = false;
			foreach ($this->fields as $field) {
				if (array_key_exists($field, $data)) {
					$sqlAdd[] = "('".mysqli_real_escape_string($this->link, $field)."', '".mysqli_real_escape_string($this->link, $data[$field])."')";
				}
			}
			
			if ($sqlAdd !== false && is_array($sqlAdd) && count($sqlAdd) > 0) {
				$query = "INSERT INTO `".$this->table."` (`key`, `value`) VALUES " . join(', ', $sqlAdd);
				if ($this->debug) echo '<pre>'.$query.'</pre>';
				mysqli_query($this->link, $query) or die(mysqli_error($this->link));
			}
		}
	}
	
	function getAll() {
		$options = array();
		
		$query = "SELECT * FROM `$this->table`";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		
		while ($row = mysqli_fetch_assoc($query_result)) {
			$options[$row['key']] = $row['value'];
		}
		
		return $options;
	}
}
?>