<?php
 //if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

//WPML integration: copy original meta to duplicates
if(!function_exists('nfpndx_wpml_attachment_duplicate')){

	function nfpndx_wpml_attachment_duplicate($nfpndx_original_image_id, $nfpndx_duplicated_image_id) {
				
		global $nfpndx_current_language_settings;
				
		//check if nfproot_automatic_meta is enabled
		if(

			!empty($nfpndx_current_language_settings['nfproot_automatic_meta']) 
			&& $nfpndx_current_language_settings['nfproot_automatic_meta'] === '1'			
					
		) {
			
			//duplicate _wp_attachment_image_alt post meta
			$nfpndx_original_attachment_image_alt_meta = get_post_meta($nfpndx_original_image_id, '_wp_attachment_image_alt', true);

			if(!empty($nfpndx_original_attachment_image_alt_meta)) {
				
				update_post_meta($nfpndx_duplicated_image_id, '_wp_attachment_image_alt', $nfpndx_original_attachment_image_alt_meta);
				
				if(NFPNDX_DEBUG === true) {error_log('NUTSFORPRESS: _wp_attachment_image_alt post meta had been replicated for post id '.$nfpndx_duplicated_image_id);}

			}	
			
			//get original post title, content and excerpt
			$nfpndx_original_attachment_title = get_the_title($nfpndx_original_image_id);
			$nfpndx_original_attachment_content = get_the_content($nfpndx_original_image_id);
			$nfpndx_original_attachment_excerpt = get_the_excerpt($nfpndx_original_image_id);
			
			//duplicate post title, content and excerpt
			if(
			
				!empty($nfpndx_original_attachment_title)
				&& !empty($nfpndx_original_attachment_content)
				&& !empty($nfpndx_original_attachment_excerpt)
				
			) {

				wp_update_post(
				
					array(
					
						'ID' => $nfpndx_duplicated_image_id, 
						'post_title' => $nfpndx_original_attachment_title, 
						'post_excerpt' => $nfpndx_original_attachment_content, 
						'post_content' => $nfpndx_original_attachment_excerpt
						
					)
					
				);			
				
			}		
		
		
		}

	}

} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_wpml_attachment_duplicate" already exists');
	
}