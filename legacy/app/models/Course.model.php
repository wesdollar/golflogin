<?php
require_once MODELS_PATH . 'App.model.php';

class CourseModel extends AppModel
{
	var $primaryKey = 'id';
	
	var $table = 'gtm_courses';

	var $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'course_title', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'tee_box', 'type' => 'varchar', 'default' => ':NULL'),
		
		array('name' => 'usga_rating', 'type' => 'decimal', 'default' => '0'),
		array('name' => 'slop_rating', 'type' => 'decimal', 'default' => '0')
	);

	function __construct() {
		parent::__construct();
	}
	
	/**
	 * Overwrites Model::save()
	 * @see Model::save()
	 * @param $data - array()
	 * @param $custom - sql query
	 */
	function save($data, $custom = null) {
		$save = array();
		
		foreach ($this->schema as $field) {
			if (isset($data[$field['name']])) {
				$save[] = "`".$field['name']."` = '" . $this->escape($data[$field['name']], null, $field['type']) . "'";
			} else {
				$save[] = "`".$field['name']."` = " . (strpos($field['default'], ":") === 0 ? substr($field['default'], 1) : "'".$this->escape($field['default'], null, $field['type'])."'");
			}
		}
		
		if (count($save) > 0) {
			mysqli_query($this->link, "INSERT IGNORE INTO `".$this->getTable()."` SET " . join(",", $save) . " " . $custom) or die(mysqli_error($this->link));
			
			if (mysqli_affected_rows($this->link) == 1) {

				$_id = mysqli_insert_id($this->link);
				
				# load course hole model
				Object::import('Model', array('CourseHole'));
				$courseHoleModel = new CourseHoleModel();
				
				# build data array
				$holesData = array();
				
				foreach (range(1, 18) as $i) {
					$holesData[$i]['course_id'] = intval($_id);
					$holesData[$i]['hole_number'] = intval($i);
					$holesData[$i]['par'] = intval($_POST['par'][$i]);
					$holesData[$i]['yardage'] = intval($_POST['yardage'][$i]);
				}
				
				# insert hole
				$courseHoleModel->save($holesData);
								
				return $_id;
			}
		}
		
		return false;
	}
	
	/**
	 * Overwrites Model::get()
	 * @see Model::get()
	 * @param $id - course ID
	 * @return array() - course with specific ID or false if not found
	 */
	function get($id) {
		$course = parent::get($id);
		$course['par'] = 0;
		
		if ($course) {
			Object::import('Model', array('CourseHole'));
			$courseHoleModel = new CourseHoleModel();
			
			$holes = $courseHoleModel->getAll(array('course_id' => intval($course['id'])));
			$par = 0;
			foreach ($holes as $h) {
				$par += intval($h['par']);
			}
			
			$course['par'] = $par;
		}
		
		return $course;		
	}
}
?>