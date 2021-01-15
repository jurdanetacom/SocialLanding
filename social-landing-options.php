<?php

// create custom plugin settings menu


function social_landing_create_menu() {

	//create new top-level menu
	add_menu_page('Social Landing', 'Social Landing', 'administrator', __FILE__, 'social_landing_settings_page' , plugins_url('/img/icon.png', __FILE__) );
    add_submenu_page(__FILE__ , 'Social Landing Plugin License', 'Plugin License', 'administrator',SOCIAL_LANDING_PLUGIN_LICENSE_PAGE , 'edd_sample_license_page' );
	//call register settings function
	add_action( 'admin_init', 'register_social_landing_settings' );
}
add_action('admin_menu', 'social_landing_create_menu');
function register_social_landing_settings() {
	//register our settings
    register_setting( 'social_landing_settings_group', 'social_landing_page_title' ); //listo
    register_setting( 'social_landing_settings_group', 'social_landing_url' );//listo
	register_setting( 'social_landing_settings_group', 'social_landing_meta_description' );//listo
    register_setting( 'social_landing_settings_group', 'social_landing_header_code' );//listo
    register_setting( 'social_landing_settings_group', 'social_landing_font' );

    register_setting( 'social_landing_settings_group', 'social_landing_font_color' );//listo
    register_setting( 'social_landing_settings_group', 'social_landing_background_color' );//listo
    register_setting( 'social_landing_settings_group', 'social_landing_background_gradient' );//listo
    register_setting( 'social_landing_settings_group', 'social_landing_background_gradient_two' );//listo
    register_setting( 'social_landing_settings_group', 'social_landing_background_animation' );//listo
    register_setting( 'social_landing_settings_group', 'social_landing_background_image' );//listo
    register_setting( 'social_landing_settings_group', 'social_landing_button_color' );
    register_setting( 'social_landing_settings_group', 'social_landing_button_hover' );
    register_setting( 'social_landing_settings_group', 'social_landing_button_border' );
    register_setting( 'social_landing_settings_group', 'social_landing_button_transparency' );

    register_setting( 'social_landing_settings_group', 'social_landing_profile_image' );//listo


}
function social_landing_custom_admin_notices() { 
    $myslurl= get_bloginfo('url').'/links';?>
	<?php if (isset($_GET['settings-updated'])) : ?>
	<div class="notice notice-success is-dismissible">
		<p><?php _e('Settings saved in Social Landing, go chech them!:  ', 'sociallanding');  echo '<a href="'.$myslurl.'" target="_blank">'.$myslurl.'</a>'; ?></p>
	</div>
    <?php endif; ?>
	
<?php }
add_action('admin_notices', 'social_landing_custom_admin_notices');



function social_landing_settings_page() {
?>
<div class="wrap">

<h1>Social Landing Settings</h1>
<form method="post" action="options.php">
    <?php settings_fields( 'social_landing_settings_group' ); ?>
    <?php do_settings_sections( 'social_landing_settings_group' ); ?>
    <table class="form-table">
    <div class="sociallandinginfo"> 
        <h2>Your Social Landing is:</h2>
        <p><?php
            if(get_option('social_landing_url')){
                $myslurl= get_bloginfo('url').'/'.get_option('social_landing_url');    
            }
            else{
                $myslurl= get_bloginfo('url').'/links';
            }

        echo '<a href="'.$myslurl.'" target="_blank" style="font-size: 1.3em;">'.$myslurl.'</a>';
        ?></p>
        </div>
        <!-- colores-->
        <tr valign="top">
        <th scope="row"><h2>Background</h2></th>    
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e('Background Color','sociallanding') ?></th>
            <td><input type="text" class="sl-color-picker" name="social_landing_background_color" value="<?php echo esc_attr( get_option('social_landing_background_color') ); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row"><?php _e('Background Gradient (Optional)','sociallanding') ?></th>
        <td><input type="text" class="sl-color-picker" name="social_landing_background_gradient" value="<?php echo esc_attr( get_option('social_landing_background_gradient') ); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row"><?php _e('Background Gradient 2 (Optional)','sociallanding') ?></th>
        <td><input type="text" class="sl-color-picker" name="social_landing_background_gradient_two" value="<?php echo esc_attr( get_option('social_landing_background_gradient_two') ); ?>" /></td>
        </tr>
        <!--Background image-->
        <tr valign="top">
        <th scope="row"><?php _e('Background Image (Optional)','sociallanding') ?></th>
        <td><input type="text" class="cargarimagen" name="social_landing_background_image" value="<?php echo esc_attr( get_option('social_landing_background_image') ); ?>" />
        <button class="upload_image_button button button-primary">Upload Image</button></td>
        </tr>
        <!-- Animación -->
        <tr valign="top">
        <th scope="row"><?php _e('Background Animation (Optional)','sociallanding') ?></th>
        <td><input type="checkbox" class="" name="social_landing_background_animation" value="1" <?php checked(1, get_option('social_landing_background_animation'), true); ?>/>
        </tr>

        <tr valign="top"><th scope="row"><h2>Buttons</h2</th></tr>
        <tr valign="top">
            <th scope="row"><?php _e('Button Background Color','sociallanding') ?></th>
            <td><input type="text" class="sl-color-picker" name="social_landing_button_color" value="<?php echo esc_attr( get_option('social_landing_button_color') ); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row"><?php _e('Button Background Transparency','sociallanding') ?><br><p>Check this if you use background image within links.</p></th>
        <td><input type="checkbox" class="" name="social_landing_button_transparency" value="1" <?php checked(1, get_option('social_landing_button_transparency'), true); ?>/>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e('Button Background Hover','sociallanding') ?></th>
            <td><input type="text" class="sl-color-picker" name="social_landing_button_hover" value="<?php echo esc_attr( get_option('social_landing_button_hover') ); ?>" /></td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e('Button Border','sociallanding') ?></th>
            <td><input type="text" class="sl-color-picker" name="social_landing_button_border" value="<?php echo esc_attr( get_option('social_landing_button_border') ); ?>" /></td>
        </tr>

        <tr valign="top"><th scope="row"><h2>Font</h2></th></tr>
        <tr valign="top">
            <th scope="row"><?php _e('Font Color','sociallanding') ?></th>
            <td><input type="text" class="sl-color-picker" name="social_landing_font_color" value="<?php echo esc_attr( get_option('social_landing_font_color') ); ?>" /></td>
        </tr>
        
        <tr valign="top"><th scope="row"><h2>Options</h2></th></tr>
        <tr valign="top">
        <th scope="row"><?php _e('Page Title','sociallanding') ?></th>
        <td><input type="text" name="social_landing_page_title" value="<?php echo esc_attr( get_option('social_landing_page_title') ); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row"><?php _e('Landing URL','sociallanding') ?></th>
        <td><input type="text" name="social_landing_url" value="<?php echo esc_attr( get_option('social_landing_url') ); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row"><?php _e('Meta description','sociallanding') ?></th>
        <td><input type="text" name="social_landing_meta_description" value="<?php echo esc_attr( get_option('social_landing_meta_description') ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row"><?php _e('Head code (You can put here Google Analytics, or other)','sociallanding') ?></th>
        <td><textarea  name="social_landing_header_code" value="" ><?php echo esc_attr( get_option('social_landing_header_code') ); ?> </textarea></td>
        </tr>

        <tr valign="top"><th scope="row"><h2>Profile Pic</h2></th></tr>
        <tr valign="top">
        <th scope="row"><?php _e('Profile Image (Optional)','sociallanding') ?></th>
        <td><input type="text" class="cargarimagen" name="social_landing_profile_image" value="<?php echo esc_attr( get_option('social_landing_profile_image') ); ?>" />
        <button class="upload_image_button button button-primary">Upload Image</button></td>
        </tr>
        
    </table>
    
    <?php submit_button(); ?>

</form>


</div>
<?php } ?>