<?php
namespace Wasilak;
require "../bootstrap.php";

// init database via Doctrine 2
$db = Database::getInstance();
$entityManager = $db->getEntityManager();

$app = new \Slim\Slim(array('templates.path'=>TEMPLATES_PATH));

// show
$app->get('/todos/:id', function($id) use ($entityManager) {

	$todo = $entityManager->find('\Wasilak\Models\Todo', $id);

	$object = new \stdClass();
	$object->id = $todo->getId();
	$object->name = $todo->getName();

	echo json_encode($object);
});

// delete
$app->delete('/todos/:id', function($id) use ($entityManager) {

	$todo = $entityManager->find('\Wasilak\Models\Todo', $id);

	$entityManager->remove($todo);
	$entityManager->flush();

	echo json_encode(true);
});

// list
$app->get('/todos', function() use ($entityManager) {
	$todoRepository = $entityManager->getRepository('\Wasilak\Models\Todo');
	$todos = $todoRepository->findAll();

	$data = array();

	foreach ($todos as $todo) {
	    $object = new \stdClass();
		$object->id = $todo->getId();
	    $object->name = $todo->getName();
	    $object->completed = $todo->getCompleted();
	    $object->createdAt = $todo->getCreatedAt();
	    $data[] = $object;
	}

	echo json_encode($data);
});

// add
$app->post('/todos', function() use ($entityManager) {
	$request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());

    if ('' === trim($data->name)) $data->name = null;

	$todo = new Models\Todo();
	$todo->setName($data->name);
	$todo->setCompleted($data->completed);
	$todo->setCreatedAt(new \DateTime(date('Y-m-d H:i:s')));

	$entityManager->persist($todo);
	$entityManager->flush();

	$data->id = $todo->getId();
	$data->completed = $todo->getCompleted();
	$data->name = $todo->getName();
	$data->createdAt = $todo->getCreatedAt();

	echo json_encode($data);
});

// update
$app->put('/todos/:id', function($id) use ($entityManager) {
	$request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());

	$todo = $entityManager->find('\Wasilak\Models\Todo', $id);
	$todo->setName($data->name);
	$todo->setCompleted($data->completed);

	$entityManager->persist($todo);
	$entityManager->flush();

	$data->id = $todo->getId();

	echo json_encode($data);
});

$app->get('/', function () use ($app, $entityManager) {
	$app->render('index.php');
})->name('home');

$app->run();
