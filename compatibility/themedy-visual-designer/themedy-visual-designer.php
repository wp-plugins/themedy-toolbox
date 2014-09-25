<?php
/*
Based on Themedy VD Version: 1.2.5
*/

class Themedy_Shortcode_Generator {

/*----------------------------------------------------------
  Class Constructor

  * Constructor function. Sets up the class and registers variable action hooks.
----------------------------------------------------------*/

	function Themedy_Shortcode_Generator () {

		// wp_ajax_... is only run for logged users.
		add_action( 'wp_ajax_themedy_check_url_action', array( &$this, 'ajax_action_check_url' ) );

	} // End Themedy_Shortcode_Generator()

/*----------------------------------------------------------
  Utility Functions

  * Helper functions for this class.
----------------------------------------------------------*/

	/**
	 * Returns the full URL of this plugin including trailing slash.
	 */
	function plugin_url() {

		return WP_PLUGIN_URL . '/' . str_replace( basename( __FILE__ ), "", plugin_basename( __FILE__ ) );
	}

	/**
	 * Returns the directory url of plugin
	 */
	function plugin_dir_url( $file ) {
    	return trailingslashit( plugins_url( '', $file ) );
	}

/*----------------------------------------------------------
  ajax_action_check_url()

  * Checks if a given url (via GET or POST) exists.
  * Returns JSON.
  *
  * NOTE: For users that are not logged in this is not called.
  * The client recieves <code>-1</code> in that case.
----------------------------------------------------------*/

function ajax_action_check_url() {

	$hadError = true;

	$url = isset( $_REQUEST['url'] ) ? $_REQUEST['url'] : '';

	if ( strlen( $url ) > 0  && function_exists( 'get_headers' ) ) {

		$file_headers = @get_headers( $url );
		$exists       = $file_headers && $file_headers[0] != 'HTTP/1.1 404 Not Found';
		$hadError     = false;
	}

	echo '{ "exists": '. ($exists ? '1' : '0') . ($hadError ? ', "error" : 1 ' : '') . ' }';

	die();

} // End ajax_action_check_url()

} // End Class

/*----------------------------------------------------------
  INSTANTIATE CLASS
----------------------------------------------------------*/

$themedy_shortcode_generator = new Themedy_Shortcode_Generator();

include(dirname( __FILE__ ) . '/shortcode-generator.php');