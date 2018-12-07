<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/ryu-compin/pwa4wp
 * @since      1.0.2
 *
 * @package    pwa4wp
 * @subpackage pwa4wp/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.2
 * @package    pwa4wp
 * @subpackage pwa4wp/includes
 * @author     Ryunosuke Shindo <ryu@compin.jp>
 */
class pwa4wp_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.2
	 */
	public static function activate() {
	    if(get_option( 'pwa4wp_sw_version' ) == false){
            update_option('pwa4wp_sw_version',0);
        }
		if(get_option('pwa4wp_manifest_created') == false) {
			update_option( 'pwa4wp_manifest_created', false );
		}
		if(get_option('pwa4wp_sw_created') == false) {
			update_option( 'pwa4wp_sw_created', false );
		}
		if(get_option('pwa4wp_push_enable') == false) {
			update_option( 'pwa4wp_push_enable', false );
		}
		if(get_option('pwa4wp_sw_installation_switch', true) == true) {
			update_option( 'pwa4wp_sw_installation_switch', true );
		}
		if(get_option('pwa4wp_multisite_unify') == false) {
			update_option( 'pwa4wp_multisite_unify', 0 );
		}
        if(get_option('pwa4wp_defer_install') == false){
	        update_option('pwa4wp_defer_install', 1);
        }
	}
}
