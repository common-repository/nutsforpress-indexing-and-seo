<?php
 //if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

//get custom title tag
if(!function_exists('nfpndx_get_custom_title')) {
	
	function nfpndx_get_custom_title($nfpndx_post_meta_title) {
		
		if(empty(get_the_ID()) || is_admin()) {
			
			return $nfpndx_post_meta_title;
			
		}
		
		$nfpndx_current_post_id = get_the_ID();
		
		//get options 
		global $nfproot_current_language_settings;
		
		//if no index is enabled
		if(

			!empty($nfproot_current_language_settings['nfpndx']['nfproot_no_index'])
			&& $nfproot_current_language_settings['nfpndx']['nfproot_no_index'] === '1'
								
		) {
			
			$nfpndx_no_index = esc_attr(get_post_meta($nfpndx_current_post_id, '_nfpndx_no_index', true));
			
			if($nfpndx_no_index === '1') {

				if(NFPNDX_DEBUG === true) {error_log('NUTSFORPRESS: displaying standard title metatag since the post is set to no index');}
				return $nfpndx_post_meta_title;

			}			
		
		}
		
		if(is_archive()) {
						
			if(NFPNDX_DEBUG === true) {error_log('NUTSFORPRESS: it is an archive page, getting archive title');}
			
			//check if it is the WooCommerce shop page
			if(function_exists('is_shop')){
				
				if(is_shop()){
					
					$nfpndx_current_post_id = get_option('woocommerce_shop_page_id');
					
					if(!empty($nfpndx_current_post_id)){
						
						$nfpndx_title = esc_attr(get_post_meta($nfpndx_current_post_id, '_nfpndx_meta_title', true));
						
					}
					
				}
				
			}
			
			if(!isset($nfpndx_title)){
			
				$nfpndx_title = wp_strip_all_tags(get_the_archive_title());				
				
			}
			
		}

		//just for the blog homepage
		else if(is_home()){
			
			$nfpndx_title = wp_strip_all_tags(get_bloginfo('name'));	
			        		
		} else {
			
			$nfpndx_queried_object_id = get_queried_object_id();
			
			if($nfpndx_current_post_id !== $nfpndx_queried_object_id){
				
				$nfpndx_title = esc_attr(get_post_meta($nfpndx_queried_object_id, '_nfpndx_meta_title', true));
				$nfpndx_title_blogname = esc_attr(get_post_meta($nfpndx_queried_object_id, '_nfpndx_meta_title_blogname', true));
				
			} else {
				
				$nfpndx_title = esc_attr(get_post_meta($nfpndx_current_post_id, '_nfpndx_meta_title', true));
				$nfpndx_title_blogname = esc_attr(get_post_meta($nfpndx_current_post_id, '_nfpndx_meta_title_blogname', true));
				
			}		
			
		}
			
		if(empty($nfpndx_title)) {
			
			$nfpndx_post_meta_title = get_the_title($nfpndx_current_post_id);
			
		} else {
				
			if(isset($nfpndx_title_blogname) && $nfpndx_title_blogname !== '0') {
				
				$nfpndx_post_meta_title = $nfpndx_title. ' | '.get_bloginfo('name');
				
			} else {
				
				$nfpndx_post_meta_title = $nfpndx_title;
				
			}		
			
		}		
		
		return $nfpndx_post_meta_title;
	
	}
	
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_get_custom_title" already exists');
	
}


if(!function_exists('nfpndx_add_title_metatag')){

	function nfpndx_add_title_metatag() {

		//get options 
		global $nfproot_current_language_settings;

		//if title and description is enabled
		if(

			!empty($nfproot_current_language_settings['nfpndx']['nfproot_title_description'])
			&& $nfproot_current_language_settings['nfpndx']['nfproot_title_description'] === '1'
								
		) {
			
			add_filter('pre_get_document_title', 'nfpndx_get_custom_title', 10, 2);

		}			

	}


} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_add_title_metatag" already exists');
	
}