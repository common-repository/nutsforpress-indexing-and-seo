<?php
 //if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

//get custom title tag
if(!function_exists('nfpndx_remove_scripts_and_styles')) {
	
	function nfpndx_remove_scripts_and_styles() {

		/*
		removed from plugin settings since WP 6.4
		the "remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles')" caused a total loss of the style
		
		//get options 
		global $nfproot_current_language_settings;

		//if remove script and styles is enabled
		if(

			!empty($nfproot_current_language_settings['nfpndx']['nfproot_remove_scripts_and_styles'])
			&& $nfproot_current_language_settings['nfpndx']['nfproot_remove_scripts_and_styles'] === '1'
								
		) {

			if(is_admin()) {
				
				//remove emoji
				remove_action('admin_print_scripts', 'print_emoji_detection_script');
				remove_action('admin_print_styles', 'print_emoji_styles');
				//remove block style
				remove_action('admin_enqueue_scripts', 'wp_common_block_scripts_and_styles');
				
			} else {
			
				//remove emoji
				remove_action('wp_head', 'print_emoji_detection_script', 7);
				remove_action('wp_print_styles', 'print_emoji_styles');
				//remve global style
				remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
				remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
				//remove block style
				remove_action('wp_enqueue_scripts', 'wp_common_block_scripts_and_styles');
				
			}
			
		}
		*/

	}
	
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_remove_scripts_and_styles" already exists');
	
}