<?php 

if(!class_exists('admin_menu'))
{
   class admin_menu{

    function __construct()
    {
            add_action('admin_menu', array($this, 'admin_menu'));
    }


    public function admin_menu()
    {
            // add_plugins_page(

            //     'MH Slider Options',
            //     'MH Slider',
            //     'manage_options',
            //     'mh_slider_admin',
            //     array($this,'mh_slider_settings_page'),
            // );


            add_menu_page(
                'MH Slider Options',
                'MH Slider',
                'manage_options',
                'mh_slider_admin',
                array($this,'mh_slider_settings_page'),
                'dashicons-format-image',
                30
                
            );
            add_submenu_page(
                'mh_slider_admin',
                'Manage Slides',
                'Manage Slides',
                'manage_options',
                'edit.php?post_type=mh-slider',
                null,
                null
            );


             add_submenu_page(
                'mh_slider_admin',
                'Add New Slides',
                'Add New Slides',
                'manage_options',
                'post-new.php?post_type=mh-slider',
                null,
              
            );


            // add_menu_page(

            //     'MH Slider Options',
            //     'MH Slider Settings',
            //     'manage_options',
            //     'mh_slider_admin',
            //     array($this,'mh_slider_settings_page'),
            // );
    }

    public function mh_slider_settings_page()
    {
       if( ! current_user_can( 'manage_options' ) ) return;

        if( isset( $_GET['settings-updated'] ) )
            add_settings_error( 'mh_slider_options', 'mh_slider_message', 'Settings Saved', 'success' );
   
        settings_errors( 'mh_slider_options' );

        require_once(MH_SLIDER_PATH .'views/settings-page.php');
    }

   }
}