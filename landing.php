<?php
global $options;
 ?>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ) . 'css/sociallanding.css'  ?>">  
    <?php
    $sl_headercode = get_option( 'social_landing_header_code' );
    echo stripcslashes($sl_headercode);
    $sl_metadescription = get_option( 'social_landing_meta_description' );
    if(get_option( 'social_landing_page_title' ) != ''){
      $sl_titulo= get_option( 'social_landing_page_title' );
    }
    else{
      $sl_titulo = get_bloginfo('name'); 
    }
     ?>


    <meta name="description" content="<?php echo $sl_metadescription; ?>"/>
    <title><?php echo $sl_titulo; ?> </title>
    
    <?php print_emoji_detection_script(); ?>
    <?php //Background stuff
    $sl_background_color = esc_attr(get_option( 'social_landing_background_color' ));
    $sl_background_gradient = esc_attr(get_option( 'social_landing_background_gradient' ));
    $sl_background_gradient_two = esc_attr(get_option( 'social_landing_background_gradient_two' ));
    $sl_background_image = esc_attr(get_option( 'social_landing_background_image' ));
    $sl_background_animation = esc_attr(get_option( 'social_landing_background_animation' ));
    
    $sl_profile_image = esc_attr(get_option( 'social_landing_profile_image' ));

    $sl_background_constructor = '';
    

    //fondo
    if($sl_background_image){
      $sl_background_constructor = 'url('.$sl_background_image.') center center no-repeat';

    }
    if($sl_background_color && $sl_background_image){
      $sl_background_constructor = $sl_background_color.' url('.$sl_background_image.') center center no-repeat';
    }
    else{
      if($sl_background_color){
        $sl_background_constructor = $sl_background_color;
      }
      if($sl_background_gradient && $sl_background_color){
        $sl_background_constructor = 'linear-gradient(25deg,'.$sl_background_color.','.$sl_background_gradient.')';
      }
      if($sl_background_gradient && $sl_background_gradient_two && $sl_background_color){
        $sl_background_constructor = 'linear-gradient(25deg,'.$sl_background_color.','.$sl_background_gradient.','.$sl_background_gradient_two.')';
      }
    }

    //Buttons stuff 
    $sl_button_color  = esc_attr(get_option( 'social_landing_button_color' ));
    $sl_button_hover  = esc_attr(get_option( 'social_landing_button_hover' ));
    $sl_button_border = esc_attr(get_option( 'social_landing_button_border' ));
    $sl_button_transparency = esc_attr(get_option( 'social_landing_button_transparency' ));
    

    $sl_font_color = esc_attr(get_option( 'social_landing_font_color' ));

    echo '<!--color:'.$sl_background_color.' ,gradient: '.$sl_background_gradient.', two:'.$sl_background_gradient_two.', checked:'.$sl_background_animation.',transparency:'.$sl_button_transparency.' -->';
     ?>
     <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    
    <style>
      body#social_landing{
        background: <?php echo $sl_background_constructor; ?>;
        background-size:cover;
        font-family: 'Nunito', sans-serif;
        <?php
        if($sl_background_animation == 1){
          echo '
          -webkit-animation: background-effect 7s ease infinite;
          -moz-animation: background-effect 7s ease infinite;
          -ms-animation: background-effect 7s ease infinite;
          -o-animation: background-effect 7s ease infinite;
          animation: background-effect 7s ease infinite;
          background-size: 400% 400%;
          ';
        }
        if($sl_font_color){
          echo 'color: '.$sl_font_color.' ; ';
        } 
        
        ?>
        }  
        a,h1,.widget_facilius_social_links a, header h1{
          <?php
          if($sl_font_color){
          echo 'color: '.$sl_font_color.' ; ';
          }
           ?>
        }
        .widget_facilius_social_links a{
          <?php
          if($sl_button_color){
          echo 'background: '.$sl_button_color.' ; ';
          }
          if($sl_button_border){
            echo 'border: 2px solid '.$sl_button_border.' ; ';
          }

          if($sl_button_color && $sl_button_transparency == 1 ){
            $sl_hex_color = hex2RGB($sl_button_color, true);
            echo 'background: rgba('.$sl_hex_color.',0.7) ; ';
          }
           ?>
        }
        
    </style>
     <?php   ?>
</head>
<body id="social_landing">


<header>
<div id="slprofilepic">
  <img src="<?php echo $sl_profile_image; ?>">
</div>


</header>
<section id="widgetzone">
  <div>
    <?php dynamic_sidebar( 'social-landing-sidebar' ); ?> 
  </div>

</section>
<section>
<?php
// add the below to your functions file
// then visit the page that you want to see 
// the enqueued scripts and stylesheets for
/*function se_inspect_styles() {
    global $wp_styles;
    //echo "<h2>Enqueued CSS Stylesheets</h2><ul>";
    foreach( $wp_styles->queue as $handle ) :
      $obj = $wp_styles->registered[$handle];
      //echo "<li>" . $handle . "- url:  ".get_site_url().$obj->src."</li>";
      echo "<link rel='stylesheet' id='dashicons-css'  href='".get_site_url().$obj->src."' type='text/css' media='all' />";
    endforeach;
   // echo "</ul>";
}

function se_inspect_scripts() {
    global $wp_scripts;
   // echo "<h2>Enqueued JS Scripts</h2><ul>";
    foreach( $wp_scripts->queue as $handle ) :
        $obj = $wp_scripts->registered[$handle];
       // echo "<li>" . $handle . "- url:  ".get_site_url().$obj->src."</li>";
        echo "<script type='text/javascript' src='".get_site_url().$obj->src."'></script>";
    endforeach;
    //echo "</ul>";
}
 se_inspect_styles(); */?>

<?php /*se_inspect_scripts();*/?>

</section>

</body></html>