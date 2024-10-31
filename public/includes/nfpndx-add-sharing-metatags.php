<?php
 //if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

if(!function_exists('nfpndx_add_sharing_metatags')){

	function nfpndx_add_sharing_metatags() {

		//get options 
		global $nfproot_current_language_settings;

		//if title and description is enabled, sharing tag is enabled and no index is not set
		if(

			!empty($nfproot_current_language_settings['nfpndx']['nfproot_title_description'])
			&& $nfproot_current_language_settings['nfpndx']['nfproot_title_description'] === '1'
			&& !empty($nfproot_current_language_settings['nfpndx']['nfproot_sharing_tag'])
			&& $nfproot_current_language_settings['nfpndx']['nfproot_sharing_tag'] === '1'
								
		) {
			
			if(empty(get_the_ID()) || is_admin()) {
				
				return;
				
			}
						
			$nfpndx_current_post_id = get_the_ID();
			
			//if no index is enabled
			if(

				!empty($nfproot_current_language_settings['nfpndx']['nfproot_no_index'])
				&& $nfproot_current_language_settings['nfpndx']['nfproot_no_index'] === '1'
									
			) {
				
				$nfpndx_no_index = esc_attr(get_post_meta($nfpndx_current_post_id, '_nfpndx_no_index', true));
				
				if($nfpndx_no_index === '1') {

					if(NFPNDX_DEBUG === true) {error_log('NUTSFORPRESS: not including sharing metatags since the post is set to no index');}
					return;

				}			
			
			}
			
			if(NFPNDX_DEBUG === true) {error_log('NUTSFORPRESS: including sharing metatags');}

			//get featured image url
			$nfpndx_featured_image_url = wp_get_attachment_url(get_post_thumbnail_id($nfpndx_current_post_id));
			$nfpndx_sharing_image = $nfpndx_featured_image_url;
				
			//if featured image is not set, get the alternative media image
			if(empty($nfpndx_sharing_image)) {
				
				if(NFPNDX_DEBUG === true) {error_log('NUTSFORPRESS: featured image not set, looking for alternative image');}
				
				if(!empty($nfproot_current_language_settings['nfpndx']['nfproot_backup_featured_image'])) {
					
					if(NFPNDX_DEBUG === true) {error_log('NUTSFORPRESS: using backup featured image');}

					$nfproot_backup_featured_image_name = esc_attr($nfproot_current_language_settings['nfpndx']['nfproot_backup_featured_image']);
					$nfpndx_sharing_image = esc_url_raw(wp_upload_dir()['baseurl'].$nfproot_backup_featured_image_name);
					
				}
				
			}
			
			if(is_archive()) {
				
				if(NFPNDX_DEBUG === true) {error_log('NUTSFORPRESS: it is an archive page, including archive title and archive description');}
				
				//check if it is the WooCommerce shop page
				if(function_exists('is_shop')){
					
					if(is_shop()){
						
						$nfpndx_current_archive_id = get_option('woocommerce_shop_page_id');
						
						if(!empty($nfpndx_current_archive_id)){
							
							$nfpndx_title = esc_attr(get_post_meta($nfpndx_current_archive_id, '_nfpndx_meta_title', true));
							$nfpndx_description = esc_attr(get_post_meta($nfpndx_current_archive_id, '_nfpndx_meta_description', true));
							
						}
						
					}
					
				}
				
				if(!isset($nfpndx_title)){
				
					$nfpndx_title = wp_strip_all_tags(get_the_archive_title());				
					
				}

				if(!isset($nfpndx_description)){
				
					$nfpndx_description = wp_strip_all_tags(get_the_archive_description());			
					
				}				
				
				if(
				
					!empty($nfproot_current_language_settings['nfpndx']['nfproot_use_backup_featured_image_for_archives'])
					&& $nfproot_current_language_settings['nfpndx']['nfproot_use_backup_featured_image_for_archives'] === '1'				
				
				) {
					
					if(NFPNDX_DEBUG === true) {error_log('NUTSFORPRESS: it is an archive page, overriding featured image with the one set as backup featured image, if set');}
					if(!empty($nfproot_current_language_settings['nfpndx']['nfproot_backup_featured_image'])) {
						
						$nfproot_backup_featured_image_name = esc_attr($nfproot_current_language_settings['nfpndx']['nfproot_backup_featured_image']);
						$nfpndx_sharing_image = esc_url_raw(wp_upload_dir()['baseurl'].$nfproot_backup_featured_image_name);
						
					}					
					
				}
				
			}
			
			//just for the blog homepage
			else if(is_home()){
				
				$nfpndx_description = wp_strip_all_tags(get_bloginfo('description'));		
				$nfpndx_title = wp_strip_all_tags(get_bloginfo('name'));	

				if(
				
					!empty($nfproot_current_language_settings['nfpndx']['nfproot_use_backup_featured_image_for_archives'])
					&& $nfproot_current_language_settings['nfpndx']['nfproot_use_backup_featured_image_for_archives'] === '1'				
				
				) {
					
					if(NFPNDX_DEBUG === true) {error_log('NUTSFORPRESS: it is an archive page (the blog page), overriding featured image with the one set as backup featured image, if set');}
					if(!empty($nfproot_current_language_settings['nfpndx']['nfproot_backup_featured_image'])) {
						
						$nfproot_backup_featured_image_name = esc_attr($nfproot_current_language_settings['nfpndx']['nfproot_backup_featured_image']);
						$nfpndx_sharing_image = esc_url_raw(wp_upload_dir()['baseurl'].$nfproot_backup_featured_image_name);
						
					}					
					
				}		
				
			
			} else {	
			
				
				if(NFPNDX_DEBUG === true) {error_log('NUTSFORPRESS: getting title');}
				
				$nfpndx_queried_object_id = get_queried_object_id();
				
				if($nfpndx_current_post_id !== $nfpndx_queried_object_id){
					
					$nfpndx_title = esc_attr(get_post_meta($nfpndx_queried_object_id, '_nfpndx_meta_title', true));
					
				} else {
					
					$nfpndx_title = esc_attr(get_post_meta($nfpndx_current_post_id, '_nfpndx_meta_title', true));
					
				}			
				
				if(empty($nfpndx_title)) {
					
					if(NFPNDX_DEBUG === true) {error_log('NUTSFORPRESS: title not set, getting post title');}
					$nfpndx_title = get_the_title($nfpndx_current_post_id);
					
				} else {

					$nfpndx_title_blogname = esc_attr(get_post_meta($nfpndx_current_post_id, '_nfpndx_meta_title_blogname', true));
						
					if($nfpndx_title_blogname !== '0') {
						
						$nfpndx_title = $nfpndx_title. ' | '.get_bloginfo('name');
						
					} else {
						
						$nfpndx_title = $nfpndx_title;
						
					}		
					
				}		
				
				if(NFPNDX_DEBUG === true) {error_log('NUTSFORPRESS: getting description');}
				
				$nfpndx_queried_object_id = get_queried_object_id();
				
				if($nfpndx_current_post_id !== $nfpndx_queried_object_id){
					
					$nfpndx_description = esc_attr(get_post_meta($nfpndx_queried_object_id, '_nfpndx_meta_description', true));
					
				} else {
					
					$nfpndx_description = esc_attr(get_post_meta($nfpndx_current_post_id, '_nfpndx_meta_description', true));
					
				}				
				
				if(empty($nfpndx_description)) {
					
					if(NFPNDX_DEBUG === true) {error_log('NUTSFORPRESS: description not set, getting blog description');}
					$nfpndx_description = get_bloginfo('description');
					
				}
				
			}		

			//facebook open graph
			echo '<meta property="og:locale" content="'.get_locale().'">'."\r\n";
			echo '<meta property="og:site_name" content="'.get_bloginfo('name').'">'."\r\n";
			echo '<meta property="og:title" content="'.$nfpndx_title.'">'."\r\n";
			echo '<meta property="og:type" content="website">'."\r\n";
			
			if(!is_archive()) {
				
				echo '<meta property="og:url" content="'.get_the_permalink().'">'."\r\n";
				
			}
			
			if($nfpndx_description) {	
				
				echo '<meta property="og:description" content="'.$nfpndx_description.'">'."\r\n";
			
			}			
										
			if($nfpndx_sharing_image) {	
				
				echo '<meta property="og:image" content="'.$nfpndx_sharing_image.'">'."\r\n";
			
			}

			//twitter card
			echo '<meta name="twitter:card" content="summary">'."\r\n";
			echo '<meta name="twitter:site" content="'.site_url().'">'."\r\n";
			echo '<meta name="twitter:creator" content="'.get_bloginfo('name').'">'."\r\n";
			echo '<meta name="twitter:title" content="'.$nfpndx_title.'">'."\r\n";

			if($nfpndx_description) {
				
				echo '<meta name="twitter:description" content="'.$nfpndx_description.'">'."\r\n";
			
			} 
			
			if($nfpndx_sharing_image) {
				
				echo '<meta name="twitter:image" content="'.$nfpndx_sharing_image.'">'."\r\n";
			
			} 			
			
		}			

	}


} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_add_sharing_metatags" already exists');
	
}