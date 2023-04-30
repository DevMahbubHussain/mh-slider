<?php 

if(!class_exists('mh_slider_cpt')){
   
    class mh_slider_cpt{

        function __construct()
        {

            add_action('init', array($this, 'create_post_type'));
            //add_action('add_meta_boxes', array($this, 'mh_slider_metaboxes'));
        }

         public function create_post_type():void
        {
            register_post_type('mh-slider', array(

                'labels'  => array(
                'name'    => __('MH Sliders', 'mh-slider'),
                'singular_name' => __('MH Sliders', 'mh-slider'),
                ),
                'public'      => true,
				'has_archive' => true,
               'rewrite'     => array( 'slug' => 'sliders' ), // my custom slug
               'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
               'hierarchical'       => false,
               'capability_type'    => 'post',
               'query_var'          => true,
               'show_in_menu'       => true,
               'show_ui'            => true,
               'publicly_queryable' => true,
               'menu_position'      => 5,
               'show_in_admin_bar'  => true,
               'show_in_nav_menus'  =>true,
               'show_in_rest'       => true,
               'can_export'         =>true,
               'menu_icon'          =>'dashicons-format-image'
  

            ));
            
        }

        // public function mh_slider_metaboxes():void
        // {
        //     //add_meta_box($id, $title, $callback, $screen, $context, $priority, $callback_args)

        //     add_meta_box(
        //         'mh_metaboxes',
        //         'MH Slider Link',
        //         array($this,'add_iner_metabox_func'),
        //         'mh-slider',
        //         'normal',
        //         'high',

        //     );
        // }

        // public function add_iner_metabox_func($post)
        // {
            
        // }
    }

}