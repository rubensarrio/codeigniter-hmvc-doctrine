# CodeIgniter 2 + HMVC + Doctrine 2

Setup ready to use CodeIgniter framework with:

-	[CodeIgniter 2.1](http://codeigniter.com)
- [Modular Extensions - HMVC](http://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc/overview)
- [Doctrine 2.0](http://http://www.doctrine-project.org/)
- [DoctrineExtensions](https://github.com/l3pp4rd/DoctrineExtensions) (partial support)


## How to use?

### Configuration

Set up *application/config/config.php* and *application/config/database.php* for your network.

Load Doctrine library adding it on autoload.php, example:

	$autoload['libraries'] = array('doctrine');
	
Or load Doctrine library in any controller, example:

	$this->load->library('doctrine');
	
### Creating models

This setup uses **docblock annotations** mapping driver and **models** namespace, you can change it in *application/libraries/Doctrine.php*.

Example of root model (not in a module), it should be inside *application/models*:

	namespace models;

	/**
	 * @Entity
	 * @Table(name="users")
	 */
	class User {
		/**
		 * @Id
		 * @Column(type="integer")
		 * @GeneratedValue
		 */
		private $id;

		/**
		 * @Column(type="string", length=32, nullable=false)
		 */
		private $username;
		
		// ...
	}
	
Example of model in a module, it should be inside *application/[module_name]/models*. Note the difference in namespace:

	// Prototype:
	// namespace [module_name]\models;
	// Example:
	namespace auth\models;

	class User {
		/**
		 * @Id
		 * @Column(type="integer")
		 * @GeneratedValue
		 */
		private $id;

		/**
		 * @Column(type="string", length=32, nullable=false)
		 */
		private $username;
		
		// ...
	}

### Creating schemas

To generate automatically schemas for your models you can use the Doctrine console or the schema tool from library:

	$this->doctrine->tool->createSchema('auth\models\User');
	
Other useful methods:

	$this->doctrine->tool->dropSchema('auth\models\User');
	
	$this->doctrine->tool->updateSchema('auth\models\User');

### Using models

Loading from controllers it's easy, example:

	$user = new auth\models\User;
	// ...
	$this->doctrine->em->persist($user);
	

You can also shorten the instantiation with the **use** operator (before class definition):

	use auth\models\User;
	
	class Test extends CI_Controller {
		// ...
		
		public function index()
		{
			$user = new User;
			// ...
		}
	}

### Doctrine console

Doctrine console can be used in terminal from *application/third_party/doctrine-orm/bin/doctrine*, examples:

	php doctrine list
	
	php doctrine orm:schema-tool:create
	
	php doctrine orm:schema-tool:update
	
	php doctrine orm:schema-tool:drop

## More information

- [CodeIgniter user guide](http://codeigniter.com/user_guide)
- [HMVC Wiki](http://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc/wiki)
- [Doctrine documentation](http://www.doctrine-project.org/projects/orm/2.0/docs/en)
- [DoctrineExtensions Post](http://www.doctrine-project.org/blog/doctrine2-behavioral-extensions)