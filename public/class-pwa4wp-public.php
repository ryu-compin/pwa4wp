<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/ryu-compin/pwa4wp
 * @since      1.0.0
 *
 * @package    pwa4wp
 * @subpackage pwa4wp/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    pwa4wp
 * @subpackage pwa4wp/public
 * @author     Ryunosuke Shindo <ryu@compin.jp>
 */
class pwa4wp_Public {

	/**
	 * @since    1.0.0
	 * @access   private
	 * @var      pwa4wp_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	private $loader;

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $pwa4wp The ID of this plugin.
	 */
	private $pwa4wp;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $pwa4wp The name of the plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $pwa4wp, $version, $loader ) {

		$this->pwa4wp = $pwa4wp;
		$this->version     = $version;
		$this->loader      = $loader;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in pwa4wp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The pwa4wp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->pwa4wp, plugin_dir_url( __FILE__ ) . 'css/pwa4wp-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in pwa4wp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The pwa4wp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		echo "<script>if ('serviceWorker' in navigator) {navigator.serviceWorker.register('/" . PWA4WP_SERVICEWORKER_FILE . "');}</script>";
	}

	public function enqueue_head() {
		echo '<link rel="manifest" href="/'. PWA4WP_MANIFEST_FILE .'" />';
		echo '<meta name="theme-color" content="'.get_option( 'pwa4wp_manifest' )['theme_color'] .'"/>';
		$manifest = get_option( 'pwa4wp_manifest' );
		foreach ( $manifest['icons'] as $icon ) {
			echo '<link rel="apple-touch-icon" sizes="' . $icon['sizes'] . '" href="' . $icon['src'] . '">';
		}
	}

	public function define_hooks() {
		$this->loader->add_action( 'wp_enqueue_scripts', $this, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $this, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_head', $this, 'enqueue_head' );
	}
}
