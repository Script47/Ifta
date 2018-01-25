<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start();

define('DB_HOST', 'localhost');
define('DB_NAME', 'ifta');
define('DB_PORT', 3306);
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHAR', 'utf8');

define('ROOT_PATH', dirname(__DIR__, 1) . '\\');

define('SCRIPT_NAME', $_SERVER['SCRIPT_NAME']);
define('SCRIPT_NAME_WITH_PARAMETERS', $_SERVER['SCRIPT_NAME'] . '?' . $_SERVER['QUERY_STRING']);

if (!function_exists('version_compare') || version_compare(phpversion(), '7.0.0', '<')) {
    exit('Unsupported PHP version, you need 7.0.0 or higher.');
}

spl_autoload_register(function ($class_name) {
    $class_name = $class_name . '.php';

    if (file_exists(ROOT_PATH . '/library/core/' . $class_name)) {
        require_once ROOT_PATH . '/library/core/' . $class_name;
    } else if (file_exists(ROOT_PATH . '/library/application/' . $class_name)) {
        require_once ROOT_PATH . '/library/application/' . $class_name;
    } else {
        throw new Exception('Cannot require class ' . $class_name . '.');
    }
});

if (!Session::is_started())
    Session::start();
