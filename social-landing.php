<?php
/** 
* Plugin Name: Social Landing
* Plugin URI: https://sociallanding.net
* Description: Create a mini landing page with custom links.
* Version:      1.1.1
* Author:       Jose Miguel Urdaneta
* Author URI:   https://jurdaneta.com
* Text  Domain: sociallanding
* License:      GNU General Public License v2
*/

define( 'SOCIAL_LANDING_STORE_URL', 'https://sociallanding.net' );
define( 'SOCIAL_LANDING_ITEM_NAME', 'Social Landing Plugin' ); 

define( 'SOCIAL_LANDING_PLUGIN_LICENSE_PAGE', 'social_landing_settings_page' );
//Options page
include_once('social-landing-options.php');
// end options page
/* urlhandler */

add_action('parse_request', 'social_landing_url_handler');
function social_landing_url_handler() {
    if(get_option('social_landing_url')){
        $social_landing_url = '/'.get_option('social_landing_url');        
    }
    else{
        $social_landing_url = '/links';
    }
    if($_SERVER["REQUEST_URI"] == $social_landing_url) {
        include_once('landing.php');
        exit();
    }
}
/** /url handler */



if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
	// load our custom updater
	include( dirname( __FILE__ ) . '/inc/EDD_SL_Plugin_Updater.php' );
}
function facilius_social_landing_plugin_updater() {

	// retrieve our license key from the DB
	$license_key = trim( get_option( 'social_landing_license_key' ) );

	// setup the updater
	$edd_updater = new EDD_SL_Plugin_Updater( SOCIAL_LANDING_STORE_URL, __FILE__, array(
			'version' 	=> '1.1.1', 				// current version number
			'license' 	=> $license_key, 		// license key (used get_option above to retrieve from DB)
			'item_name' => SOCIAL_LANDING_ITEM_NAME, 	// name of this plugin
			'author' 	=> 'Jose Miguel Urdaneta',  // author of this plugin
			'beta'		=> false
		)
	);

}
add_action( 'admin_init', 'facilius_social_landing_plugin_updater', 0 );

include( dirname( __FILE__ ) . '/inc/social_landing_update.php' );











/**
 * Sidebar handler
 */

add_action( 'widgets_init', 'facilius_social_sidebar_init' );
function facilius_social_sidebar_init() {
    register_sidebar( array(
        'name' => __( 'Social Landing', 'sociallanding' ),  
        'id' => 'social-landing-sidebar',
        'description' => __( 'Widgets in this area will be shown on your social landing.', 'sociallanding' ),
        'before_widget' => '<div id="%1$s" class="widget sociallandingwidget %2$s">',
        'after_widget'  => '</div>',
	      'before_title'  => ' ',
  	    'after_title'   => ' ',
    ) );
}


/** Widgets */
include_once('social-landing-widgets.php');




/* CUSTOMIZER HANDLER
include_once('social-landing-customizer.php');*/
add_action( 'admin_enqueue_scripts', 'social_landing_color_picker' );
function social_landing_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle', plugins_url('js/sl-color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}




#Social Landing Sidebar painting
add_action('admin_head', 'social_landing_sidebar_colors');

function social_landing_sidebar_colors() {
  echo '<style>
    
  #social-landing-sidebar {
    background: rgb(114,20,180);
    background: linear-gradient(180deg, rgba(77,14,28,1) 0%, rgba(121,9,79,1) 35%, rgba(255,255,255,1) 100%);
  }
  #social-landing-sidebar h2{
      color:#fff;
  }
  #social-landing-sidebar .description{
    color:#fff;
}
  
  </style>';
}

//cambiando el formato de la licencia

#HEX to RGB
function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
    /*
    OUTPUT:

    hex2RGB("#FF0") -> array( red =>255, green => 255, blue => 0)
    hex2RGB("#FFFF00) -> Same as above
    hex2RGB("#FF0", true) -> 255,255,0
    hex2RGB("#FF0", true, ":") -> 255:255:0
     */
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
} 