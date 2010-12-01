<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\Cache\ArrayCache,
		Doctrine\Common\Annotations\AnnotationReader,
		Doctrine\ORM\Mapping\Driver\AnnotationDriver,
    Doctrine\DBAL\Logging\EchoSqlLogger,
		Doctrine\DBAL\Event\Listeners\MysqlSessionInit,
		Doctrine\ORM\Tools\SchemaTool;

/**
 * CodeIgniter Doctrine Library
 *
 * Doctine 2 wrapper for Codeigniter 
 *
 * @category		Libraries
 * @author			Rubén Sarrió <me@rubensarrio.com>
 * @link 				https://github.com/rubensarrio/codeigniter-hmvc-doctrine
 * @version			1
 */
class Doctrine {
	
  public $em = null;
	public $tool = null;
 
  public function __construct()
  {	
    // Load database configuration from CodeIgniter
    require_once APPPATH.'config/database.php';
    
		// Set up class loading
    require_once APPPATH
			.'third_party/doctrine-orm/Doctrine/Common/ClassLoader.php';
 
    $loader = new ClassLoader('Doctrine', APPPATH
			.'third_party/doctrine-orm');
    $loader->register();
		
		// Set up models loading
		$loader = new ClassLoader('models', APPPATH);
		$loader->register();
		foreach (glob(APPPATH.'modules/*', GLOB_ONLYDIR) as $m) {
			$module = str_replace(APPPATH.'modules/', '', $m);
			$loader = new ClassLoader($module, APPPATH.'modules');
			$loader->register();
		}
		
		// Set up proxies loading
    $loader = new ClassLoader('Proxies', APPPATH.'Proxies');
    $loader->register();
 		
    // Set up caches
    $config = new Configuration;
    $cache = new ArrayCache;
    $config->setMetadataCacheImpl($cache);
    $config->setQueryCacheImpl($cache);
 
    // Set up driver
    $reader = new AnnotationReader($cache);
    $reader
			->setDefaultAnnotationNamespace('Doctrine\ORM\Mapping\\');
    
		// Set up models
		$models = array(APPPATH.'models');
		foreach (glob(APPPATH.'modules/*/models', GLOB_ONLYDIR) as $m)
			array_push($models, $m);
		$driver = new AnnotationDriver($reader, $models);

    $config->setMetadataDriverImpl($driver);
 
    // Proxy configuration
    $config->setProxyDir(APPPATH.'/Proxies');
    $config->setProxyNamespace('Proxies');
 
    // Set up logger
    //$logger = new EchoSqlLogger;
    //$config->setSqlLogger($logger);
 
    $config->setAutoGenerateProxyClasses( TRUE );
		
    // Database connection information
    $connection = array(
        'driver' => 'pdo_mysql',
        'user' =>     $db['default']['username'],
        'password' => $db['default']['password'],
        'host' =>     $db['default']['hostname'],
        'dbname' =>   $db['default']['database']
    );
 
    // Create EntityManager
    $this->em = EntityManager::create($connection, $config);
		
		// Force UTF-8
		$this->em->getEventManager()->addEventSubscriber(
			new MysqlSessionInit('utf8', 'utf8_unicode_ci'));
		
		// Schema Tool
		$this->tool = new SchemaTool($this->em);
  }
}

// END Doctrine class

/* End of file Doctrine.php */
/* Location: ./application/libraries/Doctrine.php */