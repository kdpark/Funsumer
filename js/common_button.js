$(document).ready(function() {

	// TEXT COLOR CHANGE EVENT
	
	$.each($(".text-color-chg"),function() {

			$(this).mouseenter(function() {
					$(this).css("color","#999");	
			});
	
			$(this).mouseleave(function() {
					$(this).css("color","#777");	
			});
					
			$(this).mousedown(function() {
					$(this).css("color","#dc5457");
            });
	
	});
	
	// TEXT COLOR CHANGE EVENT_subtitole용
	
	$.each($(".text-color-chg2"),function() {

			$(this).mouseenter(function() {
					$(this).css("color","#777");	
			});
	
			$(this).mouseleave(function() {
					$(this).css("color","#333");	
			});
					
			$(this).mousedown(function() {
					$(this).css("color","#dc5457");
            });
	
	});
	
	// TEXT COLOR CHANGE EVENT_anounce skill용
	
	$.each($(".text-color-chg3"),function() {

			$(this).mouseenter(function() {
					$(this).css("color","#999");	
			});
	
			$(this).mouseleave(function() {
					$(this).css("color","#888");	
			});
					
			$(this).mousedown(function() {
					$(this).css("color","#dc5457");
            });
	
	});
	
	// BUTTON_RED OVER CLICK
	
	$.each($(".Button_red"),function() {
		
		$(this).mouseenter(function() {
			$(this).css("background-image","url(../images/party/Container/buttonbgov.png)");
		});
		$(this).mouseleave(function() {
			$(this).css("background-image","url(../images/party/Container/buttonbg.png)");
		});
		$(this).mousedown(function() {
			$(this).css("background-image","url(../images/party/Container/buttonbgck.png)");
		});
		$(this).mouseup(function() {
			$(this).css("background-image","url(../images/party/Container/buttonbgov.png)");
		});
		
	}); // BUTTON_RED OVER CLICK END
	
	// BUTTON2_RED OVER CLICK
	
	$.each($(".Button2_red"),function() {
		
		$(this).mouseenter(function() {
			$(this).css("background-image","url(../images/party/Container/button2bgov.png)");
		});
		$(this).mouseleave(function() {
			$(this).css("background-image","url(../images/party/Container/button2bg.png)");
		});
		$(this).mousedown(function() {
			$(this).css("background-image","url(../images/party/Container/button2bgck.png)");
		});
		$(this).mouseup(function() {
			$(this).css("background-image","url(../images/party/Container/button2bgov.png)");
		});
		
	}); // BUTTON2_RED OVER CLICK END
	
	// BUTTON2_GRAY OVER CLICK
	
	$.each($("#partyadmin_member_container  > .ScrollBox > .container > .content > .listwrap > .list > .button > .Button_gray"),function() {
		
		$(this).mouseleave(function() {
			$(this).css("background-image","url(../images/party/Container/buttongraybg.png)");
		});
		$(this).mousedown(function() {
			$(this).css("background-image","url(../images/party/Container/buttongraybgck.png)");
		});
		$(this).mouseup(function() {
			
			if($.browser.msie && $.browser.version == "8.0" ) {
				$(this).css("background-image","url(../images/party/Container/buttongraybg.png)");
				$(this).html("권한 취소<div class=\"Button_gray_word\">권한 취소</div>");
				$(this).addClass("Button_gray_selected_ie8");
				$(this).children(".Button_gray_word").addClass("Button_gray_selected_word_ie8");			
			} else {
				$(this).css("background-image","url(../images/party/Container/buttongraybg.png)");
				$(this).html("권한 취소<div class=\"Button_gray_word\">권한 취소</div>");
				$(this).addClass("Button_gray_selected");
				$(this).children(".Button_gray_word").addClass("Button_gray_selected_word");
			}
		});
		
	}); // BUTTON_GRAY OVER CLICK END
	
	// BasePic Button EVENT
	
	$.each($("#container .party .pic > .basepic > .chg_bg"),function() {
		
		$(this).mouseenter(function(e) {
			$(this).children(".bg").css("background-image","url(../images/party/Container/partybuttonbgov.png)");
        });		
		$(this).mouseleave(function(e) {
			$(this).children(".bg").css("background-image","url(../images/party/Container/partybuttonbg.png)");
        });		
		$(this).mousedown(function(e) {
			$(this).children(".bg").css("background-image","url(../images/party/Container/partybuttonbgck.png)");
        });		
		$(this).mouseup(function(e) {      
			$(this).children(".bg").css("background-image","url(../images/party/Container/partybuttonbgov.png)");
        });
		
		$("#container .party .pic > .basepic > .partyadmin_position").mouseup(function() {
			$("#container .party .pic > .partyadminpage").css("visibility","visible");
			$("#container .party .pic > .partyadminpage").fadeTo(800,1);
		});
		
	});
	
})