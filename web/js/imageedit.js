$(function() {

	console.log('loaded imageedit');
	
	if(window.location.href.indexOf("edit") > -1) {

		// hide image upload
		$("#gallery_item_image").css("display", "none");

		// hide bgimage upload
		$("#gallery_item_bgimage").css("display", "none");
		
		// add modify image button
		var addImageButton = $('<input type="button" id="imageButton" value="modifier l\'image"/>');
		
		$("#image").append(addImageButton);
		
		// add modify bgimage button
		var addBgimageButton = $('<input type="button" id="bgimageButton" value="modifier l\'image de fond"/>');
		
		$("#bgimage").append(addBgimageButton);

		// show image upload on modify image
	    $(document).on("click","#imageButton",function(e) {
	    	$("#gallery_item_image").css("display", "block");
	    });

		// show bgimage upload on modify image
	    $(document).on("click","#bgimageButton",function(e) {
	    	$("#gallery_item_bgimage").css("display", "block");
	    });

	}



    // get image size
	var image = new Image(); // or document.createElement('img')
	var width, height;
	image.onload = function() {
	  width = this.width;
	  height = this.height;
	  $("#imageSize").html("size : " + width + "x" + height + "px");
	  console.log("1 " + width + " x " + height);
	};
	image.src = $("#image-full").attr("src");


	// get bg image size
	var bgimage = new Image(); // or document.createElement('img')
	var bgwidth, bgheight;
	bgimage.onload = function() {
	  bgwidth = this.width;
	  bgheight = this.height;
	  $("#bgimageSize").html("size : " + bgwidth + "x" + bgheight + "px");
	  console.log("2 " + bgwidth + " x " + bgheight);
	};
	bgimage.src = $("#image-bg").attr("src");

});



