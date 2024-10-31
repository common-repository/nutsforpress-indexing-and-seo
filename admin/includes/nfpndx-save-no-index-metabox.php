<?php
 //if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

if(!function_exists('nfpndx_save_no_index_metabox')){

	function nfpndx_save_no_index_metabox($nfpndx_current_post_id) {
		
		if(
		
			(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
			|| (defined('DOING_AJAX') && DOING_AJAX) 
			|| !current_user_can('edit_post', $nfpndx_current_post_id) 
			|| wp_is_post_revision($nfpndx_current_post_id) !== false
			
		) { 
		
			return;
			
		}
		
		if(
		
			!empty($_POST['nfpndx-no-index-tag-nonce']) 
			&& wp_verify_nonce($_POST['nfpndx-no-index-tag-nonce'], 'nfpndx-no-index-tag-nonce')
			
		) {
		
			if(!empty($_POST['nfpndx-no-index']) && $_POST['nfpndx-no-index'] === '1') {
				
				update_post_meta($nfpndx_current_post_id, '_nfpndx_no_index', '1');
				
			} else {
				
				update_post_meta($nfpndx_current_post_id, '_nfpndx_no_index', '0');
				
			}
		
		}		

	}


} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_save_no_index_metabox" already exists');
	
}