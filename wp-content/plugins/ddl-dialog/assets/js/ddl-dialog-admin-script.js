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
	
		$('.dialog__img').each(function() {

			var button = $(this).find('.dialog__upload');
			var imgField = $(this).find('.dialog__input');
			var imgFile = $(this).find('.dialog__file');
			var imgRemove = $(this).find('.dialog__delete');
			var imgThumb = $(this).find('.dialog__thumb');

			var customUploader;

			button.click(function(e) {

				e.preventDefault();

				if (customUploader) {
					customUploader.open();
					return;
				}

				customUploader = wp.media.frames.file_frame = wp.media({
					title: 'Choose Image',
					button: {
						text: 'Choose Image'
					},
					multiple: false
				});

				customUploader.on('select', function() {

					var attachment = customUploader.state().get('selection').first().toJSON();
					imgField.val(attachment.url);

					var filename = attachment.filename;
					imgFile.text(filename);

					imgThumb.show();

				});

				customUploader.open();

			});

			imgRemove.click(function(e) {
				e.preventDefault();
				imgThumb.hide();
				imgField.val('');
				imgFile.text('');
			});

		});
	
	});

})( jQuery );