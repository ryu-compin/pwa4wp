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
 * @since             1.0.2
 * @package           pwa4wp
 *
 * @wordpress-plugin
 * Plugin Name:       PWA for WordPress
 * Plugin URI:        https://github.com/ryu-compin/pwa4wp
 * Description:       Provides transformation for WordPress to PWA.
 * Version:           1.0.3
 * Author:            PWA for WordPress Developers Group
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
 * Start at version 1.0.2 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PWA4WP_VERSION', '1.0.3' );

define( 'PWA4WP_SERVICEWORKER_FILE', 'pwa4wp-sw-'.get_current_blog_id().'.js');
define( 'PWA4WP_MANIFEST_FILE', 'pwa4wp-manifest-'.get_current_blog_id().'.json');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pwa4wp-activator.php
 */
function pwa4wp_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pwa4wp-activator.php';
	pwa4wp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pwa4wp-deactivator.php
 */
function pwa4wp_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pwa4wp-deactivator.php';
	pwa4wp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'pwa4wp_activate' );
register_deactivation_hook( __FILE__, 'pwa4wp_deactivate' );

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
 * @since    1.0.2
 */
function pwa4wp_run() {

	$plugin = new pwa4wp_init();
	$plugin->run();

}
pwa4wp_run();


