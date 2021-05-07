<?php
/*
Plugin Name: Brain Addons for Divi
Plugin URI:  https://brainaddons.com/
Description: <a href="https://brainaddons.com/">BrainAddons</a> is a library of unique and powerfull modules that works seamlessly with Divi. <a href="https://brainaddons.com/">BrainAddons</a> is free, and comes with great support.
Version:     2.0.0
Author:      BrainAddons
Author URI:  https://brainaddons.com/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: brain-divi-addons
Domain Path: /languages

@package Brain_Addons
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

Copyright 2021 BrainAddons <https://brainaddons.com>
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BRAIN_ADDONS_DEV_MODE', $_SERVER['REMOTE_ADDR'] == '127.0.0.1' );
define( 'BRAIN_ADDONS_PLUGIN_VERSION', '2.0.0' );
define( 'BRAIN_ADDONS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'BRAIN_ADDONS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'BRAIN_ADDONS_PLUGIN_ASSETS', trailingslashit( BRAIN_ADDONS_PLUGIN_URL . 'assets' ) );
define( 'BRAIN_ADDONS_PLUGIN_FILE', __FILE__ );
define( 'BRAIN_ADDONS_PLUGIN_BASE', plugin_basename( __FILE__ ) );

do_action( 'brainaddons_loaded' );

if ( ! class_exists( 'BRAIN_ADDONS_PLUGIN' ) ) :
	
	final class BRAIN_ADDONS_PLUGIN {

		private static $instance;

		private function __construct() {
			register_activation_hook( __FILE__, array( $this, 'activate' ) );
			add_action( 'plugins_loaded', array( $this, 'init_plugin' ) );
		}

		public static function instance() {

			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof BRAIN_ADDONS_PLUGIN ) ) {
				self::$instance = new BRAIN_ADDONS_PLUGIN();
				self::$instance->init();
				self::$instance->includes();
			}

			return self::$instance;
		}

		private function init() {
			add_action( 'divi_extensions_init', array( $this, 'initialize_extension' ) );
		}

		public function init_plugin() {

			if ( is_admin() ) {
				new Brain_Addons_Divi\Includes\Admin();
			} else {
				new Brain_Addons_Divi\Includes\AssetsManager();
			}

			if ( is_admin() ) {
				$this->initFeedback();
			}

		}

		public function activate() {
			update_option( 'ba_version', BRAIN_ADDONS_PLUGIN_VERSION );

			$inactive_extensions = get_option( 'ba_inactive_extensions', array() );
			if ( ! in_array( 'login-designer', $inactive_extensions, true ) ) {
				$installer = new BrainAddons\Ext\LoginDesigner\Installer();
				$installer->run();
			}
		}

		private function includes() {
			
			require_once BRAIN_ADDONS_PLUGIN_DIR . '/freemius.php';

			if ( is_admin() ) {
				require_once BRAIN_ADDONS_PLUGIN_DIR . 'includes/admin.php';
				require_once BRAIN_ADDONS_PLUGIN_DIR . 'includes/admin/feedback.php';
			}
			require_once BRAIN_ADDONS_PLUGIN_DIR . 'includes/customizer/customizer.php';
			require_once BRAIN_ADDONS_PLUGIN_DIR . 'includes/extensions/extensions.php';
			require_once BRAIN_ADDONS_PLUGIN_DIR . 'includes/admin/static-icons.php';
			require_once BRAIN_ADDONS_PLUGIN_DIR . 'includes/assets-manager.php';
			require_once BRAIN_ADDONS_PLUGIN_DIR . 'includes/functions.php';
			require_once BRAIN_ADDONS_PLUGIN_DIR . 'includes/functions-forms.php';
		}

		public function initialize_extension() {
			require_once BRAIN_ADDONS_PLUGIN_DIR . 'includes/divi-extension.php';
		}

		private function initFeedback() {

			$feedback = true;
	
			if ( $feedback ) {
				new BrainAddons_Admin_Feedback();
			}
		}

	}
endif;

function ba_init_plugin() {
	return BRAIN_ADDONS_PLUGIN::instance();
}

ba_init_plugin();
