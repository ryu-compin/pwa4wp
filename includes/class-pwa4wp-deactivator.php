<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://github.com/ryu-compin/pwa4wp
 * @since      1.0.0
 *
 * @package    PWA_for_WordPress
 * @subpackage PWA_for_WordPress/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    PWA_for_WordPress
 * @subpackage PWA_for_WordPress/includes
 * @author     Ryunosuke Shindo <ryu@compin.jp>
 */
class PWA_for_WordPress_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
        if(file_exists(get_home_path() . MANIFEST_FILE))
        {
            unlink(get_home_path() . MANIFEST_FILE);
        }
        if(file_exists(get_home_path() . SERVICEWORKER_FILE))
        {
            unlink(get_home_path() . SERVICEWORKER_FILE);
        }
	}
}
