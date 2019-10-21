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

$school = '_school'; // used for paths and db setings, must match db & directory name
$domain_name = 'habershamboysgolf.com'; // no http, no www (FQDN)
$env = false; // set to false for production

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
	if ($env == 'dev')
	{
		# LOCAL
		define("DEFAULT_HOST",   "localhost");
		define("DEFAULT_USER",   "root");
		define("DEFAULT_PASS",   "564406");
		define("DEFAULT_DB",     "golo_dev");
		define("DEFAULT_PREFIX", "");
	} else {
		# REMOTE
		define("DEFAULT_HOST",   "localhost");
		define("DEFAULT_USER",   "golostat_admin");
		define("DEFAULT_PASS",   "564406");
		define("DEFAULT_DB",     "golostat_" . $school);
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
	
	if ($env == 'dev')
	{

        # ALL PATHS & URLS REQUIRE / AT THE END

        // base URL
		if (!defined("BASE_PATH")) define("BASE_PATH", "http://" . $_SERVER['SERVER_NAME'] . "/golo_live/_stable/");

        // core install path ? use
		if (!defined("INSTALL_FOLDER")) define("INSTALL_FOLDER", "/Library/WebServer/Documents/golo_live/".$school."/");

        // core install path ? use
		if (!defined("INSTALL_PATH")) define("INSTALL_PATH", "/Library/WebServer/Documents/golo_live/".$school."/");

        // install URL ? use
		if (!defined("INSTALL_URL")) define("INSTALL_URL", "http://localhost/golo_live/".$school."/");

        // school path
        if (!defined("SCHOOL_PATH")) define("SCHOOL_PATH", "/Library/WebServer/Documents/golo_live/".$school."/");

        // config path
        if (!defined("CONFIG_PATH")) define("CONFIG_PATH", SCHOOL_PATH);

	} else {
        if ($_SERVER['SERVER_NAME'] == $domain_name) {
            if (!defined("BASE_PATH")) define("BASE_PATH", "http://" . $domain_name . "/");
            if (!defined("INSTALL_FOLDER")) define("INSTALL_FOLDER", "/".$school."/");
            if (!defined("INSTALL_PATH")) define("INSTALL_PATH", "/home/golostat/".$school."/");
            if (!defined("INSTALL_URL")) define("INSTALL_URL", "http://www.habershamboysgolf.com/");
        }
        else {
            if (!defined("BASE_PATH")) define("BASE_PATH", "http://" . $_SERVER['SERVER_NAME'] . "/".$school."/");
            if (!defined("INSTALL_FOLDER")) define("INSTALL_FOLDER", "/".$school."/");
            if (!defined("INSTALL_PATH")) define("INSTALL_PATH", "/home/golostat/".$school."/");
            if (!defined("INSTALL_URL")) define("INSTALL_URL", "http://www.golflogin.com/".$school."/");
        }
	}
}

/*

School specific files:
app/config/config.inc.php

Setup needs to contain:
Paths to config
Paths to core
Paths to uploads
Paths to images

Can be pulled straight from golflogin.com/... via CSS stylesheets
app/web/img/bgd_container.jpg
app/web/img/uiNav.gif
app/web/img/bgd_footer.gif

*/

if (!defined("ROOT_PATH")) define("ROOT_PATH", "../_stable/app/");
if (!defined("APP_PATH")) define("APP_PATH", ROOT_PATH . "app/");
if (!defined("CORE_PATH")) define("CORE_PATH", ROOT_PATH . "core/");
if (!defined("LIBS_PATH")) define("LIBS_PATH", ROOT_PATH . "core/libs/");
if (!defined("THIRD_PARTY_PATH")) define("THIRD_PARTY_PATH", ROOT_PATH . "core/third-party/");
if (!defined("FRAMEWORK_PATH")) define("FRAMEWORK_PATH", CORE_PATH . "framework/");
if (!defined("CONTROLLERS_PATH")) define("CONTROLLERS_PATH", APP_PATH . "controllers/");
if (!defined("COMPONENTS_PATH")) define("COMPONENTS_PATH", APP_PATH . "controllers/components/");
if (!defined("MODELS_PATH")) define("MODELS_PATH", APP_PATH . "models/");
if (!defined("VIEWS_PATH")) define("VIEWS_PATH", APP_PATH . "views/");
if (!defined("HELPERS_PATH")) define("HELPERS_PATH", APP_PATH . "views/Helpers/");
if (!defined("WEB_PATH")) define("WEB_PATH", APP_PATH . "web/");
if (!defined("CSS_PATH")) define("CSS_PATH", ROOT_PATH . "app/web/css/");
if (!defined("IMG_PATH")) define("IMG_PATH", ROOT_PATH . "app/web/img/");
if (!defined("JS_PATH")) define("JS_PATH", ROOT_PATH . "app/web/js/");
if (!defined("UPLOAD_PATH")) define("UPLOAD_PATH", SCHOOL_PATH . "uploads/");
if (!defined("LOCALE_PATH")) define("LOCALE_PATH", ROOT_PATH . "app/locale/");

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
