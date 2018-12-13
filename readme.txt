=== PWA for WordPress ===
Contributors: ryushindo
Donate link: https://paypal.me/pwa4wp/10USD
Tags: pwa, progressive web app, progressive web apps, pwa4wp, mobile, responsive, offline, cache
Requires at least: 4.4
Tested up to: 5.0
Stable tag: 1.1.4
Requires PHP: 5.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

PWA for WordPress makes your WordPress site to PWA (Progressive Web App) and makes control of PWA data caches easy.

== Description ==

### About this plugin
To make your WordPress website to PWA, this plugin make two files, "Manifest" and "ServiceWorker" in your website.
Manifest file is a json file that has configurations of web applications.
ServiceWorker is a JavaScript file that controls PWA's functions.
To start PWA, configure two files from configuration screen.

You can fine-tune the cache, such as expiration date, time and URL exclusion.
By excluding the URLs, like a new arrival information,  data acquisition destination in Ajax, this plugin can keep PWA data fresh.
You can set expire time of caches, then old cache will purged after specified time.

### STEP1
#### Configure Manifest

Prepare icon image file, image file must be png format.
Make offline page, this page will cached with PWA installation and shown when PWA is offline.
Setup manifest file from Manifest Configuration page.
Image file will be resized to fit icon sizes automatically.

### STEP2
#### Configure ServiceWorker

Setup ServiceWorker file from ServiceWorker Configuration page.

### COMPLETE!

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/pwa4wp` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the `PWA for WordPress` screen to configure the plugin
1. If "Current PWA Status" in main panel is not working, press "START" button.
1. done!


== Frequently Asked Questions ==

= If you have any questions... =

Contact us from this link.
[http://www.compin.jp/contact-pwa4wp/](http://www.compin.jp/contact-pwa4wp/)

= Update information =

We are managing the source code with github.
There is information about updates and issues.
[https://github.com/ryu-compin/pwa4wp](https://github.com/ryu-compin/pwa4wp)

== Screenshots ==

1. Main panel: status and usage, toggle switch for PWA start/stop.
2. Configure and generate 'Manifest'
3. Configure and generate 'ServiceWorker'

== Upgrade Notice ==
= 1.1.4 =
Update:
Added preview page to default exclude URL.

== Changelog ==
= 1.1.4 =
Update:
Added preview page to default exclude URL.

= 1.1.3 =
Fixed issue:
in pwa4wp-a2hs-controller.js, event didn't pushed into global variable.

= 1.1.2 =
Fixed issue:
Fixed a2hs control js error.

= 1.1.0 / 1.1.1 =
Release Date - 06 December, 2018
Update:
Multi-site supported.
Defer PWA installation option added.
Fixed issue:
Regular expression form for "URLs for exclude from cache list" increases escape character in every time saving settings.

= 1.0.7 =
Release Date - 22 September, 2018
Update:
Added test form for reguler expression in ServiceWorker settings.
Fixed issue:
Fixed PHP worning when PWA is active before Manifest created.
Fixed PHP worning when Manifest create before ServiceWorker created.

= 1.0.5 / 1.0.6 =
Release Date - 12 September, 2018
Fixed issue:
Readme typo.
Fixed JavaScript error when fetching "online first".

= 1.0.4 =
Release Date - 12 September, 2018
Fixed issue:
Readme typo.
Update:
When Manifest file generated, ServiceWorker will be re-generated only when ServiceWorker already exists.
Added donation button. :)
Edited CSS.

= 1.0.3 =
Release Date - 04 September, 2018
Fixed issue:
ServiceWorker cache name is not correct.

= 1.0.2 =
Release Date - 04 September, 2018
Fixed issue:
Removed unused CSS loading.
Update:
Add toggle switch for PWA start/stop

= 1.0.1 =
Release Date - 30 August, 2018
Fixed issue:
When deactivate plugin, ServiceWorker and Manifest files are removed but PWA status remains active.

= 1.0.0 =
Release Date - 29 August, 2018
First release.

