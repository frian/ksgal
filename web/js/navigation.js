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
		
		if (window.location.href.indexOf("admin") > -1) {
			window.location.href = "/admin/gallery/show/" + $(this).attr("id");
		}
		else {
			window.location.href = "/gallery/show/" + $(this).attr("id");
		}
    });

	console.log(window.location.href);
	


});



