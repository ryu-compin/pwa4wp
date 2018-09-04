<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/ryu-compin/pwa4wp
 * @since      1.0.2
 *
 * @package    pwa4wp
 * @subpackage pwa4wp/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.2
 * @package    pwa4wp
 * @subpackage pwa4wp/includes
 * @author     Ryunosuke Shindo <ryu@compin.jp>
 */
class pwa4wp_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.2
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			'pwa4wp',
			false,
//			dirname(  __FILE__,2 )  . '/languages/'
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
//            'pwa4wp/languages/'

//			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
//            str_replace(home_url()."/",get_home_path(),WP_PLUGIN_URL.'/'.substr(plugin_basename(__FILE__),0,strpos(plugin_basename(__FILE__),"/"))), '/languages/'
		);

	}




}
