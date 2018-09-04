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
if(file_exists(get_home_path() . PWA4WP_MANIFEST_FILE))
{
    update_option('pwa4wp_manifest_created',true);
}else{
    update_option('pwa4wp_manifest_created',false);
}
if(file_exists(get_home_path() . PWA4WP_SERVICEWORKER_FILE)) {
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
        echo('<ul class="msgArea">');
        echo("<li><h3>");
        _e("Errors or Messages.");
        echo("</h3></li>");
        foreach ($data['errorMsg'] as $msg){
            echo("<li>&gt;&gt;&nbsp;" . $msg ."</li>");
        }
        echo ('</ul>');
    }
    ?>
    <ul>
    <li>
        <p class="status_display">
        Manifest :
        <?php
            if(get_option('pwa4wp_manifest_created')){
                // icon-green
                echo('<span class="status_icon"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'assets/images/green-35.png""></span>');
                _e("working","pwa4wp");
            }else{
                // icon-red
                echo('<span class="status_icon"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'assets/images/red-35.png"></span>');
                _e("not working","pwa4wp");
            }
        ?>
        <br>
        </p>
    </li>
    <li>
        <p class="status_display">
        ServiceWorker :
        <?php
        if(get_option('pwa4wp_sw_created')){
            // icon-green
            echo('<span class="status_icon"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'assets/images/green-35.png""></span>');
            _e("working","pwa4wp");
        }else{
            // icon-red
            echo('<span class="status_icon"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'assets/images/red-35.png"></span>');
            _e("not working","pwa4wp");
        }
        ?>
        <br>
        </p>
    </li>
        <li>
            <form enctype="multipart/form-data" id="pwa4wp-activate-toggle-form" method="post" action="">
            <p class="status_display">
                PWA status  :
			    <?php
			    if(get_option('pwa4wp_sw_installation_switch')){
				    // icon-green
				    echo('<span class="status_icon"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'assets/images/green-35.png""></span>');
				    _e("working","pwa4wp");
				    echo('&nbsp;&nbsp;<button  id="pwa4wp_stop_button" type="submit">');
				    _e("STOP");
				    echo('</button>');
				    echo('<input type="hidden" name="pwa_active" value="STOP">');
			    }else{
				    // icon-red
				    echo('<span class="status_icon"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'assets/images/red-35.png"></span>');
				    _e("not working","pwa4wp");
				    echo('&nbsp;&nbsp;<button id="pwa4wp_start_button" type="submit">');
				    _e("START");
				    echo('</button>');
				    echo('<input type="hidden" name="pwa_active" value="START">');
			    }
			    ?>
                <br>
            </p>
                <span class="small-text">
	            <?php _e("If PWA status is 'working', this plugin will insert Manifest link and ServiceWorker installation tag into page headers."); ?>
                </span>
                <br>
                <br>
                <?php wp_nonce_field( 'my-nonce-key1', 'my-submenu1' ); ?>
            </form>
        </li>

    </ul>
<hr>
    <h2><?php _e("Usage","pwa4wp"); ?></h2>
    <ul>
        <li>
	        <?php _e("To make your website to PWA, this plugin make two files, \"Manifest\" and \"ServiceWorker\" in your website.","pwa4wp"); ?><br>
	        <?php _e("Manifest file is a json file that has configurations of web applications.","pwa4wp"); ?><br>
	        <?php _e("ServiceWorker is a javascript file that controls PWA's functions.","pwa4wp"); ?><br>
	        <?php _e("To start PWA, configure two files from below setup links.","pwa4wp"); ?><br>
        </li>
        <li>
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
        <li>
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
        <li>
            <h3><?php _e("PWA for Wordpress develop team","pwa4wp"); ?></h3>
            <ul>
                <li>
                    Ryoichi Tsukada&nbsp;/&nbsp;Asial<br>
                </li>
                <li>
                    Yuki Okamoto&nbsp;/&nbsp;Asial<br>
                </li>
                <li>
                    Satoshi Tsuda&nbsp;/&nbsp;Asial<br>
                </li>
                <li>
                    Ryunosuke Shindo&nbsp;/&nbsp;Computing Initiative<br>
                </li>
            </ul>
            <br>
        </li>
        <li>
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
    <?php
    echo "<br>";
    echo "<br>";
    ?>
</div>
