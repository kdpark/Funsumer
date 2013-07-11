// 친구추천 :: myfansumer :: pop 열고닫기

$(document).ready(function() {

	$("#container > .wholist > .left > .questionmark").mousedown(function() {    
	
		$(this).css("background-image","none").css("background-color","#dc5457").css("color","#fff").css("border","1px solid #CE0005")
	
	});
	$("#container > .wholist > .left > .questionmark").mouseup(function() {
        
		$("#container > .wholist > .left > .pop").css("display","block").css("opacity","1")
		
    });
	
	$("#container > .wholist > .left > .pop > .content > .list > .white > .close").click(function() {
        
		$("#container > .wholist > .left > .pop").fadeTo(500,0)
		
		setTimeout(pop_close,500);
		
		$("#container > .wholist > .left > .questionmark").css("background-image","url(../../images/base/questionmarkbg.png)")
																				.css("background-color","inherit")
																				.css("color","#aaa")
																				.css("border","1px solid #e1e1e1")
																				.css("border-bottom-color","#c8c8c8")
		
    });
	
});

function pop_close() {
	
	$("#container > .wholist > .left > .pop").css("display","none")
	
}

// 친구추천 :: myfansumer :: namepop 열고닫기

$(document).ready(function() {
    
		$("#container > .wholist > .left > .content > .list > .white > .card > .pic").mouseenter(function() {
			
			$(this).children(".namepop").css("display","block")
			
		});
	
		$("#container > .wholist > .left > .content > .list > .white > .card > .pic").mouseleave(function() {
			
			$(this).children(".namepop").css("display","none")
			
		});
	
});

// fansumer 첫번째, 여섯번째 css조절

window.onload = function(){ test() }

function test() {

	$("#container > .wholist > .right > .card:first").css("border-bottom-left-radius","3px").css("border-top-left-radius","3px")
	$("#container > .wholist > .right > .card:eq(5)").css("border-top-right-radius","3px").css("border-bottom-right-radius","3px").css("width","129px").css("border-right","none")
	
}
























