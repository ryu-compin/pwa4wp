Þ    m           ì      @	     A	     `	  ¯   i	     
  D   *
     o
  =   
     ¿
  ,   Þ
               <     O  
   g  4   r     §     º     É  
   Ò  I   Ý     '     >  .   V  !        §  a   Á     #     7     ?  C   L       P     2   j  w     /     E   E  F     X   Ò  ;   +  G   g  
   ¯  )   º     ä  ,   ö     #  '   =  "   e          §  "   Ã     æ  !         %      F  !   g       I   ¡     ë     û       :        N     _     q       7   °  "   è            9     .   P       2     "   Æ  .   é  A     d   Z  ?   ¿     ÿ  5     *   G  8   r  =   «  j   é     T     s     x  %     )   ¼  ?   æ  /   &  @   V       #   ³  H   ×  h      9         Ã     ä  "   ì            j     9     6   Á  [   ø     T     `  ×  h  -   @     n    ~       k        	  o   %  +     :   Á  !   ü           7      S      k   Y   ~      Ø      ð       !     !     #!     Ã!  6   â!  ?   "  B   Y"  U   "     ò"  3   #     »#     ¿#  k   Õ#  ë   A$     -%  Q   ³%  Ó   &  U   Ù&  r   /'     ¢'     0(  `   É(  f   *)     )  ]   )     ö)  9   *  W   I*  5   ¡*  8   ×*  D   +  8   U+  8   +  8   Ç+  A    ,  8   B,  6   {,  >   ²,     ñ,     
-     -     ¬-     ¹-  y   Ö-     P.  1   o.  !   ¡.  T   Ã.  }   /  *   /     Á/     Ç/  l   Ì/  E   90  "   0  U   ¢0  #   ø0  M   1  O   j1     º1  _   >2  3   2  i   Ò2  <   <3  ]   y3  Y   ×3  §   14  0   Ù4  	   
5     5  6   *5  9   a5  d   5  V    6  f   W6  <   ¾6  I   û6  H   E7  ¯   7  j   >8     ©8     Â8  K   É8     9  	   9  ®   &9  ?   Õ9  W   :     m:  	   ;  	   ;        j   m   I   k   c                D          a   Y   /       0       .       "       	   &          _   $             T   2   -       ]       K   ;      C   F   h   8       4      #      7   Q   d       :   9           ^       L   >       U   6      [      b   1      l   g          `   %              +   ,   M             
                   \           O   <   =   f             (   3       ?   A   R       H           E   V   !   J           X                       i   N   B   e       W   G   )   5             P              @       '   S          Z   *    About developer of this plugin Add list After update this plugin, please update ServiceWorker by "Save Cache configurations" button in <a href="admin.php?page=PWA+for+WordPress%3F2">Configure ServiceWorker</a> page. Basic cache plan By default, PWA works in the directory that ServiceWorker installed. Cache Expire time Cache first plan will show cache data before get online data. Choose PWA screen orientation. Choose PWA theme color and background color. Close Regexp Test Configulation for multi sites. Configure Manifest Configure ServiceWorker Contact us Contents of these URLs are cached with installation. Current PWA Status Current config DONATION Debug mode Defer PWA install.( Make install popup by your own, or never show popup ) Defer PWA installation Define PWA description. Define length of cache expire time by minutes. Define shorten application title. Define start page of PWA. Directory /wp-admin/ is added automatibally, so you don't need to define admin directory in here. Errors or Messages. Example First caches For example, 1 hour -> 60 min, 1 day ->1440 min, 1 week->10080 min. HTTPS status check is only protocol check. Please make sure that your all contents and embeded contents in pages are connected by https. Icon file is "png" format required, more than 512px x 512px size is recommended. Icon file will be resized by system automatically. If PWA status is 'working', this plugin will insert Manifest link and ServiceWorker installation tag into page headers. If define 0 for this, expire time is unlimited. If the page requested is already in cache, cached page will be shown. If you find anyting about this plugin, contact us from mailform below. If you want PWA to work only in a apecified subdirectory, set subdirectory path in here. Image file will be resized to fit icon sizes automatically. In default setting, PWA installation popup is entrusted to the browser. Individual Input URL for test and press Test button. Installation mode Make PWAs for each multi sites individually. Make a page for offline.  Manifest : Background color is not set. Manifest : Description is not set. Manifest : Display is not set. Manifest : Icon is not set. Manifest : Orientation is not set. Manifest : Scope is not set. Manifest : Short Name is not set. Manifest : Site Name is not set. Manifest : Start URL is not set. Manifest : Theme colr is not set. Manifest Configulations Manifest file is a json file that has configurations of web applications. Multi site mode Notice Offline Page URL Online first plan will show online data before cache data. Open Regexp Test PWA display mode. PWA for WordPress develop team PWA is multi site unified mode. Prepare icon image file, image file must be png format. Regular expressions are available. START STOP Select PWA mode whether to unify PWA for all multi sites. Select a Page to show when the PWA is offline. Select/Upload Image ServiceWorker : Cache Expire time must be numeric. ServiceWorker Cache Configurations ServiceWorker Cache version ( auto increment ) ServiceWorker is a JavaScript file that controls PWA's functions. Set ON this switch, ServiceWorker JavaScript will send verbose messages to debug console of browser. Setup ServiceWorker file from ServiceWorker Configuration page. Setup cache plan. Setup manifest file from Manifest Configuration page. Show PWA install popup by browser default. Some errors found in Manifest settings, please fix them. Some errors found in ServiceWorker settings, please fix them. Start URL in manifest and offline page will added automatically, so you don't need to define them in here. Switch to show debug messages. Test Test for Reguler Expressions. This URL will be excluded from cache. This URL will not be excluded from cache. This means that all "/api/" directory will excluded from cache. This page will be cached when PWA is installed. This plugin set ServiceWorker to root directory of this website. This site is not main site. This will be PWA application title. To get more information about this setting, please read this page below. To make your website to PWA, this plugin make two files, "Manifest" and "ServiceWorker" in your website. To start PWA, configure two files from below setup links. URLs for exclude from cache list Unified Unify all multi site into one PWA. Update Usage When the browser failed to get online page, for example offline or server down, cached data will be shown. Would you like to support the advancement of this plugin? You can change this setting in main site config panel. You can set PWA installation button / popup by your own, or make PWA installation disabled. not working working Project-Id-Version: pwa4wp
POT-Creation-Date: 2018-12-13 15:56+0900
PO-Revision-Date: 2018-12-13 15:57+0900
Last-Translator: Ryunosuke Shindo <ryu@compin.jp>
Language-Team: pwa4wp <ryu@compin.jp>
Language: ja
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
X-Generator: Poedit 1.5.7
X-Poedit-KeywordsList: __;_e
X-Poedit-Basepath: ..
X-Poedit-SourceCharset: UTF-8
X-Poedit-SearchPath-0: .
X-Poedit-SearchPath-1: ./admin/partials
 ãã®ãã©ã°ã¤ã³ã®éçºèã«ã¤ãã¦ ãªã¹ãè¿½å  ãã®ãã©ã°ã¤ã³ã®ã¢ãããã¼ãå¾ã¯ã<a href=âadmin.php?page=PWA+for+WordPress%3F2â>ServiceWorker ã­ã£ãã·ã¥è¨­å®</a> ç»é¢ãããâSave Cache configurationsâ ãã¿ã³ãæ¼ãã¦ ServiceWorker ãåçºè¡ãã¦ãã ããã åºæ¬ã­ã£ãã·ã¥è¨ç» ããã©ã«ãã§ã¯ PWA ã¯ ServiceWorker ãéç½®ããããã£ã¬ã¯ããªéä¸ã§åä½ãã¾ãã ã­ã£ãã·ã¥æå¹æé Cache first ã§ã¯ãªã³ã©ã¤ã³ã§ã®ãã¼ã¿åå¾ã®åã«ã­ã£ãã·ã¥ãä½¿ç¨ãã¦è¡¨ç¤ºãã¾ãã PWA ã®ç»é¢ã®æ¹åãæå®ãã¾ãã PWA ã®ãã¼ãã«ã©ã¼ã¨èæ¯è²ãé¸æãã¾ãã æ­£è¦è¡¨ç¾ãã¹ããéãã ãã«ããµã¤ãè¨­å® ãããã§ã¹ãã®æ§æ ServiceWorker ã®æ§æ ãåãåãã ããã§æå®ãã URL ã¯ã¤ã³ã¹ãã¼ã«ã¨åæã«ã­ã£ãã·ã¥ããã¾ãã ç¾å¨ã® PWA ã®ç¶æ ç¾å¨ã®è¨­å® å¯ä»ãã ãããã°ã¢ã¼ã PWAã¤ã³ã¹ãã¼ã«ãä¿çããï¼èªåã§ã¤ã³ã¹ãã¼ã«ãã¿ã³ãä½ã£ãããã¤ã³ã¹ãã¼ã«ãããã¢ãããéè¡¨ç¤ºã«ã§ãã¾ãï¼ PWAã¤ã³ã¹ãã¼ã«ãä¿ç ã¢ããªã±ã¼ã·ã§ã³ã®èª¬æãè¨è¿°ãã¾ãã ã­ã£ãã·ã¥ã®æå¹æéãååä½ã§æå®ãã¾ãã ã¢ããªã±ã¼ã·ã§ã³ã¿ã¤ãã«ã®ç­ç¸®ãæå®ãã¾ãã PWA ãèµ·åãã¦æåã«è¡¨ç¤ºãããã¹ã¿ã¼ããã¼ã¸ãæå®ãã¾ãã /wp-admin/ ãã£ã¬ã¯ããªéä¸ã®ç®¡çç»é¢ URL ã¯èªåçã«é¤å¤è¿½å ããã¾ãã®ã§ããã§æå®ããå¿è¦ã¯ããã¾ããã ã¨ã©ã¼ã¾ãã¯ã¡ãã»ã¼ã¸ãããã¾ãã ä¾ åæã­ã£ãã·ã¥ ä¾ãã°ã1æéâ60ï¼åï¼ã1æ¥â1440ï¼åï¼ã1é±éâ10080ï¼åï¼ãã¨æå®ãã¾ãã HTTPS ã¹ãã¼ã¿ã¹ã¯åç´ã«HTTPSãã­ãã³ã«ã§éä¿¡ããã¦ãããã®ãã§ãã¯ã§ããã³ã³ãã³ãã«åãè¾¼ã¾ããã³ã³ãã³ãããã¹ã¦HTTPSã§éä¿¡ããã¦ãããã¯å¥éãç¢ºãããã ããã ã¢ã¤ã³ã³ã«ä½¿ç¨ãããã¡ã¤ã«ã¯ png å½¢å¼ã§ããå¿è¦ããã512px x 512px ä»¥ä¸ã®ãµã¤ãºããå§ããã¾ãã ç»åãã¡ã¤ã«ã¯ã·ã¹ãã ã«ããèªåçã«ãªãµã¤ãºããã¾ãã PWAã®ã¹ãã¼ã¿ã¹ããç¨¼åä¸­ãã®å ´åããã®ãã©ã°ã¤ã³ã¯ãããã§ã¹ããã¡ã¤ã«ã¸ã®ãªã³ã¯ã¨ServiceWorkerãã¤ã³ã¹ãã¼ã«ããã¿ã°ããã¼ã¸ãããã«æ¿å¥ãã¾ãã ã­ã£ãã·ã¥ã®æå¹æéãç¡æéã«ããå ´åã¯ã0ãæå®ãã¾ãã è¦æ±ããããã¼ã¸ãæ¢ã«ã­ã£ãã·ã¥ã«ããã°ãã­ã£ãã·ã¥ãåªåçã«è¡¨ç¤ºããã¾ãã ãã®ãã©ã°ã¤ã³ã«ã¤ãã¦ãæ°ã¥ãã®ç¹ãããã¾ãããä¸è¨ã®ã¡ã¼ã«ãã©ã¼ã ãããåãåãããã ããã ãã PWA ãç¹å®ã®ãµããã£ã¬ã¯ããªã®ä¸­ã ãã§åä½ããããå ´åã¯ããã«ãµããã£ã¬ã¯ããªã®ãã¹ãæå®ãã¾ãã ç»åãã¡ã¤ã«ã¯ã¢ã¤ã³ã³ãµã¤ãºã«åããã¦èªåçã«ãªãµã¤ãºããã¾ãã ããã©ã«ãã§ã¯ã¤ã³ã¹ãã¼ã«ãããã¢ããè¡¨ç¤ºã¯ãã©ã¦ã¶ã«å§ã­ããã¾ãã åé¢ ãã¹ãã«ä½¿ç¨ããURLãå¥åãã¦ããã¹ãããã¿ã³ãæ¼ãã¦ãã ããã ã¤ã³ã¹ãã¼ã«è¨­å® ãã«ããµã¤ããã¨ã®PWAãåé¢ãã¦æ§æãã ãªãã©ã¤ã³æã«è¡¨ç¤ºããããã®åºå®ãã¼ã¸ãç¨æãã¦ãã ããã Manifest : èæ¯è²ãè¨­å®ããã¦ãã¾ããã Manifest : description ãè¨­å®ããã¦ãã¾ããã Manifest : ç»é¢ã®è¡¨ç¤ºã¢ã¼ããè¨­å®ããã¦ãã¾ããã Manifest : ã¢ã¤ã³ã³ãè¨­å®ããã¦ãã¾ããã Manifest : orientation ãè¨­å®ããã¦ãã¾ããã Manifest : ã¹ã³ã¼ããè¨­å®ããã¦ãã¾ããã Manifest : ãµã¤ãã®ç­ç¸®åãè¨­å®ããã¦ãã¾ããã Manifest : ãµã¤ãåãè¨­å®ããã¦ãã¾ããã Manifest : start_url ãè¨­å®ããã¦ãã¾ããã Manifest : ãã¼ãã«ã©ã¼ãè¨­å®ããã¦ãã¾ããã ãããã§ã¹ãè¨­å® Manifestï¼ãããã§ã¹ãï¼ãã¡ã¤ã«ã¯ Web ã¢ããªã±ã¼ã·ã§ã³ã®æ§æãä¿æãã json å½¢å¼ã®ãã¡ã¤ã«ã§ãã ãã«ããµã¤ãè¨­å® ãç¥ãã ãªãã©ã¤ã³ãã¼ã¸ URL Online first ã§ã¯ã­ã£ãã·ã¥ãã¼ã¿ãå©ç¨ãããããåã«ãªã³ã©ã¤ã³ã§ãã¼ã¿ãåå¾ãã¾ãã æ­£è¦è¡¨ç¾ãã¹ããéã PWA ã®ç»é¢è¡¨ç¤ºã¢ã¼ããæå®ãã¾ãã PWA for WordPress éçºãã¼ã  ãã¹ã¦ã®ãã«ããµã¤ãã®PWAã¯ã¡ã¤ã³ãµã¤ãã¨çµ±åããã¦ãã¾ã ã¢ã¤ã³ã³ç»åãã¡ã¤ã«ãç¨æãã¦ãã ãããç»åãã¡ã¤ã«ã¯ png å½¢å¼ã§ããå¿è¦ãããã¾ãã æ­£è¦è¡¨ç¾ã§ã®æå®ãå¯è½ã§ãã START STOP PWAã®åä½ã¢ã¼ãããã¹ã¦ã®ãã«ããµã¤ãã§çµ±åãããã©ããé¸æãã¦ãã ããã ãªãã©ã¤ã³æã«è¡¨ç¤ºãããã¼ã¸ã®URLãæå®ãã¾ãã ç»åã®é¸æ/ã¢ããã­ã¼ã ServiceWorker : ã­ã£ãã·ã¥ã®æå¹æéã¯æ°å¤ã§å¥åãã¦ãã ããã ServiceWorker ã­ã£ãã·ã¥è¨­å® ServiceWorker ã­ã£ãã·ã¥ãã¼ã¸ã§ã³ï¼èªåã¤ã³ã¯ãªã¡ã³ãï¼ ServiceWorker ã¯ PWA ã®æ©è½ãå¶å¾¡ãã JavaScript ãã¡ã¤ã«ã§ãã ONã«ããã¨ ServiceWorker ã® JavaScript ãããã©ã¦ã¶ã®ã³ã³ã½ã¼ã«ã«è©³ç´°ãªã¡ãã»ã¼ã¸ãåºåããã¾ãã ServiceWorker æ§æãã¼ã¸ãã ServiceWorker ãã¡ã¤ã«ãã»ããã¢ãããã¾ãã ã­ã£ãã·ã¥ã®ä½¿ç¨è¨ç»ãæå®ãã¾ãã ãããã§ã¹ãã®æ§æãã¼ã¸ãããããã§ã¹ããã¡ã¤ã«ãã»ããã¢ãããã¾ãã ãã©ã¦ã¶ã®ããã©ã«ãã§ãããã¢ãããè¡¨ç¤º ãããã§ã¹ãã®è¨­å®ã«ã¨ã©ã¼ãããã¾ããè¨­å®ãä¿®æ­£ãã¦ãã ããã ServiceWorker ã®è¨­å®ã«ã¨ã©ã¼ãããã¾ããè¨­å®ãä¿®æ­£ãã¦ãã ããã ãããã§ã¹ãã§æå®ãã start_url ã¨ãªãã©ã¤ã³ãã¼ã¸ã¯èªåçã«ã­ã£ãã·ã¥ããã¾ãã®ã§ããã§æå®ããå¿è¦ã¯ããã¾ããã ãããã°ã¡ãã»ã¼ã¸ãè¡¨ç¤ºãã¾ãã ãã¹ã æ­£è¦è¡¨ç¾ãã¹ã ãã®URLã¯ã­ã£ãã·ã¥ããé¤å¤ããã¾ãã ãã®URLã¯ã­ã£ãã·ã¥ããé¤å¤ããã¾ããã ããã¯ã /api/ ããã£ã¬ã¯ããªãã­ã£ãã·ã¥ããé¤å¤ãããã¨ãç¤ºãã¾ãã ãã®ãã¼ã¸ã¯ PWA ã®ã¤ã³ã¹ãã¼ã«ã¨åæã«ã­ã£ãã·ã¥ããã¾ãã ãã®ãã©ã°ã¤ã³ã¯ ServiceWorker ããµã¤ãã®ã«ã¼ããã£ã¬ã¯ããªã«éç½®ãã¾ãã ãã®ãµã¤ãã¯ã¡ã¤ã³ãµã¤ãã§ã¯ããã¾ããã PWA ã®ã¢ããªã±ã¼ã·ã§ã³ã¿ã¤ãã«ã¨ãã¦ä½¿ç¨ããã¾ãã è©³ããæå ±ã¯ä»¥ä¸ã®ãªã³ã¯åãã¼ã¸ããè¦§ãã ããã ããªãã® Web ãµã¤ãã PWA ã«ããããã«ããã®ãã©ã°ã¤ã³ã¯äºã¤ã®ãã¡ã¤ã«ããManifestãã¨ãServiceWorkerãããµã¤ãåã«çæãã¾ãã PWA ãéå§ããã«ã¯ä»¥ä¸ã®ãªã³ã¯ããããããã®ãã¡ã¤ã«ãæ§æãã¦ãã ããã ã­ã£ãã·ã¥é¤å¤URL çµ±å ãã¹ã¦ã®ãã«ããµã¤ãã®PWAãã²ã¨ã¤ã®PWAã¨ãã¦çµ±åãã æ´æ° ä½¿ãæ¹ ãããªãã©ã¤ã³æããµã¼ãã¼ããã¦ã³ãã¦ããå ´åãªã©ããã©ã¦ã¶ããã¼ã¿ã®åå¾ã«å¤±æãããã­ã£ãã·ã¥ãã¼ã¿ãä½¿ç¨ãã¾ãã ãã®ãã©ã°ã¤ã³ã®éçºã«æ¯æ´ããé¡ããã¾ãã ãã®è¨­å®ã¯ã¡ã¤ã³ãµã¤ãã®è¨­å®ç»é¢ã§ç·¨éãããã¨ãã§ãã¾ãã PWAã®ã¤ã³ã¹ãã¼ã«ãã¿ã³ããããã¢ãããèªåã§ä½ã£ãããPWAã¤ã³ã¹ãã¼ã«ãããã¢ãããéè¡¨ç¤ºã«ã§ãã¾ãã åæ­¢ä¸­ ç¨¼åä¸­ 