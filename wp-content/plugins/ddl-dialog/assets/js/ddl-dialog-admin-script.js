(function( $ ) {

	'use strict';

	$(function() {

    let addDialog = document.querySelector('#addDialog');

		if (addDialog) {

			addDialog.addEventListener('click', function() {
				let number = addDialog.getAttribute('data-number');

				let row = `<div class="dialog__row"><input type="number" name="dialogPageID[${number}]" value=""/><button type="button" class="dialog__remove button" id="removeDialog">Remove</button></div>`;
				
				document.getElementById("dialogList").insertAdjacentHTML('beforeend', row);
				addDialog.dataset.number = parseInt(addDialog.dataset.number) + 1;
			});

			let dialogs = document.querySelectorAll('.dialog__row');

			dialogs.forEach(function(dialog) {

				let removeDialog = dialog.querySelector('#removeDialog');

				removeDialog.addEventListener('click', function() {
					this.parentNode.remove(dialog);
				});
			
			});

		}


	});

	jQuery(document).ready(function($){
			var customUploader;
	
			$('#uploadImageButton').click(function(e) {
					e.preventDefault();
	
					// If the uploader object has already been created, reopen the dialog
					if (customUploader) {
							customUploader.open();
							return;
					}
	
					// Extend the wp.media object
					customUploader = wp.media.frames.file_frame = wp.media({
							title: 'Choose Image',
							button: {
									text: 'Choose Image'
							},
							multiple: false
					});
	
					// When a file is selected, grab the URL and set it as the text field's value
					customUploader.on('select', function() {
							var attachment = customUploader.state().get('selection').first().toJSON();
							$('#dialogImageDesktop').val(attachment.url);
					});
	
					// Open the uploader dialog
					customUploader.open();
			});
	});

})( jQuery );