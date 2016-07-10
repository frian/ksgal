$(function() {

	console.log('loaded');
	
	$("body").css("overflow", "hidden");
	
	var count = 0;
	var image = $("#bg");

	var pos = [ "top/left", "top/right", "bottom/right", "bottom/left" ];
	
	function animeBg() {

		$( "#bgTmp" ).remove();
		
		$( "#bg" ).clone().attr("id", "bgTmp").appendTo( "body" );

		[ oldProp1, oldProp2 ] = pos[count].split("/")
		
		next = (count + 1) % 4;
		
		[ prop1, prop2 ] = pos[next].split("/");
		
		setTimeout(function test() {
			$(image)
				.animate({ opacity: 0 }, 1000, 	function() {
					// Animation complete.
					$(image)
						.css( oldProp1, "auto")
						.css( oldProp2, "auto")
						.css( prop1, "-10%")
						.css( prop2, "-10%")
					.delay(100)
					.animate({ opacity: 1 }, 1000, animeBg );
					
			    })
			}, 1000
		);

		count++;
		count = count % 4;
	}

	animeBg();
});



