<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/ryu-compin/pwa4wp
 * @since      1.0.0
 *
 * @package    PWA_for_WordPress
 * @subpackage PWA_for_WordPress/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    PWA_for_WordPress
 * @subpackage PWA_for_WordPress/includes
 * @author     Ryunosuke Shindo <ryu@compin.jp>
 */
class PWA_for_WordPress_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
	    if(get_option( 'pwa4wp_app_icons' ) == false){
            update_option('pwa4wp_sw_version',0);
        }
        update_option('pwa4wp_manifest_created',false);
        update_option('pwa4wp_sw_created',false);
        update_option('pwa4wp_push_enable',false);
	}

}
