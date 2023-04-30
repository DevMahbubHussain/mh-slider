<?PHP
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

		public function activate():void
		{

			update_option('rewrite_rules');
		}

		public static function deactivate():void 
		{
			flush_rewrite_rules();
			unregister_post_type('mh-slider');
		}
		public static function unistall():void
		{

		}
	}
}


if(class_exists('MH_Slider')){

	register_activation_hook(__FILE__, array('MH_Slider','activate'));
	register_deactivation_hook(__FILE__, array('MH_Slider','deactivate'));
	register_uninstall_hook(__FILE__, array('MH_Slider','unistall'));
	$mv_slider = new MH_Slider();
}


