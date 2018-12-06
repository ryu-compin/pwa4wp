<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/ryu-compin/pwa4wp
 * @since      1.0.2
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
	 * @since    1.0.2
	 * @access   private
	 * @var      pwa4wp_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	private $loader;

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.2
	 * @access   private
	 * @var      string $pwa4wp The ID of this plugin.
	 */
	private $pwa4wp;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.2
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.2
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
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.2
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
        if((!is_multisite())||(is_main_site())||((is_multisite())&&(get_blog_option( 1, 'pwa4wp_multisite_unify', $default = 1 ) == 1))) {
            $sw_switch = get_option('pwa4wp_sw_installation_switch');
        }else{
            $sw_switch = get_blog_option( 1, 'pwa4wp_sw_installation_switch');
        }
        if($sw_switch){
		    if(!empty(get_option('pwa4wp_manifest')['scope'])){
		        echo "<!--" . get_option('pwa4wp_manifest')['scope'] . "-->";
                echo "<script>if ('serviceWorker' in navigator) {navigator.serviceWorker.register('/" . PWA4WP_SERVICEWORKER_FILE . "', {scope:'" . get_option('pwa4wp_manifest')['scope'] . "'});}</script>";
            }else{
                echo "<script>if ('serviceWorker' in navigator) {navigator.serviceWorker.register('/" . PWA4WP_SERVICEWORKER_FILE . "', {scope:'/');}</script>";
            }
		}
	}

	public function enqueue_head() {
        if((!is_multisite())||(is_main_site())||((is_multisite())&&(get_blog_option( 1, 'pwa4wp_multisite_unify', $default = 1 ) == 1))) {
            $sw_switch = get_option('pwa4wp_sw_installation_switch');
        }else{
            $sw_switch = get_blog_option( 1, 'pwa4wp_sw_installation_switch');
        }
        if($sw_switch) {
			echo '<link rel="manifest" href="/' . PWA4WP_MANIFEST_FILE . '" />';
			echo '<meta name="theme-color" content="' . get_option( 'pwa4wp_manifest' )['theme_color'] . '"/>';
			$manifest = get_option( 'pwa4wp_manifest' );
			If (!empty($manifest['icons'])){
                foreach ( $manifest['icons'] as $icon ) {
                    echo '<link rel="apple-touch-icon" sizes="' . $icon['sizes'] . '" href="' . $icon['src'] . '">';
                }
            }
		}
	}

	public function define_hooks() {
		$this->loader->add_action( 'wp_enqueue_scripts', $this, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_head', $this, 'enqueue_head' );
	}
}
