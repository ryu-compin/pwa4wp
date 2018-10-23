<?php


class pwa4wp_Admin_View {
	public function __construct() {
	}
	public function render($data) {
		include_once plugin_dir_path(__FILE__). 'partials/pwa4wp-admin-display.php';
	}
    public function render_manifest($data) {
        include_once plugin_dir_path(__FILE__). 'partials/pwa4wp-admin-manifest.php';
    }
    public function render_sw($data) {
        include_once plugin_dir_path(__FILE__). 'partials/pwa4wp-admin-sw.php';
    }
    public function render_advanced($data) {
        include_once plugin_dir_path(__FILE__). 'partials/pwa4wp-admin-advanced.php';
    }
}
