function kimsclub_nondis() {
	$("#container > .headline > .pop").css("display","none")
}

$(document).ready(function() {

		// nav-menu EVENT.
		
		var SDDw = $(".SDD-wassup"), SDDn = $(".SDD-note"), SDDp = $(".SDD-party");
		var navw = $(".nav-wassup"), 	navn = $(".nav-note"), 	navp = $(".nav-party");
		
		navn.mouseenter(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_noteov.png)")});
		navp.mouseenter(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_partyov.png)")});
		
		navn.mouseleave(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_note.png)")});
		navp.mouseleave(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_party.png)")});
		
		navn.mousedown(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_noteck.png)")});
		navp.mousedown(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_partyck.png)")});
		
		navn.mouseup(function() { 	SDDn.css("background-image","url(../images/party/Header/header_menu_noteov.png)")
													location.href = '../../note' ;
												});
		navp.mouseup(function() { 	SDDp.css("background-image","url(../images/party/Header/header_menu_partyov.png)");
													location.href = '../../partyplay' ;
												});
												
		// 상단 좌측 프로필 이벤트
		
		$("#container > .headline > .namediv").mouseenter(function() {
			$(this).addClass("container_headline_namedivOV");
		});
		$("#container > .headline > .namediv").mouseleave(function() {
			$(this).removeClass("container_headline_namedivOV");
		});
		$("#container > .headline > .namediv").mousedown(function() {
			$(this).addClass("container_headline_namedivCK");
		});
		$("#container > .headline > .namediv").mouseup(function() {
			$(this).removeClass("container_headline_namedivCK");
			$("#container > .headline > .pop").css("display","block")
			
			if(typeof pageYOffset != 'undefined'){
				
					$("#container > .headline > .pop").fadeTo(600,1);
					
			}
			
		});
		
		$(document).click(function() {																	// pop > content밖을 클릭시 pop > content 사라짐
			
			if(typeof pageYOffset != 'undefined'){
				
					$("#container > .headline > .pop").fadeTo(300,0);
					setTimeout(kimsclub_nondis,500);
						
			}	else { 
			
					kimsclub_nondis();
			
			}
		
		});
		
		$("#container > .headline > .namediv").click(function(e) {			// namediv는 클릭해도 무 반응
			e.stopPropagation();
			return false;        	
		});
		
		$("#container > .headline > .pop > .content").click(function(e) {	// pop 의 content에도 클릭해도 무 반응
			e.stopPropagation();		// 이전 method 중지
			return false;        		// 내가 원하기전까지는 이 div에는 하지말아야한다?
		});
		
		// 상단 버튼 2개 이벤트
		
		$.each($("#container > .headline > .button > ul"),function() {

					$(this).mouseenter(function() {
						$(this).animate({top: "-10px"},{queue:false,duration:200});
					});
					
					$(this).mouseleave(function() {
						$(this).animate({top: "-5px"},{queue:false,duration:200});
					});
					
			
			if(typeof pageYOffset != 'undefined'){
			
					
					$(this).mousedown(function() {
						$(this).animate({top: "-5px"},{queue:false,duration:80});
					});
					
					$(this).mouseup(function() {
						$(this).animate({top: "-10px"},{queue:false,duration:80});
					});
					
			}
			
		});
		
		// wholist 버튼 클릭시 이벤트
		
		var kimsclub_wholist_number = 0; // 0이면 아래로 내리는것 1이면 위로 올리는것
		
		$("#container > .headline > .button > .friensumer").mouseup(function() {
			
				if(typeof pageYOffset != 'undefined'){
							
							if (kimsclub_wholist_number == 0) {
									kimsclub_wholist_number = 2;
									$("#container > .wholist").slideDown(500).queue(function() {
										$("#container > .wholist > .innerDiv").fadeTo(700,1);
										$(this).dequeue();
									});
									setTimeout(kimsclub_wholist_numF1,1200);
									
									function kimsclub_wholist_numF1() {
											kimsclub_wholist_number = 1;
									}
							}
							
							if (kimsclub_wholist_number == 1) {
									kimsclub_wholist_number = 2;
									$("#container > .wholist > .innerDiv").fadeTo(400,0).queue(function() {
										$("#container > .wholist").slideUp(500)
										$(this).dequeue();
									});
									setTimeout(kimsclub_wholist_numF2,900);
									
									function kimsclub_wholist_numF2() {
											kimsclub_wholist_number = 0;
									}
							}
							
				}	else  {
					
					$("#container > .wholist").slideToggle(500)
					
				}
			
		});
    
});



















