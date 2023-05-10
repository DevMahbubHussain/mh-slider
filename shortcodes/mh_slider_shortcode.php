<?php 

if(!class_exists('Mh_Slider_Shortcode')){
    class Mh_Slider_Shortcode{
        public function __construct(){
            add_shortcode('mh_slider', array($this, 'slider_shortcode'));
        }

        /**
         * Summary of slider_shortcode
         * @param mixed $atts
         * @param mixed $content
         * @param mixed $tag
         * @return void
         */
        public function slider_shortcode($atts = array(),$content = null,$tag = '' ){

           $atts = array_change_key_case((array)$atts, CASE_LOWER);
            extract(
               shortcode_atts(
                array('id'=>'','orderby'=>'date'),
                $atts,
                $tag
               ));

               if(!empty($id))
               {
                  $id = array_map('absint', explode(',', $id));
               }

            ob_start();
             require(MH_SLIDER_PATH . 'views/mh_slider_shortcode.php');
             wp_enqueue_script('mh-slider-min-js');
             //wp_enqueue_script('mh-slider-option-js');
             wp_enqueue_style('mh-slider-main-css');
             wp_enqueue_style('mh-slider-custom-css');
            mh_slider_options();
            return ob_get_clean();

        }
    }
}