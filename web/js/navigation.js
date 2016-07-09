$(function() {

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

	function readURL(input, imageFile) {

	    if (input.files && input.files[0]) {
	        var reader = new FileReader();

	        reader.onload = function (e) {
	            $('#' + imageFile).attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);

		    setTimeout(function() { 

			    // get image size
				var image = new Image(); // or document.createElement('img')
				var width, height;
				image.onload = function() {
				  width = this.width;
				  height = this.height;
				  $("#" + imageFile + "-size").html("size : " + width + "x" + height + "px");
				  console.log("1 " + width + " x " + height);
				};

				image.src = $("#" + imageFile).attr("src");
		    }, 500);
	    }
	}


	$("#gallery_item_image").change(function(){
	    readURL(this, "image-full");
	});

	$("#gallery_item_bgimage").change(function(){
	    readURL(this, "image-bg");
	});
	
});
