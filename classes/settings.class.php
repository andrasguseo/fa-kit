<?php

namespace TDM\FA_Kit_For_Wp;

class Settings {

	/**
	 * Adding the submenu page
	 */
	public function add_settings_page() {
		add_submenu_page(
			'options-general.php',                          // The menu where it appears
			'Font Awesome Kit',                             // The title to be displayed in the browser window for this page.
			'Font Awesome Kit',                             // The text to be displayed for this menu item
			'administrator',                                // Which type of users can see this menu item
			'tdm_fakitforwp',                               // The unique ID - that is, the slug - for this menu item
			Settings::render_options_page(),    // The name of the function to call when rendering this menu's page
		);
	}

	/**
	 * Rendering the options page
	 */
	public function render_options_page() {
		?>
        <!-- Create a header in the default WordPress 'wrap' container -->
        <div class="wrap">

            <!-- Add the icon to the page -->
            <div id="icon-themes" class="icon32"></div>
            <h2><?php esc_html_e( 'Font Awesome Kit for WordPress Options', 'tdm-font-awesome-kit-for-wordpress' ); ?></h2>
            <p><?php esc_html_e( 'version 1.0', 'tdm-font-awesome-kit-for-wordpress' ); ?></p>

            <!-- Make a call to the WordPress function for rendering errors when settings are saved. -->
			<?php settings_errors(); ?>

            <!-- Create the form that will be used to render our options -->
            <form method="post" action="options.php">
				<?php
				settings_fields( 'tdm_fakitforwp_options_group' );
				do_settings_sections( 'tdm_fakitforwp_options_page' );
				submit_button();
				?>
            </form>

            <p><?php printf( esc_html__( 'Please report any bugs to %s.', 'tdm-font-awesome-kit-for-wordpress' ), '<a href="mailto:andras@divi-magazine.com">andras@divi-magazine.com</a>' ); ?></p>
            <p><?php printf( esc_html__( 'If you would like to buy me a coffee, %sclick here%s. :-)', 'tdm-font-awesome-kit-for-wordpress' ), '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=N6CX32P44TMQJ" target="_blank">', '</a>' ); ?>
            </p>

        </div><!-- /.wrap -->
		<?php
	}

	/**
	 * Initializes the theme options page by registering the Sections, Fields, and Settings.
	 * This function is registered with the 'admin_init' hook.
	 */
	public function initialize_plugin_options() {

		// Check if the option exists. If not, add it.
		if ( false == get_option( 'tdm_fakitforwp_options' ) ) {
			add_option( 'tdm_fakitforwp_options' );
		}

		// Register a section
		add_settings_section(
			'fontawesome_settings_section',
			esc_html__( 'Instructions', 'tdm-font-awesome-kit-for-wordpress' ),
			Settings::section_description(),
			'tdm_fakitforwp_options_page'
		);

		add_settings_field(
			'fontawesome_kit_code',
			esc_html__( 'Font Awesome Kit Code', 'tdm-font-awesome-kit-for-wordpress' ),
			Settings::render_option(),
			'tdm_fakitforwp_options_page',
			'fontawesome_settings_section'
		);

		// Register the fields with WordPress
		register_setting(
			'tdm_fakitforwp_options_group',
			'tdm_fakitforwp_options',
			'validate_input'
		);

	}

	/**
	 * Provides a simple description for the General Options page.
	 *
	 * It is called from the 'tdm_fakitforwp_initialize_plugin_options' function by being passed as a parameter
	 * in the add_settings_section function.
	 */
	public function section_description() {
		$html  = '<p>' . esc_html__( 'Paste the Font Awesome Kit code in the below field.', 'tdm-font-awesome-kit-for-wordpress' ) . '</p>';
		$html .= '<p>' . esc_html__( 'Don\'t copy the full code, only copy the base of the file name, what you see in bold:', 'tdm-font-awesome-kit-for-wordpress' ) . ' <code>&lt;script src="https://kit.fontawesome.com/<strong>{uniquenum}</strong>.js"&gt;&lt;/script&gt;</code></p>';
		$html .= '<p>' . sprintf( esc_html__( 'Don\'t have a Font Awesome Kit yet? You can %screate one here%s.', 'tdm-font-awesome-kit-for-wordpress' ), '<a href="https://fontawesome.com/start" target="_blank">', '</a>' ) . ' ';
		$html .= sprintf( esc_html__( 'If you already have one, you can %sfind it here%s.', 'tdm-font-awesome-kit-for-wordpress' ), '<a href="https://fontawesome.com/kits" target="_blank">', '</a>' ) . '</p>';

		echo $html;
	}

	/**
	 * Renders the option
	 */
	function render_option() {
		$options = get_option( 'tdm_fakitforwp_options' );
		echo '<p>https://kit.fontawesome.com/<input type="text" id="fontawesome_kit_code" name="tdm_fakitforwp_options[fontawesome_kit_code]" value="' . ( $options != "" ? $options['fontawesome_kit_code'] : "" ) . '"  placeholder="' . esc_html__( 'Font Awesome Kit Code', 'tdm-font-awesome-kit-for-wordpress' ) . '" />.js</p>';

		if( ! empty( $options['fontawesome_kit_code'] ) ) {
			echo '<p><i class="fab fa-font-awesome-alt fa-2x" style="vertical-align: middle;"></i> &lt;-- ' . esc_html__( 'If you see the Font Awesome flag here, the code works.', 'tdm-font-awesome-kit-for-wordpress' ) . '</p>';
		}
	}


	/**
	 * Input validation
	 * @param $input
	 *
	 * @return mixed
	 */
	function validate_input( $input ) {
		// Create our array for storing the validated options
		$output = [];

		// Loop through each of the incoming options
		foreach ( $input as $key => $value ) {

			// Check to see if the current option has a value. If so, process it.
			if ( isset( $input[ $key ] ) ) {

				// Strip all HTML and PHP tags and properly handle quoted strings
				$output[ $key ] = strip_tags( stripslashes( $input[ $key ] ) );

			} // end if

		} // end foreach

		// Return the array processing any additional functions filtered by this action
		return apply_filters( 'validate_input', $output, $input );

	}

}