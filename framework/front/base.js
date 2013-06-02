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
});