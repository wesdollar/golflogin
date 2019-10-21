<?php
require_once CONTROLLERS_PATH . 'Front.controller.php';

class Players extends Front
{
	
	function index()
	{
		Object::import('Model', array('User'));
		$UserModel = new UserModel();

		$opts = array();
		$opts['t1.role_id'] = 2;

		$this->tpl['players'] = $UserModel->getAll(array_merge($opts, array('col_name' => 't1.name', 'direction' => 'ASC')));
		
		Object::import('Model', array('Round'));
		$roundModel = new RoundModel();

		$this->tpl['latest_rounds'] = $roundModel->getLatest();
	}
	
	function view() {
		Object::import('Model', array('User', 'News', 'Rank'));
		$userModel = new UserModel();
		$rankModel = new RankModel();
		
		$userModel->addJoin($userModel->joins, $rankModel->getTable(), 'R', array('R.user_id' => 't1.id'), array('R.handicap_index'));
		
		$this->tpl['player'] = $userModel->get(intval($_GET['id']));
		
		Object::import('Model', array('Round'));
		$roundModel = new RoundModel();

		$this->tpl['latest_rounds'] = $roundModel->getLatest();
		
		$this->tpl['player_latest'] = $roundModel->getLatest(intval($_GET['id']), 5, 'played');
		
		$this->tpl['owner_flag'] = !empty($_SESSION[$this->default_user]['id']) && intval($_REQUEST['id']) == intval($_SESSION[$this->default_user]['id']) ? true : false;
	}
	
	function viewRounds() {
		Object::import('Model', array('User', 'News', 'Rank'));
		$userModel = new UserModel();
		$rankModel = new RankModel();
		
		$userModel->addJoin($userModel->joins, $rankModel->getTable(), 'R', array('R.user_id' => 't1.id'), array('R.handicap_index'));
		
		$this->tpl['player'] = $userModel->get(intval($_GET['id']));
		
		Object::import('Model', array('Round'));
		$roundModel = new RoundModel();

		$this->tpl['latest_rounds'] = $roundModel->getLatest();

		$_GET['page'] = empty($_GET['page']) ? 1 : intval($_GET['page']);
		$page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
		$count = $roundModel->getCount(array('user_id' => $_GET['id']));
		$row_count = 30;
		$pages = ceil($count / $row_count);
		$offset = ((int) $page - 1) * $row_count;
		
		$options = array();
		$options['user_id'] = intval($_GET['id']);
		$options['offset'] = intval($offset);
		$options['row_count'] = intval($row_count);
		$options['col_name'] = 'date_played';
		$options['direction'] = 'DESC';
		
		if (!empty($_REQUEST['date_from'])) {
			list($from_m, $from_d, $from_y) = explode('/', $_REQUEST['date_from']);
			
			$options['date_from'] = date('Y-m-d', mktime(0, 0, 0, intval($from_m), intval($from_d), intval($from_y)));
		}
		
		if (!empty($_REQUEST['date_to'])) {
			list($to_m, $to_d, $to_y) = explode('/', $_REQUEST['date_to']);
			
			$options['date_to'] = date('Y-m-d', mktime(0, 0, 0, intval($to_m), intval($to_d), intval($to_y)));
		}
		
		#$roundModel->debug = 1;
		
		$this->tpl['owner_flag'] = !empty($_SESSION[$this->default_user]['id']) && intval($_REQUEST['id']) == intval($_SESSION[$this->default_user]['id']) ? true : false;
		$this->tpl['paginator'] = array('pages' => intval($pages));
		$this->tpl['player_latest'] = $roundModel->getPlayerLatest($options);
		
		$this->js[] = array('file' => 'jquery.ui.core.min.js', 'path' => LIBS_PATH . 'jquery/ui/js/');
		$this->js[] = array('file' => 'jquery.ui.datepicker.min.js', 'path' => LIBS_PATH . 'jquery/ui/js/');
		$this->css[] = array('file' => 'jquery-ui-1.8.10.custom.css', 'path' => LIBS_PATH . 'jquery/ui/css/smoothness/');
	}
	
	function stats() {
		Object::import('Model', array('User', 'Rank'));
		$userModel = new UserModel();
		$rankModel = new RankModel();
		
		$userModel->addJoin($userModel->joins, $rankModel->getTable(), 'R', array('R.user_id' => 't1.id'), array(
			'R.rounds_played', 
			'R.18_tournament_avg', 
			'R.18_avg', 
			'R.9_avg', 
			'R.fir', 
			'R.gir', 
			'R.ppg', 
			'R.ppr', 
			'R.up_and_down', 
			'R.sand_saves', 
			'R.par_or_better', 
			'R.par_breakers', 
			'R.par_three_avg', 
			'R.par_four_avg', 
			'R.par_five_avg', 
			'R.eagles', 
			'R.birdies', 
			'R.pars', 
			'R.bogies', 
			'R.double_bogies', 
			'R.three_over_par', 
			'R.handicap_index', 
			'R.pspr'
		));
		
		$this->tpl['player'] = $userModel->get(intval($_GET['id']));
		
		Object::import('Model', array('Round'));
		$roundModel = new RoundModel();

		$this->tpl['latest_rounds'] = $roundModel->getLatest();
	}
}