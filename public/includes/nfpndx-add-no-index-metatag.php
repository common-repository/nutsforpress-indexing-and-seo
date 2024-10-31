<?php
 //if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

//get custom title tag
if(!function_exists('nfpndx_add_no_index_metatag')) {
	
	function nfpndx_add_no_index_metatag($nfpndx_post_meta_title) {

		//get options 
		global $nfproot_current_language_settings;

		//if no index is enabled
		if(

			!empty($nfproot_current_language_settings['nfpndx']['nfproot_no_index'])
			&& $nfproot_current_language_settings['nfpndx']['nfproot_no_index'] === '1'
								
		) {

			if(empty(get_the_ID()) || is_admin()) {
				
				return;
				
			}
			
			$nfpndx_current_post_id = get_the_ID();
			
			$nfpndx_no_index = esc_attr(get_post_meta($nfpndx_current_post_id, '_nfpndx_no_index', true));
			
			if($nfpndx_no_index === '1') {

				//if no index is set, display a noindex meta
				echo '<meta name="robots" content="noindex">'."\r\n";

			}
			
		}

	}
	
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_add_no_index_metatag" already exists');
	
}