<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://github.com/ryu-compin/pwa4wp
 * @since      1.0.0
 *
 * @package    pwa4wp
 * @subpackage pwa4wp/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
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
	 * @since    1.0.0
	 */
	public static function deactivate() {
        if(file_exists(get_home_path() . PWA4WP_MANIFEST_FILE))
        {
            unlink(get_home_path() . PWA4WP_MANIFEST_FILE);
        }
        if(file_exists(get_home_path() . PWA4WP_SERVICEWORKER_FILE))
        {
            unlink(get_home_path() . PWA4WP_SERVICEWORKER_FILE);
        }
	}
}
