<?php
require_once MODELS_PATH . 'App.model.php';

class CourseHoleModel extends AppModel
{
	var $primaryKey = 'id';
	
	var $table = 'gtm_course_holes';
	
	var $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'course_id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'hole_number', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'par', 'type' => 'int', 'default' => '0'),
		array('name' => 'yardage', 'type' => 'int', 'default' => '0')
	);
	
	function __construct() {
		parent::__construct();
	}

	function save($data, $custom = null) {
		$save = array();

		foreach ($data as $key => $hole) {
			foreach ($this->schema as $field) {
				if (isset($hole[$field['name']])) {
					$save[$key][] = "'" . $this->escape($hole[$field['name']], null, $field['type']) . "'";
				} else {
					$save[$key][] = (strpos($field['default'], ":") === 0 ? substr($field['default'], 1) : "'".$this->escape($field['default'], null, $field['type'])."'");
				}
			}
		}
		
		if (count($save) > 0) {
			$sqlAdd = array();

			foreach ($save as $key => $val) {
				$sqlAdd[] = "(" . join(', ', $val) . ")";
			}
			
			if (count($sqlAdd) > 0) {
				$_values = array();
				
				foreach ($this->schema as $s) {
					$_values[] = "`" . $s['name'] . "`";
				}
				
				mysqli_query($this->link, "INSERT IGNORE INTO `".$this->getTable()."` (".join(', ', $_values).") VALUES " . join(",", $sqlAdd) . " " . $custom) or die(mysqli_error($this->link));

				return true;
			}
		}
		
		return false;
	}
	
	function getCourseHoles($course_id, $group = true) {
		$holes = array();
		$result = $this->getAll(array('course_id' => intval($course_id), 'col_name' => 't1.hole_number', 'direction' => 'asc'));
		
		if ($group === false) {
			return $result;
		}
		
		$counter = 1;
		foreach ($result as $key => $val) {
			if ($counter <= 9) {
				$type = 'front';
			} else {
				$type = 'back';
			}
			
			$holes[$type][$key] = $val;
			
			$counter++;
		}
		
		return $holes;
	}

    function delete($id) {
        mysqli_query($this->link, "DELETE FROM gtm_course_holes WHERE course_id='$id'") or die(mysqli_error($this->link));
        mysqli_query($this->link, "DELETe FROM gtm_rounds WHERE course_id='$id'") or die(mysqli_error($this->link));
        return true;
    }
}
?>