<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://github.com/ryu-compin/pwa4wp
 * @since      1.0.1
 *
 * @package    pwa4wp
 * @subpackage pwa4wp/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.1
 * @package    pwa4wp
 * @subpackage pwa4wp/includes
 * @author     Ryunosuke Shindo <ryu@compin.jp>
 */
class pwa4wp_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.1
	 */
	public static function deactivate() {
        if(file_exists(get_home_path() . PWA4WP_MANIFEST_FILE))
        {
            unlink(get_home_path() . PWA4WP_MANIFEST_FILE);
        }
        update_option('pwa4wp_manifest_created',false);
        if(file_exists(get_home_path() . PWA4WP_SERVICEWORKER_FILE))
        {
            unlink(get_home_path() . PWA4WP_SERVICEWORKER_FILE);
        }
        update_option('pwa4wp_sw_created',false);
		update_option('pwa4wp_sw_installation_switch', false);
	}
}
