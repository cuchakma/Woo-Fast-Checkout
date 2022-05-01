<?php

/**
 * Plugin Name: Woo Fast Checkout
 * Plugin URI:  www.facebook.com
 * Description: One Click Add To Checkout
 * Version:     1.0.0
 * Author:      Cupid Chakma
 * Author URI:  www.facebook.com
 * Text Domain: wfc
 * Domain Path: /languages
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package     PluginName
 * @author      Author Name
 * @copyright   Year Company
 * @license     GPL-2.0+
 */

final class WooFastCheckout {

	public static $instance = null;
	public function __construct() {
		$this->setup_wfc_enviroment();
		$this->includes();
	}

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function setup_wfc_enviroment() {
		$this->define( 'WFC_VERSION', '1.0.0' );
		$this->define( 'WFC_FILE_PATH', __FILE__ );
		$this->define( 'PLUGIN_WOO_DIR', plugin_dir_path( __DIR__ ) . 'woocommerce' );
		$this->define( 'WFC_BASE_FILE_NAME', plugin_basename( WFC_FILE_PATH ) );
		$this->define( 'WFC_BASE_FILE_PATH', dirname( WFC_BASE_FILE_NAME ) );
		$this->define( 'WFC_PLUGIN_DIR', plugin_dir_path( WFC_FILE_PATH ) );
		$this->define( 'WFC_PLUGIN_URL', plugin_dir_url( WFC_FILE_PATH ) );
		$this->define( 'WFC_INCLUDES_DIR', WFC_PLUGIN_DIR . 'includes' );
		$this->define( 'WFC_TEMPLATES', WFC_PLUGIN_DIR . 'templates/' );
		$this->define( 'WFC_ASSETS_DIR', WFC_PLUGIN_DIR . 'assets' );
		$this->define( 'WFC_ASSETS_URL', WFC_PLUGIN_URL . 'assets' );
	}

	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin':
				return is_admin();
			case 'ajax':
				return defined( 'DOING_AJAX' );
			case 'cron':
				return defined( 'DOING_CRON' );
			case 'frontend':
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}
	}

	public function includes() {
		//load wps default functions
		require WFC_INCLUDES_DIR . '/wfc-functions.php';

		//load wpc includes files
		if ( $this->is_request( 'frontend' ) ) {
			require WFC_INCLUDES_DIR . '/class-wfc-assets.php';
			require WFC_INCLUDES_DIR . '/class-wfc-front-templates.php';
			require WFC_INCLUDES_DIR . '/class-wfc-ajax.php';
		}
	}

	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}
}

function woo_fast_checkout() {
	return WooFastCheckout::instance();
}

add_action( 'plugin_loaded', 'woo_fast_checkout' );
