$(function() {

	console.log('loaded');
	
	var count = 0;
	var image = $("#bg");

	var pos = [ "top/left", "top/right", "bottom/right", "bottom/left" ];
	
	function animeBg() {

		$( "#bgTmp" ).remove();
		
		$( "#bg" ).clone().attr("id", "bgTmp").appendTo( "body" );

		
		[ oldProp1, oldProp2 ] = pos[count].split("/")
		
		next = (count + 1)%4;
		
		console.log( "moving from " + pos[count] + " to " + pos[next] );

		[ prop1, prop2 ] = pos[next].split("/");
		
		console.log( "setting " + oldProp1 + " and " + oldProp2 + " to none" );
		
		console.log( "setting " + prop1 + " and " + prop2 + " to 0" );
		
//		if (count === 2) return;
		
		setTimeout(function test() {
			$(image)
				.animate({ opacity: 0 }, 1000, 	function() {
					// Animation complete.
					$(image)
						.css( oldProp1, "auto")
						.css( oldProp2, "auto")
						.css( prop1, "0")
						.css( prop2, "0")
					.delay(100)
					.animate({ opacity: 1 }, 1000, animeBg );
					
			    })
			}, 2000
		);
		
		
//		$( "#bgTmp" ).remove();
		count++;
		count = count % 4;
		console.log(count)
	}

	animeBg();
});



