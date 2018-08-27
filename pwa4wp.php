<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/ryu-compin/pwa4wp
 * @since             1.0.0
 * @package           PWA_for_WordPress
 *
 * @wordpress-plugin
 * Plugin Name:       PWA for WordPress
 * Plugin URI:        https://github.com/ryu-compin/pwa4wp
 * Description:       Provides transformation for WordPress to PWA.
 * Version:           1.0.0
 * Author:            pwa4wp Developers Group
 * Author URI:        https://github.com/ryu-compin/pwa4wp/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pwa4wp
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PWA_for_WordPress_VERSION', '1.0.0' );

define( 'SERVICEWORKER_FILE', 'pwa4wp-sw-'.get_current_blog_id().'.js');
define( 'MANIFEST_FILE', 'pwa4wp-manifest-'.get_current_blog_id().'.json');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pwa4wp-activator.php
 */
function activate_PWA_for_WordPress() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pwa4wp-activator.php';
	PWA_for_WordPress_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pwa4wp-deactivator.php
 */
function deactivate_PWA_for_WordPress() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pwa4wp-deactivator.php';
	PWA_for_WordPress_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_PWA_for_WordPress' );
register_deactivation_hook( __FILE__, 'deactivate_PWA_for_WordPress' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pwa4wp.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_PWA_for_WordPress() {

	$plugin = new PWA_for_WordPress();
	$plugin->run();

}
run_PWA_for_WordPress();


