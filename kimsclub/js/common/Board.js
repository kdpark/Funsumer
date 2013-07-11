$(document).ready(function() {
    
	
	// 배치선택시 프레임 색상변경
	$.each($("#container .board > .Rfield > .write > .cameraspace > .framepart > .frame > .each_frame"),function() {
		
		$.each($(this).children("ul"),function() {
			$(this).mousedown(function(e) {
                $(this).css("background-color","#dc5457");
                $(this).css("box-shadow","0 2px 2px #a1a1a1");
				$(this).children(".XL, .L, .S").css("background-color","#F9B2B2");
				$(this).children(".XL, .L, .S").css("color","#dc5457");
            });
		});
		
	});

	// 게시판안에서 open the original ... 클릭시 원문 띄우기
	
	$.each($("#container .board > .Rfield > .contents > .posts > .comment > .origin"),function() {
		$(this).mouseup(function() {
			$("#wrapbox").addClass("changewrapBox");
			$("#fullscreen_bg").css("display","block");
			$("#win_board_original").css("display","block");
		});
	});
	
	
	// ★★★ 01/14 ★★★스크랩클릭시 스크랩창 띄우기
	
	$.each($("#container .board > .Rfield > .contents > .posts > .header > .button > .scrap"),function() {
		$(this).mouseup(function() {
			$(this).children(".scrapbox").css("visibility","visible");
		});
	});
	
	
	// ★★★ 01/14 ★★★스크랩창안에 스크랩박스 클릭시 선택목록띄우기
	
	$.each($("#container .board > .Rfield > .contents > .posts > .header > .button >.scrap > .scrapbox > .selectbox"),function() {
		$(this).mouseup(function() {
			$(this).children(".window").css("display","block");
		});
	});
	
	
});