<?php
 //if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

if(!function_exists('nfpndx_save_title_and_description_metaboxes')){

	function nfpndx_save_title_and_description_metaboxes($nfpndx_current_post_id) {
		
		if(
		
			(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
			|| (defined('DOING_AJAX') && DOING_AJAX) 
			|| !current_user_can('edit_post', $nfpndx_current_post_id) 
			|| wp_is_post_revision($nfpndx_current_post_id) !== false
			
		) { 
		
			return;
			
		}

		if(
			
			!empty($_POST['nfpndx-title-tag-nonce']) 
			&& wp_verify_nonce($_POST['nfpndx-title-tag-nonce'], 'nfpndx-title-tag-nonce')
			
		) {
				
			if(!empty($_POST['nfpndx-title'])) {
						
				$nfpndx_title_meta_box = sanitize_text_field($_POST['nfpndx-title']);
				update_post_meta($nfpndx_current_post_id, '_nfpndx_meta_title', $nfpndx_title_meta_box);
				
			} else {
				
				delete_post_meta($nfpndx_current_post_id, '_nfpndx_meta_title');
				
			}
			
			if(!empty($_POST['nfpndx-title-blogname']) && $_POST['nfpndx-title-blogname'] === '1') {
			
				update_post_meta($nfpndx_current_post_id, '_nfpndx_meta_title_blogname', '1');
				
			} else {
				
				update_post_meta($nfpndx_current_post_id, '_nfpndx_meta_title_blogname', '0');
			}
			
		}	

		if(
		
			!empty($_POST['nfpndx-description-tag-nonce']) 
			&& wp_verify_nonce($_POST['nfpndx-description-tag-nonce'], 'nfpndx-description-tag-nonce')
			
		) {
		
			if(!empty($_POST['nfpndx-description'])) {
				
				$nfpndx_description_meta_box = sanitize_text_field($_POST['nfpndx-description']);
				update_post_meta($nfpndx_current_post_id, '_nfpndx_meta_description', $nfpndx_description_meta_box);
				
			} else {
				
				delete_post_meta($nfpndx_current_post_id, '_nfpndx_meta_description');
				
			}
		
		}		

	}


} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_save_title_and_description_metaboxes" already exists');
	
}