var pmove_num = 0;			// ■■■■■ 수정될 부분 ■■■■■ 파티 즐겨찾기 변수1
var mdown_check = 0;		// ■■■■■ 수정될 부분 ■■■■■ 파티 즐겨찾기 변수2

function pmove_effect_L(index){
	
	index = index + 848;
	pmove_num_px = index + "px";

	if ( index < 1 ) {
				$("#pre_party > .contents > .section").animate({ left: ""+pmove_num_px },{queue:false,duration:1000});		
				pmove_num = index;
	}
}

function pmove_effect_R(index){

	index = index - 848;
	pmove_num_px = index + "px";
	
	if( index > -2000 ){		
				$("#pre_party > .contents > .section").animate({ left: ""+pmove_num_px },{queue:false,duration:1000});
				pmove_num = index;
	}
	
}

$(document).ready(function() {
												
		// ■■■■■ 수정될 부분 ■■■■■ 파티 즐겨찾기 js START
		
			$.each($("#pre_party"),function() {
		
					var 	aL = $(this).children(".arrow_L"), aR = $(this).children(".arrow_R"), aLR = $(this).children(".arrow");
		
					aL.mouseenter(function(){	$(this).css("background-image","url(../images/party/Pre_party/L-arrowov.png)")});
					aL.mousedown(function(){	$(this).css("background-image","url(../images/party/Pre_party/L-arrowck.png)");
															});
					aL.mouseup(function(){		$(this).css("background-image","url(../images/party/Pre_party/L-arrowov.png)")
																pmove_effect_L(pmove_num);
														});
					aL.mouseleave(function(){	$(this).css("background-image","url(../images/party/Pre_party/L-arrow.png)")});
					
					aR.mouseenter(function(){	$(this).css("background-image","url(../images/party/Pre_party/R-arrowov.png)")});
					aR.mousedown(function(){	$(this).css("background-image","url(../images/party/Pre_party/R-arrowck.png)")});
					aR.mouseup(function(){		$(this).css("background-image","url(../images/party/Pre_party/R-arrowov.png)")
																pmove_effect_R(pmove_num);
														});
					aR.mouseleave(function(){	$(this).css("background-image","url(../images/party/Pre_party/R-arrow.png)")});
		
					$(this).mouseenter(function() {
		
						   if($.browser.msie && $.browser.version == "8.0" ) {
		
										aLR.css("opacity","1");
		
						   } else {
		
										aL.fadeTo(400,1);
										aR.fadeTo(400,1);
		
						   }
		
					});
		
					$(this).mouseleave(function() {
		
						   if($.browser.msie && $.browser.version == "8.0" ) {
							   
										aLR.css("opacity","0");
		
						   } else {
		
										aL.fadeTo(400,0);
										aR.fadeTo(400,0);
		
						   }
		
					});
		
			}); // each.pre_party function
		
			// Pre_party EVENT
		
			$.each($("#pre_party > .contents > .section > ul"),function() {
		
					$(this).mouseenter(function() {
							$(this).children(".name").css("color","#dc5457");	
							$(this).children(".party_thumb").css("opacity","1");
					});
		
					$(this).mouseleave(function() {
							$(this).children(".name").css("color","#555");	
							$(this).children(".party_thumb").css("opacity","1");
					});
		
					$(this).mousedown(function() {
							$(this).children(".name").css("color","#dc5457");
					});
		
			}); // each ul
			
	
		// nav-menu EVENT.
		
		var SDDw = $(".SDD-wassup"), SDDn = $(".SDD-note"), SDDp = $(".SDD-party");
		var navw = $(".nav-wassup"), 	navn = $(".nav-note"), 	navp = $(".nav-party");
		
		navw.mouseenter(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_wassupov.png)")});
		navp.mouseenter(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_partyov.png)")});
		
		navw.mouseleave(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_wassup.png)")});
		navp.mouseleave(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_party.png)")});
		
		navw.mousedown(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_wassupck.png)")});
		navp.mousedown(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_partyck.png)")		});
		
		navw.mouseup(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_wassupov.png)")
													location.href = '../../wassup' ;
												});
		navp.mouseup(function() { 	SDDp.css("background-image","url(../images/party/Header/header_menu_partyov.png)");
													location.href = '../../partyplay' ;
												});
												
		// 상단 우측버튼 5개 마우스 클릭 이벤트 (파티생성/친구목록/커버수정/친구추가/인기투표)
		
		$.each($("#container > .baseinfo > .button > div"),function() {
			
			if(typeof pageYOffset != 'undefined'){
			
					$(this).mousedown(function() {
						$(this).children("img").animate({marginTop: '3px',marginLeft: '3px'},{queue:false,duration:100});
						$(this).children("img").animate({width: '64px',height: '99px'},{queue:false,duration:100});
					});
					$(this).mouseup(function() {
						$(this).children("img").animate({marginTop: '0px',marginLeft: '0px'},{queue:false,duration:100});
						$(this).children("img").animate({width: '70px',height: '105px'},{queue:false,duration:100});
					});
					$(this).mouseleave(function() {
						$(this).children("img").animate({marginTop: '0px',marginLeft: '0px'},{queue:false,duration:100});
						$(this).children("img").animate({width: '70px',height: '105px'},{queue:false,duration:100});
					});
					
			}
			
		});
		
		// 상단 친구목록 전환되는 이벤트

		$.each($("#container > .baseinfo > .button > .list_friend"),function() {
			
			if(typeof pageYOffset != 'undefined'){
				
					$(this).mouseup(function() {
						$("#container").css("display","none");
						$("#container").css("opacity","0");
						$("#container2").css("display","block");
						$("#container2").fadeTo(400,1)
					});
				
			}	else {
				
					$(this).mouseup(function() {
						$("#container").css("display","none");
						$("#container2").css("display","block");
					});
				
			}
			
		});
		
		// 친구목록에서 돌아가기 버튼 이벤트
		
		$.each($("#friendlist > .header > .profile > .button"),function() {
			
			if(typeof pageYOffset != 'undefined'){
			
					$(this).mouseenter(function() {
						$(this).children(".outline").animate({opacity: "1"},{queue:false,duration:200});
						$(this).children("img").animate({opacity: ".7"},{queue:false,duration:100});
					});
					
					$(this).mouseleave(function() {
						$(this).children(".outline").css("opacity","0");
						$(this).children("img").css("opacity","1");
						$(this).css("background","none");
					});
					
					$(this).mousedown(function() {
						$(this).css("background-color","#eee")
						$(this).children(".outline").addClass("friendlist_button_outline_mousedown")
					});
					
					$(this).mouseup(function() {
						$(this).css("background","none");
						$(this).children(".outline").removeClass("friendlist_button_outline_mousedown")
						$("#container2").css("display","none");
						$("#container2").css("opacity","0");
						$("#container").css("display","block");
						$("#container").fadeTo(400,1);
					});
					
			}	else {
				
					$(this).mouseenter(function() {
						$(this).children(".outline").css("visibility","visible")
					});
					
					$(this).mouseleave(function() {
						$(this).children(".outline").css("visibility","hidden")
						$(this).css("background","none");
					});
					
					$(this).mousedown(function() {
						$(this).css("background-color","#eee")
					});
					
					$(this).mouseup(function() {
						$(this).css("background","none");
						$("#container2").css("display","none");
						$("#container").css("display","block");
					});
				
			}
			
		});
		
		// 프로필 사진 마우스 오버시 사진수정 나오는 이벤트
		
		$("#container > .baseinfo > .info > .prof_pic").mouseenter(function() {
			
				$(this).children(".prof_over").css("display","block")
		});
		
		$("#container > .baseinfo > .info > .prof_pic").mouseleave(function() {
			
				$(this).children(".prof_over").css("display","none")
		});
		
		// 친구 추가 클릭시 요청완료로 변경
		
var add_friend_stop = 0;
var vote_stop = 0;
		
		$("#container > .baseinfo > .button > .add_friend").mouseup(function() {
			if ( add_friend_stop == 0 ) {
				$(this).css("opacity","0").fadeTo(500,1).html('<img src=\"../images/note/add_friending.png\" alt=\"\" />')
				add_friend_stop = 1;
			}
		});
		
		// 인기투표 클릭시 색깔올라오기 
		
		$("#container > .baseinfo > .button > .vote").mouseup(function() {
			if ( vote_stop == 0 ) {
				$(this).css("opacity","0").fadeTo(500,1).html('<img src=\"../images/note/voteok.png\" alt=\"\" />')
				vote_stop = 1;
			}
		});
    
});



















