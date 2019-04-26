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
$swVersion = $data['swVersion'];
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
<h1>PWA for WordPress Configulations</h1>
<h2><?php _e("ServiceWorker Cache Configurations","pwa4wp"); ?></h2>
    <?php if($data['errorMsg']){
        echo('<ul class="pwa4wp_msgArea">');
        echo("<li class=\"pwa4wp_list\"><h3>");
        _e("Errors or Messages.");
        echo("</h3></li>");
        foreach ($data['errorMsg'] as $msg){
            echo("<li class=\"pwa4wp_list\">&gt;&gt;&nbsp;" . $msg ."</li>");
        }
        echo ('</ul>');
    }
    ?>
<form id="pwa4wp-cache-setting-form" method="post" action="" class="">
	<?php wp_nonce_field( 'my-nonce-key2', 'my-submenu2' ); ?>
    <ul>
        <li class="pwa4wp_list">
            <span class="pwa4wp_itemname">
                <?php _e("ServiceWorker Cache version ( auto increment )","pwa4wp"); ?> :&nbsp;&nbsp;
            </span>
            <span class="pwa4wp_field">
                <?php echo $swVersion;?>
            </span>
            <br>
            <hr>
        </li>
        <li class="pwa4wp_list">
                <span class="pwa4wp_itemname">
                    <?php _e("Basic cache plan","pwa4wp"); ?>
                </span>
                <span class="pwa4wp_field">
                    <label>
                    <input type="radio" name="cache_plan" value="cachefirst" <?php if($cacheSettings['cache_plan'] != "onlinefirst"){echo "checked=\"checked\"";} ?>>Cache first
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
                    <br>
                    <label>
                        <input type="checkbox" name="noCachReflesh" value="noCachReflesh" <?php if($cacheSettings['noCachReflesh'] == "noCachReflesh"){echo "checked=\"checked\"";} ?>><?php _e("Do not reflesh cache data.","pwa4wp"); ?>
                    </label><br><br>
                    <?php _e("When this parameter checked, PWA will not reflesh cache until Expire time set below.","pwa4wp"); ?><br>
                    <?php _e("We recommend not to check here to keep contnts flesh.","pwa4wp"); ?><br>
                    <?php _e("If you want some URLs to keep cache data without reflesh, use the parameter Force cache-first URL list.","pwa4wp"); ?><br>
                    <br>
                </span>
            <hr>
        </li>
        <li class="pwa4wp_list">
            <label>
                <span class="pwa4wp_itemname">
                    <?php _e("Offline Page URL","pwa4wp"); ?>
                </span>
                <span class="pwa4wp_field">
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
                    <input name="offline_url" class="pwa4wp_midtext" value="<?php esc_html_e( $cacheSettings['offline_url'] ); ?>">
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
        <li class="pwa4wp_list">
            <label>
                <span class="pwa4wp_itemname">
                    <?php _e("Cache Expire time","pwa4wp"); ?>
                </span>
                <span class="pwa4wp_field">
                    <input name="ttl" class="pwa4wp_shorttext" value="<?php if( $cacheSettings['ttl'] != ""){esc_html_e( $cacheSettings['ttl'] );}else{echo "2880";} ?>">
                    <br><br>
	                <?php _e("Define length of cache expire time by minutes.","pwa4wp"); ?><br>
	                <?php _e("For example, 1 hour -> 60 min, 1 day ->1440 min, 1 week->10080 min.","pwa4wp"); ?><br>
	                <?php _e("If define 0 for this, expire time is unlimited.","pwa4wp"); ?><br>
                    <br>
                </span>
            </label>
            <hr>
        </li>
        <li class="pwa4wp_list">
        <div>
            <label>
                <span class="pwa4wp_itemname">
                    <?php _e("URLs for exclude from cache list","pwa4wp"); ?>&nbsp;&nbsp;
                </span>
            </label>
            <button type="button" id="add-exclusions"><?php _e("Add list","pwa4wp"); ?></button><br>
            <span class="pwa4wp_field">
                <br>
            <ul id="exclusion-list">
                <?php
                if(!empty($cacheSettings['exclusions'])):
                    foreach ( $cacheSettings['exclusions'] as $item ):
                ?>
                    <li class="pwa4wp_innerlist"><input name="exclusions[]" class="pwa4wp_longtext" value="<?php esc_html_e( stripslashes($item) ); ?>"></li>
				<?php
                    endforeach;
                    else:
                ?>
                    <li class="pwa4wp_innerlist"><input name="exclusions[]" class="pwa4wp_longtext" value=""></li>
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
        <div>
            <span class="pwa4wp_field">
                <?php _e("Test for Reguler Expressions.","pwa4wp"); ?>
                <button type="button" id="regexp_toggle"><?php _e("Open Regexp Test","pwa4wp"); ?></button><br>
            </span>
            <br>
            <div id="regextestform" class="pwa4wp_regextestform">
                <div class="pwa4wp_regexttestinner" id="pwa4wp_regexttestinner">
                <span class="pwa4wp_field">
                    <?php _e("Input URL for test and press Test button.","pwa4wp"); ?><br>
                    <input id="regextTestURL" name="regextTestURL" class="pwa4wp_longtext" value="">
                    <button type="button" id="regexp_dotest"><?php _e("Test","pwa4wp"); ?></button><br>
                </span>
                <br>
                <span class="pwa4wp_field" id="regexp_result">

                </span>
                </div>
                <br>
            </div>
        </div>
            <hr>
        </li>

        <li class="pwa4wp_list">
            <div>
                <label>
                <span class="pwa4wp_itemname">
                    <?php _e("Force cache-first URL list","pwa4wp"); ?>&nbsp;&nbsp;
                </span>
                </label>
                <button type="button" id="add-forcecache"><?php _e("Add list","pwa4wp"); ?></button><br>
                <span class="pwa4wp_field">
                <br>
            <ul id="forcecache-list">
                <?php
                if(!empty($cacheSettings['forcecache'])):
	                foreach ( $cacheSettings['forcecache'] as $item ):
		                ?>
                        <li class="pwa4wp_innerlist"><input name="forcecache[]" class="pwa4wp_longtext" value="<?php esc_html_e( stripslashes($item) ); ?>"></li>
	                <?php
	                endforeach;
                else:
	                ?>
                    <li class="pwa4wp_innerlist"><input name="forcecache[]" class="pwa4wp_longtext" value=""></li>
                <?php
                endif;
                ?>
            </ul>
                <br>
	            <?php _e("These parameters works in online-first mode.","pwa4wp"); ?><br>
	            <?php _e("Specify here URLs to cache forcely in online-first mode.","pwa4wp"); ?><br>
	            <?php _e("Example","pwa4wp"); ?>&nbsp;:&nbsp; ^.*/\.jpg.*&nbsp;<br>
	            <?php _e("This means that all \".jpg\" file will be cached.","pwa4wp"); ?><br>
                <br>
                </span>
            </div>
            <div>
            <span class="pwa4wp_field">
                <?php _e("Test for Reguler Expressions.","pwa4wp"); ?>
                <button type="button" id="regexp_toggle_forcecache"><?php _e("Open Regexp Test","pwa4wp"); ?></button><br>
            </span>
                <br>
                <div id="regextestform_forcecache" class="pwa4wp_regextestform">
                    <div class="pwa4wp_regexttestinner" id="pwa4wp_regexttestinner_forcecache">
                <span class="pwa4wp_field">
                    <?php _e("Input URL for test and press Test button.","pwa4wp"); ?><br>
                    <input id="regextTestURL_forcecache" name="regextTestURL" class="pwa4wp_longtext" value="">
                    <button type="button" id="regexp_dotest_forcecache"><?php _e("Test","pwa4wp"); ?></button><br>
                </span>
                        <br>
                        <span class="pwa4wp_field" id="regexp_result_forcecache">
                </span>
                    </div>
                    <br>
                </div>
            </div>
            <hr>
        </li>

        <li class="pwa4wp_list">
            <div>
                <label>
                <span class="pwa4wp_itemname">
                    <?php _e("Force online-first URL list","pwa4wp"); ?>&nbsp;&nbsp;
                </span>
                </label>
                <button type="button" id="add-forceonline"><?php _e("Add list","pwa4wp"); ?></button><br>
                <span class="pwa4wp_field">
                <br>
            <ul id="forceonline-list">
                <?php
                if(!empty($cacheSettings['forceonline'])):
	                foreach ( $cacheSettings['forceonline'] as $item ):
		                ?>
                        <li class="pwa4wp_innerlist"><input name="forceonline[]" class="pwa4wp_longtext" value="<?php esc_html_e( stripslashes($item) ); ?>"></li>
	                <?php
	                endforeach;
                else:
	                ?>
                    <li class="pwa4wp_innerlist"><input name="forceonline[]" class="pwa4wp_longtext" value=""></li>
                <?php
                endif;
                ?>
            </ul>
                <br>
	            <?php _e("These parameters works in cache-first mode.","pwa4wp"); ?><br>
	            <?php _e("Specify here URLs to cache forcely in cache-first mode.","pwa4wp"); ?><br>
	            <?php _e("Example","pwa4wp"); ?>&nbsp;:&nbsp; ^.*/myplugin/.*&nbsp;<br>
	            <?php _e("This means that all \"/myplugin/\" file will be online-first.","pwa4wp"); ?><br>
                <br>
                </span>
            </div>
            <div>
            <span class="pwa4wp_field">
                <?php _e("Test for Reguler Expressions.","pwa4wp"); ?>
                <button type="button" id="regexp_toggle_forceonline"><?php _e("Open Regexp Test","pwa4wp"); ?></button><br>
            </span>
                <br>
                <div id="regextestform_forceonline" class="pwa4wp_regextestform">
                    <div class="pwa4wp_regexttestinner" id="pwa4wp_regexttestinner_forceonline">
                <span class="pwa4wp_field">
                    <?php _e("Input URL for test and press Test button.","pwa4wp"); ?><br>
                    <input id="regextTestURL_forceonline" name="regextTestURL" class="pwa4wp_longtext" value="">
                    <button type="button" id="regexp_dotest_forceonline"><?php _e("Test","pwa4wp"); ?></button><br>
                </span>
                        <br>
                        <span class="pwa4wp_field" id="regexp_result_forceonline">
                </span>
                    </div>
                    <br>
                </div>
            </div>
            <hr>
        </li>

        <li class="pwa4wp_list">
        <div>
            <label>
                <span class="pwa4wp_itemname">
                    <?php _e("First caches","pwa4wp"); ?>&nbsp;&nbsp;
                </span>
            </label>
            <button type="button" id="add-initial-caches"><?php _e("Add list","pwa4wp"); ?></button><br>
            <span class="pwa4wp_field">
                <br>
            <ul id="initial-cache-list">

                <?php
                if(!empty( $cacheSettings['initial-caches'])):
                    foreach ( $cacheSettings['initial-caches'] as $item ):
                ?>
                    <li class="pwa4wp_list pwa4wp_innerlist"><input name="initial-caches[]" class="pwa4wp_longtext" value="<?php esc_html_e( $item ); ?>"></li>
                <?php
                    endforeach;
                else:
                ?>
                    <li class="pwa4wp_list pwa4wp_innerlist"><input name="initial-caches[]" class="pwa4wp_longtext" value=""></li>
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

        <li class="pwa4wp_list">
                <span class="pwa4wp_itemname">
                    <?php _e("Debug mode","pwa4wp"); ?>
                </span>
            <span class="pwa4wp_field">
                    <label>
                    <input type="radio" name="debug_msg" value="ON" <?php if($cacheSettings['debug_msg'] == "ON"){echo "checked=\"checked\"";} ?>>ON
                    </label><br>
                    <label>
                        <input type="radio" name="debug_msg" value="OFF" <?php if((empty($cacheSettings['debug_msg'])||($cacheSettings['debug_msg'] != "ON"))){echo "checked=\"checked\"";} ?>>OFF
                    </label><br><br>
                <?php _e("Switch to show debug messages.","pwa4wp"); ?><br>
                <?php _e("Set ON this switch, ServiceWorker JavaScript will send verbose messages to debug console of browser.","pwa4wp"); ?><br>
                    <br>
                </span>
            <hr>
        </li>
    </ul>
    <span class="pwa4wp_submit_button_area">
        <button type="submit" class="submit_button"><?php _e("Save Cache configurations","pwa4wp");?></button>
    </span>
</form>
    <hr>
    <div class="pwa4wp_hiddenMsg">
        <span id="msg_RegExpHit"><?php _e("This URL will be excluded from cache.","pwa4wp"); ?></span>
        <span id="msg_RegExpNone"><?php _e("This URL will not be excluded from cache.","pwa4wp"); ?></span>
        <span id="btn_OpenRegexpTest"><?php _e("Open Regexp Test","pwa4wp"); ?></span>
        <span id="btn_CloseRegexpTest"><?php _e("Close Regexp Test","pwa4wp"); ?></span>
    </div>
</div>
