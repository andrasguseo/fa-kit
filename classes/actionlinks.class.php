<?php

namespace TDM\FA_Kit_For_Wp;

class ActionLinks {

	/**
	 * Generates the 'Settings' link on the plugins page
	 *
	 * @param $links
	 *
	 * @return array
	 */
	public function action_links( $links ) {
		$links[] = '<a href="' . esc_url( get_admin_url( null, 'admin.php?page=tdm_fakitforwp' ) ) . '">' . esc_html__( 'Settings', 'tdm-font-awesome-kit-for-wordpress' ) . '</a>';

		return $links;
	}

	/**
	 * Generates the donation link for the plugin
	 *
	 * @param $links
	 * @param $file
	 *
	 * @return array
	 */
	public function donate_button( $links, $file ) {
		if ( strpos( $file, 'fa-kit.php' ) !== false ) {
			$new_links[] = '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=N6CX32P44TMQJ" target="_blank">
					<i class="fa fa-coffee"></i> ' . esc_html__( 'Invite me for a coffee :)', 'tdm-font-awesome-kit-for-wordpress' ) . '</a>';
			$links     = array_merge( $links, $new_links );
		}

		return $links;
	}

}