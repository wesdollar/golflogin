<?php
require_once CONTROLLERS_PATH . 'Admin.controller.php';

class AdminCourses extends Admin
{
	function index()
	{
		if ($this->isLoged())
		{
			if ($this->isAdmin())
			{
				Object::import('Model', array('Course', 'CourseHole'));
				$CourseModel = new CourseModel();
				$CourseHoleModel = new CourseHoleModel();

				$opts = array();
				
				$page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
				$count = $CourseModel->getCount($opts);
				$row_count = 20;
				$pages = ceil($count / $row_count);
				$offset = ((int) $page - 1) * $row_count;
				
				#$CourseModel->debug = 1;
				$arr = $CourseModel->getAll(array_merge($opts, array('offset' => $offset, 'row_count' => $row_count, 'col_name' => 't1.course_title', 'direction' => 'desc')));

				$this->tpl['arr'] = $arr;
				$this->tpl['paginator'] = array('pages' => $pages);
				
			} else {
				$this->tpl['error'] = 2;
			}
		} else {
			$this->tpl['error'] = 3;
		}
	}
	
	function update($id=null)
	{
		if ($this->isLoged())
		{
			if ($this->isAdmin())
			{
				Object::import('Model', array('Course', 'CourseHole'));
				$CourseModel = new CourseModel();
				$CourseHoleModel = new CourseHoleModel();

				if (isset($_POST['general_update'])) {
					$CourseModel->update($_POST);
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminCourses&action=index&message=31");
					exit;

				} elseif (isset($_POST['holes_update'])) {
					foreach ($_REQUEST['par'] as $key => $val) {
						$data = array();
						
						$data['par'] = intval($val);
						$data['yardage'] = intval($_REQUEST['yardage'][$key]);
						
						$CourseHoleModel->update($data, array('id' => $key, 'course_id' => intval($_REQUEST['id'])));
					}
					
					Object::import('Model', array('User', 'Rank'));
					$UserModel = new UserModel();
					$rankModel = new RankModel();
						
					$opts = array();
					$opts['t1.role_id'] = 2;
					$players = $UserModel->getAll($opts);
					
					foreach ($players as $p) {
						$rankModel->update(intval($p['id']));
					}
					
					header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminCourses&action=index&message=32");
					exit;
				} else {
					$this->tpl['course'] = $CourseModel->get($_REQUEST['id']);
					$this->tpl['course_holes'] = $CourseHoleModel->getCourseHoles($_REQUEST['id'], true);
					
					$this->js[] = array('file' => 'jquery.validate.min.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
					$this->js[] = array('file' => 'tiny_mce.js', 'path' => JS_PATH . 'tiny_mce/');
					$this->js[] = array('file' => 'adminCourses.js', 'path' => JS_PATH);
				}
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
                Object::import('Model', array('Course'));
                $courseModel = new CourseModel();

                if (!empty($_POST['course_create'])) {
                    # insert golf course here
                    $id = $courseModel->save($_POST);

                    if ($id !== false && (int) $id > 0) {
                        header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminCourses&action=index&message=33");
                        exit;
                    }
                }

                $this->js[] = array('file' => 'jquery.validate.min.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
                $this->js[] = array('file' => 'courses.js', 'path' => JS_PATH);

            } else {
                $this->tpl['error'] = 2;
            }
        } else {
            $this->tpl['error'] = 3;
        }
    }

    function delete($id)
    {
        if ($this->isLoged())
        {
            if ($this->isAdmin())
            {
                Object::import('Model', 'Course');
                $CourseModel = new CourseModel();

                Object::import('Model', 'CourseHole');
                $CourseHoleModel = new CourseHoleModel();

                $arr = $CourseModel->get($id);
                if (count($arr) == 0)
                {
                    header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminCourses&action=index&error=21");
                    exit;
                }

                if ($CourseModel->delete($id))
                {

                    $CourseHoleModel->delete($id);
                    header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminCourses&action=index&message=34");
                    exit;
                } else {
                    header("Location: " . $_SERVER['PHP_SELF'] . "?controller=AdminCourses&action=index&error=22");
                    exit;
                }
            } else {
                $this->tpl['error'] = 2;
            }
        } else {
            $this->tpl['error'] = 3;
        }
    }

}