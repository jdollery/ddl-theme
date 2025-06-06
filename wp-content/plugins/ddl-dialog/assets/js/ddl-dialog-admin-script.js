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

})( jQuery );