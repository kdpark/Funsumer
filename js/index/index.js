$(document).ready(function() {
    
	$(".header > .login input.button").mousedown(function() {
        
		$(this).css("background-image","url(../../images/base/buttongray3bgck.png)").css("box-shadow","0 -1px 1px #d2d2d2 inset").css("border","1px solid #a1a1a1")
		
    });
	
	$(".header > .login input.button").mouseup(function() {
        
		$(this).css("background-image","url(../../images/base/buttongray3bg.png)").css("box-shadow","none").css("border","1px solid #c1c1c1").css("border-bottom-color","#b1b1b1")
		
    });
	
});

$(document).ready(function(e) {
    
	$(".header > .find").mouseup(function(e) {
        
		alert('서비스 준비 중 입니다.')
		
    });
	
	$(".header > .find1").mouseup(function(e) {
        
		window.open('./askus.php','','toolbar=no,menubar=no,location=no,height=330,width=185');
		
    });
	
});

/*
$(window).load(function() {    

	var 	theWindow = $(window),
			$bg = $("#bg"),
			aspectRatio = $bg.width() / $bg.height();
	    			    		
	function resizeBg() {
		if ( (theWindow.width() / theWindow.height()) < aspectRatio ) {
			$bg.removeClass().addClass('bgheight');
		} 
		else { 
			$bg.removeClass().addClass('bgwidth');
		}
	}
	                   			
	theWindow.resize(function() { // 윈도우가 리사이징되면 함수를 돌려라.
		resizeBg();
	}).trigger("resize"); // 초기 페이지 로드시 resize함수작동.

});

// 바탕화면이 100%로 만드는 스크립트

function Fade(obj,speed,alpha){
	$("."+obj+"").fadeTo(speed,alpha);
}

function chg(obj1,obj2,obj3) { 
	$("."+obj1+"").fadeTo(400,0).queue(function(){
		$("."+obj1+"").css("display","none")
		$("."+obj2+"").css("display","block")
		$("."+obj3+"").css("cursor","default")
		$("."+obj2+"").fadeTo(1000,1);
		$("."+obj2+"").animate({top:"0"},{queue:false,duration:500})
	}); 
}

// 서서히 나타나고 서서히 사라지는 스크립트

$(document).ready(function(){
  $("input[name=id]").focusin(function(){
    $('input[name=id]').css("border","1px solid red").css("box-shadow","0px 0px 7px #FF3C3C");
  }).focusout(function(){
    $('input[name=id]').css("border","1px solid #000").css("box-shadow","none");
  });
  $("input[name=pw]").focusin(function(){
    $("input[name=pw]").css("border","1px solid red").css("box-shadow","0px 0px 7px #FF3C3C");
  }).focusout(function(){
    $("input[name=pw]").css("border","1px solid #000").css("box-shadow","none");
  });
  $("input[name=r-name]").focusin(function(){
    $('input[name=r-name]').css("border","1px solid red").css("box-shadow","0px 0px 7px #FF3C3C");
  }).focusout(function(){
    $('input[name=r-name]').css("border","1px solid #000").css("box-shadow","none");
  });
  $("input[name=r-email]").focusin(function(){
    $("input[name=r-email]").css("border","1px solid red").css("box-shadow","0px 0px 7px #FF3C3C");
  }).focusout(function(){
    $("input[name=r-email]").css("border","1px solid #000").css("box-shadow","none");
  });
  $("input[name=r-email2]").focusin(function(){
    $('input[name=r-email2]').css("border","1px solid red").css("box-shadow","0px 0px 7px #FF3C3C");
  }).focusout(function(){
    $('input[name=r-email2]').css("border","1px solid #000").css("box-shadow","none");
  });
  $("input[name=r-pw]").focusin(function(){
    $("input[name=r-pw]").css("border","1px solid red").css("box-shadow","0px 0px 7px #FF3C3C");
  }).focusout(function(){
    $("input[name=r-pw]").css("border","1px solid #000").css("box-shadow","none");
  });


});

// HTML : input의 focus 스크립트
*/