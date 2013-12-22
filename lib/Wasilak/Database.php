<?php
namespace Wasilak;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Database {
	private static $instance = null;
	private $entityManager = null;

	private function __construct()
	{

		$paths = array(MODELS_PATH);
		$isDevMode = DB_DEV_MODE;

		// the connection configuration
		$dbParams = array(
		    'driver'   => DB_DRIVER,
		    'user'     => DB_USER,
		    'password' => DB_PASSWORD,
		    'dbname'   => DB_DATABASE,
		    'host'	   => DB_HOST
		);

		$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
		$this->entityManager = EntityManager::create($dbParams, $config);
	}

	public static function getInstance()
	{
		if (!self::$instance) {
			self::$instance = new Database();
		}
		return self::$instance;
	}

	public function getEntityManager()
	{
		return $this->entityManager;
	}

}