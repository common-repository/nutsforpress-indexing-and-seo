<?php
 //if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

if(!function_exists('nfpndx_set_attachment_meta')) {

	//auto set attachment meta
	function nfpndx_set_attachment_meta($nfpndx_current_attachment_id) {

		//get options 
		global $nfproot_current_language_settings;

		if(

			!empty($nfproot_current_language_settings['nfpndx']['nfproot_automatic_meta'])
			&& $nfproot_current_language_settings['nfpndx']['nfproot_automatic_meta'] === '1'			
					
		) {
			
			//get post title
			$ptnns_attachment_title = get_post_field('post_title', $nfpndx_current_attachment_id);
			
			//clean post title
			$ptnns_attachment_title_cleaned = str_replace(array('-','_'), ' ', $ptnns_attachment_title);
			
			//set alt title
			update_post_meta($nfpndx_current_attachment_id,'_wp_attachment_image_alt', $ptnns_attachment_title_cleaned);
			
			//set excerpt, content and update title
			wp_update_post(
			
				array(
				
					'ID' => $nfpndx_current_attachment_id, 
					'post_title' => $ptnns_attachment_title_cleaned, 
					'post_excerpt' => $ptnns_attachment_title_cleaned, 
					'post_content' => $ptnns_attachment_title_cleaned
					
				)
				
			);
				
		}
			
	} 
	
	add_action('add_attachment', 'nfpndx_set_attachment_meta');	

} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_set_attachment_meta" already exists');

}