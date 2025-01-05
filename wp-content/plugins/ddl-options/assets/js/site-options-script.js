(function( $ ) {

	'use strict';

	$(function() {

		$( ".add-a-date" ).click(function() {

		  var number = $(this).data('number');

      var div = '<div class="opening__row"><input type="text" id="site-times-day" name="site-times[$i][0]" placeholder="Day" value="" /><input type="text" id="site-times-open" name="site-times[$i][1]" placeholder="Opening time" value="" /><input type="text" id="site-times-close" name="site-times[$i][2]" placeholder="Closing time" value="" /><div class="remove-row">X</div></div>'.replaceAll("$i", number);

		  $("#openingTimes").append(div);

		  $(this).data('number', $(this).data('number') + 1);

		  $(".remove-row").click(function() {
				$(this).parent().remove();
			})

		});

		$(".remove-row").click(function() {
			$(this).parent().remove();
		})

	});

})( jQuery );