<?php
namespace Wasilak;
require "bootstrap.php";

// init database via Doctrine 2
$db = Database::getInstance();
$entityManager = $db->getEntityManager();

$app = new \Slim\Slim();

$app->get('/', function () use ($app, $entityManager) {
	$todo = new Models\Todo();
	$todo->setName('first ToDo');

	$entityManager->persist($todo);
	$entityManager->flush();

	$app->render('index.php', array('hello' => 'hello world!'));
})->name('home');;

$app->run();
