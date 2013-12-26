<?php
namespace Wasilak;
require "vendor/autoload.php";

define('APPLICATION_PATH', realpath(__DIR__));
define('LIB_PATH', APPLICATION_PATH . "/lib");
define('TEMPLATES_PATH', APPLICATION_PATH . '/templates');
define('MODELS_PATH', LIB_PATH . "/Wasilak/Models");

if (PHP_SAPI != 'cli') define('URI', rtrim($_SERVER['REQUEST_URI'], '/'));

include 'config.php';
