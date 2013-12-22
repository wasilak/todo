<?php
namespace Wasilak;
require "vendor/autoload.php";

define('APPLICATION_PATH', realpath(__DIR__));
define('LIB_PATH', APPLICATION_PATH . "/lib");
define('MODELS_PATH', LIB_PATH . "/Wasilak/Models");

define('DB_DRIVER', 'pdo_mysql');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'todo');
define('DB_DEV_MODE', false);
define('DB_HOST', '127.0.0.1');
