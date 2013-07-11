function kimsclub_nondis() {
	$("#container > .partylist > .title > .pop").css("display","none")
}

$(document).ready(function() {

		// nav-menu EVENT.
		
		var SDDw = $(".SDD-wassup"), SDDn = $(".SDD-note"), SDDp = $(".SDD-party");
		var navw = $(".nav-wassup"), 	navn = $(".nav-note"), 	navp = $(".nav-party");
		
		navn.mouseenter(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_noteov.png)")});
		navw.mouseenter(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_wassupov.png)")});
		
		navn.mouseleave(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_note.png)")});
		navw.mouseleave(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_wassup.png)")});
		
		navn.mousedown(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_noteck.png)")});
		navw.mousedown(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_wassupck.png)")});
		
		navn.mouseup(function() { 	SDDn.css("background-image","url(../images/party/Header/header_menu_noteov.png)")
													location.href = '../../note' ;
												});
		navw.mouseup(function() { 	SDDw.css("background-image","url(../images/party/Header/header_menu_wassupov.png)")
													location.href = '../../wassup' ;
												});
												
		// 상단 좌측 프로필 이벤트
		
		$("#container > .partylist > .title > .namediv").mouseenter(function() {
			$(this).addClass("container_partylist_namedivOV");
		});
		$("#container > .partylist > .title > .namediv").mouseleave(function() {
			$(this).removeClass("container_partylist_namedivOV");
		});
		$("#container > .partylist > .title > .namediv").mousedown(function() {
			$(this).addClass("container_partylist_namedivCK");
		});
		$("#container > .partylist > .title > .namediv").mouseup(function() {
			$(this).removeClass("container_partylist_namedivCK");
			$("#container > .partylist > .title > .pop").css("display","block")
			
			if(typeof pageYOffset != 'undefined'){
				
					$("#container > .partylist > .title > .pop").fadeTo(600,1);
					
			}
			
		});
		
		$(document).click(function() {																	// pop > content밖을 클릭시 pop > content 사라짐
			
			if(typeof pageYOffset != 'undefined'){
				
					$("#container > .partylist > .title > .pop").fadeTo(300,0);
					setTimeout(kimsclub_nondis,500);
						
			}	else { 
			
					kimsclub_nondis();
			
			}
		
		});
		
		$("#container > .partylist > .title > .namediv").click(function(e) {			// namediv는 클릭해도 무 반응
			e.stopPropagation();
			return false;        	
		});
		
		$("#container > .partylist > .title > .pop > .content").click(function(e) {	// pop 의 content에도 클릭해도 무 반응
			e.stopPropagation();		// 이전 method 중지
			return false;        		// 내가 원하기전까지는 이 div에는 하지말아야한다?
		});
	
});



















