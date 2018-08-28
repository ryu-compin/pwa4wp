<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/ryu-compin/pwa4wp
 * @since      1.0.0
 *
 * @package    pwa4wp
 * @subpackage pwa4wp/admin/partials
 */

$manifestSettings = $data['manifestSettings'];
$cacheSettings    = $data['cacheSettings'];
$swVersion = $data['swVersion'];
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
<h1>PWA for WordPress Configulations</h1>
<h2><?php _e("ServiceWorker Cache Configurations","pwa4wp"); ?></h2>
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
<form id="pwa4wp-cache-setting-form" method="post" action="" class="">
	<?php wp_nonce_field( 'my-nonce-key2', 'my-submenu2' ); ?>
    <ul>
        <li>
            <span class="itemname">
                <?php _e("ServiceWorker Cache version ( auto increment )","pwa4wp"); ?> :&nbsp;&nbsp;
            </span>
            <span class="field">
                <?php echo $swVersion;?>
            </span>
            <br>
            <hr>
        </li>
        <li>
                <span class="itemname">
                    <?php _e("Basic cache plan","pwa4wp"); ?>
                </span>
                <span class="field">
                    <label>
                    <input type="radio" name="cache_plan" value="cachefirst" <?php if($cacheSettings['cache_plan'] == "cachefirst"){echo "checked=\"checked\"";} ?>>Cache first
                    </label><br>
                    <label>
                        <input type="radio" name="cache_plan" value="onlinefirst" <?php if($cacheSettings['cache_plan'] == "onlinefirst"){echo "checked=\"checked\"";} ?>>Online first
                    </label><br><br>
                    <?php _e("Setup cache plan.","pwa4wp"); ?><br>
	                <?php _e("Cache first plan will show cache data before get online data.","pwa4wp"); ?><br>
	                <?php _e("If the page requested is already in cache, cached page will be shown.","pwa4wp"); ?><br>
	                <?php _e("Online first plan will show online data before cache data.","pwa4wp"); ?><br>
	                <?php _e("When the browser failed to get online page, for example offline or server down, cached data will be shown.","pwa4wp"); ?><br>
                    <br>
                </span>
            <hr>
        </li>
        <li>
            <label>
                <span class="itemname">
                    <?php _e("Offline Page URL","pwa4wp"); ?>
                </span>
                <span class="field">
                    <?php
                    $args = array(
                        'depth'                 => 0,
                        'child_of'              => 0,
                        'selected'              => $cacheSettings['offline_url'],
                        'echo'                  => 1,
                        'name'                  => 'offline_url',
                        'id'                    => null, // string
                        'class'                 => null, // string
                        'show_option_none'      => null, // string
                        'show_option_no_change' => null, // string
                        'option_none_value'     => null, // string
                    );
                    wp_dropdown_pages( $args );
                    ?>
                    <!--
                    <input name="offline_url" class="midtext" value="<?php esc_html_e( $cacheSettings['offline_url'] ); ?>">
                    -->
                    <?php
                    if($cacheSettings['offline_url'] != ""){
	                    echo "Page ID:";
	                    esc_html_e( $cacheSettings['offline_url'] );
	                    echo " [ <a href=\"" . get_permalink( $cacheSettings['offline_url'] ) . "\" target=\"_blank\">" . get_permalink( $cacheSettings['offline_url'] ) . "</a> ]";
                    }
                    ?>
                    <br><br>
	                <?php _e("Select a Page to show when the PWA is offline.","pwa4wp"); ?><br>
	                <?php _e("Make a page for offline. ","pwa4wp"); ?><br>
	                <?php _e("This page will be cached when PWA is installed.","pwa4wp"); ?><br>
                    <br>
                </span>
            </label>
            <hr>
        </li>
        <li>
            <label>
                <span class="itemname">
                    <?php _e("Cache Expire time","pwa4wp"); ?>
                </span>
                <span class="field">
                    <input name="ttl" class="shorttext" value="<?php if( $cacheSettings['ttl'] != ""){esc_html_e( $cacheSettings['ttl'] );}else{echo "0";} ?>">
                    <br><br>
	                <?php _e("Define length of cache expire time by minutes.","pwa4wp"); ?><br>
	                <?php _e("For example, 1 hour -> 60 min, 1 day ->1440 min, 1 week->10080 min.","pwa4wp"); ?><br>
	                <?php _e("If define 0 for this, expire time is unlimited.","pwa4wp"); ?><br>
                    <br>
                </span>
            </label>
            <hr>
        </li>
        <li>
        <div>
            <label>
                <span class="itemname">
                    <?php _e("URLs for exclude from cache list","pwa4wp"); ?>&nbsp;&nbsp;
                </span>
            </label>
            <button type="button" id="add-exclusions"><?php _e("Add list","pwa4wp"); ?></button><br>
            <span class="field">
                <br>
            <ul id="exclusion-list">
                <?php
                if(!empty($cacheSettings['exclusions'])):
                    foreach ( $cacheSettings['exclusions'] as $item ):
                ?>
                    <li class="innerlist"><input name="exclusions[]" class="longtext" value="<?php esc_html_e( $item ); ?>"></li>
				<?php
                    endforeach;
                    else:
                ?>
                    <li class="innerlist"><input name="exclusions[]" class="longtext" value=""></li>
                <?php
                endif;
                ?>
            </ul>
                <br>
	            <?php _e("Directory /wp-admin/ is added automatibally, so you don't need to define admin directory in here.","pwa4wp"); ?><br>
	            <?php _e("Regular expressions are available.","pwa4wp"); ?><br>
	            <?php _e("Example","pwa4wp"); ?>&nbsp;:&nbsp; ^.*/api/.*&nbsp;<br>
	            <?php _e("This means that all \"/api/\" directory will excluded from cache.","pwa4wp"); ?><br>
                <br>
                </span>
        </div>
            <hr>
        </li>
        <li>
        <div>
            <label>
                <span class="itemname">
                    <?php _e("First caches","pwa4wp"); ?>&nbsp;&nbsp;
                </span>
            </label>
            <button type="button" id="add-initial-caches"><?php _e("Add list","pwa4wp"); ?></button><br>
            <span class="field">
                <br>
            <ul id="initial-cache-list">

                <?php
                if(!empty( $cacheSettings['initial-caches'])):
                    foreach ( $cacheSettings['initial-caches'] as $item ):
                ?>
                    <li class="innerlist"><input name="initial-caches[]" class="longtext" value="<?php esc_html_e( $item ); ?>"></li>
                <?php
                    endforeach;
                else:
                ?>
                    <li class="innerlist"><input name="initial-caches[]" class="longtext" value=""></li>
                <?php
                endif;
                ?>
            </ul>
                <br>
	            <?php _e("Contents of these URLs are cached with installation.","pwa4wp"); ?><br>
	            <?php _e("Start URL in manifest and offline page will added automatically, so you don't need to define them in here.","pwa4wp"); ?><br>
                <br>
            </span>
        </div>
            <hr>
        </li>
        <li>
                <span class="itemname">
                    <?php _e("Debug mode","pwa4wp"); ?>
                </span>
            <span class="field">
                    <label>
                    <input type="radio" name="debug_msg" value="ON" <?php if($cacheSettings['debug_msg'] == "ON"){echo "checked=\"checked\"";} ?>>ON
                    </label><br>
                    <label>
                        <input type="radio" name="debug_msg" value="OFF" <?php if(($cacheSettings['debug_msg'] == "OFF")||(empty($cacheSettings['debug_msg']))){echo "checked=\"checked\"";} ?>>OFF
                    </label><br><br>
                <?php _e("Switch to show debug messages.","pwa4wp"); ?><br>
                <?php _e("Set ON this switch, ServiceWorker javascript will send verbose messages to debug console of browser.","pwa4wp"); ?><br>
                    <br>
                </span>
            <hr>
        </li>
    </ul>
    <button type="submit">Save Cache configurations</button>
</form>
    <hr>
</div>
