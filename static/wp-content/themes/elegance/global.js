// JQUERY 4 LIFE

function searchAlert () {
	$(".search-alert").fadeIn("slow");
}
function searchAlertHide () {
	$(".search-alert").fadeOut("slow");	
}
function readMore () {
	$("#sub-1").fadeOut("slow", function() {
		$("#sub-2").fadeIn("slow");
	});	
}
function readLess () {
	$("#sub-2").fadeOut("slow", function() {
		$("#sub-1").fadeIn("slow");
	});	
}