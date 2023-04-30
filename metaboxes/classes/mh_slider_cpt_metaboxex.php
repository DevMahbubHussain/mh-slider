<?php
 if(!class_exists('mh_slider_cpt_metaboxex')){
    /**
     * Summary of mh_slider_cpt_metaboxex
     */
    class mh_slider_cpt_metaboxex{
        function __construct()
        {
            add_action('add_meta_boxes', array($this, 'mh_slider_metaboxes'));
            add_action( 'save_post', array($this,'save_meta_post'),10,2);
        }

        /**
         * Summary of mh_slider_metaboxes
         * @return void
         */
        public function mh_slider_metaboxes():void
        {
            //add_meta_box($id, $title, $callback, $screen, $context, $priority, $callback_args)

            add_meta_box(
                'mh_metaboxes',
                'MH Slider Link',
               array($this,'add_iner_metabox_func'),
                'mh-slider',
                'normal',
                'high',

            );
        }
      
        /**
         * Add html input filed
         * @param mixed $post
         * @return void
         */
        public function add_iner_metabox_func($post):void
        {
            //require_once(MH_SLIDER_PATH . '../../views/mh_slider_metabox_field.php');
            require_once(MH_SLIDER_PATH . 'views/mh_slider_metabox_field.php');
        }

        public function save_meta_post($post_id)
        {
            if(isset($_POST['action']) && isset($_POST['action'])=='edit')
            {
                $old_link_text = get_post_meta($post_id, 'mv_slider_link_text', true);
                $new_link_text = sanitize_text_field($_POST['mv_slider_link_text']);

                $old_link_url = get_post_meta($post_id, 'mv_slider_link_url', true);
                $new_link_url = sanitize_url($_POST['mv_slider_link_url'], true);


                if(empty($new_link_text)){
                   update_post_meta($post_id, 'mv_slider_link_text', "Add Some Text");
                }
                else{
                 update_post_meta($post_id, 'mv_slider_link_text', $new_link_text, $old_link_text);
                }

                if(empty($new_link_url)){
                  update_post_meta($post_id, 'mv_slider_link_url', '#');
                }
                else{
                    update_post_meta($post_id, 'mv_slider_link_url', $new_link_url,  $old_link_url);
                }

                // update_post_meta($post_id, 'mv_slider_link_text', $new_link_text, $old_link_text);
                // update_post_meta($post_id, 'mv_slider_link_url', $new_link_url,  $old_link_url);
               
               
                
            }
        }

        // public function save_post( $post_id ){
        //     if( isset( $_POST['action'] ) && $_POST['action'] == 'editpost' ){
        //         $old_link_text = get_post_meta( $post_id, 'mv_slider_link_text', true );
        //         $new_link_text = $_POST['mv_slider_link_text'];
        //         $old_link_url = get_post_meta( $post_id, 'mv_slider_link_url', true );
        //         $new_link_url = $_POST['mv_slider_link_url'];

        //         if( empty( $new_link_text )){
        //             update_post_meta( $post_id, 'mv_slider_link_text', 'Add some text' );
        //         }else{
        //             update_post_meta( $post_id, 'mv_slider_link_text', sanitize_text_field( $new_link_text ), $old_link_text );
        //         }

        //         if( empty( $new_link_url )){
        //             update_post_meta( $post_id, 'mv_slider_link_url', '#' );
        //         }else{
        //             update_post_meta( $post_id, 'mv_slider_link_url', sanitize_text_field( $new_link_url ), $old_link_url );
        //         }
                
                
        //     }
        // }
    }
 }