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
	$(window).load(function() {
			if ( $(window).width() < 767 ) {
				$("#article-gallery1 .article-cont").before( $("#gallery1"));
				$("#article-gallery0 .article-cont").before( $("#gallery0"));
				$(".author-description").after( $(".author-social") );
				$(".author-name").before( $(".author-avatar") );
				$(".author-avatar").append( $(".author-name") );
		    }
    });
    $('p, h1').macho();
    $("#gotop").click(function(e) {
		$("html,body").animate({
			scrollTop : 0
		}, 1000);
		event.stopPropagation();
		event.preventDefault();
	});
	$("#sc_comments").click(function(e) {
		$("html,body").animate({
			scrollTop: $("#comments").offset().top
		}, 1000);
		event.stopPropagation();
		event.preventDefault();
	});
	$(".sc_facebook , .sc_google").hover(function() {
		$(this).children().fadeIn("fast");
	}, function() {
		$(this).children().fadeOut("fast");
	}, 500);
	$(window).load(function() {
	    $(window).scroll(function(evt) {
	    	var y = $(this).scrollTop();
	        if (y > 100) {
	        	$("#gotop").fadeIn("fast");
	        } else {
	        	$("#gotop").fadeOut("fast");
	        }
	    });
	});
});