(function( $ ) {

	'use strict';

	jQuery(document).ready(function($){

		let addDialog = document.querySelector('#addDialog');

		if (addDialog) {

			addDialog.addEventListener('click', function() {
				let number = addDialog.getAttribute('data-number');

				let row = `<div class="dialog__row"><input type="number" name="dialogPageID[${number}]" value=""/><button type="button" class="dialog__remove button" id="removeDialog">Remove</button></div>`;
				
				document.getElementById("dialogList").insertAdjacentHTML('beforeend', row);
				addDialog.dataset.number = parseInt(addDialog.dataset.number) + 1;
			});

			let removeDialog = document.querySelectorAll('#removeDialog');
			
			removeDialog.forEach(function(e) {
				e.addEventListener('click', function() {
					this.parentNode.remove();
				});
			});

		}

		let addLink = document.querySelector('#addLink');

		if (addLink) {

			addLink.addEventListener('click', function() {
				let number = addLink.getAttribute('data-number');

				let row = `<div class="dialog__row"><input type="text" name="dialogLink[${number}]" value=""/><button type="button" class="dialog__remove button" id="removeLink">Remove</button></div>`;
				
				document.getElementById("dialogLinks").insertAdjacentHTML('beforeend', row);
				addLink.dataset.number = parseInt(addLink.dataset.number) + 1;
			});

		}

		let removeLink = document.querySelectorAll('.dialog__remove');

		if (removeLink) {
				
			removeLink.forEach(function(e) {
				e.addEventListener('click', function() {
					this.parentNode.remove();
				});
			});

		}
	
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