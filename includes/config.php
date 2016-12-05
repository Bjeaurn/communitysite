<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', '1');

define('DB_HOST', 'localhost');
define('DB_DATABASE', 'communitysite');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_PORT', '3306');

if(!defined(__BASEPATH__)) {
  define('__BASEPATH__', '');
}
define('__ROUTING__', '/communitysite/');
define('__REAL_PATH__', 'http://'.$_SERVER['HTTP_HOST'].__ROUTING__);
define('DEFAULT_PAGE', 'start');
define('__UNIT_NAME', 'Strike Force Omega');

define('PATH_404', 'includes/controllers/404.php');
define('PATH_UPLOADS', 'uploads');

date_default_timezone_set('Europe/Amsterdam');

require_once(__BASEPATH__."includes/config/require.php");
?>
