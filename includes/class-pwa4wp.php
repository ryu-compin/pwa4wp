<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/ryu-compin/pwa4wp
 * @since      1.0.0
 *
 * @package    PWA_for_WordPress
 * @subpackage PWA_for_WordPress/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    PWA_for_WordPress
 * @subpackage PWA_for_WordPress/includes
 * @author     Ryunosuke Shindo <ryu@compin.jp>
 */
class PWA_for_WordPress {
	/**
	 * @var PWA_for_WordPress_Admin $admin
	 */
	protected $admin;
	/**
	 * @var PWA_for_WordPress_Public $public
	 */
	protected $public;

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      PWA_for_WordPress_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $PWA_for_WordPress The string used to uniquely identify this plugin.
	 */
	protected $PWA_for_WordPress;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $version The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'PWA_for_WordPress_VERSION' ) ) {
			$this->version = PWA_for_WordPress_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->PWA_for_WordPress = 'PWA for WordPress';

		$this->load_dependencies();
		$this->set_locale();
		$this->admin->define_hooks();
		$this->public->define_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - PWA_for_WordPress_Loader. Orchestrates the hooks of the plugin.
	 * - PWA_for_WordPress_i18n. Defines internationalization functionality.
	 * - PWA_for_WordPress_Admin. Defines all hooks for the admin area.
	 * - PWA_for_WordPress_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pwa4wp-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pwa4wp-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-pwa4wp-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-pwa4wp-public.php';

		$this->loader = new PWA_for_WordPress_Loader();
		$this->admin  = $plugin_admin = new PWA_for_WordPress_Admin( $this->get_PWA_for_WordPress(), $this->get_version(), $this->loader );
		$this->public = new PWA_for_WordPress_Public( $this->get_PWA_for_WordPress(), $this->get_version(), $this->loader );

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the PWA_for_WordPress_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new PWA_for_WordPress_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_PWA_for_WordPress() {
		return $this->PWA_for_WordPress;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    PWA_for_WordPress_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
