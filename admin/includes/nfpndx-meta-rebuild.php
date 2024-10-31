<?php
 //if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

if(!function_exists('nfpndx_meta_rebuild')){

	function nfpndx_meta_rebuild() {

		//end here if user can't manage options
		if(current_user_can('manage_options') === false) {
			
			return;
			
		}
		
		//check nonce (if fails, dies)
		check_ajax_referer('nfpndx-meta-rebuild-nonce', 'nfpndx_meta_rebuild_nonce');	

		if(
			
			isset($_POST['nfpndx_current_image_id'])
			&& isset($_POST['nfpndx_rebuild_all_meta'])
			
		) {
					
			$nfpndx_image_id_to_work_with_id = absint($_POST['nfpndx_current_image_id']);
			$nfpndx_rebuild_all_meta = absint($_POST['nfpndx_rebuild_all_meta']);

			//get post title
			$nfpndx_current_image_meta_title = get_post_field('post_title', $nfpndx_image_id_to_work_with_id);
			
			//get alt title
			$nfpndx_current_image_meta_alt = get_post_meta($nfpndx_image_id_to_work_with_id, '_wp_attachment_image_alt', true);			

			//get post excerpt
			$nfpndx_current_image_meta_excerpt = get_post_field('post_excerpt', $nfpndx_image_id_to_work_with_id);			

			//get post content
			$nfpndx_current_image_meta_content = get_post_field('post_content', $nfpndx_image_id_to_work_with_id);		

			//clean post title
			$nfpndx_current_image_meta_title_cleaned = str_replace(array('-','_'), ' ', $nfpndx_current_image_meta_title);

			//deal with attachment duplication created by WPML
			$nfpndx_get_wpml_active_languages = apply_filters('wpml_active_languages', false);

			//if WPML has active languages
			if(!empty($nfpndx_get_wpml_active_languages)) {
			  
				//loop into languages
				foreach($nfpndx_get_wpml_active_languages as $nfpndx_wpml_language) {
					
					$nfpndx_wpml_language_code = $nfpndx_wpml_language['language_code'];
					
					$nfpndx_image_id_to_work_with_translation_id = apply_filters('wpml_object_id', $nfpndx_image_id_to_work_with_id, 'attachment', false, $nfpndx_wpml_language_code);
					
					if(!empty($nfpndx_image_id_to_work_with_translation_id)) {

						//update title, if empty or if all meta is selected
						if(empty($nfpndx_current_image_meta_title) || $nfpndx_rebuild_all_meta === 1) {
						
							//update title
							wp_update_post(
							
								array(
								
									'ID' => $nfpndx_image_id_to_work_with_translation_id, 
									'post_title' => $nfpndx_current_image_meta_title_cleaned
								
								)
								
							);	
						
						}
						
						//update alt title, if empty
						if(empty($nfpndx_current_image_meta_alt) || $nfpndx_rebuild_all_meta === 1) {
							
							//set alt title
							update_post_meta($nfpndx_image_id_to_work_with_translation_id,'_wp_attachment_image_alt', $nfpndx_current_image_meta_title_cleaned);
							
						}
						
						//update post excerpt, if empty
						if(empty($nfpndx_current_image_meta_excerpt) || $nfpndx_rebuild_all_meta === 1) {

							wp_update_post(
							
								array(
								
									'ID' => $nfpndx_image_id_to_work_with_translation_id, 
									'post_excerpt' => $nfpndx_current_image_meta_title_cleaned
								
								)
								
							);	
				
						}
						
						//update post content, if empty
						if(empty($nfpndx_current_image_meta_content) || $nfpndx_rebuild_all_meta === 1) {

							wp_update_post(
							
								array(
								
									'ID' => $nfpndx_image_id_to_work_with_translation_id, 
									'post_content' => $nfpndx_current_image_meta_title_cleaned
								
								)
							
							);	
							
						}
						
					}
					
				}
								
				if(NFPNDX_DEBUG === true) {error_log('NUTSFORPRESS: updating metadata for id '.$nfpndx_image_id_to_work_with_id. ' and its translations');}
				
			} else {

				//update title, if empty or if all meta is selected
				if(empty($nfpndx_current_image_meta_title) || $nfpndx_rebuild_all_meta === 1) {

					//update title
					wp_update_post(
					
						array(
						
							'ID' => $nfpndx_image_id_to_work_with_id, 
							'post_title' => $nfpndx_current_image_meta_title_cleaned
						
						)
						
					);	
					
				}
				
				//update alt title, if empty
				if(empty($nfpndx_current_image_meta_alt) || $nfpndx_rebuild_all_meta === 1) {
					
					//set alt title
					update_post_meta($nfpndx_image_id_to_work_with_id,'_wp_attachment_image_alt', $nfpndx_current_image_meta_title_cleaned);
					
				}
				
				//update post excerpt, if empty
				if(empty($nfpndx_current_image_meta_excerpt) || $nfpndx_rebuild_all_meta === 1) {

					wp_update_post(
					
						array(
						
							'ID' => $nfpndx_image_id_to_work_with_id, 
							'post_excerpt' => $nfpndx_current_image_meta_title_cleaned
						
						)
						
					);	
		
				}
				
				//update post content, if empty
				if(empty($nfpndx_current_image_meta_content) || $nfpndx_rebuild_all_meta === 1) {

					wp_update_post(
					
						array(
						
							'ID' => $nfpndx_image_id_to_work_with_id, 
							'post_content' => $nfpndx_current_image_meta_title_cleaned
						
						)
					
					);	
					
				}

				if(NFPNDX_DEBUG === true) {error_log('NUTSFORPRESS: updating metadata for id '.$nfpndx_image_id_to_work_with_id);}
										
			}	
			
		} else {		

			$nfpndx_images_to_deal_with = new WP_Query(

				//post arguments
				array(
				
					'post_type' => 'attachment',
					'posts_per_page' => -1,
					'orderby' => 'ID',
					'order' => 'DESC',						
					'suppress_filters' => false, //otherwise it loads WPML duplicates media
					'offset' => 0,
					'post_status' => 'inherit',
					'ignore_sticky_posts' => true,
					'no_found_rows' => true,
					'fields' => 'ids'				
					
				)
				
			);

			//get image post ids array
			$nfpndx_images_ids_to_deal_with = $nfpndx_images_to_deal_with->posts;

			wp_reset_postdata();

			$nfpndx_images_ids_to_work_with = array();			
			
			if(
			
				!empty($_POST['nfpndx_rebuild_all_meta'])
				&& absint($_POST['nfpndx_rebuild_all_meta']) === 1
				
			) {
				
				//rebuild all attachment meta
				$nfpndx_images_ids_to_work_with['id'] = $nfpndx_images_ids_to_deal_with;
				
				if(NFPNDX_DEBUG === true) {error_log('NUTSFORPRESS: including all images into work_with array, since all meta is selected');}
				
				echo json_encode($nfpndx_images_ids_to_work_with);
			
				wp_die();
				
			}			
						
			//loop into post id array
			foreach($nfpndx_images_ids_to_deal_with as $nfpndx_current_image_id) {
				
				if(NFPNDX_DEBUG === true) {error_log('NUTSFORPRESS: dealing with id: '.$nfpndx_current_image_id);}

				//get post title
				$nfpndx_current_image_id_meta_title = get_post_field('post_title', $nfpndx_current_image_id);

				//get alt title
				$nfpndx_current_image_id_meta_alt = get_post_meta($nfpndx_current_image_id, '_wp_attachment_image_alt', true);			

				//get post excerpt
				$nfpndx_current_image_id_meta_excerpt = get_post_field('post_excerpt', $nfpndx_current_image_id);			

				//get post content
				$nfpndx_current_image_id_meta_content = get_post_field('post_content', $nfpndx_current_image_id);	
			
				//include in array only elements with at least one meta to fill
				if(
				
					!empty($nfpndx_current_image_id_meta_title) 
					
					&& (
					
						empty($nfpndx_current_image_id_meta_alt) 
						|| empty($nfpndx_current_image_id_meta_excerpt) 
						|| empty($nfpndx_current_image_id_meta_content)
					
					)
					
				) {
					
					$nfpndx_images_ids_to_work_with['id'][] = $nfpndx_current_image_id;
					
					if(NFPNDX_DEBUG === true) {error_log('NUTSFORPRESS: including image id '.$nfpndx_current_image_id.' into work_with array, since at least one meta is empty');}
					
				} else {
					
					if(NFPNDX_DEBUG === true) {error_log('NUTSFORPRESS: skipping image id '.$nfpndx_current_image_id.' since all meta are set yet (or title is empty)');}
					
				}			

			}
			
			echo json_encode($nfpndx_images_ids_to_work_with);
			
			wp_die();
		
		}

	}


} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_meta_rebuild" already exists');
	
}