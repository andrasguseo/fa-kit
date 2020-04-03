<?php
/**
 * Plugin Name:     Font Awesome Kit for Wordpress
 * Plugin URI:      https://www.divi-magazine.com
 * Description:     Easily add Font Awesome Kit code to WordPress. Nothing more, nothing less.
 * Version:         1.0
 * Author:          Andras Guseo | The Divi Magazine
 * Author URI:      https://www.divi-magazine.com
 * License:         GPL version 3 or any later version
 * License URI:     https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:     tdm-font-awesome-kit-for-wordpress
 *
 *     This plugin is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     any later version.
 *
 *     This plugin is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *     GNU General Public License for more details.
 */

namespace TDM\FA_Kit_For_Wp;

include ( 'classes/actionlinks.class.php' );
include ( 'classes/settings.class.php' );

if ( ! class_exists( 'Main::class' ) ) {
	/**
	 * Main Class
	 */
	class Main {

		/**
		 * Setup the plugin's properties.
		 */
		public function __construct() {

			// Load plugin textdomain
			load_plugin_textdomain( 'tdm-font-awesome-kit-for-wordpress', false, basename( dirname( __FILE__ ) ) . '/languages/' );

			// Add action links
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), [ ActionLinks::class, 'action_links' ] );
			add_filter( 'plugin_row_meta', [ ActionLinks::class, 'donate_button' ], 10, 2 );

			// Initialize plugin options
			//add_action( 'admin_init', [ Settings::class, 'initialize_plugin_options' ] );

			// Render plugin options page
			add_action( 'admin_menu', [ Settings::class, 'add_settings_page' ], 99 );

			// Add script to head
			//add_action( 'wp_head', [ $this, 'child_theme_head_script' ] );
			//add_action( 'admin_head', [ $this, 'child_theme_head_script' ] );

			// Uninstall
			//register_uninstall_hook( __FILE__, [ $this, 'uninstall_tdm_fakitforwp' ] );
			//register_activation_hook( __FILE__, [ $this, 'tdm_fakitforwp_activate' ] );
		}


	}
}

$fa_kit = new Main();