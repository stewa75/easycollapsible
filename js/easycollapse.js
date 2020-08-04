// Javascript functions for Easycollapsible plugin


$(document).ready(function(){

	//************************************************
	// Capture click on Topic Title and show topic div

	$( ".format_easycollapsible_fheader" ).each( function() {

		$(this).on("click", function (e) {	

			// Toogle the class
			$( $(this).attr("href") ).toggleClass( "showed" );
			$( $(this) ).toggleClass( "showed" );
			$( ".multi-collapse" ).not($(this).attr("href")).removeClass( "showed" );

			// Center the page on the element clicked
			var el = $( e.target.getAttribute('href') );
			var elOffset = el.offset().top;
			var elHeight = el.height();
			var windowHeight = $(window).height();
			var offset;

			if (elHeight < windowHeight) {

				offset = elOffset - ((windowHeight / 2) - (elHeight / 2));

			} else {

				offset = elOffset;
			}

			var speed = 700;
			$('html, body').animate({scrollTop:offset}, speed);


		});	

	});	

	//************************************************
	// Show/Hide Topics

	$("#showhideallbtn").on("click", function () {

		$( ".multi-collapse" ).toggleClass( "showed" );

	});

});