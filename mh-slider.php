<?PHP
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
/**
 * @package MhSlider
 */
/*
Plugin Name: Mahbub Slider
Plugin URI: https://wordpress.org/mh-slider
Description: this is Simple Slider Plugin
Version: 1.0
Requires at least: 5.5
Requires PHP: 7.00
Author: Mahbub Hussain
Author URI: https://mahbub.com/wordpress-plugins/
License: GPLv2 or later
Text Domain: mh-slider
Domain Path :/language
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2023 Mahbub Hussain.
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(E_ALL);

if(!class_exists('MH_Slider')){
	/**
	 * Summary of MH_Slider
	 */
	class MH_Slider{
		/**
		 * Summary of __construct
		 */
		function __construct(){
			$this->define_constants();

			// calling cpt class 
			require_once(MH_SLIDER_PATH . 'post-types/classess/mh_slider_cpt.php');
			$MH_Slider = new mh_slider_cpt();

			//metabox class call 
			require_once(MH_SLIDER_PATH . 'metaboxes/classes/mh_slider_cpt_metaboxex.php');
			$mh_Metabox = new mh_slider_cpt_metaboxex();

			//admin menu pages class call
			require_once(MH_SLIDER_PATH .'admin/classess/admin_menu.php');
			$mh_slider_settings = new admin_menu();
           
			//Settings API call
			require_once(MH_SLIDER_PATH . 'admin/classess/slider_settings.php');
			$mh_settings_api = new MH_slider_settings();

			//shortcode API Call
			require_once(MH_SLIDER_PATH . '/shortcodes/mh_slider_shortcode.php');
			$mh_Slider_Sh = new Mh_Slider_Shortcode(); 

			// enquee esential assets css + js for front end
			add_action('wp_enqueue_scripts',array($this,'register_script'),999);

			// admin enquee esential assets css + js for front end
			add_action('admin_enqueue_scripts',array($this,'admin_register_scripts'));

			require_once(MH_SLIDER_PATH . './functions/functions.php');


		}

		/**
		 * Summary of define_constants
		 * @return void
		 */
		public function define_constants():void
		{
			define('MH_SLIDER_PATH', plugin_dir_path(__FILE__));
			define('MH_SLIDER_URL', plugin_dir_url(__FILE__));
			define('MH_SLIDER_VERSION', '1.00');

		}

		 public function load_textdomain()
		{
			load_plugin_textdomain(
				'mh-slider',
				false,
				dirname(plugin_basename(__FILE__)).'/languages/'
			);
		}
		
		public function register_script():void
		{
			wp_register_script('mh-slider-min-js', MH_SLIDER_URL . './vendor/flexslider/jquery.flexslider-min.js', array('jquery'), MH_SLIDER_VERSION, true);
			wp_register_style('mh-slider-main-css', MH_SLIDER_URL .'./vendor/flexslider/flexslider.css',array(),MH_SLIDER_VERSION,'all');
			wp_register_style('mh-slider-custom-css', MH_SLIDER_URL .'./assets/css/custom.css',array(),MH_SLIDER_VERSION,'all');
		}
		public function admin_register_scripts():void
		{
			global $typenow;
			if($typenow == 'mh-slider'){
              wp_enqueue_style('mh-slider-admin-css', MH_SLIDER_URL .'./assets/css/admin.css',array(),MH_SLIDER_VERSION,'all');
			}
			
		}

		public static function activate():void
		{
			update_option('rewrite_rules','');
		}

		public static function deactivate():void 
		{
			flush_rewrite_rules();
			unregister_post_type('mh-slider');
		}
		// public static function unistall():void
		// {
		// 	 delete_option( 'mh_slider_options' );

        //     $posts = get_posts(
        //         array(
        //             'post_type' => 'mh-slider',
        //             'number_posts'  => -1,
        //             'post_status'   => 'any'
        //         )
        //     );

        //     foreach( $posts as $post ){
        //         wp_delete_post( $post->ID, true );
        //     }

		// }
	}
}


if(class_exists('MH_Slider')){
	register_activation_hook(__FILE__, array('MH_Slider','activate'));
	register_deactivation_hook(__FILE__, array('MH_Slider','deactivate'));
	//register_uninstall_hook(__FILE__, array('MH_Slider','unistall'));
	$mv_slider = new MH_Slider();
}


