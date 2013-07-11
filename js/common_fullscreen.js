$(document).ready(function() {
	
	// background click event
	
	$("#fullscreen_bg").click(function() {

			$("#fullscreen_bg").css("display","none");
			$("#win_friend_invite").css("display","none");
			$("#win_anounce_original").css("display","none");
			$("#win_board_original").css("display","none");
			$("#wrapbox").removeClass("changewrapBox");
			
    });
	
	// ESC close event
	
	$(document).keydown(function (e) {
	
		if (e.keyCode == 27) {
			
			$("#fullscreen_bg").css("display","none");
			$("#win_friend_invite").css("display","none");
			$("#win_anounce_original").css("display","none");
			$("#win_board_original").css("display","none");
			$("#wrapbox").removeClass("changewrapBox");
			
			 }
	
	});
	
	 // WIN_INVITATION 초대창에서 하나하나의 카드목록들 오버,클릭, 아웃시 EVENT
	 
	$.each($("#win_friend_invite > .container > .contents > .list"),function() {
		
		$(this).mouseenter(function() {
            $(this).css("background-color","#f9f9f9");
        });
		$(this).mouseleave(function() {
            $(this).css("background-color","#fff");
        });
		$(this).mousedown(function() {
            $(this).css("background-color","#f5f5f5");
        });
		$(this).mouseup(function() {
			alert('a');
			$(this).children(".button").css("background-image","url(../images/party/Container/checkck.png)");
		 	$(this).css("background-color","#f5f5f5");
		});
		
	});
	
	// WIN_ANOUNCE_ORIGINAL 에서 스크랩클릭시
	
	$.each($("#win_anounce_original > .container > .title > .skill > .scrap"),function() {
		$(this).mouseup(function() {
			$(this).siblings(".scrapbox").css("display","block");
		});
	});
	
	$.each($("#win_anounce_original > .container > .title > .skill > .scrapbox > .selectbox"),function() {
		$(this).mouseup(function() {
			$(this).children(".window").css("display","block");
		});
	});
	
	// WIN_BOARD_ORGINAL 에서 스크랩클릭시 
	
	// 스크랩클릭시 스크랩창 띄우기
	
	$.each($("#win_board_original > .posts > .header > .button > .scrap"),function() {
		$(this).mouseup(function() {
			$(this).siblings(".scrapbox").css("display","block");
		});
	});
	
	// 스크랩창안에 스크랩박스 클릭시 선택목록띄우기
	
	$.each($("#win_board_original > .posts > .header > .button > .scrapbox > .selectbox"),function() {
		$(this).mouseup(function() {
			$(this).children(".window").css("display","block");
		});
	});
	
})