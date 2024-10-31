<?php
/*
Plugin Name: 	NutsForPress Indexing and SEO
Plugin URI:		https://www.nutsforpress.com/
Description: 	NutsForPress Indexing and SEO is an essential tool that improves your site indexing and helps you in your search engine optimization. 
Version:     	2.3
Author:			Christian Gatti
Author URI:		https://profiles.wordpress.org/christian-gatti/
License:		GPL-2.0+
License URI:	http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain:	nutsforpress-indexing-and-seo
*/

//if this file is called directly, die.
if(!defined('ABSPATH')) die('please, do not call this page directly');


//DEFINITIONS

if(!defined('NFPROOT_BASE_RELATIVE')) {define('NFPROOT_BASE_RELATIVE', dirname(plugin_basename( __FILE__ )).'/root');}
define('NFPNDX_BASE_PATH', plugin_dir_path( __FILE__ ));
define('NFPNDX_BASE_URL', plugins_url().'/'.plugin_basename( __DIR__ ).'/');
define('NFPNDX_BASE_RELATIVE', dirname( plugin_basename( __FILE__ )));
define('NFPNDX_DEBUG', false);


//NUTSFORPRESS ROOT CONTENT
	
//add NutsForPress parent menu page
require_once NFPNDX_BASE_PATH.'root/nfproot-settings.php';
add_action('admin_menu', 'nfproot_settings');

//add NutsForPress save settings function and make it available through ajax
require_once NFPNDX_BASE_PATH.'root/nfproot-save-settings.php';
add_action('wp_ajax_nfproot_save_settings', 'nfproot_save_settings');

//add NutsForPress saved settings and make them available through the global varibales $nfproot_current_language_settings and $nfproot_options_name
require_once NFPNDX_BASE_PATH.'root/nfproot-saved-settings.php';
add_action('plugins_loaded', 'nfproot_saved_settings');

//register NutsForPress styles and scripts
require_once NFPNDX_BASE_PATH.'root/nfproot-styles-and-scripts.php';
add_action('admin_enqueue_scripts', 'nfproot_styles_and_scripts');
	
//add NutsForPress settings structure that contains nfproot_options_structure function invoked by plugin settings
require_once NFPNDX_BASE_PATH.'root/nfproot-settings-structure.php';


//PLUGIN INCLUDES

//add activate actions
require_once NFPNDX_BASE_PATH.'includes/nfpndx-plugin-activate.php';
register_activation_hook(__FILE__, 'nfpndx_plugin_activate');

//add deactivate actions
require_once NFPNDX_BASE_PATH.'includes/nfpndx-plugin-deactivate.php';
register_deactivation_hook(__FILE__, 'nfpndx_plugin_deactivate');

//add uninstall actions
require_once NFPNDX_BASE_PATH.'includes/nfpndx-plugin-uninstall.php';
register_uninstall_hook(__FILE__, 'nfpndx_plugin_uninstall');

//styles and scripts
require_once NFPNDX_BASE_PATH.'includes/nfpndx-styles-and-scripts.php';
add_action('admin_enqueue_scripts', 'nfpndx_styles_and_scripts');


//PLUGIN SETTINGS

//add plugin settings
require_once NFPNDX_BASE_PATH.'admin/nfpndx-settings.php';
add_action('admin_menu', 'nfpndx_settings');


//ADMIN INCLUDES CONDITIONALLY

require_once NFPNDX_BASE_PATH.'admin/includes/nfpndx-add-title-and-description-metaboxes.php';
add_action('add_meta_boxes', 'nfpndx_add_title_and_description_metaboxes');

require_once NFPNDX_BASE_PATH.'admin/includes/nfpndx-add-no-index-metabox.php';
add_action('add_meta_boxes', 'nfpndx_add_no_index_metabox');

require_once NFPNDX_BASE_PATH.'admin/includes/nfpndx-save-title-and-description-metaboxes.php';
add_action('save_post', 'nfpndx_save_title_and_description_metaboxes');

require_once NFPNDX_BASE_PATH.'admin/includes/nfpndx-save-no-index-metabox.php';
add_action('save_post', 'nfpndx_save_no_index_metabox');

require_once NFPNDX_BASE_PATH.'admin/includes/nfpndx-add-summary-to-post-list-columns.php';
add_action('manage_posts_custom_column', 'nfpndx_add_summary_to_post_list_columns', 10, 2);
add_action('manage_pages_custom_column', 'nfpndx_add_summary_to_post_list_columns', 10, 2);

require_once NFPNDX_BASE_PATH.'admin/includes/nfpndx-meta-rebuild.php';
add_action('wp_ajax_nfpndx_meta_rebuild', 'nfpndx_meta_rebuild');

require_once NFPNDX_BASE_PATH.'admin/includes/nfpndx-set-attachment-meta.php';
add_action('add_attachment', 'nfpndx_set_attachment_meta');

require_once NFPNDX_BASE_PATH.'admin/includes/nfpndx-wpml-attachment-duplicate.php';
add_action('wpml_media_create_duplicate_attachment', 'nfpndx_wpml_attachment_duplicate',10, 2);


//PUBLIC INCLUDES CONDITIONALLY

require_once NFPNDX_BASE_PATH.'public/includes/nfpndx-add-title-metatag.php';
add_action('wp', 'nfpndx_add_title_metatag');

require_once NFPNDX_BASE_PATH.'public/includes/nfpndx-add-description-metatag.php';
add_action('wp_head', 'nfpndx_add_description_metatag');

require_once NFPNDX_BASE_PATH.'public/includes/nfpndx-add-no-index-metatag.php';
add_action('wp_head', 'nfpndx_add_no_index_metatag');

require_once NFPNDX_BASE_PATH.'public/includes/nfpndx-add-sharing-metatags.php';
add_action('wp_head', 'nfpndx_add_sharing_metatags');

require_once NFPNDX_BASE_PATH.'public/includes/nfpndx-add-head-scripts.php';
add_action('wp_head', 'nfpndx_add_head_scripts');

require_once NFPNDX_BASE_PATH.'public/includes/nfpndx-add-body-scripts.php';
add_action('wp_body_open', 'nfpndx_add_body_scripts');

require_once NFPNDX_BASE_PATH.'public/includes/nfpndx-add-footer-scripts.php';
add_action('wp_footer', 'nfpndx_add_footer_scripts');

require_once NFPNDX_BASE_PATH.'public/includes/nfpndx-remove-wp-sitemap.php';
add_action('plugins_loaded', 'nfpndx_remove_wp_sitemap');

require_once NFPNDX_BASE_PATH.'public/includes/nfpndx-add-sitemap.php';
add_action('template_redirect', 'nfpndx_add_sitemap');

require_once NFPNDX_BASE_PATH.'public/includes/nfpndx-remove-scripts-and-styles.php';
add_action('init', 'nfpndx_remove_scripts_and_styles');

//override style in post and page tables
if(!function_exists('nfpndx_set_summary_column_width')) {
	
	function nfpndx_set_summary_column_width() {
		
		echo '
			<style type="text/css">
			#nfpndx_nutsforpress_summary {
				width:220px;
			}
			</style>
	   ';
		
	}

	add_action('admin_head', 'nfpndx_set_summary_column_width');
	
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_set_summary_column_width" already exists');
	
}