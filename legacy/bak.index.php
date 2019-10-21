<?php
if (!headers_sent())
{
	session_name('GolfTeamManager');
	@session_start();
}

if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1')
{
	ini_set("display_errors", "On");
	error_reporting(E_ALL);
} else {
	error_reporting(0);
}

header("Content-type: text/html; charset=utf-8");

if (!defined("ROOT_PATH"))
{
	define("ROOT_PATH", dirname(__FILE__) . '/');
}

// require_once ROOT_PATH . 'app/config/config.inc.php';
// Use school's config in school directory
require_once ROOT_PATH . 'app/config/config.inc.php';

# Load default helpers
require_once ROOT_PATH . 'app/views/Helpers/escape.widget.php';
require_once ROOT_PATH . 'app/views/Helpers/url.widget.php';

if (!isset($_GET['controller']) || empty($_GET['controller']))
{
	header("HTTP/1.1 301 Moved Permanently");
	redirect('Front/index/');
	exit;
}

if (isset($_GET['controller']))
{
	if (!is_file(CONTROLLERS_PATH . $_GET['controller'] . '.controller.php'))
	{
		echo 'controller not found';
		exit;
	}

	require_once CONTROLLERS_PATH . $_GET['controller'] . '.controller.php';
	
	if (class_exists($_GET['controller']))
	{
		$controller = new $_GET['controller'];
		$controller->setController($_GET['controller']);

		if (is_object($controller))
		{
			$tpl = &$controller->tpl;
				
			if (isset($_GET['action']))
			{
				$action = $_GET['action'];
				
				if (method_exists($controller, $action))
				{
					$controller->setAction($action);
					
					$controller->beforeFilter();
					parse_str($_SERVER['QUERY_STRING'], $output);
					unset($output['controller']);
					unset($output['action']);
					$output = Object::multidimensionalArrayMap("urlencode", $output);
					$params = count($output) > 0 ? "'" . @join("','", $output) . "'" : '';
					$str = '$controller->$action('.$params.');';
					eval($str);
					$controller->afterFilter();
					unset($str);
					unset($params);
					$controller->beforeRender();
						
					$templatePath = $controller->getTemplatePath();
					$templatePath = is_null($templatePath) ? $_GET['controller'] : $templatePath;
						
					$template = $controller->getTemplate();
					$template = is_null($template) ? $action : $template;
						
					$content_tpl = VIEWS_PATH . $templatePath . '/' . $template . '.php';
				} else {
					echo 'method didn\'t exists';
					exit;
				}
			} else {
				$_GET['action'] = 'index';

				$controller->setAction($_GET['action']);
				
				$controller->beforeFilter();
				$controller->index();
				$controller->afterFilter();
				$controller->beforeRender();
				$templatePath = $controller->getTemplatePath();
				$templatePath = is_null($templatePath) ? $_GET['controller'] : $templatePath;
				$content_tpl = VIEWS_PATH . $templatePath . '/index.php';
			}
			
			if (!is_file($content_tpl))
			{
				echo 'template not found';
				exit;
			}

			# Language
			require_once ROOT_PATH . 'app/locale/'. $controller->getLanguage() . '.php';
			
			# Admin - default language
			require_once ROOT_PATH . 'app/locale/admin_'. $controller->getLanguage() . '.php';
			
			# Front - default language
			require_once ROOT_PATH . 'app/locale/Front_'. $controller->getLanguage() . '.php';
			
			# Load controller specific language files e.g. players_en.php (controller -> players, language -> en)
			if (is_file(ROOT_PATH . 'app/locale/'. $_GET['controller'] . '_' . $controller->getLanguage() . '.php')) {
				require_once ROOT_PATH . 'app/locale/'. $_GET['controller'] . '_' . $controller->getLanguage() . '.php';
			}
			
			if ($controller->isAjax())
			{
				require $content_tpl;
				$controller->afterRender();
			} else {
				require VIEWS_PATH . 'Layouts/' . $controller->getLayout() . '.php';
				$controller->afterRender();
			}
		}
	} else {
		echo 'class didn\'t exists';
		exit;
	}
}