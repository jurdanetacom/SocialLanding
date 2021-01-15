<?php
/*******************************
******** LINK WIDGET ******
*******************************/
class facilius_social_link_widget extends WP_Widget {
  function __construct() {
    add_action('admin_enqueue_scripts', array($this, 'sociallandingscripts'));
    parent::__construct(
      // base ID of the widget
      'facilius_social_links',
      // name of the widget
      __('📱 Social Landing - Link', 'facilius' ),
      // widget options
      array (
          'description' => __( 'Show an specific link', 'facilius' )
      )
      );
  }
  function form( $instance ) {
    $defaults = array(
      'faciliuslinktext' => ' ',
      'faciliuslink'  => ' ',
      'faciliusimage' => ' '

    );
    $faciliuslinktext = ! empty( $instance['faciliuslinktext'] ) ? $instance['faciliuslinktext'] : '';
    $faciliuslink  = ! empty( $instance['faciliuslink'] ) ? $instance['faciliuslink'] : '';
    $faciliusimage = ! empty( $instance['faciliusimage'] ) ? $instance['faciliusimage'] : '';
      
    // markup for form ?>
    <p>
          <label for="<?php echo $this->get_field_id( 'faciliuslinktext' ); ?>">Text:</label>
          <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'faciliuslinktext' ); ?>" name="<?php echo $this->get_field_name( 'faciliuslinktext' ); ?>" value="<?php echo esc_attr( $faciliuslinktext ); ?>">
          <label for="<?php echo $this->get_field_id( 'faciliuslink' ); ?>">Your Link:</label>
          <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'faciliuslink' ); ?>" name="<?php echo $this->get_field_name( 'faciliuslink' ); ?>" value="<?php echo esc_attr( $faciliuslink ); ?>">
          <label for="<?php echo $this->get_field_id( 'faciliusimage' ); ?>"><?php _e( 'Image:' ); ?></label>
          <input class="widefat cargarimagen" id="<?php echo $this->get_field_id( 'faciliusimage' ); ?>" name="<?php echo $this->get_field_name( 'faciliusimage' ); ?>" type="text" value="<?php echo esc_url( $faciliusimage ); ?>" />
          <button class="upload_image_button button button-primary">Upload Image</button>
    </p>
   <?php }

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'faciliuslink' ] = strip_tags( $new_instance[ 'faciliuslink' ] );
    $instance[ 'faciliuslinktext' ] = strip_tags( $new_instance[ 'faciliuslinktext' ] );
    $instance[ 'faciliusimage' ] = strip_tags( $new_instance[ 'faciliusimage' ] );
    return $instance;    
  }
  function widget( $args, $instance ) {
    extract( $args );
    echo $before_widget;
    $faciliusimage = ! empty( $instance['faciliusimage'] ) ? $instance['faciliusimage'] : '';
    ob_start();
    //echo '<img src="'.esc_url($faciliusimage).'" alt="">';
    echo '<div class="sociallandingbutton" style="background: url('.esc_url($faciliusimage).') center center; background-size:cover;"><a href="'.$instance[ 'faciliuslink' ].'" target="_blank" >'.$instance[ 'faciliuslinktext' ].'</a></div>';
    ob_end_flush();
    echo $after_widget;
  }
  function sociallandingscripts(){
    wp_enqueue_script( 'media-upload' );
    wp_enqueue_media();
    wp_enqueue_script('our_admin', plugin_dir_url( __FILE__ ) . '/js/admin.js', array('jquery'));
  }

}
/*******************************
********IMAGE LINK WIDGET ******
*******************************/

class facilius_image_link extends WP_Widget {
  function __construct(){
    add_action('admin_enqueue_scripts', array($this, 'sociallandingscripts'));
    parent::__construct(
      // base ID of the widget
      'facilius_image_linkpic',
      // name of the widget
      __('📱 Social Landing - Image link', 'facilius' ),
      // widget options
      array (
          'description' => __( 'Display an image with a link ', 'facilius' )
      )
      );    
  }
  function form( $instance ) {
    $defaults = array(
      'faciliusimagelinkurl'  => ' ',
      'faciliusimagelink' => ' '

    );
    $faciliusimagelinkurl  = ! empty( $instance['faciliusimagelinkurl'] ) ? $instance['faciliusimagelinkurl'] : '';
    $faciliusimagelink = ! empty( $instance['faciliusimagelink'] ) ? $instance['faciliusimagelink'] : '';
      
    // markup for form ?>
    <p>
          <label for="<?php echo $this->get_field_id( 'faciliusimagelinkurl' ); ?>">faciliusimagelinkurl:</label>
          <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'faciliusimagelinkurl' ); ?>" name="<?php echo $this->get_field_name( 'faciliusimagelinkurl' ); ?>" value="<?php echo esc_attr( $faciliusimagelinkurl ); ?>">
          
          

          <label for="<?php echo $this->get_field_id( 'faciliusimagelink' ); ?>"><?php _e( 'Image:' ); ?></label>
          <input class="widefat cargarimagen" id="<?php echo $this->get_field_id( 'faciliusimagelink' ); ?>" name="<?php echo $this->get_field_name( 'faciliusimagelink' ); ?>" type="text" value="<?php echo esc_url( $faciliusimagelink ); ?>" />
          <button class="upload_image_button button button-primary">Upload Image</button>
    </p>
   <?php }
  
  function update($new_instance,$old_instance){
    $instance = $old_instance;
    $instance[ 'faciliusimagelinkurl' ] = strip_tags( $new_instance[ 'faciliusimagelinkurl' ] );
    $instance[ 'faciliusimagelink' ] = strip_tags( $new_instance[ 'faciliusimagelink' ] );
    
    return $instance;    
  }

  function widget( $args, $instance ) {
    extract( $args );
    echo $before_widget;
    $faciliusimagelink = ! empty( $instance['faciliusimagelink'] ) ? $instance['faciliusimagelink'] : '';
    $faciliusimagelinkurl = ! empty( $instance['faciliusimagelinkurl'] ) ? $instance['faciliusimagelinkurl'] : '';
    ob_start();
    
    echo '<div class="sociallandingpic">';
    
    echo '<a href="'.stripcslashes($faciliusimagelinkurl).'" target="_blank"><img src="'.esc_url($faciliusimagelink).'" ></a>';
    
    echo '</div>';
    
    /*style="background: url('..') center center; background-size:cover;">
    <a href="'.$instance[ 'faciliuslink' ].'" target="_blank" >'.$instance[ 'faciliuslinktext' ].'</a></div>';*/
    ob_end_flush();
    echo $after_widget;
  }


  function sociallandingscripts(){
    wp_enqueue_script( 'media-upload' );
    wp_enqueue_media();
    wp_enqueue_script('our_admin', plugin_dir_url( __FILE__ ) . '/js/admin.js', array('jquery'));
  }
}

/**WHATSAPP CLICK TO CHAT */
class social_landing_whatsapp_ctc extends WP_Widget {
  function __construct() {
    
    parent::__construct(
      // base ID of the widget
      'social_landing_whatsapp_ctc',
      // name of the widget
      __('📱 Social Landing - Whatsapp', 'facilius' ),
      // widget options
      array (
          'description' => __( 'Create a Whatsapp Click to Chat Button', 'facilius' )
      )
      );
  }
  function form( $instance ) {
    $defaults = array(
      'social_landing_whatsapp_text' => ' ',
      'social_landing_whatsapp_number'  => ' ',
      );
    $social_landing_whatsapp_text = ! empty( $instance['social_landing_whatsapp_text'] ) ? $instance['social_landing_whatsapp_text'] : '';
    $social_landing_whatsapp_number  = ! empty( $instance['social_landing_whatsapp_number'] ) ? $instance['social_landing_whatsapp_number'] : '';

      
    // markup for form ?>
    <p>
          <label for="<?php echo $this->get_field_id( 'social_landing_whatsapp_text' ); ?>">Text:</label>
          <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'social_landing_whatsapp_text' ); ?>" name="<?php echo $this->get_field_name( 'social_landing_whatsapp_text' ); ?>" value="<?php echo esc_attr( $social_landing_whatsapp_text ); ?>">
          <label for="<?php echo $this->get_field_id( 'social_landing_whatsapp_number' ); ?>">Your number:</label>
          <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'social_landing_whatsapp_number' ); ?>" name="<?php echo $this->get_field_name( 'social_landing_whatsapp_number' ); ?>" value="<?php echo esc_attr( $social_landing_whatsapp_number ); ?>">
          <p>Remember to use your full phone number in international format (e.g. 15551234567 ) </p>
    </p>
   <?php }

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'social_landing_whatsapp_number' ] = strip_tags( $new_instance[ 'social_landing_whatsapp_number' ] );
    $instance[ 'social_landing_whatsapp_text' ] = strip_tags( $new_instance[ 'social_landing_whatsapp_text' ] );
    return $instance;    
  }
  function widget( $args, $instance ) {
    extract( $args );
    echo $before_widget;
 
    ob_start();
     echo '
    <div class="sociallandingwhatsapp">
        <a href="https://wa.me/'.$instance[ 'social_landing_whatsapp_number' ].'" target="_blank" >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 418.86 420.88"><defs><style>.cls-1{fill:#fff;fill-rule:evenodd;}</style></defs><title>Asset 1</title><g id="Layer_2" data-name="Layer 2"><g id="WhatsApp_Logo" data-name="WhatsApp Logo"><g id="WA_Logo" data-name="WA Logo"><path class="cls-1" d="M357.83,61.16A207.2,207.2,0,0,0,210.31,0C95.35,0,1.79,93.55,1.75,208.54A208.18,208.18,0,0,0,29.59,312.8L0,420.88l110.56-29a208.37,208.37,0,0,0,99.66,25.38h.09c114.94,0,208.51-93.56,208.55-208.55A207.29,207.29,0,0,0,357.83,61.16ZM210.31,382h-.07A173.08,173.08,0,0,1,122,357.87l-6.33-3.76L50.07,371.33l17.51-64-4.12-6.56A172.93,172.93,0,0,1,37,208.55C37,113,114.76,35.22,210.38,35.22A173.37,173.37,0,0,1,383.65,208.69C383.61,304.27,305.85,382,210.31,382Zm95.08-129.82c-5.21-2.61-30.83-15.21-35.61-17s-8.25-2.61-11.72,2.61-13.46,17-16.5,20.43-6.08,3.91-11.29,1.3-22-8.11-41.91-25.86c-15.49-13.82-25.95-30.88-29-36.1s-.32-8,2.28-10.63c2.34-2.34,5.21-6.09,7.82-9.13s3.47-5.22,5.21-8.69.87-6.52-.43-9.13-11.72-28.26-16.07-38.69c-4.23-10.16-8.53-8.78-11.72-8.95-3-.15-6.51-.18-10-.18a19.14,19.14,0,0,0-13.9,6.52c-4.78,5.22-18.24,17.83-18.24,43.47s18.67,50.43,21.28,53.91,36.75,56.11,89,78.69a299.33,299.33,0,0,0,29.71,11c12.48,4,23.84,3.41,32.82,2.07,10-1.5,30.83-12.61,35.17-24.78s4.34-22.61,3-24.78S310.6,254.82,305.39,252.21Z"/></g></g></g></svg>
            '.$instance[ 'social_landing_whatsapp_text' ].'
        </a>
    </div>';
    
        ob_end_flush();
    echo $after_widget;
  }

}

/* WIDGET INITS*/
function facilius_register_widgets() {
 
  register_widget( 'facilius_social_link_widget' );
  register_widget( 'facilius_image_link' );
  register_widget( 'social_landing_whatsapp_ctc' );

}
add_action( 'widgets_init', 'facilius_register_widgets' );


