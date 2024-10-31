<?php
 //if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

//STYLES AND SCRIPTS

//admin styles
if(!function_exists('nfpndx_styles_and_scripts')){
	
	function nfpndx_styles_and_scripts() {

		//add media to be used into option page
		wp_enqueue_media();
		//script for option page		
		wp_enqueue_script('nfpndx-option', NFPNDX_BASE_URL.'admin/js/nfpndx-option.js', array('jquery'), '', true );	
		
		//meta rebuild script and ajax		
		wp_enqueue_script('nfpndx-meta-rebuild', NFPNDX_BASE_URL.'admin/includes/js/nfpndx-meta-rebuild.js', array('jquery'), '', true );
		wp_localize_script('nfpndx-meta-rebuild', 'nfpndx_meta_rebuild_object', array(
		
			'nfpndx_meta_rebuild_url' => admin_url('admin-ajax.php'),
			'nfpndx_meta_rebuild_nonce' => wp_create_nonce('nfpndx-meta-rebuild-nonce')
			
		));
		
	}
			
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_styles_and_scripts" already exists');
	
}