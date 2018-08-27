<?php


class PWA_for_WordPress_Admin_View {
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
}
