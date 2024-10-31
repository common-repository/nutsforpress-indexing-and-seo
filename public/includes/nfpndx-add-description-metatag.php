<?php
 //if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

if(!function_exists('nfpndx_add_description_metatag')){

	function nfpndx_add_description_metatag() {
		
		//get options 
		global $nfproot_current_language_settings;

		//if title and description is enabled
		if(

			!empty($nfproot_current_language_settings['nfpndx']['nfproot_title_description'])
			&& $nfproot_current_language_settings['nfpndx']['nfproot_title_description'] === '1'
								
		) {
			
			if(is_admin()) {
				
				return;
				
			}
			
			$nfpndx_current_post_id = get_queried_object_id();
			
			//if no index is enabled
			if(

				!empty($nfproot_current_language_settings['nfpndx']['nfproot_no_index'])
				&& $nfproot_current_language_settings['nfpndx']['nfproot_no_index'] === '1'
									
			) {
				
				$nfpndx_no_index = esc_attr(get_post_meta($nfpndx_current_post_id, '_nfpndx_no_index', true));
				
				if($nfpndx_no_index === '1') {

					if(NFPNDX_DEBUG === true) {error_log('NUTSFORPRESS: not including description metatag since the post is set to no index');}
					return;

				}			
			
			}

			if(is_archive()) {
				
				if(NFPNDX_DEBUG === true) {error_log('NUTSFORPRESS: it is an archive page, getting archive description');}
				
				//check if it is the WooCommerce shop page
				if(function_exists('is_shop')){
					
					if(is_shop()){
						
						$nfpndx_current_post_id = get_option('woocommerce_shop_page_id');
						
						if(!empty($nfpndx_current_post_id)){
							
							$nfpndx_description = esc_attr(get_post_meta($nfpndx_current_post_id, '_nfpndx_meta_description', true));
							
						}
						
					}
					
				}
							
				if(!isset($nfpndx_description)) {
					
					$nfpndx_description = wp_strip_all_tags(get_the_archive_description());
					
				}		
				
			}

			//just for the blog homepage
			else if(is_home()){
				
				$nfpndx_description = wp_strip_all_tags(get_bloginfo('description'));			
			
			} else {	
					
				$nfpndx_description = esc_attr(get_post_meta($nfpndx_current_post_id, '_nfpndx_meta_description', true));
			
			}
			
			//just in case description is not found
			if(empty($nfpndx_description)){
				
				$nfpndx_description = get_bloginfo('description');
				
			}
						
			if(!empty($nfpndx_description)){
			
				//if a custom description is provided, display it as description
				echo '<meta name="description" content="'.$nfpndx_description.'">'."\r\n";
			
			}

		}	

	}

} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_add_description_metatag" already exists');
	
}