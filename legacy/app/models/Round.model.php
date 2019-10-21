<?php
require_once MODELS_PATH . 'App.model.php';

class RoundModel extends AppModel
{
	var $primaryKey = 'id';
	
	var $table = 'gtm_rounds';
	
	var $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'user_id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'course_id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'type', 'type' => 'enum', 'default' => '18_STATS'),
		array('name' => 'date_played', 'type' => 'date', 'default' => ':NULL'),
		array('name' => 'date_added', 'type' => 'date', 'default' => ':NOW()'),
		array('name' => 'is_tournament', 'type' => 'enum', 'default' => 'F'), 
		array('name' => 'nine_start', 'type' => 'enum', 'default' => 'front')
	);
	
	function __construct() {
		parent::__construct();
	}
	
	function save($data = array()) {
		$_id = parent::save($data);

		if ($_id !== false && (int) $_id > 0) {
			Object::import('Model', array('RoundData'));
			$roundDataModel = new RoundDataModel();
			
			$roundDataModel->save($data['hole_data'], $_id);
			
			return $_id;
		}
		
		return false;
	}

    function delete($id) {
        parent::delete($id);
        return false;
    }
	
	function getLatest($user_id = 0, $limit = 10, $order = 'added') {
		
		Object::import('Model', array('User', 'RoundData', 'Course'));
		$userModel = new UserModel();
		$roundDataModel = new RoundDataModel();
		$courseModel = new CourseModel();
		
		$sqlAdd = '';
		$sqlLimit = '';
		$sqlOrder = '';
		
		if (!empty($user_id) && $user_id > 0) {
			$sqlAdd .= " AND r.user_id = ".intval($user_id)." ";
		}

		if (!empty($limit) && $limit > 0) {
			$sqlLimit .= " LIMIT ".intval($limit);
		}
		
		if ($order == 'added') {
			$sqlOrder .= " ORDER BY r.date_added DESC ";
		} elseif ($order == 'played') {
			$sqlOrder .= " ORDER BY r.date_played DESC ";
		}
		
		$query = "SELECT r.*, c.course_title, c.tee_box, u.name, u.id AS user_id, (SELECT SUM(strokes) FROM `".$roundDataModel->getTable()."` AS rd WHERE rd.round_id = r.id) AS score
					FROM `".$this->getTable()."` AS r 
					LEFT JOIN `".$userModel->getTable()."` AS u ON r.user_id = u.id 
					LEFT JOIN `".$courseModel->getTable()."` AS c ON r.course_id = c.id 
					WHERE 1 = 1
					".$sqlAdd."
					".$sqlOrder." 
					".$sqlLimit."";
		if ($this->debug) echo $query.'<br/>';
		$queryResult = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$result = array();

		while ($row = mysqli_fetch_assoc($queryResult)) {
            if ($row['user_id'] != NULL) {
                $result[] = $row;
            }
		}

		return $result;
	}
	
	function getPlayerLatest($options) {
		Object::import('Model', array('User', 'RoundData', 'Course'));
		$userModel = new UserModel();
		$roundDataModel = new RoundDataModel();
		$courseModel = new CourseModel();
		
		$sqlAdd = '';
		$sqlLimit = '';
		$sqlOrder = '';
		
		if (array_key_exists('user_id', $options) && $options['user_id'] > 0) {
			$sqlAdd .= " AND r.user_id = ".intval($options['user_id'])." ";
		}
		
		if (array_key_exists('date_from', $options) && !array_key_exists('date_to', $options))
		{
			$sqlAdd .= " AND r.date_played >= '".$options['date_from']."' ";
		} 
		elseif (!array_key_exists('date_from', $options) && array_key_exists('date_to', $options)) 
		{
			$sqlAdd .= " AND r.date_played <= '".$options['date_to']."' ";
		} 
		elseif (array_key_exists('date_from', $options) && array_key_exists('date_to', $options)) 
		{
			$sqlAdd .= " AND r.date_played BETWEEN '".$options['date_from']."' AND '".$options['date_to']."' ";
		}
		
		if (!empty($options['col_name']) && !empty($options['direction']) && in_array(strtoupper($options['direction']), array('ASC', 'DESC')))
		{
			$sqlOrder .= " ORDER BY ".$options['col_name']." " . strtoupper($options['direction']);
		}
		
		if (array_key_exists('offset', $options) && array_key_exists('row_count', $options))
		{
			$sqlLimit = "LIMIT " . intval($options['offset']) . ", " . intval($options['row_count']);
		} elseif (array_key_exists('limit', $options) && $options['limit'] > 0) {
			$sqlLimit = "LIMIT " . intval($options['offset']) . "";
		}
		
		$query = "SELECT r.*, c.course_title, c.tee_box, u.name, (SELECT SUM(strokes) FROM `".$roundDataModel->getTable()."` AS rd WHERE rd.round_id = r.id) AS score 
					FROM `".$this->getTable()."` AS r 
					LEFT JOIN `".$userModel->getTable()."` AS u ON r.user_id = u.id 
					LEFT JOIN `".$courseModel->getTable()."` AS c ON r.course_id = c.id 
					WHERE 1=1 
					".$sqlAdd."
					".$sqlOrder." 
					".$sqlLimit."";
		if ($this->debug) echo $query.'<br/>';
		$queryResult = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$result = array();
		
		while ($row = mysqli_fetch_assoc($queryResult)) {
			$result[] = $row;
		}
		
		return $result;
	}

    function getAll($user_id = 0, $limit = 10, $offset = null, $order = 'added') {

        Object::import('Model', array('User', 'RoundData', 'Course'));
        $userModel = new UserModel();
        $roundDataModel = new RoundDataModel();
        $courseModel = new CourseModel();

        $sqlAdd = '';
        $sqlLimit = '';
        $sqlOrder = '';

        if (!empty($user_id) && $user_id > 0) {
            $sqlAdd .= " AND r.user_id = ".intval($user_id)." ";
        }

        if (!empty($limit) && $limit > 0) {
            if ($offset == null) {
                $sqlLimit .= " LIMIT ".intval($limit);
            }
            else {
                $sqlLimit .= " LIMIT ".intval($limit) . ", " . intval($offset);
            }
        }

        if ($order == 'added') {
            $sqlOrder .= " ORDER BY r.date_added DESC ";
        } elseif ($order == 'played') {
            $sqlOrder .= " ORDER BY r.date_played DESC ";
        }

        $query = "SELECT r.*, c.course_title, c.tee_box, u.name, u.id AS user_id, (SELECT SUM(strokes) FROM `".$roundDataModel->getTable()."` AS rd WHERE rd.round_id = r.id) AS score
					FROM `".$this->getTable()."` AS r
					LEFT JOIN `".$userModel->getTable()."` AS u ON r.user_id = u.id
					LEFT JOIN `".$courseModel->getTable()."` AS c ON r.course_id = c.id
					WHERE 1 = 1
					".$sqlAdd."
					".$sqlOrder."
					".$sqlLimit."";
        if ($this->debug) echo $query.'<br/>';
        $queryResult = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
        $result = array();

        while ($row = mysqli_fetch_assoc($queryResult)) {
            if ($row['user_id'] != NULL) {
                $result[] = $row;
            }
        }

        return $result;
    }

}
?>