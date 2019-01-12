<?php

define('DC', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('BASEPATH', ROOT.DC.'system');
define('APPPATH', ROOT.DC.'app');

require_once(BASEPATH.DC.'core'.DC.'Config.php');
require_once(APPPATH.DC.'config'.DC.'Config.php');

if(Config::get('show_errors')){
	ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}

require_once(BASEPATH.DC.'core'.DC.'Common.php');
require_once(BASEPATH . DC . 'core' . DC . 'Load.php');
require_once(BASEPATH.DC.'core'.DC.'Component.php');
require_once(BASEPATH.DC.'core'.DC.'Controller.php');
require_once(BASEPATH.DC.'core'.DC.'Model.php');
require_once(BASEPATH.DC.'core'.DC.'App.php');

$app = new App();
$app->run();