<?php
 //if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

if(!function_exists('nfpndx_add_head_scripts')){

	function nfpndx_add_head_scripts() {

		//get options 
		global $nfproot_current_language_settings;

		//if title and description is enabled
		if(

			!empty($nfproot_current_language_settings['nfpndx']['nfproot_head_scripts'])
			&& $nfproot_current_language_settings['nfpndx']['nfproot_head_scripts'] === '1'
			&& !empty($nfproot_current_language_settings['nfpndx']['nfproot_head_code'])
								
		) {
			
			if(
			
				is_admin()
				
				|| (
				
					is_admin() === false
					&& is_user_logged_in()
					&& current_user_can('manage_options')
					&& !empty($nfproot_current_language_settings['nfpndx']['nfproot_skip_head_code'])
					&& $nfproot_current_language_settings['nfpndx']['nfproot_skip_head_code'] === '1'
				
				)
				
			){
				
				return;

				
			}
			
			$nfpndx_head_code = html_entity_decode($nfproot_current_language_settings['nfpndx']['nfproot_head_code']);
			
			echo "\n".$nfpndx_head_code."\n";

		}			

	}


} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_add_head_scripts" already exists');
	
}