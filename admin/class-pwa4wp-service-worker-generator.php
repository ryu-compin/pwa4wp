<?php


class pwa4wp_Service_Worker_Generator {

	private $plugin_root_url;
	private $version = '1.2.0';

	public function __construct( $plugin_root ) {
		$this->plugin_root_url = $plugin_root;
	}

	public function generate( $data ) {
        $offlinePage = get_permalink( $data['offline_url'] );
        $data['initial-caches'][] = $offlinePage;
		$initialCaches   = stripslashes(json_encode( $data['initial-caches'] ));
        $data['exclusions'][] = "^.*/wp-admin/.*";
		$data['exclusions'][] = "^.*/wp-login.php$";
        $data['exclusions'][] = "^.*[\\\\?&]preview=true.*$";
		$exclusions = stripslashes(stripslashes(json_encode($data['exclusions'])));
        $forcechache = stripslashes(stripslashes(json_encode($data['forcecache'])));
        $forceonline = stripslashes(stripslashes(json_encode($data['forceonline'])));
        $ttl = intval($data['ttl'])*60;
		$cachePlan = $data['cache_plan'];
		if($data['noCachReflesh'] == "noCachReflesh"){
			$cacheReflesh = "OFF";
		}else{
			$cacheReflesh = "ON";
		}
        $swVersion = $data['sw_version'];
		$cacheManagerUrl = $this->plugin_root_url . 'public/js/pwa4wp-cache-manager.js?' . $this->version .".". get_option('pwa4wp_sw_version');
		$dexieUrl        = $this->plugin_root_url . 'public/js/lib/dexie.min.js?' . $this->version .".". get_option('pwa4wp_sw_version');
		$debug_msg = $data['debug_msg'];

		$script          = <<<SCRIPT
const cacheSettings = {
	name: "pwa4wp-cache-${swVersion}",
	cacheName: "pwa4wp-cache-${swVersion}",
	initialCaches: ${initialCaches},
	exclusions: ${exclusions},
	forceonline: ${forceonline},
	forcecache: ${forcechache},
	ttl : ${ttl},
	offlinePage : "${offlinePage}",
	cachePlan : "${cachePlan}",
	cacheReflesh : "${cacheReflesh}",
	dbVersion : "${swVersion}",
	debug_msg : "${debug_msg}",
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
