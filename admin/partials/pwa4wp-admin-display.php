<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/ryu-compin/pwa4wp
 * @since      1.0.2
 *
 * @package    pwa4wp
 * @subpackage pwa4wp/admin/partials
 */

$manifestSettings = $data['manifestSettings'];
$cacheSettings    = $data['cacheSettings'];
if(file_exists($_SERVER['DOCUMENT_ROOT'] ."/" . PWA4WP_MANIFEST_FILE))
{
    update_option('pwa4wp_manifest_created',true);
}else{
    update_option('pwa4wp_manifest_created',false);
}
if(file_exists($_SERVER['DOCUMENT_ROOT'] ."/" . PWA4WP_SERVICEWORKER_FILE)) {
    update_option('pwa4wp_sw_created',true);
}else{
    update_option('pwa4wp_sw_created',false);
}
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h1>PWA for WordPress Configulations</h1>
    <h2><?php _e("Current PWA Status","pwa4wp");?></h2>
    <?php if($data['errorMsg']){
        echo('<ul class="pwa4wp_msgArea">');
        echo('<li class="pwa4wp_list"><h3>');
        _e("Errors or Messages.");
        echo("</h3></li>");
        foreach ($data['errorMsg'] as $msg){
            echo("<li class=\"pwa4wp_list\">&gt;&gt;&nbsp;" . $msg ."</li>");
        }
        echo ('</ul>');
    }
    ?>
    <ul>
        <li class="pwa4wp_list">
            <p class="pwa4wp_status_display">
                HTTPS :
                <?php
                if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                    // icon-green
                    echo('<span class="pwa4wp_status_icon"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'assets/images/green-35.png""></span>');
                    _e("working","pwa4wp");
                }else{
                    // icon-red
                    echo('<span class="pwa4wp_status_icon"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'assets/images/red-35.png"></span>');
                    _e("not working","pwa4wp");
                }
                ?>
                <br>
            </p>
        </li>
        <?php
        // if multi site and unified mode, get parent sites property.
        if((is_multisite())&&(get_blog_option( 1, 'pwa4wp_multisite_unify', $default = 1 ) == 0)) {
            $manifest_created = get_blog_option( 1, 'pwa4wp_manifest_created', $default = false );
            $sw_created = get_blog_option( 1, 'pwa4wp_sw_created', $default = false );
            $sw_installation = get_blog_option( 1, 'pwa4wp_sw_installation_switch', $default = false );
        }else{
            $manifest_created = get_option('pwa4wp_manifest_created');
            $sw_created = get_option('pwa4wp_sw_created');
            $sw_installation = get_option('pwa4wp_sw_installation_switch');
        }
        ?>
    <li class="pwa4wp_list">
        <p class="pwa4wp_status_display">
        Manifest :
        <?php
            if($manifest_created){
                // icon-green
                echo('<span class="pwa4wp_status_icon"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'assets/images/green-35.png""></span>');
                _e("working","pwa4wp");
            }else{
                // icon-red
                echo('<span class="pwa4wp_status_icon"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'assets/images/red-35.png"></span>');
                _e("not working","pwa4wp");
            }
        ?>
        <br>
        </p>
    </li>
    <li class="pwa4wp_list">
        <p class="pwa4wp_status_display">
        ServiceWorker :
        <?php
        if($sw_created){
            // icon-green
            echo('<span class="pwa4wp_status_icon"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'assets/images/green-35.png""></span>');
            _e("working","pwa4wp");
        }else{
            // icon-red
            echo('<span class="pwa4wp_status_icon"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'assets/images/red-35.png"></span>');
            _e("not working","pwa4wp");
        }
        ?>
        <br>
        </p>
    </li>
        <li class="pwa4wp_list">
            <form enctype="multipart/form-data" id="pwa4wp-activate-toggle-form" method="post" action="">
            <p class="pwa4wp_status_display">
                PWA status  :
			    <?php
                if(((!is_main_site())&&(is_multisite())&&(get_blog_option( 1, 'pwa4wp_multisite_unify', $default = 1 ) == 0))) {
                    if ($sw_installation) {
                        // icon-green
                        echo('<span class="pwa4wp_status_icon"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'assets/images/green-35.png""></span>');
                        _e("working", "pwa4wp");
                        echo "&nbsp;(&nbsp;";
                        _e("PWA is multi site unified mode.", "pwa4wp");
                        echo "&nbsp;)&nbsp;";
                    } else {
                        // icon-red
                        echo('<span class="pwa4wp_status_icon"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'assets/images/red-35.png"></span>');
                        _e("not working", "pwa4wp");
                        echo "&nbsp;(&nbsp;";
                        _e("PWA is multi site unified mode.", "pwa4wp");
                        echo "&nbsp;)&nbsp;";
                    }

                }else {
                    if ($sw_installation) {
                        // icon-green
                        echo('<span class="pwa4wp_status_icon"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'assets/images/green-35.png""></span>');
                        _e("working", "pwa4wp");
                        echo('&nbsp;&nbsp;<button  id="pwa4wp_stop_button" type="submit">');
                        _e("STOP");
                        echo('</button>');
                        echo('<input type="hidden" name="pwa_active" value="STOP">');
                    } else {
                        // icon-red
                        echo('<span class="pwa4wp_status_icon"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'assets/images/red-35.png"></span>');
                        _e("not working", "pwa4wp");
                        echo('&nbsp;&nbsp;<button id="pwa4wp_start_button" type="submit">');
                        _e("START");
                        echo('</button>');
                        echo('<input type="hidden" name="pwa_active" value="START">');
                    }
                }
			    ?>
                <br>
            </p>
                <span class="small-text">
	            <?php _e("If PWA status is 'working', this plugin will insert Manifest link and ServiceWorker installation tag into page headers.","pwa4wp"); ?>
                <br>
                <?php _e("HTTPS status check is only protocol check. Please make sure that your all contents and embeded contents in pages are connected by https.","pwa4wp"); ?>
                </span>
                <br>
                <br>
                <?php wp_nonce_field( 'my-nonce-key1', 'my-submenu1' ); ?>
            </form>
        </li>
    </ul>


    <h2><?php _e("Defer PWA installation","pwa4wp");?></h2>
    <ul>
        <li class="pwa4wp_list">
            <span class="pwa4wp_itemname">
                <?php _e( "Installation mode", "pwa4wp" ); ?>
            </span>
            <?php
                if(((!is_main_site())&&(is_multisite())&&(get_blog_option( 1, 'pwa4wp_multisite_unify', $default = 1 ) == 0))) {
            ?>
            <span class="pwa4wp_field">
                <?php if ( get_blog_option( 1,  'pwa4wp_defer_install', $default = 1 ) == 0 ) {
	                _e( "Defer PWA install.( Make install popup by your own, or never show popup )","pwa4wp" );
                }else{
	                _e( "Show PWA install popup by browser default.","pwa4wp" );
                }
                ?>
                <br>
	            <?php _e("This site is not main site.","pwa4wp"); ?><br>
	            <?php _e("You can change this setting in main site config panel.","pwa4wp"); ?><br>

            </span>

            <?php
                }else{
            ?>

            <form enctype="multipart/form-data" id="pwa4wp-installmode-setting-form" method="post" action="">
                <span class="pwa4wp_field">
                    <label>
                    <input type="radio" name="defer_install"
                           value="0" <?php if ( get_option( 'pwa4wp_defer_install', $default = 1 ) == 0 ) {
	                    echo "checked=\"checked\"";
                    } ?>>&nbsp;<?php _e( "Defer PWA install.( Make install popup by your own, or never show popup )","pwa4wp" ); ?>
                    </label><br>
                    <label>
                        <input type="radio" name="defer_install"
                               value="1" <?php if ( get_option( 'pwa4wp_defer_install', $default = 1 ) == 1 ) {
	                        echo "checked=\"checked\"";
                        } ?>>&nbsp;<?php _e( "Show PWA install popup by browser default.","pwa4wp" ); ?>
                    </label><br><br>
		        <?php wp_nonce_field( 'my-nonce-key4', 'my-submenu4' ); ?>
                <button id="pwa4wp_defer_install_button" type="submit">
			        <?php _e( "Update", "pwa4wp" ); ?>
                </button>
                </span>
                <br>
	            <?php _e("You can set PWA installation button / popup by your own, or make PWA installation disabled.","pwa4wp"); ?><br>
	            <?php _e("In default setting, PWA installation popup is entrusted to the browser.","pwa4wp"); ?><br>
	            <?php _e("To get more information about this setting, please read this page below.","pwa4wp"); ?><br>
                <a href="https://github.com/ryu-compin/pwa4wp/wiki/How-to-make-your-own-PWA-installation-button" target="_blank">https://github.com/ryu-compin/pwa4wp/wiki/How-to-make-your-own-PWA-installation-button</a>

            <?php
                }
            ?>


            </form>

        </li>
    </ul>



<?php
        // multiple site
        if(is_multisite()) :
?>
        <h2><?php _e("Multi site mode","pwa4wp");?></h2>
        <ul>
            <li class="pwa4wp_list">
                <?php
                    if(is_main_site()):
                ?>
                <form enctype="multipart/form-data" id="pwa4wp-multisite-setting-form" method="post" action="">
                <span class="pwa4wp_itemname">
                    <?php _e("Multi site mode","pwa4wp"); ?>
                </span>
                <span class="pwa4wp_field">
                    <label>
                    <input type="radio" name="multisite_unify" value="0" <?php if(get_option('pwa4wp_multisite_unify', $default = 1) == 0){echo "checked=\"checked\"";} ?>>&nbsp;<?php _e("Unify all multi site into one PWA.","pwa4wp");?>
                    </label><br>
                    <label>
                        <input type="radio" name="multisite_unify" value="1" <?php if(get_option('pwa4wp_multisite_unify', $default = 1) == 1){echo "checked=\"checked\"";} ?>>&nbsp;<?php _e("Make PWAs for each multi sites individually.","pwa4wp");?>
                    </label><br><br>
                </span>
                    <?php wp_nonce_field( 'my-nonce-key3', 'my-submenu3' ); ?>
                    <button  id="pwa4wp_multisitemode_button" type="submit">
                        <?php _e("Update","pwa4wp");?>
                    </button><br>
                </form>
                <?php _e("Configulation for multi sites.","pwa4wp"); ?><br>
                <?php _e("Select PWA mode whether to unify PWA for all multi sites.","pwa4wp"); ?><br>

                <?php
                else:
                ?>
                    <?php _e("Configulation for multi sites.","pwa4wp"); ?><br>
                    <?php _e("Current config","pwa4wp") ?>&nbsp;:&nbsp;[&nbsp;
                    <?php
                        if( get_blog_option( 1, 'pwa4wp_multisite_unify', $default = 1 ) == 0){
                            _e("Unified","pwa4wp");
                            //echo " -" . get_blog_option( 1, 'pwa4wp_multisite_unify', $default = 1 ) . "-";
                        }else{
                            _e("Individual","pwa4wp");
                            //echo " -" . get_blog_option( 1, 'pwa4wp_multisite_unify', $default = 1 ) . "-";
                        }
                    ?>&nbsp;]<br>
                    <?php _e("This site is not main site.","pwa4wp"); ?><br>
                    <?php _e("You can change this setting in main site config panel.","pwa4wp"); ?><br>
                <?php
                endif;
                ?>
            </li>
        </ul>

<?php
        // end multiple site
        endif;
?>




<hr>
    <h2><?php _e("Notice","pwa4wp"); ?></h2>
    <ul>
        <li class="pwa4wp_list">
            <?php _e("After update this plugin, please update ServiceWorker by \"Save Cache configurations\" button in <a href=\"admin.php?page=PWA+for+WordPress%3F2\">Configure ServiceWorker</a> page.","pwa4wp"); ?><br>
        </li>
    </ul>
    <h2><?php _e("Usage","pwa4wp"); ?></h2>
    <ul>
        <li class="pwa4wp_list">
	        <?php _e("To make your website to PWA, this plugin make two files, \"Manifest\" and \"ServiceWorker\" in your website.","pwa4wp"); ?><br>
	        <?php _e("Manifest file is a json file that has configurations of web applications.","pwa4wp"); ?><br>
	        <?php _e("ServiceWorker is a JavaScript file that controls PWA's functions.","pwa4wp"); ?><br>
	        <?php _e("To start PWA, configure two files from below setup links.","pwa4wp"); ?><br>
        </li>
        <li class="pwa4wp_list">
            <h3>STEP1</h3>
            <a href="admin.php?page=PWA+for+WordPress%3F1">
            <?php
            _e("Configure Manifest","pwa4wp");
            ?>
            </a><br>
            <?php
            echo "<br>";
            _e("Prepare icon image file, image file must be png format.","pwa4wp");
            echo "<br>";
            _e("Setup manifest file from Manifest Configuration page.","pwa4wp");
            echo "<br>";
            _e("Image file will be resized to fit icon sizes automatically.","pwa4wp");
            echo "<br>";
            ?><br>

        </li>
        <li class="pwa4wp_list">
            <h3>STEP2</h3>
            <a href="admin.php?page=PWA+for+WordPress%3F2">
            <?php _e("Configure ServiceWorker","pwa4wp");?>
            </a><br>
	        <?php
	        echo "<br>";
	        _e("Setup ServiceWorker file from ServiceWorker Configuration page.","pwa4wp");
	        ?><br><br>
        </li>
    </ul>
    <hr>
    <br>
    <h2><?php _e("About developer of this plugin","pwa4wp"); ?></h2>
    <ul>
        <li class="pwa4wp_list">
            <h3><?php _e("PWA for WordPress develop team","pwa4wp"); ?></h3>
            <ul>
                <li class="pwa4wp_list">
                    Ryoichi Tsukada&nbsp;/&nbsp;Asial<br>
                </li>
                <li class="pwa4wp_list">
                    Yuki Okamoto&nbsp;/&nbsp;Asial<br>
                </li>
                <li class="pwa4wp_list">
                    Satoshi Tsuda&nbsp;/&nbsp;Asial<br>
                </li>
                <li class="pwa4wp_list">
                    Ryunosuke Shindo&nbsp;/&nbsp;Computing Initiative<br>
                </li>
            </ul>
            <br>
        </li>
        <li class="pwa4wp_list">
            <h3><?php _e("Contact us","pwa4wp"); ?></h3>
	        <?php _e("If you find anyting about this plugin, contact us from mailform below.","pwa4wp"); ?><br>
            <br>
            <a href="https://www.compin.jp/contact-pwa4wp/" target="_blank">https://www.compin.jp/contact-pwa4wp/</a>
            <br>
        </li>
    </ul>
    <br>
    <hr>
    <br>
    <span class="pwa4wp_donate_button_area">
        <?php
        echo "<br>";
        _e("Would you like to support the advancement of this plugin?");
        echo "<br>";
        ?>
        <a href="https://paypal.me/pwa4wp/10USD" class="pwa4wp_square_btn" target="_blank"><?php _e("DONATION"); ?> ( Paypal )</a>
    </span>
    <br>
    <hr>
    <br>
</div>
