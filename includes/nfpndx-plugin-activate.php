<?php
 //if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

//ACTIVATE

//plugin activate function
if(!function_exists('nfpndx_plugin_activate')){

	function nfpndx_plugin_activate() {
				
		//get NutsForPress setting
		global $nfproot_plugins_settings;
		
		//define plugin installaton type
		$nfproot_plugins_settings['nfpndx']['prefix'] = 'nfpndx';
		$nfproot_plugins_settings['nfpndx']['slug'] = 'nfpndx-settings';
		$nfproot_plugins_settings['nfpndx']['edition'] = 'repository';
		$nfproot_plugins_settings['nfpndx']['name'] = 'Indexing and SEO';
		
		//update NutsForPress setting
		update_option('_nfproot_plugins_settings', $nfproot_plugins_settings, false);
		
		//get postmeta values from Optenhanse and translate them to NutsForPress
		global $wpdb;
		$nfpndx_postmeta_table_name = $wpdb->prefix.'postmeta';
	
		$nfpndx_convert_title = "
		
			UPDATE $nfpndx_postmeta_table_name 
			SET meta_key = '_nfpndx_meta_title'
			WHERE meta_key = '_ptnns_meta_title'
			
		;";
		
		$nfpndx_convert_title_blogname = "
		
			UPDATE $nfpndx_postmeta_table_name 
			SET meta_key = '_nfpndx_meta_title_blogname'
			WHERE meta_key = '_ptnns_meta_title_blogname'
			
		;";
		
		$nfpndx_convert_description = "
		
			UPDATE $nfpndx_postmeta_table_name 
			SET meta_key = '_nfpndx_meta_description'
			WHERE meta_key = '_ptnns_meta_description'
			
		;";
		
		$nfpndx_convert_no_index = "
		
			UPDATE $nfpndx_postmeta_table_name 
			SET meta_key = '_nfpndx_no_index'
			WHERE meta_key = '_ptnns_no_index'
			
		;";
	
		$wpdb->query($nfpndx_convert_title);
		$wpdb->query($nfpndx_convert_title_blogname);
		$wpdb->query($nfpndx_convert_description);
		$wpdb->query($nfpndx_convert_no_index);
	
	}
		
}  else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_plugin_activate" already exists');
	
}