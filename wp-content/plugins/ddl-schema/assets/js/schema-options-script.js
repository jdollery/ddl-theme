(function( $ ) {

	'use strict';

	$(function() {

		let times = document.querySelectorAll( '.opening__row' );
		let addTime = document.querySelector('#addTime');

		addTime.addEventListener('click', function() {
			let number = addTime.getAttribute('data-number');
			let row = `<div class="opening__row"><input type="text" id="schema-times-day" name="schema-times[${number}][0]" placeholder="Day" value="" /><input type="text" id="schema-times-open" name="schema-times[${number}][1]" placeholder="Opening time" value="" /><input type="text" id="schema-times-close" name="schema-times[${number}][2]" placeholder="Closing time" value="" /><button type="button" class="opening__remove button" id="removeTime">Remove</button></div>`;
			document.getElementById("openingList").insertAdjacentHTML('beforeend', row);
			addTime.dataset.number = parseInt(this.dataset.number) + 1;
		});

		times.forEach(function(time) {

			let removeTime = time.querySelector('#removeTime');

			removeTime.addEventListener('click', function() {
				this.parentNode.remove(time);
			});
		
		});

		
		let addChannel = document.querySelector('#addChannel');

		addChannel.addEventListener('click', function() {
			let number = addChannel.getAttribute('data-number');
			let row = `<div class="social__row"><input type="text" id="schema-social-url" name="schema-social[${number}][0]" placeholder="https://..." value="" /><button type="button" class="social__remove button" id="removeChannel">Remove</button></div>`;
			document.getElementById("channelList").insertAdjacentHTML('beforeend', row);
			addChannel.dataset.number = parseInt(this.dataset.number) + 1;
		});

		let channels = document.querySelectorAll('.social__row');

		channels.forEach(function(channel) {

			let removeChannel = channel.querySelector('#removeChannel');

			removeChannel.addEventListener('click', function() {
				this.parentNode.remove(channel);
			});
		
		});


	});

})( jQuery );