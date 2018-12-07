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
		if((!is_multisite())||(is_main_site())||((is_multisite())&&(get_blog_option( 1, 'pwa4wp_multisite_unify', $default = 1 ) == 1))) {
            $sw_switch = get_option('pwa4wp_sw_installation_switch');
            $sw_version = get_option('pwa4wp_sw_version') ;
	        $sw_scope = get_option('pwa4wp_manifest')['scope'];
            $a2hs_switch = get_option( 'pwa4wp_defer_install', $default = 1 );
        }else{
            $sw_switch = get_blog_option( 1, 'pwa4wp_sw_installation_switch');
	        $sw_version = get_blog_option( 1,'pwa4wp_sw_version') ;
	        $sw_scope = get_blog_option( 1,'pwa4wp_manifest')['scope'];
	        $a2hs_switch = get_blog_option( 1,  'pwa4wp_defer_install', $default = 1 );
        }
        if($sw_switch){
        	if($a2hs_switch == 0){
		        echo "<script>if ('serviceWorker' in navigator) {import('" . plugin_dir_url( __FILE__ ) . 'js/pwa4wp-a2hs-controler.js?' . $this->version .".". $sw_version . "');}</script>";
	        }
		    if($sw_scope != ""){
                echo "<script>if ('serviceWorker' in navigator) {navigator.serviceWorker.register('/" . PWA4WP_SERVICEWORKER_FILE . "', {scope:'" . $sw_scope . "'});}</script>";
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
	        if((!is_multisite())||(is_main_site())||((is_multisite())&&(get_blog_option( 1, 'pwa4wp_multisite_unify', $default = 1 ) == 1))) {
		        $manifest = get_option( 'pwa4wp_manifest' );
	        }else{
		        $manifest = get_blog_option( 1, 'pwa4wp_manifest' );
	        }
	        echo '<meta name="theme-color" content="' . $manifest['theme_color'] . '"/>';
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
