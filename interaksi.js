_reArrangeDivs = function()
{
    var docHeight = $(window).height();
    var docWidth = $(window).width();
	
	var dvMainTop = docHeight / 2 - $("#dvMain").height() / 2;
	dvMainTop = dvMainTop - 5;
	var dvMainLeft = docWidth / 2 - $("#dvMain").width() / 2;
	$("#dvMain").css({"top" : dvMainTop, "left" : dvMainLeft});
	
	var dvCopyTop = docHeight - 60;
    var dvCopyLeft = docWidth - 315;
    $("#dvCopy").css({"top" : dvCopyTop, "left" : dvCopyLeft});
	
	var dvPartnerTop = docHeight - 60;
    var dvPartnerLeft = 10;
    $("#dvPartner").css({"top" : dvPartnerTop, "left" : dvPartnerLeft});
    
    var luMessageTop = docHeight - 40;
    var luMessageLeft = docWidth / 2 - ($('#lumessage').width() / 2)
    $("#lumessage").css({"top" : luMessageTop, "left" : luMessageLeft});
}

// ON WINDOW RESIZED
$(window).resize(function() {
    _reArrangeDivs();
});

$(document).ready(function () {
	
    _reArrangeDivs();
	
	$(document).bgStretcher({
        images: ['images/background07.jpg'], imageWidth: 1680, imageHeight: 1050
    });
	
	/*
	$("#imInfoJibas").elevateZoom({
		zoomType: "inner",
		cursor: "crosshair",
		zoomWindowFadeIn: 600,
		zoomWindowFadeOut: 500,
		lensFadeIn: 600,
		lensFadeOut: 500
	});
	*/
	
});