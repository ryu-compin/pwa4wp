<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/ryu-compin/pwa4wp
 * @since      1.0.0
 *
 * @package    PWA_for_WordPress
 * @subpackage PWA_for_WordPress/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    PWA_for_WordPress
 * @subpackage PWA_for_WordPress/admin
 * @author     Ryunosuke Shindo <ryu@compin.jp>
 */
class PWA_for_WordPress_Admin {

	/**
	 * @since    1.0.0
	 * @access   private
	 * @var      PWA_for_WordPress_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	private $loader;

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $PWA_for_WordPress The ID of this plugin.
	 */
	private $PWA_for_WordPress;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	public function define_hooks() {
		$this->loader->add_action( 'admin_enqueue_scripts', $this, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $this, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $this, 'setup_admin_menu' );
		$this->loader->add_action( 'admin_init', $this, 'pwa4wp_admin_init' );
	}

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $PWA_for_WordPress The name of this plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $PWA_for_WordPress, $version, $loader ) {

		$this->PWA_for_WordPress = $PWA_for_WordPress;
		$this->version     = $version;
		$this->loader      = $loader;
        $this->errorMsg = array();
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->PWA_for_WordPress, plugin_dir_url( __FILE__ ) . 'css/pwa4wp-admin.css', array(), $this->version, 'all' );
        wp_enqueue_style( 'wp-color-picker' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->PWA_for_WordPress, plugin_dir_url( __FILE__ ) . 'js/pwa4wp-admin.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_script( 'media-uploader-main-js', plugins_url( 'js/media-uploader.js', __FILE__ ), array( 'jquery' ) );
        wp_enqueue_media();
	}

	public function setup_admin_menu() {
        add_menu_page($this->PWA_for_WordPress, $this->PWA_for_WordPress, 'manage_options', $this->PWA_for_WordPress, array(
            $this,
            'render_view',
        ), '');
        add_submenu_page($this->PWA_for_WordPress, 'Manifest', 'Manifest', 'manage_options', $this->PWA_for_WordPress . '?1', array(
            $this,
            'render_view_manifest',
        ));
        add_submenu_page($this->PWA_for_WordPress, 'ServiceWorker', 'ServiceWorker', 'manage_options', $this->PWA_for_WordPress . '?2', array(
            $this,
            'render_view_sw',
        ));
	}

	public function render_view() {
		require_once( plugin_dir_path( __FILE__ ) . 'class-pwa4wp-admin-view.php' );
		$manifestSettings = get_option( 'pwa4wp_manifest' );
		$cacheSettings    = get_option( 'pwa4wp_cache_settings' );
		$view             = new PWA_for_WordPress_Admin_View();
		$view->render( [ 'manifestSettings' => $manifestSettings, 'cacheSettings' => $cacheSettings ,'errorMsg' => $this->errorMsg] );
	}
    public function render_view_manifest() {
        require_once( plugin_dir_path( __FILE__ ) . 'class-pwa4wp-admin-view.php' );
        $manifestSettings = get_option( 'pwa4wp_manifest' );
        $cacheSettings    = get_option( 'pwa4wp_cache_settings' );
        $savedIconURL  = get_option( 'pwa4wp_app_iconurl' );
        $savedIcons = get_option('pwa4wp_app_icons');
        $view             = new PWA_for_WordPress_Admin_View();
        $view->render_manifest( [ 'manifestSettings' => $manifestSettings, 'cacheSettings' => $cacheSettings , 'iconurl' => $savedIconURL ,'icons' => $savedIcons ,'errorMsg' => $this->errorMsg]);
    }
    public function render_view_sw() {
        require_once( plugin_dir_path( __FILE__ ) . 'class-pwa4wp-admin-view.php' );
        $manifestSettings = get_option( 'pwa4wp_manifest' );
        $cacheSettings    = get_option( 'pwa4wp_cache_settings' );
        $savedIconURL  = get_option( 'pwa4wp_app_iconurl' );
        $view             = new PWA_for_WordPress_Admin_View();
        $swVersion = get_option('pwa4wp_sw_version');
        $view->render_sw( [ 'manifestSettings' => $manifestSettings, 'cacheSettings' => $cacheSettings, 'swVersion' => $swVersion ,'errorMsg' => $this->errorMsg] );
    }
	public function pwa4wp_admin_init() {

        $manifestSettings = get_option( 'pwa4wp_manifest' );
        $cacheSettings    = get_option( 'pwa4wp_cache_settings' );
        $savedIconURL  = get_option( 'pwa4wp_app_iconurl' );
        $savedIcons  = get_option( 'pwa4wp_app_icons' );
        $swVersion = get_option('pwa4wp_sw_version') + 1;
        // Loop sw version Max:99999
        if($swVersion > 99999){
            $swVersion = 1;
        }


		if ( isset( $_POST['my-submenu'] ) && $_POST['my-submenu'] && check_admin_referer( 'my-nonce-key', 'my-submenu' ) ) {
			// マニフェスト編集
//			echo '<pre>'; var_dump([$_POST, $_FILES]); echo'</pre>';
			// resize icon
            if($savedIconURL != $_POST['iconurl']){
                if($_POST['iconurl'] != ""){
                    $iconPath = str_replace(home_url()."/",get_home_path(),$_POST['iconurl']);
//                echo "<!-- icon-path: [" . $icon_path . "] replaced [" . home_url() ."] - [". get_home_path() ."] -->";
                    $mimeType = mime_content_type($iconPath);
                    if($mimeType == "image/png"){
                        $icons = $this->resizeIcons($iconPath,$mimeType);
                    }else{
                        $this->errorMsg[] = "Icon image type is not png.";
                        $icons = [];
                    }
                }else{
                    $icons = [];
                }
                update_option( 'pwa4wp_app_iconurl', $_POST['iconurl'] );
            }else{
                $icons = $savedIcons;
            }
            if(empty($icons)){
                echo "<!--icon empty-->";
            }
            if($this->check_manifest($_POST,$icons)){
                $manifest = $this->makeManifest( $_POST, $icons );
                $this->saveAndGenerateManifestFile( $manifest );
                update_option('pwa4wp_manifest_created',true);
                $data = [
                    'sw_version' => get_option( 'pwa4wp_sw_version'),
                    'cache_plan' => get_option( 'pwa4wp_cache_settings' )['cache_plan'],
                    'exclusions' =>array_filter(get_option( 'pwa4wp_cache_settings' )['exclusions'], function($pattern) {
                        return !empty($pattern);
                    }),
                    'initial-caches' => array_filter(get_option( 'pwa4wp_cache_settings' )['initial-caches'], function($url) {
                        return !empty($url);
                    }),
                    'ttl'            => get_option( 'pwa4wp_cache_settings' )['ttl'],
                    'offline_url'    => get_option( 'pwa4wp_cache_settings' )['offline_url'],
                ];
                if($this->check_sw($data)){
                    $this->generateServiceWorker( $data );
                }
                update_option('pwa4wp_sw_version',get_option('pwa4wp_sw_version')+1);
                update_option('pwa4wp_sw_created',true);
            }else{
                // error or parameter is not set.
                // Todo : display error message to admin console.
            }
		} else if ( isset( $_POST['my-submenu2'] ) && $_POST['my-submenu2'] && check_admin_referer( 'my-nonce-key2', 'my-submenu2' ) ) {
			// キャッシュ設定
			$data = [
			    'sw_version' => $swVersion ,
                'cache_plan' => $_POST['cache_plan'],
				'exclusions'     => array_filter($_POST['exclusions'], function($pattern) {
					return !empty($pattern);
				}),
				'initial-caches' => array_filter($_POST['initial-caches'], function($url) {
					return !empty($url);
				}),
				'ttl'            => $_POST['ttl'],
				'offline_url'    => $_POST['offline_url'],
                'debug_msg'     => $_POST['debug_msg'],
			];
            if($this->check_sw($data)){
                $this->generateServiceWorker( $data );
            }
            update_option('pwa4wp_sw_version',get_option('pwa4wp_sw_version')+1);
            update_option('pwa4wp_sw_created',true);
		}
	}

	private function saveAndGenerateManifestFile( $manifest ) {
		update_option( 'pwa4wp_manifest', $manifest );
		$manifestJson = json_encode( $manifest );
		file_put_contents( get_home_path() . MANIFEST_FILE, $manifestJson );
		echo "<!--manifest created --- "  .get_home_path()." --- " .home_url(). "--!>"."<!--" .$manifestJson ." -->";
	}
	private function resizeIcons($iconBase,$imageType){
	    if(!(file_exists($iconBase))){
            return [];
        }
        $returnIcons = array();
        $imagesize = getimagesize($iconBase);
        $iconWidth = $imagesize[0];
        $iconHeight = $imagesize[1];
        // 512px is needed for splash screen
        $saveFileName = dirname($iconBase)."/". preg_replace("/\.[^.]+$/", "", basename($iconBase))."_512x512.png";
        //echo "<!-- icon512[" .$saveFileName . "] -->";
        if(!(file_exists($saveFileName))){
            $image = wp_get_image_editor( $iconBase );
            if ( ! is_wp_error( $image ) ) {
                $image->resize( 512, 512, true );
                $image->save( $saveFileName );
            }
        }
        $returnIcons[] = [
            'filename' => str_replace(get_home_path(),home_url()."/",$saveFileName),
            'type'     => $imageType,
            'sizes'    => '512x512',
        ];

        // 192px must exists
        $saveFileName = dirname($iconBase)."/". preg_replace("/\.[^.]+$/", "", basename($iconBase))."_192x192.png";
        //echo "<!-- icon192[" .$saveFileName . "] -->";
        if(!(file_exists($saveFileName))){
            $image = wp_get_image_editor( $iconBase );
            if ( ! is_wp_error( $image ) ) {
                $image->resize( 192, 192, true );
                $image->save( $saveFileName );
            }
        }
        $returnIcons[] = [
            'filename' => str_replace(get_home_path(),home_url()."/",$saveFileName),
            'type'     => $imageType,
            'sizes'    => '192x192',
        ];
        $saveFileName = dirname($iconBase)."/". preg_replace("/\.[^.]+$/", "", basename($iconBase))."_144x144.png";
        if(!(file_exists($saveFileName))){
            $image = wp_get_image_editor( $iconBase );
            if ( ! is_wp_error( $image ) ) {
                $image->resize( 144, 144, true );
                $image->save( $saveFileName );
            }
        }
        $returnIcons[] = [
	        'filename' => str_replace(get_home_path(),home_url()."/",$saveFileName),
            'type'     => $imageType,
            'sizes'    => '144x144',
        ];
        $saveFileName = dirname($iconBase)."/". preg_replace("/\.[^.]+$/", "", basename($iconBase))."_96x96.png";
        if(!(file_exists($saveFileName))){
            $image = wp_get_image_editor( $iconBase );
            if ( ! is_wp_error( $image ) ) {
                $image->resize( 96, 96, true );
                $image->save( $saveFileName );
            }
        }
        $returnIcons[] = [
	        'filename' => str_replace(get_home_path(),home_url()."/",$saveFileName),
            'type'     => $imageType,
            'sizes'    => '96x96',
        ];
        $saveFileName = dirname($iconBase)."/". preg_replace("/\.[^.]+$/", "", basename($iconBase))."_48x48.png";
        if(!(file_exists($saveFileName))){
            $image = wp_get_image_editor( $iconBase );
            if ( ! is_wp_error( $image ) ) {
                $image->resize( 48, 48, true );
                $image->save( $saveFileName );
            }
        }
        $returnIcons[] = [
	        'filename' => str_replace(get_home_path(),home_url()."/",$saveFileName),
            'type'     => $imageType,
            'sizes'    => '48x48',
        ];
        echo "<!--manifest path --- " . $saveFileName . " --- "  .get_home_path()." --- " .home_url(). "--!>";
        update_option( 'pwa4wp_app_icons', $returnIcons );
        return $returnIcons;
    }

	private function makeManifest( $data, $icons ) {

		return [
			'name'             => $data['name'],
			'short_name'       => $data['short_name'],
			'icons'            => array_map( function ( $icon ) {
				return [
					'src'   => $icon['filename'],
					'type'  => $icon['type'],
					'sizes' => $icon['sizes'],
				];
			}, $icons ),
			'start_url'        => $data['start_url'],
            'scope'        => $data['scope'],
			'display'          => $data['display'],
			'background_color' => $data['background_color'],
			'description'      => $data['description'],
			'theme_color'      => $data['theme_color'],
			'orientation'      => $data['orientation'],
		];
	}

	private function generateServiceWorker( $data ) {
		require_once plugin_dir_path( __FILE__ ) . 'class-pwa4wp-service-worker-generator.php';
		update_option( 'pwa4wp_cache_settings', $data );
		$generator = new PWA4WP_Service_Worker_Generator( plugin_dir_url( dirname( __FILE__ ) ) );
		$script    = $generator->generate( $data );
		file_put_contents( get_home_path() . SERVICEWORKER_FILE, $script );
	}

	private function check_manifest($data, $icons ){
	    $returnValue = true;
        if( empty($icons) ){
            $returnValue = false;
            $this->errorMsg[] = __("Manifest : Icon is not set.","pwa4wp");

        }
        if( $data['name'] == "" ){
            $returnValue = false;
            $this->errorMsg[] = __("Manifest : Site Name is not set.","pwa4wp");

        }
        if( $data['short_name'] == "" ){
            $returnValue = false;
            $this->errorMsg[] = __("Manifest : Short Name is not set.","pwa4wp");

        }
        if( $data['start_url'] == "" ){
            $returnValue = false;
            $this->errorMsg[] = __("Manifest : Start URL is not set.","pwa4wp");

        }
        if( $data['scope'] == "" ){
            $returnValue = false;
            $this->errorMsg[] = __("Manifest : Scope is not set.","pwa4wp");

        }
        if( $data['display'] == "" ){
            $returnValue = false;
            $this->errorMsg[] = __("Manifest : Display is not set.","pwa4wp");

        }
        if( $data['background_color'] == "" ){
            $returnValue = false;
            $this->errorMsg[] = __("Manifest : Background color is not set.","pwa4wp");

        }
        if( $data['description'] == "" ){
            $returnValue = false;
            $this->errorMsg[] = __("Manifest : Description is not set.","pwa4wp");

        }
        if( $data['theme_color'] == "" ){
            $returnValue = false;
            $this->errorMsg[] = __("Manifest : Theme colr is not set.","pwa4wp");

        }
        if( $data['orientation'] == "" ){
            $returnValue = false;
            $this->errorMsg[] = __("Manifest : Orientation is not set.","pwa4wp");

        }
        return $returnValue;
    }
    private function check_sw($data ){
        $returnValue = true;
        if(!(ctype_digit($data['ttl']))){
            $returnValue = false;
            $this->errorMsg[] = __("ServiceWorker : Cache Expire time must be numeric.","pwa4wp");
        }

        return $returnValue;
    }

}
