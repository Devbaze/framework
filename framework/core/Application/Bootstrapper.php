<?php
/**
 * Boot application
 *
 * @package Frameworks
 * @subpackage Devbaze
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Frameworks\Application;

use Theme\App;
use Timber\Timber;
use Frameworks\Assets\Assets;
use Frameworks\Support\Traits\HasAppTrait;
use Frameworks\Providers\AppServiceProvider;
use Frameworks\Providers\CommandServiceProvider;
use Frameworks\Providers\ModelServiceProvider;
use Frameworks\Providers\DebugServiceProvider;
use Theme\Providers\ThemeServiceProvider;

class Bootstrapper
{

	use HasAppTrait;

	/**
	 * Define if the app was booted or not
	 *
	 * @var boolean
	 */
	private bool $isBooted = false;

	/**
	 * Timber object
	 *
	 * @var Timber
	 */
	public Timber $timber;

	/**
	 * Theme base path
	 *
	 * @var string
	 */
	private string $basePath;

	/**
	 * Theme base uri
	 *
	 * @var string
	 */
	private string $baseUri;

	/**
	 * Languages dir name
	 *
	 * @var string
	 */
	private string $langDir = 'languages';

	/**
	 * Public dir name
	 *
	 * @var string
	 */
	private string $publicDir = 'public';

	/**
	 * Resources dir name
	 *
	 * @var string
	 */
	private string $resourcesDir = 'resources';

	/**
	 * Storage dir name
	 *
	 * @var string
	 */
	private string $storageDir = 'storage';

	/**
	 * Routes dir name
	 *
	 * @var string
	 */
	private string $routesDir = 'routes';

	/**
	 * Init configuration object
	 *
	 * @param Timber $timber
	 */
	public function __construct( Timber $timber )
	{
		if ( ! defined( 'ABSPATH' ) ) {
			exit;
		}

		$this->timber = $timber;

		$this->setAppContainerKeys();
	}

	/**
	 * Boot application
	 *
	 * @return void
	 */
	public function run() : void
	{
		if ( $this->isBooted ) {
			return;
		}

		$this->isBooted = true;

		$this->setAppInstance( App::make() );

		$config = array_merge_recursive(
			$this->getBaseAppProviders(),
			config( 'wpemerge' ),
		);

		self::$app->bootstrap( $config );

		if ( config( 'app.assets.autoload', true ) ) {
			$this->loadAssets();
		}
	}

	/**
	 * Initialize configuration object
	 * and Timber resource directory
	 *
	 * @param string $basePath
	 * @param string $baseUri
	 * @return void
	 */
	public function setBase( string $basePath, string $baseUri ) : void
	{
		$this->basePath = $basePath;
		$this->baseUri  = $baseUri;

		$this->setBasePath();

		Config::set(
			wp_normalize_path( $this->basePath . '/config/*.php' )
		);

		$this->timber::$dirname = config( 'timber.views', 'resources/views' );
		$this->timber::$cache   = config( 'timber.cache.apply' );

		if ( true === config( 'timber.cache.apply' ) ) {
			$this->applyTimberCache();
		}
	}

	/**
	 * Get base app providers
	 *
	 * @return array
	 */
	private function getBaseAppProviders() : array
	{
		return [
			'providers' => [
				CommandServiceProvider::class,
				DebugServiceProvider::class,
				AppServiceProvider::class,
				ModelServiceProvider::class,

				/**
				 * @since 1.10.0
				 */
				ThemeServiceProvider::class,
			],
		];
	}

	/**
	 * Set Timber cache for twig templates
	 *
	 * @return void
	 */
	private function applyTimberCache() : void
	{
		add_filter(
			'timber/cache/location',
			function( $path ) {
				return config( 'timber.cache.location' );
			}
		);

		add_filter(
			'timber/twig/environment/options',
			function( $options ) {
				$options['cache'] = config( 'timber.cache.location' );
				return $options;
			}
		);
	}

	/**
	 * Load assets from manifest file
	 *
	 * @return void
	 */
	private function loadAssets() : void
	{
		$assets = new Assets();
		$assets->loadAssets();
	}

	/**
	 * Set main theme constants
	 *
	 * @return void
	 */
	private function setBasePath() : void
	{
		if ( ! defined( 'FRAMEWORKS_FRAMEWORK_PATH' ) ) {
			define( 'FRAMEWORKS_FRAMEWORK_PATH', dirname( __DIR__, 2 ) );
		}

		if ( ! defined( 'FRAMEWORKS_THEME_PATH' ) ) {
			define( 'FRAMEWORKS_THEME_PATH',  $this->basePath );
		}

		if ( ! defined( 'FRAMEWORKS_THEME_URI' ) ) {
			define( 'FRAMEWORKS_THEME_URI', $this->baseUri );
		}

		/**
		 * Path where all i18n files are
		 *
		 * @since 1.5.0
		 */
		if ( ! defined( 'FRAMEWORKS_THEME_LANG_PATH' ) ) {
			define( 'FRAMEWORKS_THEME_LANG_PATH', FRAMEWORKS_THEME_PATH . $this->langDir );
		}

		/**
		 * Public folder
		 *
		 * @since 1.7.3
		 */
		if ( ! defined( 'FRAMEWORKS_THEME_PUBLIC_PATH' ) ) {
			define( 'FRAMEWORKS_THEME_PUBLIC_PATH', FRAMEWORKS_THEME_PATH . $this->publicDir );
		}

		if ( ! defined( 'FRAMEWORKS_THEME_PUBLIC_URI' ) ) {
			define( 'FRAMEWORKS_THEME_PUBLIC_URI', FRAMEWORKS_THEME_URI . $this->publicDir );
		}

		/**
		 * Resources folder
		 *
		 * @since 1.7.3
		 */
		if ( ! defined( 'FRAMEWORKS_THEME_RESOURCES_PATH' ) ) {
			define( 'FRAMEWORKS_THEME_RESOURCES_PATH', FRAMEWORKS_THEME_PATH . $this->resourcesDir );
		}

		if ( ! defined( 'FRAMEWORKS_THEME_RESOURCES_URI' ) ) {
			define( 'FRAMEWORKS_THEME_RESOURCES_URI', FRAMEWORKS_THEME_URI . $this->resourcesDir );
		}

		/**
		 * Storage folder
		 *
		 * @since 1.10.0
		 */
		if ( ! defined( 'FRAMEWORKS_THEME_STORAGE_PATH' ) ) {
			define( 'FRAMEWORKS_THEME_STORAGE_PATH', FRAMEWORKS_THEME_PATH . $this->storageDir );
		}

		if ( ! defined( 'FRAMEWORKS_THEME_CACHED_CONFIG_FILE' ) ) {
			define( 'FRAMEWORKS_THEME_CACHED_CONFIG_FILE', FRAMEWORKS_THEME_STORAGE_PATH . '/cache/config.php' );
		}

		/**
		 * Routes folder
		 *
		 * @since 1.12.1
		 */
		if ( ! defined( 'FRAMEWORKS_THEME_ROUTES_PATH' ) ) {
			define( 'FRAMEWORKS_THEME_ROUTES_PATH', FRAMEWORKS_THEME_PATH . $this->routesDir );
		}
	}

	/**
	 * Set application keys
	 *
	 * @since 1.12.2
	 * @return void
	 */
	private function setAppContainerKeys()
	{
		/**
		 * Container keys
		 *
		 * @since 1.10.0
		 */
		if ( ! defined( 'FRAMEWORKS_CONSOLE_COMMANDS_KEY' ) ) {
			define( 'FRAMEWORKS_CONSOLE_COMMANDS_KEY', 'brocooly.console.commands' );
		}

		if ( ! defined( 'FRAMEWORKS_DEBUGGER_TWIG_KEY' ) ) {
			define( 'FRAMEWORKS_DEBUGGER_TWIG_KEY', 'brocooly.debugger.twig' );
		}

		if ( ! defined( 'FRAMEWORKS_MAIL_FACTORY_KEY' ) ) {
			define( 'FRAMEWORKS_MAIL_FACTORY_KEY', 'brocooly.mail' );
		}

		if ( ! defined( 'FRAMEWORKS_CUSTOMIZER_FACTORY_KEY' ) ) {
			define( 'FRAMEWORKS_CUSTOMIZER_FACTORY_KEY', 'brocooly.customizer' );
		}

		if ( ! defined( 'FRAMEWORKS_VALIDATOR_FACTORY_KEY' ) ) {
			define( 'FRAMEWORKS_VALIDATOR_FACTORY_KEY', 'brocooly.validator' );
		}

		if ( ! defined( 'FRAMEWORKS_FILE_FACTORY_KEY' ) ) {
			define( 'FRAMEWORKS_FILE_FACTORY_KEY', 'brocooly.file' );
		}
	}
}
