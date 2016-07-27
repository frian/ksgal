$(function() {


	/*
	 * disable / enable scroll
	 */
	if ( location.pathname == "/" ) {
		$("body").css( 'overflow', 'hidden' );
		disableScroll();
	}
	else if ( window.location.href.indexOf("galleryitem") > -1 && window.location.href.indexOf("admin") == -1 ) {
		disableScroll();
		$("footer").css("position", "absolute");
	}
	else {
		enableScroll();
	}

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
});


/**
 * -- Prevent scrolling -------------------------------------------------------
 */

/**
 * left: 37, up: 38, right: 39, down: 40,
 * spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
 */
var keys = {37: 1, 38: 1, 39: 1, 40: 1, 32: 1, 33: 1, 34: 1, 35: 1, 36: 1};

function preventDefault(e) {
	e = e || window.event;
	if (e.preventDefault)
		e.preventDefault();
	e.returnValue = false;
}

function preventDefaultForScrollKeys(e) {
	if (keys[e.keyCode]) {
		preventDefault(e);
		return false;
	}
}

function disableScroll() {
	if (window.addEventListener) // older FF
		window.addEventListener('DOMMouseScroll', preventDefault, false);
	window.onwheel = preventDefault; // modern standard
	window.onmousewheel = document.onmousewheel = preventDefault; // older browsers, IE
	window.ontouchmove  = preventDefault; // mobile
	document.onkeydown  = preventDefaultForScrollKeys;

	unloadScrollBars();
}

function enableScroll() {

	if (window.removeEventListener)
		window.removeEventListener('DOMMouseScroll', preventDefault, false);
	window.onmousewheel = document.onmousewheel = null;
	window.onwheel = null;
	window.ontouchmove = null;
	document.onkeydown = null;

	reloadScrollBars();
}

function reloadScrollBars() {
    document.documentElement.style.overflow = 'auto';  // firefox, chrome
    document.body.scroll = "yes"; // ie only
}

function unloadScrollBars() {
    document.documentElement.style.overflow = 'hidden';  // firefox, chrome
    document.body.scroll = "no"; // ie only
}
