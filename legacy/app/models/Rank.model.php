<?php
require_once MODELS_PATH . 'App.model.php';

class RankModel extends AppModel
{
	var $primaryKey = 'id';
	
	var $table = 'gtm_ranks';
	
	var $user_id = null;
	
	var $roundModel = null;
	var $roundDataModel = null;

	var $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'user_id', 'type' => 'int', 'default' => ':NULL'),
		
		array('name' => 'rounds_played', 'type' => 'int', 'default' => '0'),
		array('name' => '18_tournament_avg', 'type' => 'decimal', 'default' => '0'),
		array('name' => '18_avg', 'type' => 'decimal', 'default' => '0'),
		array('name' => '9_avg', 'type' => 'decimal', 'default' => '0'),
		array('name' => 'fir', 'type' => 'decimal', 'default' => '0'),
		array('name' => 'gir', 'type' => 'decimal', 'default' => '0'),
		array('name' => 'ppg', 'type' => 'decimal', 'default' => '0'),
		array('name' => 'ppr', 'type' => 'decimal', 'default' => '0'),
		array('name' => 'up_and_down', 'type' => 'decimal', 'default' => '0'),
		array('name' => 'sand_saves', 'type' => 'decimal', 'default' => '0'),
		array('name' => 'par_or_better', 'type' => 'decimal', 'default' => '0'),
		array('name' => 'par_breakers', 'type' => 'decimal', 'default' => '0'),
		array('name' => 'par_three_avg', 'type' => 'decimal', 'default' => '0'),
		array('name' => 'par_four_avg', 'type' => 'decimal', 'default' => '0'),
		array('name' => 'par_five_avg', 'type' => 'decimal', 'default' => '0'),
		array('name' => 'eagles', 'type' => 'int', 'default' => '0'),
		array('name' => 'birdies', 'type' => 'int', 'default' => '0'),
		array('name' => 'pars', 'type' => 'int', 'default' => '0'),
		array('name' => 'bogies', 'type' => 'int', 'default' => '0'),
		array('name' => 'double_bogies', 'type' => 'int', 'default' => '0'),
		array('name' => 'three_over_par', 'type' => 'int', 'default' => '0'), 
		array('name' => 'handicap_index', 'type' => 'decimal', 'default' => '0'),
		array('name' => 'pspr', 'type' => 'decimal', 'default' => '0') // Penalty Shots per Round
	);
	
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * Update user rankings
	 * @see (core) Model::update()
	 * @return void
	 */
	function update($user_id) {
		$data = array();
		
		Object::import('Model', array('Round', 'RoundData'));
		
		$this->roundModel = new RoundModel();
		$this->roundDataModel = new RoundDataModel();
		
		$this->user_id = intval($user_id);
		
		$data['rounds_played'] 		= $this->calcRoundsPlayed();
		$data['18_tournament_avg'] 	= $this->calc18TAvg();
		$data['18_avg'] 			= $this->calc18Ang();
		$data['9_avg'] 				= $this->calc9Ang();
		$data['fir'] 				= $this->calcFIR();
		$data['gir'] 				= $this->calcGIR();
		$data['ppg'] 				= $this->calcPPG();
		$data['ppr'] 				= $this->calcPPR();
		$data['up_and_down'] 		= $this->calcUp();
		$data['sand_saves'] 		= $this->calcSandSave();
		$data['par_or_better'] 		= $this->calcParOrBetter();
		$data['par_breakers'] 		= $this->calcParBreakers();
		$data['par_three_avg'] 		= $this->calcParNAvg(3);
		$data['par_four_avg'] 		= $this->calcParNAvg(4);
		$data['par_five_avg'] 		= $this->calcParNAvg(5);
		$data['eagles'] 			= $this->calcEagles();
		$data['birdies'] 			= $this->calcBirdies();
		$data['pars'] 				= $this->calcPars();
		$data['bogies'] 			= $this->calcBogies();
		$data['double_bogies'] 		= $this->calc2xBogies();
		$data['three_over_par'] 	= $this->calc3OverPar();
		$data['pspr'] 				= $this->calcPSPR(); // Penalty Shots per Round
		
		foreach ($data as $key => $val) {
			$data[$key] = number_format($val, 2);
		}
		
		// Calculate handicap index because of number formating
		$data['handicap_index'] 	= $this->calcHandicapIndex();
		
		if ($this->debug == 1) {
			echo '<pre>';
			var_dump($data);
			echo '</pre>';
		}

        try {
            parent::update($data, array('user_id' => $this->user_id));
        }
        catch (Exception $e) {
            die('Failed to update player stats. ' . "\n\n" . $e->getMessage());
        }
		
	}
	
	/**
	 * 
	 * Calculate differentials
	 * @return array
	 */
	function calcDifferentials() {
		$query = "SELECT 
					r.id, 
					(SELECT (SUM(rd.strokes) - c.usga_rating) * 113 / c.slop_rating FROM `".$this->roundDataModel->getTable()."` AS rd WHERE rd.round_id = r.id LIMIT 1) AS differential
					FROM `".$this->roundModel->getTable()."` AS r 
					LEFT JOIN `gtm_courses` AS c 
						ON r.course_id = c.id 
					WHERE r.user_id = ".$this->user_id." 
						AND (r.type = '18_STATS' OR r.type = '18_NO_STATS') 
					ORDER BY r.date_played ASC 
					LIMIT 20";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$differentials = array();

		//TODO Remove || true
		if (mysqli_num_rows($query_result) >= 5 || true) {
			while ($row = mysqli_fetch_assoc($query_result)) {
				$differentials[$row['id']] = abs(number_format($row['differential'], 1));
			}
		}
		
		asort($differentials, SORT_NUMERIC);
				
		return $differentials; 
	}
	
	/**
	 * 
	 * Calculate handicap index
	 * @return float
	 */
	function calcHandicapIndex() {
		$index = 0;
		$differentials = $this->calcDifferentials();
		
		if ($differentials && count($differentials) >= 5) {
			$accepptableScores = count($differentials);
			$diffToBeUsed = 0;
			
			// Determine the number of Handicap Differential(s) to use
			
			switch ($accepptableScores) {
				case 5:
				case 6:
					$diffToBeUsed = 1; // Lowest 1
					break;
				case 7:
				case 8:
					$diffToBeUsed = 2; // Lowest 2
					break;
				case 9:
				case 10:
					$diffToBeUsed = 3; // Lowest 3
					break;
				case 11:
				case 12:
					$diffToBeUsed = 4; // Lowest 4
					break;
				case 13:
				case 14:
					$diffToBeUsed = 5; // Lowest 5
					break;
				case 15:
				case 16:
					$diffToBeUsed = 6; // Lowest 6
					break;
				case 17:
					$diffToBeUsed = 7; // Lowest 7
					break;
				case 18:
					$diffToBeUsed = 8; // Lowest 8
					break;
				case 19:
					$diffToBeUsed = 9; // Lowest 9
					break;
				case 20:
					$diffToBeUsed = 10; // Lowest 10
					break;
				default:
					$diffToBeUsed = 0; // Default value. The differntial array will be empty after next step
					break;
			}
			
			// Get just the number of differentials that we need based on number of Handicap Differential(s) to be used
			$differentials = array_slice($differentials, 0, $diffToBeUsed);
			
			// Average the Handicap Differential(s) being used
			$differentialsAvg = array_sum($differentials);
			
			$index = number_format($differentialsAvg * 0.96, 2);
			$index = substr($index, 0, strpos($index, '.') + 2);
			
			return $index;
		}
		
		return 0;
	}
	
	/**
	 * 
	 * Total number of rounds played
	 * @return integer
	 */
	function calcRoundsPlayed() {
		$query = "SELECT COUNT(*) AS total FROM `".$this->roundModel->getTable()."` WHERE `user_id` = ".$this->user_id." LIMIT 1";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$result = mysqli_fetch_assoc($query_result);
		
		if ($result) {
			return intval($result['total']);
		}
		
		return 0;
	}
	
	/**
	 * 
	 * Total number of stats rounds played
	 * @return integer
	 */
	function calcStatsRoundsPlayed() {
		$query = "SELECT COUNT(*) AS total FROM `".$this->roundModel->getTable()."` WHERE `user_id` = ".$this->user_id." AND (`type` = '18_STATS' OR `type` = '9_STATS') LIMIT 1";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$result = mysqli_fetch_assoc($query_result);
		
		if ($result) {
			return intval($result['total']);
		}
		
		return 0;
	}
	
	/**
	 * 
	 * 18 Hole Tournament Round Scoring Average
	 * @return float
	 */
	function calc18TAvg() {
		$query = "SELECT * FROM `".$this->roundModel->getTable()."` WHERE `user_id` = ".$this->user_id." AND is_tournament = 'T' AND (type = '18_STATS' || type = '18_NO_STATS') ";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$rounds = array();
		
		while ($row = mysqli_fetch_assoc($query_result)) {
			$rounds[] = intval($row['id']);
		}
		
		if ($rounds && count($rounds) > 0) {
			$query = "SELECT SUM(strokes) AS score FROM `".$this->roundDataModel->getTable()."` WHERE round_id IN (".join(', ', $rounds).") LIMIT 1";
			if ($this->debug == 1) echo $query."<br/>";
			$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
			$temp = mysqli_fetch_assoc($query_result);
			$score = intval($temp['score']);
			
			return $score / count($rounds);
		}
		
		return 0;
	}
	
	/**
	 * 
	 * 18 Hole Scoring Average 
	 * @return float
	 */
	function calc18Ang() {
		$query = "SELECT * FROM `".$this->roundModel->getTable()."` WHERE `user_id` = ".$this->user_id." AND (type = '18_STATS' || type = '18_NO_STATS') ";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$rounds = array();
		
		while ($row = mysqli_fetch_assoc($query_result)) {
			$rounds[] = intval($row['id']);
		}
		
		if ($rounds && count($rounds) > 0) {
			$query = "SELECT SUM(strokes) AS score FROM `".$this->roundDataModel->getTable()."` WHERE round_id IN (".join(', ', $rounds).") LIMIT 1";
			if ($this->debug == 1) echo $query."<br/>";
			$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
			$temp = mysqli_fetch_assoc($query_result);
			$score = intval($temp['score']);
			
			return $score / count($rounds);
		}
		
		return 0;
	}
	
	/**
	 * 
	 * 9 Hole Scoring Average
	 * @return float
	 */
	function calc9Ang() {
		$query = "SELECT * FROM `".$this->roundModel->getTable()."` WHERE `user_id` = ".$this->user_id." AND (type = '9_STATS' || type = '9_NO_STATS') ";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$rounds = array();
		
		while ($row = mysqli_fetch_assoc($query_result)) {
			$rounds[] = intval($row['id']);
		}
		
		if ($rounds && count($rounds) > 0) {
			$query = "SELECT SUM(strokes) AS score FROM `".$this->roundDataModel->getTable()."` WHERE round_id IN (".join(', ', $rounds).") LIMIT 1";
			if ($this->debug == 1) echo $query."<br/>";
			$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
			$temp = mysqli_fetch_assoc($query_result);
			$score = intval($temp['score']);
			
			return $score / count($rounds);
		}
		
		return 0;
	} 
	
	/**
	 * 
	 * Fairway in Regulation (%)
	 * @return float
	 */
	function calcFIR() {
		# get total fairways
		$query = "SELECT COUNT(*) AS total 
					FROM `".$this->roundModel->getTable()."` AS r 
					LEFT JOIN `".$this->roundDataModel->getTable()."` AS rd 
						ON r.id = rd.round_id 
					WHERE r.user_id = ".$this->user_id." 
						AND rd.fir <> 'NA' 
					LIMIT 1";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$temp = mysqli_fetch_assoc($query_result);
		$total = intval($temp['total']);
		
		if ($total > 0) {
			$query = "SELECT COUNT(*) AS total_hits 
						FROM `".$this->roundModel->getTable()."` AS r 
						LEFT JOIN `".$this->roundDataModel->getTable()."` AS rd 
							ON r.id = rd.round_id 
						WHERE r.user_id = ".$this->user_id." 
							AND rd.fir = 'YES' 
						LIMIT 1";
			if ($this->debug == 1) echo $query."<br/>";
			$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
			$temp = mysqli_fetch_assoc($query_result);
			$total_hits = intval($temp['total_hits']);
			
			return $total_hits / $total;
		}
		
		return 0;
	} 
	
	/**
	 * 
	 * Greens in Regulation (%)
	 * @return float
	 */
	function calcGIR() {
		$total = $this->calcTotalGreensPlayed();
		
		if ($total > 0) {
			$query = "SELECT COUNT(*) AS gir_count 
						FROM `".$this->roundModel->getTable()."` AS r 
						LEFT JOIN `".$this->roundDataModel->getTable()."` AS rd 
							ON r.id = rd.round_id 
						WHERE r.user_id = ".$this->user_id." 
							AND rd.gir = 'YES' 
						LIMIT 1";
			if ($this->debug == 1) echo $query."<br/>";
			$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
			$temp = mysqli_fetch_assoc($query_result);
			$gir_count = intval($temp['gir_count']);
			
			return $gir_count / $total;
		}
		
		return 0;
		
	}
	
	/**
	 * 
	 * Putts per Green (average)
	 * @return float
	 */
	function calcPPG() {
		$total = $this->calcTotalStatGreensPlayed();

		if ($total > 0) {
			$total_score = $this->calcTotalPutts();

			return $total_score / $total;
		}

		return 0;
	}
	
	/**
	 * 
	 * Putts per Round (average)
	 * @return float
	 */
	function calcPPR() {
		$total_score = $this->calcTotalPutts(true);
		//$total_greens = $this->calcTotalStatGreensPlayed();
		//$total_rounds = $this->calcRoundsPlayed();
		$total_rounds = $this->calcStatsRoundsPlayed();

		if ($total_rounds > 0) {
			return $total_score / $total_rounds;
		}

		return 0;
	}
	
	/**
	 * 
	 * Up & Down/Par Saves (%)
	 * @return float
	 */
	function calcUp() {
		$query = "SELECT COUNT(*) AS total 
					FROM `".$this->roundModel->getTable()."` AS r 
					LEFT JOIN `".$this->roundDataModel->getTable()."` AS rd 
						ON r.id = rd.round_id 
					WHERE r.user_id = ".$this->user_id." 
						AND rd.up_and_down = 'YES'
					LIMIT 1";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$temp = mysqli_fetch_assoc($query_result);
		$success_count = intval($temp['total']);
		
		if ($success_count > 0) {
			$query = "SELECT COUNT(*) AS total 
						FROM `".$this->roundModel->getTable()."` AS r 
						LEFT JOIN `".$this->roundDataModel->getTable()."` AS rd 
							ON r.id = rd.round_id 
						WHERE r.user_id = ".$this->user_id." 
							AND rd.up_and_down <> 'NA'
						LIMIT 1";
			if ($this->debug == 1) echo $query."<br/>";
			$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
			$temp = mysqli_fetch_assoc($query_result);
			$total_count = intval($temp['total']);
			
			return $success_count / $total_count;
		} 
		
		return 0;
	}
	
	/**
	 * 
	 * Sand Saves (%)
	 * @return float
	 */
	function calcSandSave() {
		$query = "SELECT COUNT(*) AS total 
					FROM `".$this->roundModel->getTable()."` AS r 
					LEFT JOIN `".$this->roundDataModel->getTable()."` AS rd 
						ON r.id = rd.round_id 
					WHERE r.user_id = ".$this->user_id." 
						AND rd.sand_save = 'YES'
					LIMIT 1";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$temp = mysqli_fetch_assoc($query_result);
		$success_count = intval($temp['total']);
		
		if ($success_count > 0) {
			$query = "SELECT COUNT(*) AS total 
						FROM `".$this->roundModel->getTable()."` AS r 
						LEFT JOIN `".$this->roundDataModel->getTable()."` AS rd 
							ON r.id = rd.round_id 
						WHERE r.user_id = ".$this->user_id." 
							AND rd.sand_save <> 'NA'
						LIMIT 1";
			if ($this->debug == 1) echo $query."<br/>";
			$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
			$temp = mysqli_fetch_assoc($query_result);
			$total_count = intval($temp['total']);
			
			return $success_count / $total_count;
		} 
		
		return 0;
	}
	
	/**
	 * 
	 * Par or better (%)
	 * @return float
	 */
	function calcParOrBetter() {
		$query = "SELECT COUNT(*) AS total 
					FROM `".$this->roundModel->getTable()."` AS r 
					LEFT JOIN `".$this->roundDataModel->getTable()."` AS rd 
						ON r.id = rd.round_id 
					LEFT JOIN `gtm_course_holes` AS ch 
						ON rd.hole_id = ch.id 
					WHERE r.user_id = ".$this->user_id." 
						AND rd.strokes <= ch.par 
					LIMIT 1";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$temp = mysqli_fetch_assoc($query_result);
		$better_count = intval($temp['total']);
		
		if ($better_count > 0) {
			$total = $this->calcTotalGreensPlayed();
			
			return $better_count / $total;
		}
		
		return 0;
	}
	
	/**
	 * 
	 * Par Breakers (%)
	 * @return float
	 */
	function calcParBreakers() {
		$query = "SELECT COUNT(*) AS total 
					FROM `".$this->roundModel->getTable()."` AS r 
					LEFT JOIN `".$this->roundDataModel->getTable()."` AS rd 
						ON r.id = rd.round_id 
					LEFT JOIN `gtm_course_holes` AS ch 
						ON rd.hole_id = ch.id 
					WHERE r.user_id = ".$this->user_id." 
						AND rd.strokes < ch.par
					LIMIT 1";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$temp = mysqli_fetch_assoc($query_result);
		$beaker_count = intval($temp['total']);
		
		if ($beaker_count > 0) {
			$total = $this->calcTotalGreensPlayed();
			
			return $beaker_count / $total;
		}
		
		return 0;
	}
	
	/**
	 * 
	 * Par "N" Average
	 * @param integer $par
	 * @return float
	 */
	function calcParNAvg($par = 3) {
		$query = "SELECT SUM(rd.strokes) AS total_strokes, COUNT(*) AS total 
					FROM `".$this->roundModel->getTable()."` AS r 
					LEFT JOIN `".$this->roundDataModel->getTable()."` AS rd 
						ON r.id = rd.round_id 
					LEFT JOIN `gtm_course_holes` AS ch 
						ON rd.hole_id = ch.id 
					WHERE r.user_id = ".$this->user_id." 
						AND ch.par = ".intval($par)."
					LIMIT 1";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$temp = mysqli_fetch_assoc($query_result);
		$total_strokes = intval($temp['total_strokes']);
		$total = intval($temp['total']);
		
		if ($total_strokes != 0 && $total != 0) {
			return $total_strokes / $total;
		}
		
		return 0;
	}
	
	/**
	 * 
	 * Total Eagles or better
	 * @return float
	 */
	function calcEagles() {
		$query = "SELECT COUNT(*) AS total 
					FROM `".$this->roundModel->getTable()."` AS r 
					LEFT JOIN `".$this->roundDataModel->getTable()."` AS rd 
						ON r.id = rd.round_id 
					LEFT JOIN `gtm_course_holes` AS ch 
						ON rd.hole_id = ch.id 
					WHERE r.user_id = ".$this->user_id." 
						AND ch.par - 2 >= rd.strokes
					LIMIT 1";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$temp = mysqli_fetch_assoc($query_result);
		$total = intval($temp['total']);
				
		return $total;
	}
	
	/**
	 * 
	 * Total Birdies
	 * @return float
	 */
	function calcBirdies() {
		$query = "SELECT COUNT(*) AS total 
					FROM `".$this->roundModel->getTable()."` AS r 
					LEFT JOIN `".$this->roundDataModel->getTable()."` AS rd 
						ON r.id = rd.round_id 
					LEFT JOIN `gtm_course_holes` AS ch 
						ON rd.hole_id = ch.id 
					WHERE r.user_id = ".$this->user_id." 
						AND ch.par - 1 = rd.strokes
					LIMIT 1";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$temp = mysqli_fetch_assoc($query_result);
		$total = intval($temp['total']);
				
		return $total;
	}
	
	/**
	 * 
	 * Total Pars
	 * @return float
	 */
	function calcPars() {
		$query = "SELECT COUNT(*) AS total 
					FROM `".$this->roundModel->getTable()."` AS r 
					LEFT JOIN `".$this->roundDataModel->getTable()."` AS rd 
						ON r.id = rd.round_id 
					LEFT JOIN `gtm_course_holes` AS ch 
						ON rd.hole_id = ch.id 
					WHERE r.user_id = ".$this->user_id." 
						AND ch.par = rd.strokes
					LIMIT 1";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$temp = mysqli_fetch_assoc($query_result);
		$total = intval($temp['total']);
				
		return $total;
	}
	
	/**
	 * 
	 * Total Bogies (1 over par)
	 * @return integer
	 */
	function calcBogies() {
		$query = "SELECT COUNT(*) AS total 
					FROM `".$this->roundModel->getTable()."` AS r 
					LEFT JOIN `".$this->roundDataModel->getTable()."` AS rd 
						ON r.id = rd.round_id 
					LEFT JOIN `gtm_course_holes` AS ch 
						ON rd.hole_id = ch.id 
					WHERE r.user_id = ".$this->user_id." 
						AND ch.par + 1 = rd.strokes
					LIMIT 1";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$temp = mysqli_fetch_assoc($query_result);
		$total = intval($temp['total']);
				
		return $total;
	}
	
	/**
	 * 
	 * Total Double bogies (2 over par)
	 * @return integer
	 */
	function calc2xBogies() {
		$query = "SELECT COUNT(*) AS total 
					FROM `".$this->roundModel->getTable()."` AS r 
					LEFT JOIN `".$this->roundDataModel->getTable()."` AS rd 
						ON r.id = rd.round_id 
					LEFT JOIN `gtm_course_holes` AS ch 
						ON rd.hole_id = ch.id 
					WHERE r.user_id = ".$this->user_id." 
						AND ch.par + 2 = rd.strokes
					LIMIT 1";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$temp = mysqli_fetch_assoc($query_result);
		$total = intval($temp['total']);
				
		return $total;
	}
	
	/**
	 * 
	 * Total other (3 over par or worse)
	 * @return integer
	 */
	function calc3OverPar() {
		$query = "SELECT COUNT(*) AS total 
					FROM `".$this->roundModel->getTable()."` AS r 
					LEFT JOIN `".$this->roundDataModel->getTable()."` AS rd 
						ON r.id = rd.round_id 
					LEFT JOIN `gtm_course_holes` AS ch 
						ON rd.hole_id = ch.id 
					WHERE r.user_id = ".$this->user_id." 
						AND ch.par + 3 <= rd.strokes
					LIMIT 1";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$temp = mysqli_fetch_assoc($query_result);
		$total = intval($temp['total']);
				
		return $total;
	}
	
	/**
	 * 
	 * Calculate penalty shots per round.
	 * @return float
	 */
	function calcPSPR() {
		$query = "SELECT COUNT(*) AS total 
					FROM `".$this->roundModel->getTable()."` AS r 
					WHERE r.user_id = ".$this->user_id." 
						AND (r.type = '18_STATS' OR r.type = '9_STATS') 
					LIMIT 1";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$temp = mysqli_fetch_assoc($query_result);
		$total_rounds = intval($temp['total']);
		
		if ($total_rounds > 0) {
			$query = "SELECT SUM(rd.penalty_shots) AS total_penalties 
						FROM `".$this->roundModel->getTable()."` AS r 
						LEFT JOIN `".$this->roundDataModel->getTable()."` AS rd 
							ON r.id = rd.round_id 
						WHERE r.user_id = ".$this->user_id." 
						LIMIT 1";
			if ($this->debug == 1) echo $query."<br/>";
			$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
			$temp = mysqli_fetch_assoc($query_result);
			$total_penalties = intval($temp['total_penalties']);
			
			return $total_penalties / $total_rounds;
		}
		
		return 0;
	}
	
	/**
	 * 
	 * Total greens played
	 * @return integer
	 */
	function calcTotalGreensPlayed() {
		$total = 0;
		
		$query = "SELECT COUNT(*) AS total 
					FROM `".$this->roundModel->getTable()."` AS r 
					LEFT JOIN `".$this->roundDataModel->getTable()."` AS rd 
						ON r.id = rd.round_id 
					WHERE r.user_id = ".$this->user_id." 
					LIMIT 1";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$temp = mysqli_fetch_assoc($query_result);
		$total = intval($temp['total']);
		
		return $total;
	}
	
	/**
	 * 
	 * Total greens played - only 18 & 9 stat
	 * @return integer
	 */
	function calcTotalStatGreensPlayed() {
		$total = 0;
		
		$query = "SELECT COUNT(*) AS total 
					FROM `".$this->roundModel->getTable()."` AS r 
					LEFT JOIN `".$this->roundDataModel->getTable()."` AS rd 
						ON r.id = rd.round_id 
					WHERE r.user_id = ".$this->user_id." 
						AND ( r.type = '18_STATS' || r.type = '9_STATS' )
					LIMIT 1";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$temp = mysqli_fetch_assoc($query_result);
		$total = intval($temp['total']);
		
		return $total;
	}
	
	/**
	 * 
	 * Calculate total score for all greens played
	 * @return float
	 */
	function calcTotalScore() {
		$query = "SELECT SUM(rd.strokes) AS total_score 
					FROM `".$this->roundModel->getTable()."` AS r 
					LEFT JOIN `".$this->roundDataModel->getTable()."` AS rd 
						ON r.id = rd.round_id 
					WHERE r.user_id = ".$this->user_id." 
					LIMIT 1";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		$temp = mysqli_fetch_assoc($query_result);
		$total_score = intval($temp['total_score']);
		
		return $total_score;
	}

    /**
     *
     * Calculate total putts for all greens played
     * @param string $multiplier default false, make true for per round
     * @return float
     */
    function calcTotalPutts($multiplier=NULL) {

        // total putts on all 9 holes stats
        $query = "SELECT SUM(rd.putts) AS total_score
					FROM `".$this->roundModel->getTable()."` AS r
					LEFT JOIN `".$this->roundDataModel->getTable()."` AS rd
						ON r.id = rd.round_id
					WHERE r.user_id = ".$this->user_id."
					    AND r.type='9_STATS'
					LIMIT 1";
        if ($this->debug == 1) echo $query."<br/>";
        $query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
        $temp = mysqli_fetch_assoc($query_result);
        $total_score9 = intval($temp['total_score']);

        // total putts on all 18 holes stats
        $query = "SELECT SUM(rd.putts) AS total_score
					FROM `".$this->roundModel->getTable()."` AS r
					LEFT JOIN `".$this->roundDataModel->getTable()."` AS rd
						ON r.id = rd.round_id
					WHERE r.user_id = ".$this->user_id."
					    AND r.type='18_STATS'
					LIMIT 1";
        if ($this->debug == 1) echo $query."<br/>";
        $query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
        $temp = mysqli_fetch_assoc($query_result);
        $total_score18 = intval($temp['total_score']);

        // total_score9 needs to be multiplied by 2 for putts per round stat
        if ($multiplier == true) {
            $total_score = ($total_score9 * 2) + $total_score18;
        }
        else {
            $total_score = $total_score9 + $total_score18;
        }

        return $total_score;
    }
	
	/**
	 * 
	 * Get overall statistic
	 * @return array
	 */
	function getOverallStat($limit='') {
		$result = array();
        $result2 = array();
		
		$query = "SELECT u.id, u.name, ((r.par_three_avg * 3) + (r.par_four_avg * 2) + (r.par_five_avg * 1) - (1.00 - r.fir))  AS overall
					FROM `gtm_users` AS u 
					LEFT JOIN `gtm_ranks` AS r 
						ON u.id = r.user_id 
					WHERE r.18_avg > 0
					ORDER BY overall ASC
					LIMIT 0, $limit";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		
		while ($row = mysqli_fetch_assoc($query_result)) {
			$result[$row['id']] = $row;
			$result[$row['id']]['overall'] = number_format($row['overall'], 2);
		}

		return $result;
	}
	
	/**
	 * 
	 * Get 18 Hole Tournament Round Scoring Average statistic
	 * @return array
	 */
	function get18TAvgStat($limit='') {
		$result = array();
		
		$query = "SELECT u.id, u.name, r.18_tournament_avg
					FROM `gtm_users` AS u 
					LEFT JOIN `gtm_ranks` AS r 
						ON u.id = r.user_id 
					WHERE r.18_tournament_avg > 0 
					ORDER BY r.18_tournament_avg ASC 
					LIMIT $limit";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		
		while ($row = mysqli_fetch_assoc($query_result)) {
			$result[$row['id']] = $row;
		}
		
		return $result;
	}
	
	/**
	 * 
	 * Get 18 Hole Scoring Average statistic
	 * @return array
	 */
	function get18AvgStat($limit='') {
		$result = array();
		
		$query = "SELECT u.id, u.name, r.18_avg
					FROM `gtm_users` AS u 
					LEFT JOIN `gtm_ranks` AS r 
						ON u.id = r.user_id 
					WHERE r.18_avg > 0 
					ORDER BY r.18_avg ASC 
					LIMIT $limit";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		
		while ($row = mysqli_fetch_assoc($query_result)) {
			$result[$row['id']] = $row;
		}
		
		return $result;
	}
	
	/**
	 * 
	 * Get 9 Hole Scoring Average statistic
	 * @return array
	 */
	function get9AvgStat($limit='') {

		$result = array();

		$query = "SELECT u.id, u.name, r.9_avg
					FROM `gtm_users` AS u 
					LEFT JOIN `gtm_ranks` AS r 
						ON u.id = r.user_id 
					WHERE r.9_avg > 0 
					ORDER BY r.9_avg ASC 
					LIMIT $limit";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		
		while ($row = mysqli_fetch_assoc($query_result)) {
			$result[$row['id']] = $row;
		}
		
		return $result;
	}
	
	/**
	 * 
	 * Get Estimated USGA Handicap statistic
	 * @return array
	 */
	function getHandicapStat($limit='') {
		$result = array();
		
		$query = "SELECT u.id, u.name, r.handicap_index
					FROM `gtm_users` AS u 
					LEFT JOIN `gtm_ranks` AS r 
						ON u.id = r.user_id 
					WHERE r.handicap_index > 0 
					ORDER BY r.handicap_index ASC 
					LIMIT $limit";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		
		while ($row = mysqli_fetch_assoc($query_result)) {
			$result[$row['id']] = $row;
		}
		
		return $result;
	}
	
	/**
	 * 
	 * Get Fairway in Regulation statistic
	 * @return array
	 */
	function getFirStat($limit='') {
		$result = array();
		
		$query = "SELECT u.id, u.name, r.fir
					FROM `gtm_users` AS u 
					LEFT JOIN `gtm_ranks` AS r 
						ON u.id = r.user_id 
					WHERE r.fir > 0 
					ORDER BY r.fir DESC 
					LIMIT $limit";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		
		while ($row = mysqli_fetch_assoc($query_result)) {
			$result[$row['id']] = $row;
		}
		
		return $result;
	}
	
	/**
	 * 
	 * Get Greens in Regulation statistic
	 * @return array
	 */
	function getGirStat($limit='') {
		$result = array();
		
		$query = "SELECT u.id, u.name, r.gir
					FROM `gtm_users` AS u 
					LEFT JOIN `gtm_ranks` AS r 
						ON u.id = r.user_id 
					WHERE r.gir > 0 
					ORDER BY r.gir DESC 
					LIMIT $limit";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		
		while ($row = mysqli_fetch_assoc($query_result)) {
			$result[$row['id']] = $row;
		}
		
		return $result;
	}
	
	/**
	 * 
	 * Get Putts per Green statistic
	 * @return array
	 */
	function getPpgStat($limit='') {
		$result = array();
		
		$query = "SELECT u.id, u.name, r.ppg
					FROM `gtm_users` AS u 
					LEFT JOIN `gtm_ranks` AS r 
						ON u.id = r.user_id 
					WHERE r.ppg > 0 
					ORDER BY r.ppg ASC 
					LIMIT $limit";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		
		while ($row = mysqli_fetch_assoc($query_result)) {
			$result[$row['id']] = $row;
		}
		
		return $result;
	}
	
	/**
	 * 
	 * Get Putts per Round statistic
	 * @return array
	 */
	function getPprStat($limit='') {
		$result = array();
		
		$query = "SELECT u.id, u.name, r.ppr
					FROM `gtm_users` AS u 
					LEFT JOIN `gtm_ranks` AS r 
						ON u.id = r.user_id 
					WHERE r.ppr > 0 
					ORDER BY r.ppr ASC 
					LIMIT $limit";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		
		while ($row = mysqli_fetch_assoc($query_result)) {
			$result[$row['id']] = $row;
		}
		
		return $result;
	}
	
	/**
	 * 
	 * Get Up & Down/Par Saves statistic
	 * @return array
	 */
	function getUpStat($limit='') {
		$result = array();
		
		$query = "SELECT u.id, u.name, r.up_and_down
					FROM `gtm_users` AS u 
					LEFT JOIN `gtm_ranks` AS r 
						ON u.id = r.user_id 
					WHERE r.up_and_down > 0 
					ORDER BY r.up_and_down DESC 
					LIMIT $limit";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		
		while ($row = mysqli_fetch_assoc($query_result)) {
			$result[$row['id']] = $row;
		}
		
		return $result;
	}
	
	/**
	 * 
	 * Get Sand Saves statistic
	 * @return array
	 */
	function getSandSavesStat($limit='') {
		$result = array();
		
		$query = "SELECT u.id, u.name, r.sand_saves
					FROM `gtm_users` AS u 
					LEFT JOIN `gtm_ranks` AS r 
						ON u.id = r.user_id 
					WHERE r.sand_saves > 0 
					ORDER BY r.sand_saves DESC 
					LIMIT $limit";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		
		while ($row = mysqli_fetch_assoc($query_result)) {
			$result[$row['id']] = $row;
		}
		
		return $result;
	}
	
	/**
	 * 
	 * Get Par or better statistic
	 * @return array
	 */
	function getParOrBetterStat($limit='') {
		$result = array();
		
		$query = "SELECT u.id, u.name, r.par_or_better 	
					FROM `gtm_users` AS u 
					LEFT JOIN `gtm_ranks` AS r 
						ON u.id = r.user_id 
					WHERE r.par_or_better > 0 
					ORDER BY r.par_or_better DESC 
					LIMIT $limit";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		
		while ($row = mysqli_fetch_assoc($query_result)) {
			$result[$row['id']] = $row;
		}
		
		return $result;
	}
	
	/**
	 * 
	 * Get Par Breakers statistic
	 * @return array
	 */
	function getParBreakersStat($limit='') {
		$result = array();
		
		$query = "SELECT u.id, u.name, r.par_breakers 
					FROM `gtm_users` AS u 
					LEFT JOIN `gtm_ranks` AS r 
						ON u.id = r.user_id 
					WHERE r.par_breakers > 0 
					ORDER BY r.par_breakers DESC 
					LIMIT $limit";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		
		while ($row = mysqli_fetch_assoc($query_result)) {
			$result[$row['id']] = $row;
		}
		
		return $result;
	}
	
	/**
	 * 
	 * Get Penalty Shots per Round statistic
	 * @return array
	 */
	function getPsprStat($limit='') {
		$result = array();
		
		$query = "SELECT u.id, u.name, r.pspr 
					FROM `gtm_users` AS u 
					LEFT JOIN `gtm_ranks` AS r 
						ON u.id = r.user_id 
					WHERE r.pspr > 0 
					ORDER BY r.pspr ASC 
					LIMIT $limit";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		
		while ($row = mysqli_fetch_assoc($query_result)) {
			$result[$row['id']] = $row;
		}
		
		return $result;
	}
	
	/**
	 * 
	 * Get Par Three Average statistic
	 * @return array
	 */
	function getPar3Stat($limit='') {
		$result = array();
		
		$query = "SELECT u.id, u.name, r.par_three_avg 
					FROM `gtm_users` AS u 
					LEFT JOIN `gtm_ranks` AS r 
						ON u.id = r.user_id 
					WHERE r.par_three_avg > 0 
					ORDER BY r.par_three_avg ASC 
					LIMIT $limit";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		
		while ($row = mysqli_fetch_assoc($query_result)) {
			$result[$row['id']] = $row;
		}
		
		return $result;
	}
	
	/**
	 * 
	 * Get Par Four Average statistic
	 * @return array
	 */
	function getPar4Stat($limit='') {
		$result = array();
		
		$query = "SELECT u.id, u.name, r.par_four_avg 
					FROM `gtm_users` AS u 
					LEFT JOIN `gtm_ranks` AS r 
						ON u.id = r.user_id 
					WHERE r.par_four_avg > 0 
					ORDER BY r.par_four_avg ASC 
					LIMIT $limit";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		
		while ($row = mysqli_fetch_assoc($query_result)) {
			$result[$row['id']] = $row;
		}
		
		return $result;
	}
	
	/**
	 * 
	 * Get Par Five Average statistic
	 * @return array
	 */
	function getPar5Stat($limit='') {
		$result = array();
		
		$query = "SELECT u.id, u.name, r.par_five_avg 
					FROM `gtm_users` AS u 
					LEFT JOIN `gtm_ranks` AS r 
						ON u.id = r.user_id 
					WHERE r.par_five_avg > 0 
					ORDER BY r.par_five_avg ASC 
					LIMIT $limit";
		if ($this->debug == 1) echo $query."<br/>";
		$query_result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		
		while ($row = mysqli_fetch_assoc($query_result)) {
			$result[$row['id']] = $row;
		}
		
		return $result;
	}
}