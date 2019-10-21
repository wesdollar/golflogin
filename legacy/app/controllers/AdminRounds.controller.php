<?php
require_once CONTROLLERS_PATH . 'Admin.controller.php';

class AdminRounds extends Admin
{
	function index()
	{
		if ($this->isLoged())
		{
			if ($this->isAdmin())
			{
				Object::import('Model', array('Round', 'RoundData'));
				$RoundModel = new RoundModel();

				$opts = array();

                $_GET['page'] = empty($_GET['page']) ? 1 : intval($_GET['page']);
                $page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
                $count = $RoundModel->getCount($opts);
                $row_count = 20;
                $pages = ceil($count / $row_count);
                $offset = ((int) $page - 1) * $row_count;

				$arr = $RoundModel->getAll(0, $row_count, $offset, 'played');

				$this->tpl['arr'] = $arr;
                $this->tpl['totalCount'] = $count;
				$this->tpl['paginator'] = array('pages' => $pages);
				// $this->js[] = array('file' => 'adminCourses.js', 'path' => JS_PATH);
                $this->css[] = array('file' => 'admin-rounds.css', 'path' => CSS_PATH);
			} else {
				$this->tpl['error'] = 2;
			}
		} else {
			$this->tpl['error'] = 3;
		}
	}
	
	function update()
	{
		if ($this->isLoged())
		{
			if ($this->isAdmin())
			{
                Object::import('Model', array('RoundData'));
                $roundDataModel = new RoundDataModel();

                $player_id = $_POST['player_id'];

                if (!empty($_POST['round_update'])) {

                    $data = $this->buildUpdateData($_POST);

                    // add db connection for mysqli
                    $link = @mysqli_connect(DEFAULT_HOST, DEFAULT_USER, DEFAULT_PASS, DEFAULT_DB);
                    if (!$link) {
                        die('Could not connect: ' . mysqli_error($link));
                    }

                    // todo: check if user has a ranks row
                    $query = 'SELECT id FROM gtm_ranks WHERE user_id = ' . $player_id;

                    $result = mysqli_query($link, $query) or die(mysqli_error($link));

                    if (mysqli_affected_rows($link) < 1) {

                        $sql = 'INSERT INTO gtm_ranks (user_id) VALUES ('.$player_id.')';
                        $result = mysqli_query($link, $sql) or die(mysqli_error($link));

                    }

                    if ($roundDataModel->update($data['hole_data'])) {

                        Object::import('Model', array('Rank'));
                        $rankModel = new RankModel();

                        try {
                            $rankModel->update(intval($_POST['player_id']));
                        }
                        catch (\Exception $e) {
                            die('Unable to update rankings. ' . "\n\n" . $e->getMessage());
                        }

                        header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminRounds&action=index&message=35");
                        exit;
                    }

                    header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminRounds&action=update&message=36");
                    exit;
                }

                Object::import('Model', array('Round', 'Course', 'CourseHole', 'RoundData', 'User'));
                $roundModel = new RoundModel();
                $courseModel = new CourseModel();
                $courseHoleModel = new CourseHoleModel();
                $roundDataModel = new RoundDataModel();
                $playerModel = new UserModel();

                $this->tpl['round'] = $roundModel->get($_GET['id']);
                $this->tpl['player'] = $playerModel->get($this->tpl['round']['user_id']);
                $this->tpl['course'] = $courseModel->get($this->tpl['round']['course_id']);
                $this->tpl['holes'] = $courseHoleModel->getCourseHoles($this->tpl['round']['course_id'], true);
                $this->tpl['rholes'] = $roundDataModel->getAll(array('round_id' => $this->tpl['round']['id'], 'col_name' => 't1.hole_id', 'direction' => 'desc'));
                // allow admin to access
                $this->tpl['owner_flag'] = intval($this->tpl['round']['user_id']) == intval($_SESSION[$this->default_user]['id']) ? true : true;

                $this->css[] = array('file' => 'admin-rounds.css', 'path' => CSS_PATH);
                $this->js[] = array('file' => 'jquery.ui.widget.min.js', 'path' => LIBS_PATH . 'jquery/ui/js/');
                $this->js[] = array('file' => 'jquery.validate.min.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
                $this->js[] = array('file' => 'rounds.js', 'path' => JS_PATH);

			} else {
				$this->tpl['error'] = 2;
			}
		} else {
			$this->tpl['error'] = 3;
		}
	}

    function create() {
        if ($this->isLoged())
        {
            if ($this->isAdmin())
            {

                Object::import('Model', array('Round'));
                $roundModel = new RoundModel();

                if (!empty($_POST['round_create'])) {
                    # insert round

                    // set player_id
                    $player_id = $_POST['player_id'];

                    $data = $this->buildSaveData($_POST, $player_id);

                    $id = $roundModel->save($data);

                    if ($id !== false && (int) $id > 0) {
                        include LOCALE_PATH . 'Rounds_en.php';

                        Object::import('Model', array('Course', 'User'));
                        $courseModel = new CourseModel();
                        $userModel = new UserModel();
                        $course = $courseModel->get($data['course_id']);

                        $search = array(
                            '{USERNAME}',
                            '{NAME}',
                            '{STATS}',
                            '{COURSE}',
                            '{TOURNAMENT}',
                            '{DATE_PLAYED}'
                        );

                        $replace = array(
                            $_SESSION[$this->default_user]['username'],
                            $_SESSION[$this->default_user]['name'],
                            $GTM_LANG['Rounds']['create']['round_types'][$data['type']],
                            $course['course_title'],
                            $data['is_tournament'] == 'T' ? 'Yes' : 'No',
                            $data['date_played']
                        );

                        Object::import('Component', 'Email');
                        $Email = new Email();

                        # Send to players
                        // todo: send to players if ticked
                        $send_to_players = (!isset($send_to_players)) ? null : $send_to_players;
                        if ($send_to_players === true) {
                            $opts = array();
                            $opts['t1.role_id'] = 2;
                            $players = $userModel->getAll(array_merge($opts, array('col_name' => 't1.name', 'direction' => 'ASC')));

                            foreach ($players as $p) {
                                $Email->send($p['email'], $this->option_arr['email_new_round_added_subject'], $message, $this->option_arr['system_email']);
                            }
                        }

                        # Update Rank
                        Object::import('Model', array('Rank'));
                        $rankModel = new RankModel();

                        //$rankModel->debug = 1;
                        $rankModel->update($player_id);

                        header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminRounds&action=index&message=39");
                        exit;
                    }
                    else {
                        header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminRounds&action=create&message=40");
                    }
                }

                Object::import('Model', array('Course', 'User', 'Role'));
                $courseModel = new CourseModel();
                $playerModel = new UserModel();
                $roleModel = new RoleModel();
                
                // select & prepare player, exclude admins & observers
                $opts = array();
                $opts['t1.role_id'] = 2;
                $playerModel->addJoin($playerModel->joins, $roleModel->getTable(), 'TR', array('TR.id' => 't1.role_id'), array('TR.role'));

                $this->tpl['players'] = $playerModel->getAll(array_merge($opts, array('col_name' => 't1.name', 'direction' => 'asc')));

                $this->tpl['courses'] = $courseModel->getAll();

                $this->js[] = array('file' => 'jquery.ui.widget.min.js', 'path' => LIBS_PATH . 'jquery/ui/js/');
                $this->js[] = array('file' => 'jquery.validate.min.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
                $this->js[] = array('file' => 'rounds.js', 'path' => JS_PATH);
                $this->css[] = array('file' => 'admin-rounds.css', 'path' => CSS_PATH);

            } else {
                $this->tpl['error'] = 2;
            }
        } else {
            $this->tpl['error'] = 3;
        }
    }

    function delete()
    {
        if ($this->isLoged())
        {
            if ($this->isAdmin())
            {
                Object::import('Model', array('RoundData', 'Round'));
                $roundModel = new RoundModel();

                $this->tpl['round'] = $roundModel->get($_GET['id']);
                $round = $this->tpl['round'];

                if ($round != null) {
                    // delete the round ($round = round ID)
                    $roundModel->delete($round);

                    // delete round data based on round ID
                    $roundDataModel = new RoundDataModel();
                    $roundDataModel->delete($round);

                    $player_id = $_GET['player_id'];

                    // update player rankings
                    Object::import('Model', array('Rank'));
                    $rankModel = new RankModel();
                    $rankModel->update($player_id);

                    header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminRounds&action=index&message=37");
                    exit;
                }

                else {
                    header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminRounds&action=index&message=38");
                    exit;
                }
            } else {
                $this->tpl['error'] = 2;
            }
        } else {
            $this->tpl['error'] = 3;
        }
    }

    function buildSaveData($rowData, $player_id) {
        $data = array();

        $data['user_id'] = ($player_id != null) ? $player_id : intval($_SESSION[$this->default_user]['id']);
        $data['course_id'] = intval($rowData['course_id']);
        $data['type'] = $rowData['type'];
        $data['is_tournament'] = $rowData['is_tournament'];
        $data['nine_start'] = @$rowData['nine_start'];

        if (!empty($rowData['date_played_month']) && !empty($rowData['date_played_day']) && !empty($rowData['date_played_year'])) {
            $data['date_played'] = date('Y-m-d', mktime(0, 0, 0, intval($rowData['date_played_month']), intval($rowData['date_played_day']), intval($rowData['date_played_year'])));
        }

        foreach ($rowData['strokes'] as $hole_id => $hole_data) {
            $data['hole_data']['strokes'][$hole_id] = $hole_data;
        }

        foreach ($data['hole_data']['strokes'] as $hole_id => $hole_data) {
            if (!empty($rowData['putts']) && is_array($rowData['putts']) && array_key_exists($hole_id, $rowData['putts'])) {
                $data['hole_data']['putts'][$hole_id] = $rowData['putts'][$hole_id];
            } else {
                $data['hole_data']['putts'][$hole_id] = 0;
            }

            if (!empty($rowData['gir']) && is_array($rowData['gir']) && array_key_exists($hole_id, $rowData['gir'])) {
                $data['hole_data']['gir'][$hole_id] = $rowData['gir'][$hole_id];
            } else {
                $data['hole_data']['gir'][$hole_id] = 'NA';
            }

            if (!empty($rowData['fir']) && is_array($rowData['fir']) && array_key_exists($hole_id, $rowData['fir'])) {
                $data['hole_data']['fir'][$hole_id] = $rowData['fir'][$hole_id];
            } else {
                $data['hole_data']['fir'][$hole_id] = 'NA';
            }

            if (!empty($rowData['up_and_down']) && is_array($rowData['up_and_down']) && array_key_exists($hole_id, $rowData['up_and_down'])) {
                $data['hole_data']['up_and_down'][$hole_id] = $rowData['up_and_down'][$hole_id];
            } else {
                $data['hole_data']['up_and_down'][$hole_id] = 'NA';
            }

            if (!empty($rowData['sand_save']) && is_array($rowData['sand_save']) && array_key_exists($hole_id, $rowData['sand_save'])) {
                $data['hole_data']['sand_save'][$hole_id] = $rowData['sand_save'][$hole_id];
            } else {
                $data['hole_data']['sand_save'][$hole_id] = 'NA';
            }

            if (!empty($rowData['penalty_shots']) && is_array($rowData['penalty_shots']) && array_key_exists($hole_id, $rowData['penalty_shots'])) {
                $data['hole_data']['penalty_shots'][$hole_id] = intval($rowData['penalty_shots'][$hole_id]);
            } else {
                $data['hole_data']['penalty_shots'][$hole_id] = 0;
            }
        }

        return $data;
    }

    function buildUpdateData($rowData) {
        $data = array();

        foreach ($rowData['strokes'] as $key => $hole_data) {
            list($id, $round_id, $hole_id) = explode('-', $key);

            $data['hole_data'][$id]['id'] = intval($id);
            $data['hole_data'][$id]['round_id'] = intval($round_id);
            $data['hole_data'][$id]['hole_id'] = intval($hole_id);

            $data['hole_data'][$id]['strokes'] = $hole_data;
        }

        foreach ($data['hole_data'] as $key => $hole_data) {
            $_key = $hole_data['id'].'-'.$hole_data['round_id'].'-'.$hole_data['hole_id'];

            if (!empty($rowData['putts']) && is_array($rowData['putts']) && array_key_exists($_key, $rowData['putts'])) {
                $data['hole_data'][$key]['putts'] = $rowData['putts'][$_key];
            } else {
                $data['hole_data'][$key]['putts'] = 0;
            }

            if (!empty($rowData['gir']) && is_array($rowData['gir']) && array_key_exists($_key, $rowData['gir'])) {
                $data['hole_data'][$key]['gir'] = $rowData['gir'][$_key];
            } else {
                $data['hole_data'][$key]['gir'] = 'NA';
            }

            if (!empty($rowData['fir']) && is_array($rowData['fir']) && array_key_exists($_key, $rowData['fir'])) {
                $data['hole_data'][$key]['fir'] = $rowData['fir'][$_key];
            } else {
                $data['hole_data'][$key]['fir'] = 'NA';
            }

            if (!empty($rowData['up_and_down']) && is_array($rowData['up_and_down']) && array_key_exists($_key, $rowData['up_and_down'])) {
                $data['hole_data'][$key]['up_and_down'] = $rowData['up_and_down'][$_key];
            } else {
                $data['hole_data'][$key]['up_and_down'] = 'NA';
            }

            if (!empty($rowData['sand_save']) && is_array($rowData['sand_save']) && array_key_exists($_key, $rowData['sand_save'])) {
                $data['hole_data'][$key]['sand_save'] = $rowData['sand_save'][$_key];
            } else {
                $data['hole_data'][$key]['sand_save'] = 'NA';
            }

            if (!empty($rowData['penalty_shots']) && is_array($rowData['penalty_shots']) && array_key_exists($_key, $rowData['penalty_shots'])) {
                $data['hole_data'][$key]['penalty_shots'] = intval($rowData['penalty_shots'][$_key]);
            } else {
                $data['hole_data'][$key]['penalty_shots'] = 0;
            }
        }

        return $data;
    }

}