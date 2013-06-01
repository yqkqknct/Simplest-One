jQuery(document).ready(function($) {
	$("#gallery0").hover(function(){
		$("#article-gallery0").addClass("hover");
	}, function() {
		$("#article-gallery0").removeClass("hover");
	});
	$("#gallery1").hover(function(){
		$("#article-gallery1").addClass("hover");
	}, function() {
		$("#article-gallery1").removeClass("hover");
	});
});