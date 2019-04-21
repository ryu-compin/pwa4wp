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
$iconurl = $data['iconurl'];
if(function_exists('mb_substr')){
    $thisPluginsPath = WP_PLUGIN_URL.'/'.mb_substr(plugin_basename(__FILE__),0,mb_strpos(plugin_basename(__FILE__),"/"));
}else{
    $thisPluginsPath = WP_PLUGIN_URL.'/'.substr(plugin_basename(__FILE__),0,strpos(plugin_basename(__FILE__),"/"));
}
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
<h1>PWA for WordPress Configulations</h1>
<h2><?php _e("Manifest Configulations","pwa4wp"); ?></h2>
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
<form enctype="multipart/form-data" id="pwa4wp-manifest-setting-form" method="post" action="">
    <ul>
        <li class="pwa4wp_list">
            <label>
                <span class="pwa4wp_itemname">
                    Site Name
                </span>
                <span class="pwa4wp_field">
                    <?php
                        if((empty($manifestSettings['name']))||($manifestSettings['name'] == "")):
                    ?>
                            <input type="text" id="test" name="name" class="pwa4wp_midtext" value="<?php esc_html_e( bloginfo("name") ); ?>">
                    <?php
                        else:
                    ?>
                            <input type="text" id="test" name="name" class="pwa4wp_midtext" value="<?php esc_html_e( $manifestSettings['name'] ); ?>">
                    <?php
                        endif;
                    ?>
                    <br><br>
	                <?php _e("This will be PWA application title.","pwa4wp"); ?><br>
                    <br>
                </span>
            </label>
        </li>
        <li class="pwa4wp_list">
            <hr>
            <label>
                <span class="pwa4wp_itemname">
                    Short Name
                </span>
                <span class="pwa4wp_field">
                <?php
                if((empty($manifestSettings['short_name']))||($manifestSettings['short_name'] == "")):
                    ?>
                    <input type="text" id="test" name="short_name" class="pwa4wp_midtext" value="<?php esc_html_e( bloginfo("name") ); ?>">
                <?php
                else:
                    ?>
                    <input type="text" id=" test" name="short_name" class="pwa4wp_midtext" value="<?php esc_html_e( $manifestSettings['short_name'] ); ?>">
                <?php
                endif;
                ?>
                    <br><br>
	                <?php _e("Define shorten application title.","pwa4wp"); ?><br>
                    <br>
                </span>
            </label>
        </li>
        <li class="pwa4wp_list">
            <hr>
            <label>
                <span class="pwa4wp_itemname">
                    description
                </span>
                <span class="pwa4wp_field">
                <?php
                if((empty($manifestSettings['description']))||($manifestSettings['description'] == "")):
                    ?>
                    <input type="text" id="test" name="description" class="pwa4wp_longtext" value="<?php esc_html_e( bloginfo("description") ); ?>">
                <?php
                else:
                    ?>
                    <input type="text" name="description" class="pwa4wp_longtext" value="<?php esc_html_e( $manifestSettings['description'] ); ?>">
                <?php
                endif;
                ?>
                    <br><br>
	                <?php _e("Define PWA description.","pwa4wp"); ?><br>
                    <br>

                </span>
            </label>
        </li>
        <li class="pwa4wp_list">
            <hr>
            <label>
                <span class="pwa4wp_itemname">
                    start_url
                </span>
                <span class="pwa4wp_field">
                <?php
                if((empty($manifestSettings['start_url']))||($manifestSettings['start_url'] == "")):
                    ?>
                    <input type="text" id="test" name="start_url" class="pwa4wp_midtext" value="/">
                <?php
                else:
                    ?>
                    <input type="text" name="start_url" class="pwa4wp_midtext" value="<?php esc_html_e( $manifestSettings['start_url'] ); ?>">
                <?php
                endif;
                ?>
                    <br><br>
	                <?php _e("Define start page of PWA.","pwa4wp"); ?><br>
                    <br>
                </span>
            </label>
        </li>
        <li class="pwa4wp_list">
            <hr>
            <label>
                <span class="pwa4wp_itemname">
                    scope
                </span>
                <span class="pwa4wp_field">
                <?php
                if((empty($manifestSettings['scope']))||($manifestSettings['scope'] == "")):
                    ?>
                    <input type="text" id="test" name="scope" class="pwa4wp_midtext" value="/">
                <?php
                else:
                    ?>
                    <input type="text" name="scope" class="pwa4wp_midtext" value="<?php esc_html_e( $manifestSettings['scope'] ); ?>">
                <?php
                endif;
                ?>
                    <br><br>
	                <?php _e("By default, PWA works in the directory that ServiceWorker installed.","pwa4wp"); ?><br>
	                <?php _e("This plugin set ServiceWorker to root directory of this website.","pwa4wp"); ?><br>
	                <?php _e("If you want PWA to work only in a apecified subdirectory, set subdirectory path in here.","pwa4wp"); ?><br>
                    <br>
                </span>
            </label>
            <br>

        </li>
        <li class="pwa4wp_list">
            <hr>
                <span class="pwa4wp_itemname">
                    Icons
                </span>
            <span class="pwa4wp_field">
                <p>
                    <br>

                </p>
                <?php
                    if(empty($iconurl) || ($iconurl == "")):
                ?>
                    <img id="image-view" src="<?php echo  $thisPluginsPath.'/'. "public/img/no_img.png"; ?>" width="260"><br>
                    <input name="iconurl" id="image-url" type="text" class="pwa4wp_longtext">
                <?php
                    else:
                ?>
                        <img id="image-view" src="<?php echo $iconurl; ?>" width="260"><br>
                        <input name="iconurl" id="image-url" type="text" class="pwa4wp_longtext" value="<?php echo $iconurl; ?>">
                <?php
                    endif;
                ?>
                <span id="image-error"></span>
                <button id="media-upload"><?php _e("Select/Upload Image","pwa4wp"); ?></button>
                <br><br>
	            <?php _e("Icon file is \"png\" format required, more than 512px x 512px size is recommended.","pwa4wp"); ?><br>
	            <?php _e("Icon file will be resized by system automatically.","pwa4wp"); ?><br>
                <br>
                </span>
            <br>
        </li>

        <li class="pwa4wp_list">
            <hr>
            <label>
                <span class="pwa4wp_itemname">
                    theme_color
                </span>
                <span class="pwa4wp_field">
                    <?php
                        if((empty($manifestSettings['theme_color']))||($manifestSettings['theme_color'] == "")){
                            $themeColor = background_color();
                        }else{
                            $themeColor = $manifestSettings['theme_color'];
                        }
                    ?>
                    <input name="theme_color" id="themeColorPicker" class="pwa4wp_shorttext" value="<?php esc_html_e( $themeColor ); ?>">
                </span>
            </label>
        </li>
        <li class="pwa4wp_list">
            <label>
                <span class="pwa4wp_itemname">
                    background_color
                </span>
                <span class="pwa4wp_field">
                    <?php
                    if((empty($manifestSettings['theme_color']))||($manifestSettings['theme_color'] == "")){
                        $bgColor =  background_color();
                    }else{
                        $bgColor = $manifestSettings['background_color'];
                    }
                    ?>
                    <input name="background_color" id="bgColorPicker" class="pwa4wp_shorttext" value="<?php esc_html_e( $bgColor ); ?>">
                    <br>
	                <?php _e("Choose PWA theme color and background color.","pwa4wp"); ?><br>
                    <br>
                </span>
            </label>
        </li>
        <li class="pwa4wp_list">
            <hr>
            <label>
                <span class="pwa4wp_itemname">
                    display
                </span>
                <span class="pwa4wp_field">
                    <select name="display">
                        <option value="fullscreen" <?php if((empty($manifestSettings['display']))||($manifestSettings['display'] == "fullscreen")) echo "selected"?> >
                            fullscreen
                        </option>
                        <option value="standalone" <?php if($manifestSettings['display'] == "standalone") echo "selected"?> >
                            standalone
                        </option>
                        <option value="minimal-ui" <?php if($manifestSettings['display'] == "minimal-ui") echo "selected"?> >
                            minimal-ui
                        </option>
                        <option value="browser" <?php if($manifestSettings['display'] == "browser") echo "selected"?> >
                            browser
                        </option>
                    </select>
                    <br><br>
	                <?php _e("PWA display mode.","pwa4wp"); ?><br>
                    <br>
                </span>
            </label>
        </li>

        <li class="pwa4wp_list">
            <label>
                <span class="pwa4wp_itemname">
                    orientation
                </span>
                <span class="pwa4wp_field">
                    <select name="orientation">
                        <option value="any" <?php if((empty($manifestSettings['orientation']))||($manifestSettings['orientation'] == "any")) echo "selected"?> >
                            any
                        </option>
                        <option value="natural" <?php if($manifestSettings['orientation'] == "natural") echo "selected"?> >
                            natural
                        </option>
                        <option value="landscape" <?php if($manifestSettings['orientation'] == "landscape") echo "selected"?> >
                            landscape
                        </option>
                        <option value="landscape-primary" <?php if($manifestSettings['orientation'] == "landscape-primary") echo "selected"?> >
                            landscape-primary
                        </option>
                        <option value="landscape-secondary" <?php if($manifestSettings['orientation'] == "landscape-secondary") echo "selected"?> >
                            landscape-secondary
                        </option>
                        <option value="portrait" <?php if($manifestSettings['orientation'] == "portrait") echo "selected"?> >
                            portrait
                        </option>
                        <option value="portrait-primary" <?php if($manifestSettings['orientation'] == "portrait-primary") echo "selected"?> >
                            portrait-primary
                        </option>
                        <option value="portrait-secondary" <?php if($manifestSettings['orientation'] == "portrait-secondary") echo "selected"?> >
                            portrait-secondary
                        </option>
                        <option value="notset" <?php if($manifestSettings['orientation'] == "notset") echo "selected"?> >
                            not set (use browser default)
                        </option>
                    </select>
                    <br><br>
	                <?php _e("Choose PWA screen orientation.","pwa4wp"); ?><br>
                    <br>
                </span>
            </label>
            <br>
            <hr>
        </li>
		<?php wp_nonce_field( 'my-nonce-key', 'my-submenu' ); ?>
    </ul>
    <span class="pwa4wp_submit_button_area">
        <button type="submit" class="submit_button">Save Manifest configurations</button>
    </span>
    <hr>
    </form>
</div>
