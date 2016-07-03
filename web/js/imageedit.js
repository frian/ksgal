$(function() {

	console.log('loaded');
	
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

});



