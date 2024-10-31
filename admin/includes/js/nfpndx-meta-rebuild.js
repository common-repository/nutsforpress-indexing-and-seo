jQuery(document).ready(function() {
	
	//bind rebuild meta button
	jQuery('#nfpndx_rebuild_meta_button').click(function(){
		
		jQuery('.nfpndx-ending-meta-rebuild').hide();
		jQuery('.nfpndx-preparing-meta-rebuild').show();
		jQuery('#nfpndx_rebuild_meta_button').prop('disabled', true);
		
		var nfpndx_rebuild_all_meta = 0;
		if(jQuery('#nfpndx_rebuild_all_meta').prop('checked') === true) {
			
			nfpndx_rebuild_all_meta = 1;
		}
				
		var nfpndx_rebuild_pdf_meta = 0;
		if(jQuery('#nfpndx_rebuild_pdf_meta').prop('checked') === true) {
			
			nfpndx_rebuild_pdf_meta = 1;
			
		}
	
		//get media to work with
		jQuery.ajax({
			type: 'POST',
			dataType: 'json',
			url: nfpndx_meta_rebuild_object.nfpndx_meta_rebuild_url,
			data: {
				'action': 'nfpndx_meta_rebuild',
				'nfpndx_meta_rebuild_nonce': nfpndx_meta_rebuild_object.nfpndx_meta_rebuild_nonce,
				'nfpndx_rebuild_all_meta': nfpndx_rebuild_all_meta
			},
			
			//deal with success
			success:function(data){
				
				//count ids
				var nfpndxEntriesToWorkWith = data.length;
				
				if(nfpndxEntriesToWorkWith === 0) {
					
					//no image needs to be treated
					jQuery('.nfpndx-preparing-meta-rebuild').hide();
					jQuery('.nfpndx-ending-meta-rebuild').show();
					jQuery('#nfpndx_rebuild_meta_button').prop('disabled', false);
					//console.log("no image to work with");
					return;
					
				} else {
					
					nfpndxEntriesToWorkWith = data['id'].length;
					
					jQuery('.nfpndx-preparing-meta-rebuild').hide();
					jQuery('.nfpndx-executing-current-meta').text('1');
					jQuery('.nfpndx-executing-total-meta').text(nfpndxEntriesToWorkWith);
					jQuery('.nfpndx-executing-meta-rebuild').show();
					
					//console.log(nfpndxEntriesToWorkWith+' meta to work with');
					
				}
							
												
				//define a viariable to count loops
				var nfpndxRebuildReiterances = 0;				
				
				function nfpndxRebuildMeta(nfpndxEntriesToWorkWith,nfpndxRebuildReiterances) {

					var nfpndxImagesIds = data['id'];

					var nfpndxInvolvedImageId = nfpndxImagesIds[nfpndxRebuildReiterances];

					//console.log(nfpndxRebuildReiterances+": treating "+nfpndxInvolvedImageId);		
								
					jQuery.ajax({
						type: 'POST',
						dataType: 'json',
						url: nfpndx_meta_rebuild_object.nfpndx_meta_rebuild_url,
						data: {
							'action': 'nfpndx_meta_rebuild',
							'nfpndx_meta_rebuild_nonce': nfpndx_meta_rebuild_object.nfpndx_meta_rebuild_nonce,
							'nfpndx_rebuild_all_meta': nfpndx_rebuild_all_meta,
							'nfpndx_current_image_id': nfpndxInvolvedImageId
						},
						
						//deal with success
						success:function(data) {
							
							nfpndxRebuildReiterances++;
																
							if(nfpndxRebuildReiterances < nfpndxEntriesToWorkWith) {
								
								setTimeout(function() {
								
									jQuery('.nfpndx-executing-current-meta').text(nfpndxRebuildReiterances+1);																
									nfpndxRebuildMeta(nfpndxEntriesToWorkWith,nfpndxRebuildReiterances);
									
								}, 125);									
							
							}
							
							else if(nfpndxRebuildReiterances === nfpndxEntriesToWorkWith) {

								jQuery('#nfpndx_rebuild_meta_button').prop('disabled', false);
								jQuery('.nfpndx-executing-meta-rebuild').hide();
								jQuery('.nfpndx-ending-meta-rebuild').show();
								
								//console.log("job completed")
								return;								
								
							}
							
						},
						
						//deal with errors
						error: function(errorThrown){
							console.log(errorThrown);
						},

					}); 
				
				};
									
				nfpndxRebuildMeta(nfpndxEntriesToWorkWith,nfpndxRebuildReiterances);

										
			},
			
			error: function(errorThrown){
				console.log(errorThrown);
			}
			
		});		
		
		
	})
              
});