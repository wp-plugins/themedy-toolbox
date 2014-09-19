<?php
/*
Plugin Name: Themedy Toolbox
Plugin URI: http://themedy.com
Description: Shortcodes to extend your Themedy site even further.
Version: 1.0
Author: Themedy
Author URI: http://themedy.com
*/
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/* Variables */
$ja_themedy_shortcodes_path = dirname(__FILE__);
$ja_themedy_shortcodes_main_file = dirname(__FILE__).'/themedy-shortcodes.php';
$ja_themedy_shortcodes_directory = plugin_dir_url($ja_themedy_shortcodes_main_file);
$ja_themedy_shortcodes_name = "themedy Shortcodes";

/* Add shortcodes scripts file */
function themedy_shortcodes_add_scripts() {

	global $ja_themedy_shortcodes_directory, $ja_themedy_shortcodes_path;

	if(!is_admin()) {
		
		/* Includes */
		include($ja_themedy_shortcodes_path.'/includes/shortcodes.php');

		wp_enqueue_style('themedy_shortcodes', $ja_themedy_shortcodes_directory.'/includes/shortcodes.css');
		
		wp_enqueue_script('jquery');
		wp_register_script('themedy_shortcodes_js', $ja_themedy_shortcodes_directory.'/includes/shortcodes.js', 'jquery');
		wp_enqueue_script('themedy_shortcodes_js');
		
	} else {
		
		wp_enqueue_style( 'wp-color-picker' );
	    wp_enqueue_script( 'wp-color-picker' );
	    		
	}
	
	/* Font Awesome */
	wp_enqueue_style('themedy_shortcodes_fontawesome', $ja_themedy_shortcodes_directory.'/fonts/fontawesome/css/font-awesome.min.css');
	wp_enqueue_style('themedy_shortcodes_fontello', $ja_themedy_shortcodes_directory.'/fonts/fontello/css/fontello.css');
	
}
add_filter('init', 'themedy_shortcodes_add_scripts');

/* Add button to TinyMCE */
function themedy_shortcodes_addbuttons() {

   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
 
   if ( get_user_option('rich_editing') == 'true') {
     add_filter("mce_external_plugins", "add_themedy_shortcodes_tinymce_plugin");
     add_filter('mce_buttons', 'register_themedy_shortcodes_button');
   }
}
 
function register_themedy_shortcodes_button($buttons) {
   array_push($buttons, "|", "themedy_shortcodes_button");
   return $buttons;
}
 
function add_themedy_shortcodes_tinymce_plugin($plugin_array) {
	global $ja_themedy_shortcodes_directory;
	$plugin_array['themedy_shortcodes'] = $ja_themedy_shortcodes_directory.'includes/tinymce_button.js';
	return $plugin_array;
}
 
add_action('init', 'themedy_shortcodes_addbuttons');