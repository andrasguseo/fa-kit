<?php

namespace TDM\FA_Kit_For_Wp;

	/**
	 * Hooks Class
	 */
	class Hooks {

		public function setup_languages() {
			// Load plugin textdomain
			load_plugin_textdomain( 'tdm-font-awesome-kit-for-wordpress', false, basename( dirname( __FILE__ ) ) . '/languages/' );
		}

		public function add_filters() {
			// Add action links
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), [ ActionLinks::class, 'action_links' ] );
			add_filter( 'plugin_row_meta', [ ActionLinks::class, 'donate_button' ], 10, 2 );
		}

		public function add_actions() {

			// Initialize plugin options - comes later
			//add_action( 'admin_init', [ Settings::class, 'initialize_plugin_options' ] );

			// Render plugin options page
			add_action( 'admin_menu', [ Settings::class, 'add_settings_page' ], 99 );

			// Add script to head - comes later
			//add_action( 'wp_head', [ $this, 'child_theme_head_script' ] );
			//add_action( 'admin_head', [ $this, 'child_theme_head_script' ] );
		}

		public function add_uninstall_hooks() {

			// Uninstall
			//register_uninstall_hook( __FILE__, [ $this, 'uninstall_tdm_fakitforwp' ] );
			//register_activation_hook( __FILE__, [ $this, 'tdm_fakitforwp_activate' ] );
		}

	}