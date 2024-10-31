<?php
 //if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

//get custom title tag
if(!function_exists('nfpndx_remove_wp_sitemap')) {
	
	function nfpndx_remove_wp_sitemap() {

		//get options 
		global $nfproot_current_language_settings;

		//if sitemap is enabled
		if(

			!empty($nfproot_current_language_settings['nfpndx']['nfproot_replace_sitemap'])
			&& $nfproot_current_language_settings['nfpndx']['nfproot_replace_sitemap'] === '1'
								
		) {

			if(is_admin()) {
				
				return;
				
			}
			
			//remove WP sitemap
			add_filter('wp_sitemaps_enabled', '__return_false');		
			
		}

	}
	
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_remove_wp_sitemap" already exists');
	
}