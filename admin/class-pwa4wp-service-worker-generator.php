<?php


class pwa4wp_Service_Worker_Generator {

	private $plugin_root_url;
	private $version = '0.0.2';

	public function __construct( $plugin_root ) {
		$this->plugin_root_url = $plugin_root;
	}

	public function generate( $data ) {
        $offlinePage = get_permalink( $data['offline_url'] );
        $data['initial-caches'][] = $offlinePage;
		$initialCaches   = json_encode( $data['initial-caches'] );
        $data['exclusions'][] = "^.*/wp-admin/.*";
		$exclusions = json_encode($data['exclusions']);
        $ttl = intval($data['ttl'])*60;
		$cachePlan = $data['cache_plan'];
        $swVersion = $data['sw_version'];
		$cacheManagerUrl = $this->plugin_root_url . 'public/js/pwa4wp-cache-manager.js?' . $this->version;
		$dexieUrl        = $this->plugin_root_url . 'public/js/lib/dexie.min.js?' . $this->version;
		$debug_msg = $data['debug_msg'];
		$script          = <<<SCRIPT
const cacheSettings = {
	name: "pwa4wp-cache-${swVersion}",
	cacheName: "pwa4wp-cache-${swVersion}",
	initialCaches: ${initialCaches},
	exclusions: ${exclusions},
	ttl : ${ttl},
	offlinePage : "${offlinePage}",
	cachePlan : "${cachePlan}",
	dbVersion : "${swVersion}",
	debug_msg : "${debug_msg}"
};

importScripts('${cacheManagerUrl}');
importScripts('${dexieUrl}');
const db = new Dexie('pwa4wp-db');
const pwa4wp_cacheManager = new pwa4wp_CacheManager(this, caches, db, cacheSettings);
pwa4wp_cacheManager.initialize();
SCRIPT;

		return $script;
	}
}
