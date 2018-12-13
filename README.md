# pwa4wp
## PWA for WordPress
___
### About this plugin
To make your WordPress website to PWA, this plugin make two files, "Manifest" and "ServiceWorker" in your website.  
Manifest file is a json file that has configurations of web applications.  
ServiceWorker is a JavaScript file that controls PWA's functions.
To start PWA, configure two files.

You can fine-tune the cache, such as expiration date, time and URL exclusion.
By excluding the URLs, like a new arrival information,  data acquisition destination in Ajax, this plugin can keep PWA data fresh.
You can set expire time of caches, then old cache will purged after specified time.

After version 1.1.2,
Multi sites are supported.
You can difer the PWA installation popup shown in browser default and add your own installation button on your sites.


### STEP1
#### Configure Manifest   

Prepare icon image file, image file must be png format.  
Setup manifest file from Manifest Configuration page.  
Image file will be resized to fit icon sizes automatically.  

### STEP2
#### Configure ServiceWorker   

Setup ServiceWorker file from ServiceWorker Configuration page.  

---

### Japanese  

---

### このプラグインについて
あなたの WordPress サイトを PWA にするために、このプラグインは二つのファイル、「Manifest」と「ServiceWorker」をサイト内に生成します。
Manifest（マニフェスト）ファイルは Web アプリケーションの構成を保持する json 形式のファイルです。  
ServiceWorker は PWA の機能を制御する JavaScript ファイルです。
PWA を開始するにはそれぞれのファイルを構成してください。 

このプラグインは、PWAのキャッシュプラン「online-first」、「cache-first」の切り替えが可能で、また、キャッシュに有効期限を設けることでキャッシュが永久に保存されてしまうことを避けることができます。

新しいバージョン、1.1.2以降のバージョンでは、マルチサイトに対応しました。 
また、デフォルトでブラウザから出されるPWAインストールポップアップを抑止し、自分で配置したボタンからPWAのインストールを実行することが可能になりました。

### STEP1
#### マニフェストの構成 

アイコン画像ファイルを用意してください。画像ファイルは png 形式である必要があります。  
マニフェストの構成ページからマニフェストファイルをセットアップします。  
画像ファイルはアイコンサイズに合わせて自動的にリサイズされます。  
  
### STEP2
#### ServiceWorker の構成 

ServiceWorker 構成ページから ServiceWorker ファイルをセットアップします。


