<?php

// Define the CORE PATHS
// define them as absolute paths to make sure that require_once works as expected

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for windows, / for Unix)

$chapter = 10;

defined('DS')       ? null:define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT')? null:define('SITE_ROOT', "C:".DS.DS."mywamp".DS."www".DS."PHP Beyond the Basics Training".DS."Chapter {$chapter}".DS."photo_gallery");
defined('LIB_PATH') ? null:define('LIB_PATH' , SITE_ROOT.DS."includes");

// load config file first
require_once(LIB_PATH.DS."config.php");

// load basic functions next so that everything after can use them
require_once(LIB_PATH.DS."functions.php");

// load core objects
require_once(LIB_PATH.DS.'database.php');
require_once(LIB_PATH.DS.'session.php');

// load database-related classes
require_once(LIB_PATH.DS.'user.php');
require_once(LIB_PATH.DS.'photograph.php');


?>