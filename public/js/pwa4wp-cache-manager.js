/* global STATIC_FILES, CACHE_NAME, NEVER_CACHE_URLS, blacklist */

class pwa4wp_CacheManager {
    /**
     *
     * @param serviceWorker ServiceWorker
     * @param caches Cache
     * @param db Dexie
     * @param settings
     */
    constructor(serviceWorker, caches, db, settings) {
        this.serviceWorker = serviceWorker;
        this.caches = caches;
        this.settings = settings;
        this.db = db;
        this.debug = false;
        if(this.settings.debug_msg =="ON"){
            this.debug = true;
        }
    }

    // イベント登録処理
    initialize() {
        this.db.version(this.settings.dbVersion).stores({caches: "url,cached_at,ttl"});
        if(this.debug){
            console.log("db version" + this.settings.dbVersion.toString());
        }
        this.serviceWorker.addEventListener('install', (event) => {
            if(this.debug){
                console.log('service worker installed');
            }

            // インストール処理
            event.waitUntil(
                this.caches.open(this.settings.cacheName)
                    .then((cache) => {
                        if(this.debug){
                            console.log("add initial cache");
                            console.log(this.settings.initialCaches);
                        }
                        return cache.addAll(this.settings.initialCaches);
                    })
            )
        });
        this.serviceWorker.addEventListener('activate', (event) => {
            event.waitUntil(
                caches.keys().then((keys)=>{
                    keys.map((key)=>{
                        if(key !== this.settings.cacheName){
                            if(this.debug){
                                console.log("deleted cache. : " + key);
                            }
                            return caches.delete(key);
                        }
                    })
                })
            );
        });

        this.serviceWorker.addEventListener('fetch', (event) => {
            if(this.debug){
                console.log("fetch request:" + event.request.url);
            }
            return this.onFetch(event);
        });

    }

    onFetch(event) {
        // キャッシュ可能かどうか
        let isGetRequest = event.request.method === 'GET';
        let isExcluded = this.settings.exclusions.some((pattern) => {
            return (new RegExp(pattern)).test(event.request.url);
        });
        let cacheable = event.request.method === 'GET' && !this.settings.exclusions.some((pattern) => {
            return (new RegExp(pattern)).test(event.request.url);
        });
        if (!cacheable) {
            // キャッシュ対象外の場合はサーバーにリクエスト。
            if(this.debug){
                console.log("cache excluded.");
            }
            return event.respondWith(fetch(event.request).catch(() => {
                return this.caches.match(this.settings.offlinePage);
            }));
        }
        if(this.settings.cachePlan === "onlinefirst"){
            // online-first
            if(this.debug){
                console.log("online-first mode : " + event.request.url);
            }
            return event.respondWith(this.remoteFirstFetch(event.request).catch(() => {
                return this.caches.match(this.settings.offlinePage);
            }));
        }else{
            // cache-first
            if(this.debug){
                console.log("cache-first mode : " + event.request.url);
            }
            // キャッシュ対象の場合はキャッシュ優先方式でレスポンスを返す。
            return event.respondWith(this.cacheFirstFetch(event.request).catch(() => {
                return this.caches.match(this.settings.offlinePage);
            }));
        }
    }

    /**

     * @param request Request
     */
    cacheFirstFetch(request) {
        if(this.debug){
            console.log("get cache : " + request.url);
        }
        return this.db.caches.get(request.url)
            .then((data) => {
                // キャッシュ情報がundefined,もしくはttl以上の時間が経過していた場合はサーバーから再取得優先
                if (!data ){
                    if(this.debug){
                        console.log("no data -> fetch");
                    }
                    return this.remoteFirstFetch(request);
                }else if((data.ttl > 0)&&( Date.now() - data.cached_at > data.ttl * 1000)) {
                    if(this.debug){
                        console.log("elapsed time from cached : " + (Date.now() - data.cached_at).toString() + " -> expire ( > " + data.ttl + " x1000 )" + " -> fetch");
                    }
                    this.db.caches.delete(request.url);
                    return this.remoteFirstFetch(request);
                }
                console.log("elapsed time from cached : " + (Date.now() - data.cached_at).toString() + " -> still can be use ( < " + data.ttl + " x1000 )");

                return this.caches.match(request).then((response) => {
                    if(this.debug){
                        console.log("return cached data");
                    }
                    if (response) {
                        return response;
                    }
                    if(this.debug){
                        console.log('call fetch&cache', request.url);
                    }
                    return this.fetchAndCache(request);
                });
            }).catch(() => {
                if(this.debug){
                    console.log("return new cached data");
                }
                return this.fetchAndCache(request);
            });
    }


    remoteFirstFetch(request) {
        if(this.debug){
            console.log('remoteFirstFetch', request.url);
        }
        return this.fetchAndCache(request).catch(() => {
            if(this.debug){
                console.log('fail to fetch. use cache');
            }
            return this.caches.match(request);
        });
    }

    fetchAndCache(request) {
        // Indexeddbにキャッシュ日時を保存し、expireする。
        return fetch(request).then((response) => {
            if (response.status !== 200) {
                return response;
            }
            let res = response.clone();
            this.caches.open(this.settings.cacheName).then((cache) => {
                cache.add(request.url, res).then((result) => {
                    if(this.debug){
                        console.log("added cache :" + request.url + " : " + result);
                    }
                }, (err) => {
                    if(this.debug){
                        console.log("add cache error : " + request.url + " : " + err);
                    }
                });
            });
            this.db.caches.put({
                url: request.url,
                cached_at: Date.now(),
                ttl: this.settings.ttl
            });
            return response;
        });
    }
}



