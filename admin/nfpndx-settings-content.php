<?php
//if this file is called directly, die.
if(!defined('ABSPATH')) die('please, do not call this page directly');
	
//with this function we will define the NutsForPress menu page content
if(!function_exists('nfpndx_settings_content')) {
	
	function nfpndx_settings_content() {
	
		$nfpndx_settings_content = array(
		
			array(
			
				'container-title'	=> __('Title and description for pages and posts','nutsforpress-indexing-and-seo'),
				
				'container-id'		=> 'nfpndx_title_description_container',
				'container-class' 	=> 'nfpndx-title-description-container',
				'input-name'		=> 'nfproot_title_description',
				'add-to-settings'	=> 'global',
				'data-save'			=> 'nfpndx',
				'input-id'			=> 'nfpndx_title_description',
				'input-class'		=> 'nfpndx-title-description',
				'input-description'	=> __('If switched on, title and description fields are added to pages and posts editor and their content will be used by search engines to index and to describe your website into search results','nutsforpress-indexing-and-seo'),
				'arrow-before'		=> true,
				'after-input'		=> '',
				'input-type' 		=> 'switch',
				'input-value'		=> '1',
							
				'childs'			=> array(
				
					array(
					
						'container-title'	=> __('Add Facebook Open Graph and Twitter Card','nutsforpress-indexing-and-seo'),
					
						'container-id'		=> 'nfpndx_sharing_tag_container',
						'container-class' 	=> 'nfpndx-sharing-tag-container',					
						'input-name' 		=> 'nfproot_sharing_tag',
						'add-to-settings'	=> 'global',
						'data-save'			=> 'nfpndx',
						'input-id' 			=> 'nfpndx_sharing_tag',
						'input-class'		=> 'nfpndx-sharing-tag',
						'input-description' => __('If switched on, sharing meta tags for Facebook and Twitter are added to the code of your pages and posts and they are populated with the entered title, description and featured image','nutsforpress-indexing-and-seo'),
						'arrow-before'		=> true,
						'after-input'		=> '',
						'input-type' 		=> 'switch',
						'input-value'		=> '1',
						
						'childs'			=> array(
						
							array(
							
								'container-title'	=> __('Backup featured image','nutsforpress-indexing-and-seo'),
							
								'container-id'		=> 'nfpndx_backup_featured_image_container',
								'container-class' 	=> 'nfpndx-backup-featured-image-container',					
								'input-name' 		=> 'nfproot_backup_featured_image',
								'add-to-settings'	=> 'global',
								'data-save'			=> 'nfpndx',
								'input-id' 			=> 'nfpndx_backup_featured_image',
								'input-class'		=> 'nfpndx-backup-featured-image',
								'input-description' => __('Choose a backup featured image to be used in sharing tags when no featured image is set','nutsforpress-indexing-and-seo'),
								'arrow-before'		=> false,
								'after-input'		=> array(
								
									array(
									
										'type' 		=> 'button',
										'id' 		=> 'nfpndx_open_media_library',
										'class' 	=> 'nfproot-after-input nfpsmt-mail-test-description button secondary-button',
										'hidden' 	=> false,
										'content' 	=> __('Open Media Library','nutsforpress-indexing-and-seo'),
										'value'		=> wp_upload_dir()['baseurl'],
									
									),
								
								),
								'input-type' 		=> 'text',
								'input-value'		=> ''
								
							),	
							
							array(
							
								'container-title'	=> __('Use backup featured image for archive pages','nutsforpress-indexing-and-seo'),
							
								'container-id'		=> 'nfpndx_use_backup_featured_image_for_archives_container',
								'container-class' 	=> 'nfpndx-use-backup-featured-image-for-archives-container',					
								'input-name' 		=> 'nfproot_use_backup_featured_image_for_archives',
								'add-to-settings'	=> 'global',
								'data-save'			=> 'nfpndx',
								'input-id' 			=> 'nfpndx_use_backup_featured_image_for_archives',
								'input-class'		=> 'nfpndx-use-backup-featured-image-for-archives',
								'input-description' => __('If enabled, the above backup featured image will be included into archive pages sharing meta tags instead of the featured image of the first post','nutsforpress-indexing-and-seo'),
								'arrow-before'		=> false,
								'after-input'		=> '',
								'input-type' 		=> 'checkbox',
								'input-value'		=> ''
								
							),
													
						)
						
					),	
					
				),
				
			),
			
			array(
			
				'container-title'	=> __('Write meta on upload','nutsforpress-indexing-and-seo'),
				
				'container-id'		=> 'nfpndx_automatic_meta_container',
				'container-class' 	=> 'nfpndx-automatic-meta-container',
				'input-name'		=> 'nfproot_automatic_meta',
				'add-to-settings'	=> 'global',
				'data-save'			=> 'nfpndx',
				'input-id'			=> 'nfpndx_automatic_meta',
				'input-class'		=> 'nfpndx-automatic-meta',
				'input-description'	=> __('If switched on, "alt title", "description" and "excerpt" will be automatically filled out with a cleaned version of the title value; for example, "my_best_image" will turn to "my best image"','nutsforpress-indexing-and-seo'),
				'after-input'		=> '',
				'arrow-before'		=> false,
				'input-type' 		=> 'switch',
				'input-value'		=> '1',
				
				'childs'			=> array()
				
			),

			array(

				'container-title'	=> __('Bulk rewrite meta','nutsforpress-indexing-and-seo'),
				
				'container-id'		=> 'nfpndx_rebuild_meta_container',
				'container-class' 	=> 'nfpndx-rebuild-meta-container',
				'input-name'		=> 'nfproot_rebuild_meta',
				'add-to-settings'	=> false,
				'data-save'			=> 'nfpndx',
				'input-id'			=> 'nfpndx_rebuild_meta',
				'input-class'		=> 'nfpndx-rebuild-meta',
				'input-description'	=> '',
				'arrow-before'		=> true,
				'after-input'		=> array(
				
					array(
					
						'type' 		=> 'paragraph',
						'id' 		=> 'nfpndx_rebuild_meta_description',
						'class' 	=> 'nfproot-after-input nfpndx-rebuild-meta-description',
						'hidden' 	=> false,
						'content' 	=> __('Click on the arrow to display the bulk rewrite meta functions','nutsforpress-indexing-and-seo'),
						'value'		=> ''
					
					),
				
				),
				'input-type' 		=> 'arrow',
				'input-value'		=> '1',

				'childs'			=> array(

					array(
					
						'container-id'		=> 'nfpndx_rebuild_meta_button_container',
						'container-class' 	=> 'nfpndx-rebuild-meta-button-container',					
						'input-name' 		=> 'nfproot_rebuild_meta_button',
						'add-to-settings'	=> false,
						'data-save'			=> 'nfpndx',
						'input-id' 			=> 'nfpndx_rebuild_meta_button',
						'input-class'		=> 'nfpndx-rebuild-meta-button',
						'input-description' => '',
						'arrow-before'		=> false,
						'after-input'		=> array(
						
							array(
							
								'type' 		=> 'paragraph',
								'id' 		=> 'nfpndx_preparing_meta_rebuild',
								'class' 	=> 'nfproot-after-input nfproot-after-input-bold nfpndx-preparing-meta-rebuild',
								'hidden' 	=> true,
								'content' 	=> __('Calculating media to treat','nutsforpress-indexing-and-seo'),
								'value'		=> ''
							
							),
						
							array(
							
								'type' 		=> 'paragraph',
								'id' 		=> 'nfpndx_executing_meta_rebuild',
								'class' 	=> 'nfproot-after-input nfproot-after-input-bold nfpndx-executing-meta-rebuild',
								'hidden' 	=> true,
								'content' 	=> __('Now treating media','nutsforpress-indexing-and-seo').' <span class="nfpndx-executing-current-meta"></span> '.__('of','nutsforpress-indexing-and-seo').' <span class="nfpndx-executing-total-meta"></span>',
								'value'		=> ''
							
							),
							
							array(
							
								'type' 		=> 'paragraph',
								'id' 		=> 'nfpndx_ending_meta_rebuild',
								'class' 	=> 'nfproot-after-input nfproot-after-input-bold nfpndx-ending-meta-rebuild',
								'hidden' 	=> true,
								'content' 	=> __('Job Completed','nutsforpress-indexing-and-seo'),
								'value'		=> ''
							
							),
						
						),
						
						'input-type' 		=> 'button',
						'input-value'		=> __('Bulk rewrite meta','nutsforpress-indexing-and-seo'),					

					),				
					
					array(
					
						'container-title'	=> __('Rebuild all the attachments meta','nutsforpress-indexing-and-seo'),
						
						'container-id'		=> 'nfpndx_rebuild_all_meta_container',
						'container-class' 	=> 'nfpndx-rebuild-all-meta-container',					
						'input-name' 		=> 'nfproot_rebuild_all_meta',
						'add-to-settings'	=> false,
						'data-save'			=> 'nfpndx',
						'input-id' 			=> 'nfpndx_rebuild_all_meta',
						'input-class'		=> 'nfpndx-rebuild-all-meta',
						'input-description' => __('If switched on, all the meta will be rewritten, not only the ones with empty entries','nutsforpress-indexing-and-seo'),
						'arrow-before'		=> false,
						'after-input'		=> '',
						'input-type' 		=> 'checkbox',
						'input-value'		=> '1'					

					),	
					
				),
				
			),
			
			/*
			removed since WP 6.4
			the "remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles')" caused a total loss of the style
			
			array(
			
				'container-title'	=> __('Remove basic, global and block scripts and styles','nutsforpress-indexing-and-seo'),
				
				'container-id'		=> 'nfpndx_remove_scripts_and_styles_container',
				'container-class' 	=> 'nfpndx-remove-scripts-and-styles-container',
				'input-name'		=> 'nfproot_remove_scripts_and_styles',
				'add-to-settings'	=> 'global',
				'data-save'			=> 'nfpndx',
				'input-id'			=> 'nfpndx_remove_scripts_and_styles',
				'input-class'		=> 'nfpndx-remove-scripts-and-styles',
				'input-description'	=> __('If switched on, basic WordPress scripts and styles, like emoji, global style and the block editor main style are prevented from being equeued', 'nutsforpress-indexing-and-seo'),
				'arrow-before'		=> false,
				'after-input'		=> '',
				'input-type' 		=> 'switch',
				'input-value'		=> '1',					
				
			),		

			*/			
			
			array(
			
				'container-title'	=> __('Replace WordPress sitemap','nutsforpress-indexing-and-seo'),
				
				'container-id'		=> 'nfpndx_replace_sitemap_container',
				'container-class' 	=> 'nfpndx-replace-sitemap-container',
				'input-name'		=> 'nfproot_replace_sitemap',
				'add-to-settings'	=> 'global',
				'data-save'			=> 'nfpndx',
				'input-id'			=> 'nfpndx_replace_sitemap',
				'input-class'		=> 'nfpndx-replace-sitemap',
				'input-description'	=> sprintf(
					
						__('If switched on, default WordPress %s will be disabled, a better %s will be created and the sitemap link will be replaced into WordPress %s', 'nutsforpress-indexing-and-seo'), 
						'<a href="'.site_url().'/wp-sitemap.xml" target="_blank" title="Sitemap" alt="Sitemap" >sitemap</a>', 
						'<a href="'.site_url().'/sitemap.xml" target="_blank" title="Sitemap" alt="Sitemap">sitemap</a>',
						'<a href="'.site_url().'/robots.txt" target="_blank" title="Robots" alt="Robots">robots</a>'
						
					),
	
				'arrow-before'		=> true,
				'after-input'		=> '',
				'input-type' 		=> 'switch',
				'input-value'		=> '1',
				
				'childs'			=> array(

					array(
					
						'container-title'	=> __('Custom Post Types single pages','nutsforpress-indexing-and-seo'),
					
						'container-id'		=> 'nfpndx_cpt_single_pages_container',
						'container-class' 	=> 'nfpndx-cpt-single-pages-container',					
						'input-name' 		=> 'nfproot_cpt_single_pages',
						'add-to-settings'	=> 'global',
						'data-save'			=> 'nfpndx',
						'input-id' 			=> 'nfpndx_cpt_single_pages',
						'input-class'		=> 'nfpndx-cpt-single-pages',
						'input-description' => __('Include public Custom Post Types single pages into sitemap','nutsforpress-indexing-and-seo'),
						'arrow-before'		=> false,
						'input-type' 		=> 'checkbox',
						'input-value'		=> ''
						
					),	
									
					array(
					
						'container-title'	=> __('Taxonomies terms archive pages','nutsforpress-indexing-and-seo'),
					
						'container-id'		=> 'nfpndx_taxonomy_term_archive_pages_container',
						'container-class' 	=> 'nfpndx-taxonomy-term-archive-pages-container',					
						'input-name' 		=> 'nfproot_taxonomy_term_archive_pages',
						'add-to-settings'	=> 'global',
						'data-save'			=> 'nfpndx',
						'input-id' 			=> 'nfpndx_taxonomy_term_archive_pages',
						'input-class'		=> 'nfpndx-taxonomy-term-archive-pages',
						'input-description' => __('Include all the existing archive pages for terms of taxonomies into sitemap','nutsforpress-indexing-and-seo'),
						'arrow-before'		=> true,
						'input-type' 		=> 'switch',
						'input-value'		=> '',
						
						'childs'			=> array(

							array(
							
								'container-title'	=> __('Skip empty terms','nutsforpress-indexing-and-seo'),
							
								'container-id'		=> 'nfpndx_skip_empty_terms_container',
								'container-class' 	=> 'nfpndx-skip-empty-terms-container',					
								'input-name' 		=> 'nfproot_skip_empty_terms',
								'add-to-settings'	=> 'global',
								'data-save'			=> 'nfpndx',
								'input-id' 			=> 'nfpndx_skip_empty_terms',
								'input-class'		=> 'nfpndx-skip-empty-terms',
								'input-description' => __('Do not include into sitemap the existing archive pages for terms that have no posts','nutsforpress-indexing-and-seo'),
								'arrow-before'		=> false,
								'input-type' 		=> 'checkbox',
								'input-value'		=> ''
								
							),

							array(
							
								'container-title'	=> __('Skip custom taxonomies terms','nutsforpress-indexing-and-seo'),
							
								'container-id'		=> 'nfpndx_skip_custom_taxonomies_container',
								'container-class' 	=> 'nfpndx-skip-custom-taxonomies-container',					
								'input-name' 		=> 'nfproot_skip_custom_taxonomies',
								'add-to-settings'	=> 'global',
								'data-save'			=> 'nfpndx',
								'input-id' 			=> 'nfpndx_skip_custom_taxonomies',
								'input-class'		=> 'nfpndx-skip-custom-taxonomies',
								'input-description' => __('Do not include into sitemap the existing archive pages for terms of custom taxonomies','nutsforpress-indexing-and-seo'),
								'arrow-before'		=> false,
								'input-type' 		=> 'checkbox',
								'input-value'		=> ''
								
							),	
							

							
						),
						
					),

					array(
					
						'container-title'	=> __('Authors profile pages','nutsforpress-indexing-and-seo'),
					
						'container-id'		=> 'nfpndx_author_profile_pages_container',
						'container-class' 	=> 'nfpndx-author-profile-pages-container',					
						'input-name' 		=> 'nfproot_author_profile_pages',
						'add-to-settings'	=> 'global',
						'data-save'			=> 'nfpndx',
						'input-id' 			=> 'nfpndx_author_profile_pages',
						'input-class'		=> 'nfpndx-author-profile-pages',
						'input-description' => __('Include Authors profile pages into sitemap','nutsforpress-indexing-and-seo'),
						'arrow-before'		=> false,
						'input-type' 		=> 'checkbox',
						'input-value'		=> ''
						
					),						

											
				)
				
			),
			
			array(
			
				'container-title'	=> __('Allow no index for pages and posts','nutsforpress-indexing-and-seo'),
				
				'container-id'		=> 'nfpndx_no_index_container',
				'container-class' 	=> 'nfpndx-no-index-container',
				'input-name'		=> 'nfproot_no_index',
				'add-to-settings'	=> 'global',
				'data-save'			=> 'nfpndx',
				'input-id'			=> 'nfpndx_no_index',
				'input-class'		=> 'nfpndx-no-index',
				'input-description'	=> __('If switched on, a checkbox is added to pages and posts editor and, where the checkbox is flagged, a meta no index is added to the post or the page haeder', 'nutsforpress-indexing-and-seo'),
				'arrow-before'		=> false,
				'after-input'		=> '',
				'input-type' 		=> 'switch',
				'input-value'		=> '1',					
				
			),
			
			array(
			
				'container-title'	=> __('Head scripts','nutsforpress-indexing-and-seo'),
				
				'container-id'		=> 'nfpndx_head_scripts_container',
				'container-class' 	=> 'nfpndx-head-scripts-container',
				'input-name'		=> 'nfproot_head_scripts',
				'add-to-settings'	=> 'global',
				'data-save'			=> 'nfpndx',
				'input-id'			=> 'nfpndx_head_scripts',
				'input-class'		=> 'nfpndx-head-scripts',
				'input-description'	=> __('If switched on, the code in the textarea below will be added to the head section', 'nutsforpress-indexing-and-seo'),
				'arrow-before'		=> true,
				'after-input'		=> '',
				'input-type' 		=> 'switch',
				'input-value'		=> '1',	

				'childs'			=> array(
				
					array(
					
						'container-title'	=> __('Enter the code that you want to add to the head section','nutsforpress-indexing-and-seo'),
					
						'container-id'		=> 'nfpndx_head_code_container',
						'container-class' 	=> 'nfpndx-head-code-container',					
						'input-name' 		=> 'nfproot_head_code',
						'add-to-settings'	=> 'global',
						'data-save'			=> 'nfpndx',
						'input-id' 			=> 'nfpndx_head_code',
						'input-class'		=> 'nfpndx-head-code',
						'input-description' => __('The above code will be added to the head section of your website: be very careful since a wrong code can break your entire website','nutsforpress-indexing-and-seo'),
						'arrow-before'		=> false,
						'after-input'		=> '',
						'input-type' 		=> 'textarea',
						'input-value'		=> '',	

					),

					array(
					
						'container-title'	=> __('Skip when a user with role of admin is logged in','nutsforpress-indexing-and-seo'),
					
						'container-id'		=> 'nfpndx_skip_head_code_container',
						'container-class' 	=> 'nfpndx-skip-head-code-container',					
						'input-name' 		=> 'nfproot_skip_head_code',
						'add-to-settings'	=> 'global',
						'data-save'			=> 'nfpndx',
						'input-id' 			=> 'nfpndx_skip_head_code',
						'input-class'		=> 'nfpndx-skip-head-code',
						'input-description' => __('The above code will not be added to the head section of the website when a user with role of admin is logged in','nutsforpress-indexing-and-seo'),
						'arrow-before'		=> false,
						'after-input'		=> '',
						'input-type' 		=> 'checkbox',
						'input-value'		=> ''
						
					),				
					
				),					
				
			),
			
			array(
			
				'container-title'	=> __('Body scripts','nutsforpress-indexing-and-seo'),
				
				'container-id'		=> 'nfpndx_body_scripts_container',
				'container-class' 	=> 'nfpndx-body-scripts-container',
				'input-name'		=> 'nfproot_body_scripts',
				'add-to-settings'	=> 'global',
				'data-save'			=> 'nfpndx',
				'input-id'			=> 'nfpndx_body_scripts',
				'input-class'		=> 'nfpndx-body-scripts',
				'input-description'	=> __('If switched on, the code in the textarea below will be added to the body section', 'nutsforpress-indexing-and-seo'),
				'arrow-before'		=> true,
				'after-input'		=> '',
				'input-type' 		=> 'switch',
				'input-value'		=> '1',	

				'childs'			=> array(
				
					array(
					
						'container-title'	=> __('Enter the code that you want to add to the body section','nutsforpress-indexing-and-seo'),
					
						'container-id'		=> 'nfpndx_body_code_container',
						'container-class' 	=> 'nfpndx-body-code-container',					
						'input-name' 		=> 'nfproot_body_code',
						'add-to-settings'	=> 'global',
						'data-save'			=> 'nfpndx',
						'input-id' 			=> 'nfpndx_body_code',
						'input-class'		=> 'nfpndx-body-code',
						'input-description' => __('The above code will be added to the body section of your website: be very careful since a wrong code can break your entire website','nutsforpress-indexing-and-seo'),
						'arrow-before'		=> false,
						'after-input'		=> '',
						'input-type' 		=> 'textarea',
						'input-value'		=> '',	

					),

					array(
					
						'container-title'	=> __('Skip when a user with role of admin is logged in','nutsforpress-indexing-and-seo'),
					
						'container-id'		=> 'nfpndx_skip_body_code_container',
						'container-class' 	=> 'nfpndx-skip-body-code-container',					
						'input-name' 		=> 'nfproot_skip_body_code',
						'add-to-settings'	=> 'global',
						'data-save'			=> 'nfpndx',
						'input-id' 			=> 'nfpndx_skip_body_code',
						'input-class'		=> 'nfpndx-skip-body-code',
						'input-description' => __('The above code will not be added to the body section of the website when a user with role of admin is logged in','nutsforpress-indexing-and-seo'),
						'arrow-before'		=> false,
						'after-input'		=> '',
						'input-type' 		=> 'checkbox',
						'input-value'		=> ''
						
					),				
					
				),					
				
			),
			
			array(
			
				'container-title'	=> __('Footer scripts','nutsforpress-indexing-and-seo'),
				
				'container-id'		=> 'nfpndx_footer_scripts_container',
				'container-class' 	=> 'nfpndx-footer-scripts-container',
				'input-name'		=> 'nfproot_footer_scripts',
				'add-to-settings'	=> 'global',
				'data-save'			=> 'nfpndx',
				'input-id'			=> 'nfpndx_footer_scripts',
				'input-class'		=> 'nfpndx-footer-scripts',
				'input-description'	=> __('If switched on, the code in the textarea below will be added to the footer section', 'nutsforpress-indexing-and-seo'),
				'arrow-before'		=> true,
				'after-input'		=> '',
				'input-type' 		=> 'switch',
				'input-value'		=> '1',	

				'childs'			=> array(
				
					array(
					
						'container-title'	=> __('Enter the code that you want to add to the footer section','nutsforpress-indexing-and-seo'),
					
						'container-id'		=> 'nfpndx_footer_code_container',
						'container-class' 	=> 'nfpndx-footer-code-container',					
						'input-name' 		=> 'nfproot_footer_code',
						'add-to-settings'	=> 'global',
						'data-save'			=> 'nfpndx',
						'input-id' 			=> 'nfpndx_footer_code',
						'input-class'		=> 'nfpndx-footer-code',
						'input-description' => __('The above code will be added to the footer section of your website: be very careful since a wrong code can break your entire website','nutsforpress-indexing-and-seo'),
						'arrow-before'		=> false,
						'after-input'		=> '',
						'input-type' 		=> 'textarea',
						'input-value'		=> '',	

					),

					array(
					
						'container-title'	=> __('Skip when a user with role of admin is logged in','nutsforpress-indexing-and-seo'),
					
						'container-id'		=> 'nfpndx_skip_footer_code_container',
						'container-class' 	=> 'nfpndx-skip-footer-code-container',					
						'input-name' 		=> 'nfproot_skip_footer_code',
						'add-to-settings'	=> 'global',
						'data-save'			=> 'nfpndx',
						'input-id' 			=> 'nfpndx_skip_footer_code',
						'input-class'		=> 'nfpndx-skip-footer-code',
						'input-description' => __('The above code will not be added to the footer section of the website when a user with role of admin is logged in','nutsforpress-indexing-and-seo'),
						'arrow-before'		=> false,
						'after-input'		=> '',
						'input-type' 		=> 'checkbox',
						'input-value'		=> ''
						
					),				
					
				),					
				
			),
				
		);
						
		return $nfpndx_settings_content;
		
	}
	
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_settings_content" already exists');
	
}