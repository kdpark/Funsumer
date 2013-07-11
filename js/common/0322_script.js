

// 게시판_Preview :: fixed_layer

$(document).ready(function(){ 

	$(document).scroll(function() {
		
		fixed_layer()
		
	});
	
});

function fixed_layer() {
	
	var position = $(document).scrollTop()
	
	if ( position >= 500 ) {
		
			$("#container .board > .Lfield > .preview ").css("position","fixed").css("top","20px");
	
	}
	
	if ( position < 500 ) {
		
			$("#container .board > .Lfield > .preview ").css("position","absolute").css("top","520px");
	
	}
	
}

// 게시판_preview :: hover시 css변경

$(document).ready(function() {

	$.each($("#container .board > .Lfield > .preview > .content > .list > .cards"),function(){
		
		$(this).mouseenter(function() {
           
			$(this).children(".white").children(".text").css("color","#000").css("font-weight","bold");
			$(this).children(".white").children(".pic").children(".img").css("opacity","1");
		    
        });
		
		$(this).mouseleave(function() {
           
			$(this).children(".white").children(".text").css("color","#777").css("font-weight","500");
			$(this).children(".white").children(".pic").children(".img").css("opacity",".8");
		    
        });
		
	});

});