<?php
require "bootstrap.php";

use Doctrine\ORM\Tools\Console\ConsoleRunner;

$db = Wasilak\Database::getInstance();

$entityManager = $db->getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);
