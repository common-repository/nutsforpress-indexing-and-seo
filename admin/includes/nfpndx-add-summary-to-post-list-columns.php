<?php
 //if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

//add custom column to post type list
if(!function_exists('nfpndx_summary_post_column_header')) {
	
	function nfpndx_summary_post_column_header($nfpndx_default_wp_columns) {
		
		//get options 
		global $nfproot_current_language_settings;

		//if title and description or no index is enabled
		if(

			(
			
				!empty($nfproot_current_language_settings['nfpndx']['nfproot_title_description'])
				&& $nfproot_current_language_settings['nfpndx']['nfproot_title_description'] === '1'
				
			) || (
			
				!empty($nfproot_current_language_settings['nfpndx']['nfproot_no_index'])
				&& $nfproot_current_language_settings['nfpndx']['nfproot_no_index'] === '1'
				
			)
								
		) {		
		
			//keep this condition to hide column only on some post types
			$nfpndx_excluded_post_types = array('elementor_library');
			global $current_screen;
			
			if(!in_array($current_screen->post_type,$nfpndx_excluded_post_types)) {
				
				$nfpndx_default_wp_columns['nfpndx_nutsforpress_summary'] = 'NutsForPress Indexing and SEO';
				
			}
			
		}
		
		return $nfpndx_default_wp_columns;
		
	}
	
	add_filter('manage_posts_columns', 'nfpndx_summary_post_column_header');
	
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_summary_post_column_header" already exists');
	
}

//add custom column to page list
if(!function_exists('nfpndx_summary_page_column_header')) {
	
	function nfpndx_summary_page_column_header($nfpndx_default_wp_columns) {
		
		//get options 
		global $nfproot_current_language_settings;

		//if title and description or no index is enabled
		if(

			(
			
				!empty($nfproot_current_language_settings['nfpndx']['nfproot_title_description'])
				&& $nfproot_current_language_settings['nfpndx']['nfproot_title_description'] === '1'
				
			) || (
			
				!empty($nfproot_current_language_settings['nfpndx']['nfproot_no_index'])
				&& $nfproot_current_language_settings['nfpndx']['nfproot_no_index'] === '1'
				
			)
								
		) {
		
			$nfpndx_summary_page_column_header = array(
				
				'nfpndx_nutsforpress_summary' => 'NutsForPress Indexing and SEO'
				
			);
			
			$nfpndx_all_page_columns = array_merge($nfpndx_default_wp_columns, $nfpndx_summary_page_column_header);
			
			return $nfpndx_all_page_columns;
			
		} else {

			return $nfpndx_default_wp_columns;
			
		}
		
	}
	
	add_filter('manage_pages_columns', 'nfpndx_summary_page_column_header');

} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_summary_page_column_header" already exists');
	
}


if(!function_exists('nfpndx_add_summary_to_post_list_columns')){

	function nfpndx_add_summary_to_post_list_columns($nfpndx_column_name, $nfpndx_involved_post_id) {
					
		if($nfpndx_column_name === 'nfpndx_nutsforpress_summary') {
				
			$nfpndx_nutsforpress_summary = null;
			
			//get options 
			global $nfproot_current_language_settings;

			if(
				
				!empty($nfproot_current_language_settings['nfpndx']['nfproot_no_index'])
				&& $nfproot_current_language_settings['nfpndx']['nfproot_no_index'] === '1'
									
			) {	

				//deal with no index
				$nfpndx_no_index = esc_attr(get_post_meta($nfpndx_involved_post_id, '_nfpndx_no_index', true));
				
				if($nfpndx_no_index === '1') {
					
					$nfpndx_nutsforpress_summary .= '<strong><span style="color:#CA4A1F;">No Index</span></strong>';
					echo $nfpndx_nutsforpress_summary;
					
					//display only "no index"
					return;
					
				} 
			
			}

			if(
				
				!empty($nfproot_current_language_settings['nfpndx']['nfproot_title_description'])
				&& $nfproot_current_language_settings['nfpndx']['nfproot_title_description'] === '1'
									
			) {	
				
				$nfpndx_title = esc_attr(get_post_meta($nfpndx_involved_post_id, '_nfpndx_meta_title', true));
				
				if(!empty($nfpndx_title)) {
					
					$nfpndx_meta_title = $nfpndx_title;
					
					$nfpndx_title_blogname = esc_attr(get_post_meta($nfpndx_involved_post_id, '_nfpndx_meta_title_blogname', true));
											
					if($nfpndx_title_blogname === '1') {
						
						$nfpndx_meta_title = $nfpndx_meta_title.' | '.get_bloginfo('name');
						
					} 
					
				} else {
					
					$nfpndx_meta_title = get_the_title($nfpndx_involved_post_id);
				}
				
				
				$nfpndx_title_length = strlen($nfpndx_meta_title);
				
				if((int)$nfpndx_title_length > 60 != (int)$nfpndx_title_length < 25) {
					
					$nfpndx_title_length = '<span style="color:#CA4A1F">'.$nfpndx_title_length.'</span>';
					
				}
				
				$nfpndx_nutsforpress_summary .= '<strong>'.__('Title','nutsforpress-indexing-and-seo').'</strong>: '.$nfpndx_meta_title. ' (<strong>'.$nfpndx_title_length.'</strong>)';
									
				//deal with description
				$nfpndx_description = esc_attr(get_post_meta($nfpndx_involved_post_id, '_nfpndx_meta_description', true));	

				$nfpndx_description_length = strlen($nfpndx_description);
			
				if((int)$nfpndx_description_length > 160 || (int)$nfpndx_description_length < 100) {
					
					$nfpndx_description_length = '<span style="color:#CA4A1F">'.$nfpndx_description_length.'</span>';
					
				}

				$nfpndx_nutsforpress_summary .= '<br><strong>'.__('Description','nutsforpress-indexing-and-seo').'</strong>: '.$nfpndx_description. ' (<strong>'.$nfpndx_description_length.'</strong>)';
					
				echo $nfpndx_nutsforpress_summary;

			}	

		}				
		
	}


} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_add_summary_to_post_list_columns" already exists');
	
}