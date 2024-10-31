<?php
 //if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

if(!function_exists('nfpndx_add_title_and_description_metaboxes')){

	function nfpndx_add_title_and_description_metaboxes() {

		//get options 
		global $nfproot_current_language_settings;

		//if title and description is enabled
		if(

			!empty($nfproot_current_language_settings['nfpndx']['nfproot_title_description'])
			&& $nfproot_current_language_settings['nfpndx']['nfproot_title_description'] === '1'
								
		) {
			
			//get all public post types
			$nfpndx_all_post_types = get_post_types(array('public' => true));
			
			//add title metabox
			add_meta_box( 
			
				'nfpndx-title', 
				__('Title','nutsforpress-indexing-and-seo'), 
				'nfpndx_title_metabox_content', 
				$nfpndx_all_post_types,
				'side',
				'default'
			
			);	

			//add title metabox
			add_meta_box(
			
				'nfpndx-description', 
				__('Description','nutsforpress-indexing-and-seo'), 
				'nfpndx_description_metabox_content', 
				$nfpndx_all_post_types,
				'side',
				'default'
				
			);	

		}			

	}


} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_add_title_and_description_metaboxes" already exists');
	
}

if(!function_exists('nfpndx_title_metabox_content')) {
	
	function nfpndx_title_metabox_content($nfpndx_post_object) {
		
		if(empty(get_the_ID())) {
			
			return;
			
		}
		
		$nfpndx_current_post_id = get_the_ID();
		
		$nfpndx_title = esc_attr(get_post_meta($nfpndx_current_post_id, '_nfpndx_meta_title', true));
		
		$nfpndx_title_blogname = esc_attr(get_post_meta($nfpndx_current_post_id, '_nfpndx_meta_title_blogname', true));
		
		if($nfpndx_title_blogname === '0') {
			
			$nfpndx_title_blogname_checked = null;
			
		} else {
			
			$nfpndx_title_blogname_checked = 'checked';
			
		}		
		
		$nfpndx_blog_name = get_bloginfo('name');
		
		?>

		<label for="nfpndx-title"><?php echo __('These 70 chars represent the content of your title tag','nutsforpress-indexing-and-seo'); ?><br><br>
		<textarea id="nfpndx-title" name="nfpndx-title" class="nfpndx-title" style="width:100%; "rows="3" maxlength="70"><?php echo $nfpndx_title; ?></textarea>
		</label>
		
		<?php
		if(!empty($nfpndx_blog_name)) {
			?>
			<br><br>
			<?php echo __('Add','nutsforpress-indexing-and-seo'); ?>  <?php echo '"<strong>'.$nfpndx_blog_name.'</strong>"'; ?> <?php echo __('to the above title','nutsforpress-indexing-and-seo'); ?> <?php echo __('so that your page title becames','nutsforpress-indexing-and-seo'); ?>: <em>"<?php echo __('your title','nutsforpress-indexing-and-seo'); ?></em> | <em><?php echo __('your sitename','nutsforpress-indexing-and-seo'); ?>"</em> <br><br>
			<input type="checkbox" name="nfpndx-title-blogname" class="nfproot-switch" id="nfpndx-title-blogname-checkbox" value="1" <?php echo $nfpndx_title_blogname_checked; ?> />
			<label for="nfpndx-title-blogname-checkbox">&nbsp;</label>			
			
			<?php
		}
		?>

		<input type="hidden" value="<?php echo wp_create_nonce('nfpndx-title-tag-nonce'); ?>" id="nfpndx-title-tag-nonce" name="nfpndx-title-tag-nonce">

		<?php
	}

} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_title_metabox_content" already exists');
	
}

if(!function_exists('nfpndx_description_metabox_content')) {
	
	function nfpndx_description_metabox_content($nfpndx_post_object) {
		
		if(empty(get_the_ID())) {
			
			return;
			
		}
		
		$nfpndx_current_post_id = get_the_ID();
		
		$nfpndx_description = esc_attr(get_post_meta($nfpndx_current_post_id, '_nfpndx_meta_description', true));
		
		?>

		<label for="nfpndx-description"><?php echo __('These 160 chars represent the content of your meta description tag','nutsforpress-indexing-and-seo'); ?><br><br>
		<textarea id="nfpndx-description" name="nfpndx-description" class="nfpndx-description" style="width:100%"; rows="5" maxlength="160"><?php echo $nfpndx_description; ?></textarea>
		</label>
		
		<input type="hidden" value="<?php echo wp_create_nonce('nfpndx-description-tag-nonce'); ?>" id="nfpndx-description-tag-nonce" name="nfpndx-description-tag-nonce">

		<?php
	}

} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpndx_description_metabox_content" already exists');
	
}