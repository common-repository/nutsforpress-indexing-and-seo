<?php
 //if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

//generate sitemap node
if(!function_exists('nfpndx_generate_sitemap_node')) {
	
		function nfpndx_generate_sitemap_node($nfpndx_node_loc, $nfpndx_node_lastmod = false) {
		
			echo '

				  <url>'."\r\n".
					'<loc>'.$nfpndx_node_loc.'</loc>'."\r\n"

					
			;
					
			if(!empty($nfpndx_node_lastmod)){
				
				echo '			

					<lastmod>'.$nfpndx_node_lastmod.'</lastmod>'."\r\n";
					
			}					

			echo '						

					<changefreq>monthly</changefreq>'."\r\n".
					'<priority>1</priority>'."\r\n".
				  '</url>'."\r\n"
				  
			;
			
		}
	
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_generate_sitemap_node" already exists');
	
}

//generate page loop
if(!function_exists('nfpndx_pages_loop')) {
	
	function nfpndx_pages_loop() {

		//get front page id
		$nfpndx_get_frontpage_id = get_option('page_on_front');
		//get blog page id
		$nfpndx_get_blog_id = get_option('page_for_posts');		
		 
		//deal with pages and exclude homepages (front page and blog)
		$nfpndx_pages_arguments = array(
		
			'posts_per_page' => -1,
			'post_type' => 'page',
			'post_status' => 'publish',
			'suppress_filters' => false,
			'orderby'  => 'post_title',
			'order' => 'DESC',
            'meta_query' => array(
                array(
                    'key' => '_nfpndx_no_index',
                    'value' => '1',
                    'compare' => '!=',
                ),	
                array(
                    'key' => '_nfpndx_no_index',
                    'compare' => 'NOT EXISTS',
                ),
                'relation' => 'OR',
            ),
			'exclude' => $nfpndx_get_frontpage_id, $nfpndx_get_blog_id
			 
		);
		
		$nfpndx_pages = get_posts($nfpndx_pages_arguments); 
		
		//deal with pages to print
		if($nfpndx_pages) {
			
			foreach($nfpndx_pages as $nfpndx_page) {
								
				$nfpndx_modified = get_post_modified_time('Y-m-d\TH:i:sP', false, $nfpndx_page->ID, false);				
				
				$nfpndx_url_complete = get_permalink($nfpndx_page->ID);
				
				//generate node
				nfpndx_generate_sitemap_node($nfpndx_url_complete, $nfpndx_modified);
		
			}
			
		}
		
	}
	
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_pages_loop" already exists');
	
}

//generate post loop
if(!function_exists('nfpndx_posts_loop')) {
	
	function nfpndx_posts_loop() {

		//deal with posts
		$nfpndx_posts_arguments = array(
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'suppress_filters' => true,
			'orderby'  => 'post_title',
			'order' => 'DESC',
            'meta_query' => array(
                array(
                    'key' => '_nfpndx_no_index',
                    'value' => '1',
                    'compare' => '!=',
                ),	
                array(
                    'key' => '_nfpndx_no_index',
                    'compare' => 'NOT EXISTS',
                ),
                'relation' => 'OR',
            ),
		);
		
		$nfpndx_posts = get_posts($nfpndx_posts_arguments); 
		
		//deal with posts to print	
		if($nfpndx_posts) {
			
			foreach($nfpndx_posts as $nfpndx_post) {

				if(has_filter('wpml_post_language_details') !== false){
					
					$nfpndx_current_post_lang_informations = apply_filters('wpml_post_language_details', NULL, $nfpndx_post->ID);
					
					if(!empty($nfpndx_current_post_lang_informations)) {
						
						$nfpndx_current_post_lang_code = $nfpndx_current_post_lang_informations['language_code'];
						do_action('wpml_switch_language', $nfpndx_current_post_lang_code);
						
					}
					
				}	
				
				$nfpndx_modified = get_post_modified_time('Y-m-d\TH:i:sP', false, $nfpndx_post->ID, false);			
			
				$nfpndx_url_complete = get_permalink($nfpndx_post->ID);
				
				//generate node
				nfpndx_generate_sitemap_node($nfpndx_url_complete, $nfpndx_modified);
			
			}
			
		}
		
	}
	
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_posts_loop" already exists');
	
}


//generate terms loop
if(!function_exists('nfpndx_terms_loop')) {
	
	function nfpndx_terms_loop($nfpndx_skip_empty_terms = false, $nfpndx_skip_custom_taxonomies = false) {
		
		//tax arguments
		$nfpndx_taxonomies_arguments = array(
		  'public'   => true,

		); 		
	
		//deal with custom taxonomies
		if($nfpndx_skip_custom_taxonomies === true){

			$nfpndx_taxonomies_arguments['_builtin'] = true;
		
		}
		
		$nfpndx_taxonomies_output = 'objects';
		$nfpndx_taxonomies_operator = 'and';
		
		$nfpndx_taxonomies = get_taxonomies($nfpndx_taxonomies_arguments, $nfpndx_taxonomies_output, $nfpndx_taxonomies_operator); 
		
		if(!empty($nfpndx_taxonomies)){
			
			foreach($nfpndx_taxonomies  as $nfpndx_taxonomy) {
				
				$nfpndx_taxonomy_name = $nfpndx_taxonomy->name;
				$nfpndx_taxonomy_label = $nfpndx_taxonomy->labels->singular_name;				
				
				$nfpndx_get_parent_terms_args = array( 
					'taxonomy' => $nfpndx_taxonomy_name, 
					'parent' => false, 
					'suppress_filters' => true,
					'orderby' => 'count',
					'order' => 'desc',
					'hide_empty' => $nfpndx_skip_empty_terms
				);	
				
				$nfpndx_parent_terms = get_terms($nfpndx_get_parent_terms_args);
				
				if(!empty($nfpndx_parent_terms)) { 
					
					foreach($nfpndx_parent_terms as $nfpndx_parent_term) {

						$nfpndx_parent_term_id = $nfpndx_parent_term->term_id;
						
						/*if(has_filter('wpml_element_language_details') !== false){
							
							$nfpndx_current_element_lang_informations = apply_filters('wpml_element_language_details', NULL, array($nfpndx_parent_term_id, $nfpndx_taxonomy_name));
							
							if(!empty($nfpndx_current_element_lang_informations)) {
								
								$nfpndx_current_term_lang_code = $nfpndx_current_element_lang_informations['language_code'];
								do_action('wpml_switch_language', $nfpndx_current_term_lang_code);
								
							}
							
						}*/						
						
						$nfpndx_parent_term_link = get_term_link($nfpndx_parent_term_id, $nfpndx_taxonomy_name);
						
						if(!empty($nfpndx_parent_term_link)){
							
							//generate node
							nfpndx_generate_sitemap_node($nfpndx_parent_term_link);							
							
						}
																
						$nfpndx_get_child_terms_args = array( 
							'taxonomy' => $nfpndx_taxonomy_name, 
							'parent' => $nfpndx_parent_term_id, 
							'suppress_filters' => true,
							'orderby' => 'count',
							'order' => 'desc',
							'hide_empty' => $nfpndx_skip_empty_terms
						);
						
						$nfpndx_child_terms = get_terms($nfpndx_get_child_terms_args);
						
						if(!empty($nfpndx_child_terms)) { 
						
							foreach($nfpndx_child_terms as $nfpndx_child_term) {

								$nfpndx_child_term_id = $nfpndx_child_term->term_id;
								
								/*if(has_filter('wpml_element_language_details') !== false){
									
									$nfpndx_current_element_lang_informations = apply_filters('wpml_element_language_details', NULL, array($nfpndx_child_term_id, $nfpndx_taxonomy_name));
									
									if(!empty($nfpndx_current_element_lang_informations)) {
										
										$nfpndx_current_term_lang_code = $nfpndx_current_element_lang_informations['language_code'];
										do_action('wpml_switch_language', $nfpndx_current_term_lang_code);
										
									}
									
								}*/								
								
								$nfpndx_child_term_link = get_term_link($nfpndx_child_term_id, $nfpndx_taxonomy_name);
								
								if(!empty($nfpndx_child_term_link)){
									
									//generate node
									nfpndx_generate_sitemap_node($nfpndx_child_term_link);							
									
								}								
								
							}
							
						}
												
					}
				
				}

			}
			
		}		
					
	}
	
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_terms_loop" already exists');
	
}

//generate authors loop
if(!function_exists('nfpndx_authors_loop')) {
	
	function nfpndx_authors_loop() {
		
		//deal with authors
		$nfpndx_authors_arguments = array(
			'orderby'   => 'post_count',
			'order'   => 'DESC',
			'role__in' => array('author'),
			'hide_empty' => false
		);
		
		$nfpndx_authors = get_users($nfpndx_authors_arguments); 
		
		//deal with authors to print
		if($nfpndx_authors){
			
			foreach($nfpndx_authors as $nfpndx_author){
				
				$nfpndx_author_data = get_userdata($nfpndx_author->ID);
				$nfpndx_author_registration = $nfpndx_author_data->user_registered;
								
				if(!empty($nfpndx_author_registration)){
					
					$nfpndx_author_registration = date('Y-m-d\TH:i:sP', strtotime($nfpndx_author_registration));
					
				}
								
				$nfpndx_author_link = get_author_posts_url($nfpndx_author->ID);
								
				//generate node
				nfpndx_generate_sitemap_node($nfpndx_author_link, $nfpndx_author_registration);
								
			}
			
		}
		
	}
	
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_authors_loop" already exists');
	
}

//generate custom post loop
if(!function_exists('nfpndx_custom_posts_loop')) {
	
	function nfpndx_custom_posts_loop() {
		
		//deal with custom posts
		$nfpndx_custom_posts_arguments = array(
		   'public' => true,
		   'publicly_queryable' => true,
		   'exclude_from_search' => false,
		   'show_ui' => true,
		   '_builtin' => false
		);
		
		$nfpndx_all_custom_post_types = get_post_types($nfpndx_custom_posts_arguments); 
		
		//exclude elementor library e jet elements mega menu
		$nfpndx_excluded_post_types = array('elementor_library', 'jet-menu');
		
		$nfpndx_custom_post_types = array_diff($nfpndx_all_custom_post_types, $nfpndx_excluded_post_types);		

		//deal with custom posts to print
		if($nfpndx_custom_post_types) {
			
			foreach($nfpndx_custom_post_types  as $nfpndx_custom_post_type) {
				
				$nfpndx_custom_posts_arguments = array(
					'post_type' => $nfpndx_custom_post_type,
					'posts_per_page' => -1,
					'post_status' => 'publish',
					'suppress_filters' => true,
					'orderby'  => 'post_title',
					'order' => 'DESC',
					'meta_query' => array(
						array(
							'key' => '_nfpndx_no_index',
							'value' => '1',
							'compare' => '!=',
						),	
						array(
							'key' => '_nfpndx_no_index',
							'compare' => 'NOT EXISTS',
						),
						'relation' => 'OR',
					),
				);
				
				$nfpndx_custom_posts = get_posts($nfpndx_custom_posts_arguments);
				
				foreach ($nfpndx_custom_posts as $nfpndx_custom_post) {
					
					if(has_filter('wpml_post_language_details') !== false){
						
						$nfpndx_current_post_lang_informations = apply_filters('wpml_post_language_details', NULL, $nfpndx_custom_post->ID);
						
						if(!empty($nfpndx_current_post_lang_informations)) {
							
							$nfpndx_current_post_lang_code = $nfpndx_current_post_lang_informations['language_code'];
							do_action('wpml_switch_language', $nfpndx_current_post_lang_code);
							
						}
						
					}	

					$nfpndx_modified = get_post_modified_time('Y-m-d\TH:i:sP', false, $nfpndx_custom_post->ID, false);

					$nfpndx_url_complete = get_permalink($nfpndx_custom_post->ID);
						
					//generate node
					nfpndx_generate_sitemap_node($nfpndx_url_complete,$nfpndx_modified);
	
				}
				
			}
			
		}
		
	}
	
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_custom_posts_loop" already exists');
	
}

//add sitemap
if(!function_exists('nfpndx_add_sitemap')) {
	
	function nfpndx_add_sitemap($nfpndx_post_meta_title) {

		//get options 
		global $nfproot_current_language_settings;

		//if replace sitemap is enabled
		if(

			!empty($nfproot_current_language_settings['nfpndx']['nfproot_replace_sitemap'])
			&& $nfproot_current_language_settings['nfpndx']['nfproot_replace_sitemap'] === '1'
								
		) {

			if(is_admin()) {
				
				return;
				
			}

			//add sitemap to robots
			add_filter('robots_txt', 
			
				function($nfpndx_current_robots_content){ 
					
					$nfpndx_current_robots_content .= "\r\n"."sitemap: ".site_url()."/sitemap.xml";
					return $nfpndx_current_robots_content;
					
				}
				
			);

			global $wp;

			if($wp->request === 'wp-sitemap.xml'){
				
				wp_safe_redirect('/sitemap.xml');
				die;
				
			}
			
			if($wp->request === 'sitemap.xml'){
				
				//change headers status
				status_header(200);
				
				//print headers
				ob_clean();
				header("Content-type: text/xml");
				echo '<?xml version="1.0" encoding="UTF-8"?>'."\r\n";
				echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\r\n";

				//deal with homepage
				$nfpndx_site_url = get_home_url();
				//get last post modified
				$nfpndx_modified = get_post_modified_time('Y-m-d\TH:i:sP', false, get_option('page_on_front'), false);

				//deal with WPML
				$nfpmgm_get_wpml_active_languages = apply_filters('wpml_active_languages', false);

				//if WPML has active languages
				if(!empty($nfpmgm_get_wpml_active_languages)) {
				  
					//loop into languages
					foreach($nfpmgm_get_wpml_active_languages as $nfpmgm_wpml_language) {
						
						$nfpmgm_wpml_language_code = $nfpmgm_wpml_language['language_code'];
						
						//change language
						do_action('wpml_switch_language', $nfpmgm_wpml_language_code); 
												
						//get site url by language
						$nfpndx_site_url = apply_filters('wpml_home_url', $nfpndx_site_url);
						
						//generate node for front page
						nfpndx_generate_sitemap_node($nfpndx_site_url,$nfpndx_modified);
						nfpndx_pages_loop();						
							
					}

				} else {
					
					//generate node
					nfpndx_generate_sitemap_node($nfpndx_site_url,$nfpndx_modified);

					//generate nodes for every other page and post type
					nfpndx_pages_loop();
						
				}	
				
				//generate nodes for every post and post type
				nfpndx_posts_loop();
				
				if(

					!empty($nfproot_current_language_settings['nfpndx']['nfproot_cpt_single_pages'])
					&& $nfproot_current_language_settings['nfpndx']['nfproot_cpt_single_pages'] === '1'
										
				){		

					nfpndx_custom_posts_loop();
				
				}				

				if(

					!empty($nfproot_current_language_settings['nfpndx']['nfproot_taxonomy_term_archive_pages'])
					&& $nfproot_current_language_settings['nfpndx']['nfproot_taxonomy_term_archive_pages'] === '1'
										
				){	

					if(

						!empty($nfproot_current_language_settings['nfpndx']['nfproot_skip_empty_terms'])
						&& $nfproot_current_language_settings['nfpndx']['nfproot_skip_empty_terms'] === '1'
											
					){	
					
						if(

							!empty($nfproot_current_language_settings['nfpndx']['nfproot_skip_custom_taxonomies'])
							&& $nfproot_current_language_settings['nfpndx']['nfproot_skip_custom_taxonomies'] === '1'
												
						){				

							nfpndx_terms_loop(true, true);
							
						} else {
							
							nfpndx_terms_loop(true, false);
							
						}					
					
					} else {
						
						if(

							!empty($nfproot_current_language_settings['nfpndx']['nfproot_skip_custom_taxonomies'])
							&& $nfproot_current_language_settings['nfpndx']['nfproot_skip_custom_taxonomies'] === '1'
												
						){				

							nfpndx_terms_loop(false, true);
							
						} else {
							
							nfpndx_terms_loop(false, false);
							
						}						
						
					}

				}
				
				if(

					!empty($nfproot_current_language_settings['nfpndx']['nfproot_author_profile_pages'])
					&& $nfproot_current_language_settings['nfpndx']['nfproot_author_profile_pages'] === '1'
										
				){		

					nfpndx_authors_loop();	
				
				}

				//print closing tag
				echo '</urlset>';
				die;
				
			}			
			
		}

	}
	
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_add_sitemap" already exists');
	
}