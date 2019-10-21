<?php
require_once MODELS_PATH . 'App.model.php';

class RoundDataModel extends AppModel
{
	var $primaryKey = 'id';
	
	var $table = 'gtm_rounds_data';
	
	var $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'round_id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'hole_id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'strokes', 'type' => 'int', 'default' => '0'),
		array('name' => 'putts', 'type' => 'int', 'default' => '0'),
		array('name' => 'gir', 'type' => 'enum', 'default' => 'NA'),
		array('name' => 'fir', 'type' => 'enum', 'default' => 'NA'),
		array('name' => 'up_and_down', 'type' => 'enum', 'default' => 'NA'),
		array('name' => 'sand_save', 'type' => 'enum', 'default' => 'NA'),
		array('name' => 'penalty_shots', 'type' => 'int', 'default' => '0')
	);
	
	function __construct() {
		parent::__construct();
	}
	
	function save($data, $round_id) {
		
		if (!empty($round_id) && $round_id > 0 && $data && is_array($data) && count($data) > 0) {
			$queryArr = array();
			
			foreach ($data['strokes'] as $hole_id => $val) {
				$queryArr[] = "(NULL, 
								".intval($round_id).", 
								".intval($hole_id).", 
								".intval($val).", 
								'".mysqli_real_escape_string($this->link, $data['putts'][$hole_id])."', 
								'".mysqli_real_escape_string($this->link, $data['gir'][$hole_id])."', 
								'".mysqli_real_escape_string($this->link, $data['fir'][$hole_id])."', 
								'".mysqli_real_escape_string($this->link, $data['up_and_down'][$hole_id])."', 
								'".mysqli_real_escape_string($this->link, $data['sand_save'][$hole_id])."', 
								".intval($data['penalty_shots'][$hole_id]).")";
			}
			
			if (count($queryArr) > 0) {
				$query = "INSERT IGNORE INTO `".$this->getTable()."` 
							(`id`, `round_id`, `hole_id`, `strokes`, `putts`, `gir`, `fir`, `up_and_down`, `sand_save`, `penalty_shots`) 
							VALUES ".join(', ', $queryArr);
				mysqli_query($this->link, $query) or die(mysqli_error($this->link));
				return true;
			}
		}
		
		return false;
	}
	
	function update($data = array()) {
		if (!empty($data) && count($data) > 0) {
			foreach ($data as $id => $row) {
				$sql = "UPDATE `".$this->getTable()."` 
						SET `strokes` = ".intval($row['strokes']).",
							`putts` = ".intval($row['putts']).",
							`gir` = '".mysqli_real_escape_string($this->link, $row['gir'])."',
							`fir` = '".mysqli_real_escape_string($this->link, $row['fir'])."',
							`up_and_down` = '".mysqli_real_escape_string($this->link, $row['up_and_down'])."',
							`sand_save` = '".mysqli_real_escape_string($this->link, $row['sand_save'])."',
							`penalty_shots` = ".intval($row['penalty_shots'])."
						WHERE id = ".intval($row['id'])." 
							AND round_id = ".intval($row['round_id'])." 
							AND hole_id = ".intval($row['hole_id'])." 
						LIMIT 1";
				
				mysqli_query($this->link, $sql) or die(mysqli_error($this->link));
			}
				
			return true;
		}

		return false;
	}

    function delete($id) {
        $sql = "DELETE FROM " . $this->getTable() . " WHERE round_id='" . $id . "'";
        mysqli_query($this->link, $sql) or die(mysqli_error($this->link));
        return true;
    }
	
	function getAll($options=array())
	{
		$a_arr = array();
		$opts = $this->buildOpts($options);
		$sql_conditions = $opts['conditions'];
		
		$sql_limit = NULL;
		if (array_key_exists('offset', $options) && array_key_exists('row_count', $options))
		{
			$sql_limit = "LIMIT " . intval($options['offset']) . ", " . intval($options['row_count']);
		}
		
		if (!empty($options['col_name']) && !empty($options['direction']) && in_array(strtoupper($options['direction']), array('ASC', 'DESC')))
		{
			$sql_order = " ORDER BY ".$options['col_name']." " . strtoupper($options['direction']);
		} else {
			$sql_order = " ORDER BY `t1`.`id` DESC";
		}
		
		$sql_group = NULL;
		if (!empty($options['group_by']))
		{
			$sql_group = " GROUP BY " . $options['group_by'];
		}
		
	    $j = $this->buildJoins($a_arr);
	    $sql_join = $j['join'];
	    $sql_join_fields = $j['fields'];
    	
		$sql_subquery = null;
    	if (count($this->subqueries) > 0)
    	{
    		foreach ($this->subqueries as $v)
    		{
    			$sql_subquery .= ", (" . $v['query'] . ") AS `" . $v['alias'] . "`";
    			$a_arr[] = $v['alias'];
    		}
    	}
		
		$arr = array();
		$query = "SELECT `t1`.*
					$sql_join_fields
					$sql_subquery
					FROM `".$this->getTable()."` AS `t1`
					$sql_join
					WHERE 1=1 $sql_conditions
					$sql_group
					$sql_order
					$sql_limit
					";
		if ($this->debug) echo '<pre>'.$query.'</pre>';
		
		$r = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		if (mysqli_num_rows($r) > 0)
		{
			$i = 0;
			$f = $this->showColumns($this->getTable());
			for($j = 0; $j < count($f); $j++)
			{
				$a_arr[] = $f[$j]['field'];
			}
			while ($row = mysqli_fetch_object($r))
			{
				if (count($a_arr) > 0)
				{
					foreach ($a_arr as $v)
					{
						$arr[$row->hole_id][$v] = $row->$v;
					}
				}
				$i++;
			}
		}
		return $arr;
	}
	
}