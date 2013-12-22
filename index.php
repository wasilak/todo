<?php
require "vendor/autoload.php";

define('APPLICATION_PATH', realpath(__DIR__));

$app = new \Slim\Slim();

$app->get('/', function () use ($app) {
	$app->render('index.php', array('hello' => 'hello world!', 'app'=>$app));
})->name('home');;

$app->run();
