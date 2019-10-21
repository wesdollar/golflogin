<?php
require_once CONTROLLERS_PATH . 'Front.controller.php';

class Courses extends Front
{

	function index() {
	}

	function view() {
	}

	function create() {
		if ($this->isLoged()) {
			Object::import('Model', array('Course'));
			$courseModel = new CourseModel();
						
			if (!empty($_POST['course_create'])) {
				# insert golf course here
				$id = $courseModel->save($_POST);

				if ($id !== false && (int) $id > 0) {
					redirect('Front/index/course_created_success');
					exit;
				}
			}

			$this->js[] = array('file' => 'jquery.validate.min.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
			$this->js[] = array('file' => 'courses.js', 'path' => JS_PATH);
		} else {
			redirect('Front/login/not_logged_in');
		}
	}
}