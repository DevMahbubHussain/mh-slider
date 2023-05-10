<?php 

if(!function_exists('mh_slider_options')){
      function mh_slider_options(){
         $show_bullets = isset( MH_slider_settings::$options["'mh_slider_bullest'"] ) && MH_slider_settings::$options["'mh_slider_bullest'"] == 1 ? true : false;

       // var_dump($show_bullets);

         wp_enqueue_script('mh-slider-option-js', MH_SLIDER_URL . './vendor/flexslider/plugin-activate.js', array('jquery'), MH_SLIDER_VERSION, true);

        wp_localize_script('mh-slider-option-js', 'SLIDER_OPTIONS', array(
            'controlNav'=>$show_bullets
        ));
      }
}

if( ! function_exists( 'mh_slider_get_placeholder_image' )){
    function mv_slider_get_placeholder_image(){
        return "<img src='" . MH_SLIDER_URL . "assets/images/default.jpg' class='img-fluid wp-post-image' />";
    }
}