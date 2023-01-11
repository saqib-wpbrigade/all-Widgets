<?php
/**
 * Plugin Name: Maricopa Functionality Plugin
 * Plugin URI: https://LANETERRALEVER.com
 * Description: CPT and other API functionalities
 * Version: 1.0.0
 * Author: LANETERRALEVER
 * Author URI: https://LANETERRALEVER.com
 * Text Domain: widgets
 *
 * @package 
 */

if ( ! defined( 'MARICOPA_PLUGIN_VERSION' ) ) {
	define( 'MARICOPA_PLUGIN_VERSION', '1.0.0' );
}

if ( ! defined( 'MARICOPA_PLUGIN_DIR' ) ) {
	define( 'MARICOPA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'MARICOPA_PLUGIN_INC_DIR' ) ) {
	define( 'MARICOPA_PLUGIN_INC_DIR', MARICOPA_PLUGIN_DIR . '/includes/' );
}

if ( ! defined( 'MARICOPA_PLUGIN_URL' ) ) {
	define( 'MARICOPA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

/**
 * Create object for Maricopa Functionality Plugin for calling the functionality files.
 *
 * @since 1.0.0
 */
class Maricopa_Functionality_Plugin {

	/**
	 * Constructor of the Class.
	 */
	public function __construct() {

		// // CTP definitions.
		include_once MARICOPA_PLUGIN_INC_DIR . 'elementor-widgets.php';
		// include_once MARICOPA_PLUGIN_INC_DIR . 'custom-post-types.php';
		// include_once MARICOPA_PLUGIN_DIR . '/featured-meta.php';
	}

}

// plugin init.
$maricopa_functionality_plugin = new Maricopa_Functionality_Plugin();
