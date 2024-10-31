jQuery(document).ready(function(){
	
	//define a variable nfpndxMedia
	var nfpndxMedia;

	jQuery('#nfpndx_open_media_library').click(function() {
	
		//if the upload object has already been created, reopen the dialog
		if(nfpndxMedia) {
			
			nfpndxMedia.open();
			return;
			
		}
	
		//extend the wp.media object
		nfpndxMedia = wp.media.frames.file_frame = wp.media({
		
			title: 'Select media',
			button: {text: 'Select media'}, 
			multiple: false 
	
		});

		//when a file is selected, grab the URL and set it as the text field's value
		nfpndxMedia.on('select', function() {
		
			var nfpndxAttachment = nfpndxMedia.state().get('selection').first().toJSON();
			
			var nfpndxAttachmentUrl = nfpndxAttachment.url;
			var nfpndxAttachmentBaseurl = jQuery('#nfpndx_open_media_library').val();
			var nfpndxAttachmentUrlStripped = nfpndxAttachmentUrl.replace(nfpndxAttachmentBaseurl, "");
						
			//enter filename and dir
			jQuery('#nfpndx_backup_featured_image').val(nfpndxAttachmentUrlStripped);
			
			//trigger change
			jQuery('#nfpndx_backup_featured_image').trigger('change');
		
		});
	
		//open the upload dialog
		nfpndxMedia.open();
	
	});
	
});