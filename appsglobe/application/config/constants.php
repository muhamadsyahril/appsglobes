<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

// website
define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

define('PROJECT_NAME', 'Appglobes');
define('PROJECT_LOGO', 'logo.gif');

// web
$view_path_web = str_replace('\\','/',realpath($application_folder).'/views/html/');
define('VIEWS_PATH_WEB', $view_path_web);
//define('HTML_PATH_WEB', $html_path_web);
define('TWITTER_ID', "OrangetvID");
define('FACEBOOK_ID', "orangetvID");


define('BASE_URL', 'http://'.$_SERVER['SERVER_NAME'].'/appsglobe');
define('EXTRAS',						BASE_URL.'/asset/extras/');
define('JS_BASE_URL', 						BASE_URL.'/asset/js');
define('CSS_BASE_URL', 						BASE_URL.'/asset/css');
define('TOOLS_BASE_URL', 				 BASE_URL.'/asset/tools');
define('FONT_AWESOME', 				 BASE_URL.'/asset/font-awesome');
define('IMAGES_BASE_URL', 			BASE_URL.'/asset/images');
define('CAPCTHA_BASE_URL', 			BASE_URL.'/asset/capctha/');
define('PATH_JSON', 				APPPATH.'cache/');
define('JSON_FEATURE', 				PATH_JSON.'feature_product.json');
define('JSON_ALIAS', 				PATH_JSON.'alias.json');
define('JSON_CATEGORY_MENU',		PATH_JSON.'category_menu.json');
define('JSON_SUBCATEGORY', 			PATH_JSON.'subcategory_menu.json');
define('JSON_CATALOG', 				PATH_JSON.'catalog_menu.json');
define('JSON_BANNER', 				PATH_JSON.'banner.json');
define('JSON_MENU', 				PATH_JSON.'menu_front.json');

// backend
define('PATH', str_replace('\\','/',realpath($application_folder).'/'));
define('PATH_PROJECT', '/dev');
define('PATH_asset', PATH_PROJECT.'/asset');
define('BASE_URL_BACKEND', 'http://'.$_SERVER['SERVER_NAME'].'/backend');
$view_path_backend = str_replace('\\','/',realpath($application_folder).'/views/backend/');
define('VIEWS_PATH_BACKEND', $view_path_backend);

define('PER_PAGE', 20);


/* End of file constants.php */
/* Location: ./application/config/constants.php */