$(function() {

	console.log('navigation loaded');

	/*
	 * click on index logo
	 */
	$(document).on("click",".indexContainer",function(e) {
    	window.location.href = "/gallery/";
    });

	/*
	 * click on a gallery
	 */
	$(document).on("click",".indexTitle",function(e) {
    	window.location.href = "/gallery/show/" + $(this).attr("id");
    });

	
});



