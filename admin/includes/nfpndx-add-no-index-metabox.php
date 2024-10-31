<?php
 //if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

if(!function_exists('nfpndx_add_no_index_metabox')){

	function nfpndx_add_no_index_metabox() {

		//get options 
		global $nfproot_current_language_settings;

		//if no index is enabled
		if(

			!empty($nfproot_current_language_settings['nfpndx']['nfproot_no_index'])
			&& $nfproot_current_language_settings['nfpndx']['nfproot_no_index'] === '1'
								
		) {
			
			//get all public post types
			$nfpndx_all_post_types = get_post_types(array('public' => true));
			
			//add no index metabox
			add_meta_box( 
			
				'nfpndx-no-index', 
				__('No Index','nutsforpress-indexing-and-seo'), 
				'nfpndx_no_index_meta_box_content', 
				$nfpndx_all_post_types,
				'side',
				'default'
			
			);	

		}			

	}


} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_add_no_index_metabox" already exists');
	
}

if(!function_exists('nfpndx_no_index_meta_box_content')) {
	
	function nfpndx_no_index_meta_box_content($nfpndx_post_object) {
		
		if(empty(get_the_ID())) {
			
			return;
			
		}
		
		$nfpndx_current_post_id = get_the_ID();
		
		$nfpndx_no_index = esc_attr(get_post_meta($nfpndx_current_post_id, '_nfpndx_no_index', true));
				
		if($nfpndx_no_index === '1') {
			
			$nfpndx_no_index_checked = 'checked';
			
		} else {
			
			$nfpndx_no_index_checked = null;
		}
		
		?>
		
		<?php echo __('Flag this checkbox if you want that add "noindex" meta to this page','nutsforpress-indexing-and-seo'); ?><br><br>
		
		<input type="checkbox" name="nfpndx-no-index" class="nfproot-switch" id="nfpndx-no-index-checkbox" value="1" <?php echo $nfpndx_no_index_checked; ?> />
		<label for="nfpndx-no-index-checkbox">&nbsp;</label>
		<input type="hidden" value="<?php echo wp_create_nonce('nfpndx-no-index-tag-nonce'); ?>" id="nfpndx-no-index-tag-nonce" name="nfpndx-no-index-tag-nonce">

		<?php
	}

} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_no_index_meta_box_content" already exists');
	
}