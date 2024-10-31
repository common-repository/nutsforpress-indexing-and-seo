<?php
//if this file is called directly, die.
if(!defined('ABSPATH')) die('please, do not call this page directly');

//with this function we will create the NutsForPress menu page
if(!function_exists('nfpndx_settings')) {
	
	function nfpndx_settings() {	
		
		global $nfproot_root_settings;
		$nfpndx_pro = null;
		
		if(
		
			!empty($nfproot_root_settings) 
			&& !empty($nfproot_root_settings['installed_plugins']['nfpndx']['edition'])
			&& $nfproot_root_settings['installed_plugins']['nfpndx']['edition'] === 'registered'
			
		) {
			
			$nfpndx_pro = ' <span class="dashicons dashicons-saved"></span>';
			
		}
		
		add_submenu_page(
	
			'nfproot-settings',
			'Indexing and SEO',
			'Indexing and SEO'.$nfpndx_pro,
			'manage_options',
			'nfpndx-settings',
			'nfpndx_settings_callback'
		
		);
		
		
	}
	
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_base_options" already exists');
	
}
	
//with this function we will define the NutsForPress menu page content
if(!function_exists('nfpndx_settings_callback')) {
	
	function nfpndx_settings_callback() {
		
		?>
		
		<div class="wrap nfproot-settings-wrap">
			
			<h1>Indexing and SEO settings</h1>
			
			<div class="nfproot-settings-main-container">
		
				<?php
				
				//include option content page
				require_once NFPNDX_BASE_PATH.'admin/nfpndx-settings-content.php';
				
				//define contents as result of the function nfpndx_settings_content
				$nfpndx_settings_content = nfpndx_settings_content();
				
				//invoke nfproot_options_structure functions included into /root/options/nfproot-options-structure.php
				nfproot_settings_structure($nfpndx_settings_content);
				
				?>
			
			</div>
		
		</div>
		
		<?php
		
	}
	
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_settings" already exists');
	
}