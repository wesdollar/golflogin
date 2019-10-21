<?php
if (in_array(version_compare(phpversion(), '5.1.0'), array(0,1)))
{
	date_default_timezone_set('UTC');
} else {
	$safe_mode = ini_get('safe_mode');
	if ($safe_mode)
	{
		putenv("TZ=UTC");
	}
}

$stop = false;
if (isset($_GET['controller']) && $_GET['controller'] == 'Installer')
{
	$stop = true;
	if (isset($_GET['install']))
	{
		switch ($_GET['install'])
		{
			case 1:
				$stop = true;
				break;
			default:
				$stop = false;
				break;
		}
	}
}

if (!$stop)
{
	if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1')
	{
		# LOCAL
		define("DEFAULT_HOST",   "localhost");
		define("DEFAULT_USER",   "root");
		define("DEFAULT_PASS",   "mysql");
		define("DEFAULT_DB",     "lhsknights");
		define("DEFAULT_PREFIX", "");
	} else {
		# REMOTE
		define("DEFAULT_HOST",   "localhost");
		define("DEFAULT_USER",   "golostat_admin");
		define("DEFAULT_PASS",   "564406");
		define("DEFAULT_DB",     "golostat_lhsknights");
		define("DEFAULT_PREFIX", "");
	}
	
	if (preg_match('/\[hostname\]/', DEFAULT_HOST))
	{
		//header("Location: index.php?controller=Installer&action=step0&install=1");
		die('Website not properly installed!');
	}

	$link = @mysqli_connect(DEFAULT_HOST, DEFAULT_USER, DEFAULT_PASS, DEFAULT_DB);
	if (!$link) {
	    die('Could not connect: ' . mysqli_error($link));
	}
	
	mysqli_query($link, "SET NAMES 'utf8'");
	//mysql_query("SET SESSION time_zone = '-5:00'", $link);

	if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1')
	{
		if (!defined("BASE_PATH")) define("BASE_PATH", "http://" . $_SERVER['SERVER_NAME'] . "/lhsknights/");
		if (!defined("INSTALL_FOLDER")) define("INSTALL_FOLDER", "/lhsknights/");
		if (!defined("INSTALL_PATH")) define("INSTALL_PATH", "C://ampps/www/lhsknights/");
		if (!defined("INSTALL_URL")) define("INSTALL_URL", "http://localhost/lhsknights/");
	} else {
		if (!defined("BASE_PATH")) define("BASE_PATH", "http://" . $_SERVER['SERVER_NAME'] . "/lhsknights/");
		if (!defined("INSTALL_FOLDER")) define("INSTALL_FOLDER", "/lhsknights/");
		if (!defined("INSTALL_PATH")) define("INSTALL_PATH", "/home/golostat/lhsknights/");
		if (!defined("INSTALL_URL")) define("INSTALL_URL", "http://www.golostats.com/lhsknights/");
	}
}

if (!defined("APP_PATH")) define("APP_PATH", ROOT_PATH . "app/");
if (!defined("CORE_PATH")) define("CORE_PATH", ROOT_PATH . "core/");
if (!defined("LIBS_PATH")) define("LIBS_PATH", "core/libs/");
if (!defined("THIRD_PARTY_PATH")) define("THIRD_PARTY_PATH", "core/third-party/");
if (!defined("FRAMEWORK_PATH")) define("FRAMEWORK_PATH", CORE_PATH . "framework/");
if (!defined("CONFIG_PATH")) define("CONFIG_PATH", APP_PATH . "config/");
if (!defined("CONTROLLERS_PATH")) define("CONTROLLERS_PATH", APP_PATH . "controllers/");
if (!defined("COMPONENTS_PATH")) define("COMPONENTS_PATH", APP_PATH . "controllers/components/");
if (!defined("MODELS_PATH")) define("MODELS_PATH", APP_PATH . "models/");
if (!defined("VIEWS_PATH")) define("VIEWS_PATH", APP_PATH . "views/");
if (!defined("HELPERS_PATH")) define("HELPERS_PATH", APP_PATH . "views/Helpers/");
if (!defined("WEB_PATH")) define("WEB_PATH", APP_PATH . "web/");
if (!defined("CSS_PATH")) define("CSS_PATH", "app/web/css/");
if (!defined("IMG_PATH")) define("IMG_PATH", "app/web/img/");
if (!defined("JS_PATH")) define("JS_PATH", "app/web/js/");
if (!defined("UPLOAD_PATH")) define("UPLOAD_PATH",  "uploads/");
if (!defined("LOCALE_PATH")) define("LOCALE_PATH", "app/locale/");

if (!defined("SCRIPT_VERSION")) define("SCRIPT_VERSION", "");
if (!defined("SCRIPT_ID")) define("SCRIPT_ID", "");

# Upload configuration
if (!defined("UPLOAD_MAX_SIZE")) define("UPLOAD_MAX_SIZE", 2048);
if (!defined("TEMP_PATH")) define("TEMP_PATH", UPLOAD_PATH . 'temp/');

if (!defined("PROFILE_IMAGES_PATH")) define("PROFILE_IMAGES_PATH", UPLOAD_PATH . 'profile/');
if (!defined("PROFILE_IMAGES_MAX_WIDTH")) define("PROFILE_IMAGES_MAX_WIDTH", 200);
if (!defined("PROFILE_IMAGES_MAX_HEIGHT")) define("PROFILE_IMAGES_MAX_HEIGHT", 200);

if (!defined("ANNOUNCEMENTS_IMAGE_PATH")) define("ANNOUNCEMENTS_IMAGE_PATH", UPLOAD_PATH . 'announcements/');
if (!defined("ANNOUNCEMENTS_IMAGE_MAX_WIDTH")) define("ANNOUNCEMENTS_IMAGE_MAX_WIDTH", 425);
if (!defined("ANNOUNCEMENTS_IMAGE_THUMB_MAX_WIDTH")) define("ANNOUNCEMENTS_IMAGE_THUMB_MAX_WIDTH", 73);

if (!defined("NEWS_IMAGE_PATH")) define("NEWS_IMAGE_PATH", UPLOAD_PATH . 'news/');
if (!defined("NEWS_IMAGE_MAX_WIDTH")) define("NEWS_IMAGE_MAX_WIDTH", 425);
if (!defined("NEWS_IMAGE_THUMB_MAX_WIDTH")) define("NEWS_IMAGE_THUMB_MAX_WIDTH", 75);














