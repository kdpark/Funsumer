// pre_party moveEVENT.

var pmove_num = 0;
var mdown_check = 0;

$(document).ready(function() {
	
	
		// nav-menu EVENT.
		
		var SDDw = $(".SDD-wassup"), SDDn = $(".SDD-note"), SDDp = $(".SDD-party");
		var navw = $(".nav-wassup"), 	navn = $(".nav-note"), 	navp = $(".nav-party");
		
		navw.mouseenter(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_wassupov.png)")});
		navn.mouseenter(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_noteov.png)")});
		
		navw.mouseleave(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_wassup.png)")});
		navn.mouseleave(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_note.png)")});
		
		navw.mousedown(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_wassupck.png)")});
		navn.mousedown(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_noteck.png)")});
		
		navw.mouseup(function() { 	SDDw.css("background-image","url(../images/party/Header/header_menu_wassupov.png)")
													location.href = 'http://localhost/wassup';
													});
		navn.mouseup(function() { 	SDDn.css("background-image","url(../images/party/Header/header_menu_noteov.png)");
													location.href = 'http://localhost/note';
												});
		
		// nav-search EVENT.

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
					$(this).children(".name").css("color","#999");	
					$(this).children(".party_thumb").css("opacity",".7");
			});

			$(this).mouseleave(function() {
					$(this).children(".name").css("color","#555");	
					$(this).children(".party_thumb").css("opacity","1");
			});

			$(this).mousedown(function() {
					$(this).children(".name").css("color","#dc5457");
            });

	}); // each ul
	
	// BasePic pinvite DIV OPEN
	
	$.each($("#container .party .pic > .basepic > .pinvite_position > .contents > .B-position"),function() {
		
		$(this).mouseup(function(){
			$("#fullscreen_bg").css("display","block");
			$("#win_friend_invite").css("display","block");
			$("#wrapbox").addClass("changewrapBox");
		});
		
	});
	
	// PartyAdmin PAGE Menu button EVENT
	
	$.each($("#container .party .pic > .partyadminpage > .menu > .menus > div"),function() {
		
		$(this).mouseenter(function() {
            $(this).css("background-color","#f5f5f5");
        });
		$(this).mouseleave(function() {
            $(this).css("background-color","#fff");
        });
		$(this).mousedown(function() {
            $(this).css("background-color","#eee");
        });
		
	});
	
	// PartyAdmin PAGE pageEffect
	
	$.each($("#container .party .pic > .partyadminpage > .menu > .menus"),function() {
	
	if($.browser.msie && $.browser.version == "8.0" ) {
		
					var 	power = $("#container .party .pic > .partyadminpage > .power > .contents");
							member = $("#container .party .pic > .partyadminpage > .member > .contents");
							invite = $("#container .party .pic > .partyadminpage > .invite > .contents");
		
				$(this).children(".menu1").mouseup(function() {
					power.css("visibility","visible");
					power.css("opacity","1");
					power.css("right","0");
					member.css("visibility","hidden");
					member.css("opacity","0");
					invite.css("visibility","hidden");
					invite.css("opacity","0");
				});
				$(this).children(".menu2").mouseup(function() {
					power.css("visibility","vhideen");
					power.css("opacity","0");
					member.css("visibility","visible");
					member.css("opacity","1");
					member.css("right","0");
					invite.css("visibility","hidden");
					invite.css("opacity","0");
				});
				$(this).children(".menu3").mouseup(function() {
					power.css("visibility","hidden");
					power.css("opacity","0");
					member.css("visibility","hidden");
					member.css("opacity","0");
					invite.css("visibility","visible");
					invite.css("opacity","1");
					invite.css("right","0");
				});
		
	} else {

					var 	power = $("#container .party .pic > .partyadminpage > .power > .contents");
							member = $("#container .party .pic > .partyadminpage > .member > .contents");
							invite = $("#container .party .pic > .partyadminpage > .invite > .contents");
				
				$(this).children(".menu1").mouseup(function() {
					power.css("visibility","visible");
					power.animate({ right: "0px" },{queue:false,duration:400});
					power.fadeTo(400,1);
					member.css("visibility","hidden");
					member.css("right","20px");
					member.css("opacity","0");
					invite.css("visibility","hidden");
					invite.css("right","20px");
					invite.css("opacity","0");
				});
				$(this).children(".menu2").mouseup(function() {
					member.css("visibility","visible");
					member.animate({ right: "0px" },{queue:false,duration:400});
					member.fadeTo(400,1);
					power.css("visibility","hidden");
					power.css("right","20px");
					power.css("opacity","0");
					invite.css("visibility","hidden");
					invite.css("right","20px");
					invite.css("opacity","0");
				});
				$(this).children(".menu3").mouseup(function() {
					invite.css("visibility","visible");
					invite.animate({ right: "0px" },{queue:false,duration:400});
					invite.fadeTo(400,1);
					member.css("visibility","hidden");
					member.css("right","20px");
					member.css("opacity","0");
					power.css("visibility","hidden");
					power.css("right","20px");
					power.css("opacity","0");
				});
	
			}
			
	});
	
	// PartyAdmin PAGE Power OX EVENT
	
	$.each($("#container .party .pic > .partyadminpage > .power > .contents > .container .OX"),function() {
		
		$(this).children(".O-read").mousedown(function(){
			$(this).css("background-image","url(../images/party/Container/ock.png)");
			$("#container .party .pic > .partyadminpage > .power > .contents > .container > .read > .OX > .X-read").css("background-image","url(../images/party/Container/x.png)");
		});
		$(this).children(".X-read").mousedown(function(){
			$(this).css("background-image","url(../images/party/Container/xck.png)");
			$("#container .party .pic > .partyadminpage > .power > .contents > .container > .read > .OX > .O-read").css("background-image","url(../images/party/Container/o.png)");
		});
		
		$(this).children(".O-regi").mousedown(function(){
			$(this).css("background-image","url(../images/party/Container/ock.png)");
			$("#container .party .pic > .partyadminpage > .power > .contents > .container > .regi > .OX > .X-regi").css("background-image","url(../images/party/Container/x.png)");
		});
		$(this).children(".X-regi").mousedown(function(){
			$(this).css("background-image","url(../images/party/Container/xck.png)");
			$("#container .party .pic > .partyadminpage > .power > .contents > .container > .regi > .OX > .O-regi").css("background-image","url(../images/party/Container/o.png)");
		});
		
	});
	
	// PartyAdmin PAGE member & invite scroll effect
	
	 
	 $.each($(".Tap"),function() {
		 
		 var mem			= $("#partyadmin_member_container"), 								invite		= $("#partyadmin_invite_container");
		 var mem_bar	= $("#partyadmin_member_container .dragger_container"), 	invite_bar	 	= $("#partyadmin_invite_container .dragger_container");
		 
			 if($.browser.msie && $.browser.version == "8.0" ) {
				 
								mem.mouseenter(function() { mem_bar.css("visibility","visible") });
								mem.mouseleave(function() {	mem_bar.css("visibility","hidden") });
								 
								invite.mouseenter(function() { 	invite_bar.css("visibility","visible") });
								invite.mouseleave(function() {	invite_bar.css("visibility","hidden"); });
				 
			 } else {
			 
								mem.mouseenter(function() {  mem_bar.css("visibility","visible");mem_bar.fadeTo(400,1);});
								mem.mouseleave(function() {	mem_bar.fadeTo(400,0); });
								 
								invite.mouseenter(function() { invite_bar.css("visibility","visible");invite_bar.fadeTo(400,1) });
								invite.mouseleave(function() {	invite_bar.fadeTo(400,0); });
			
			}
		 
	 });
	 
	 $.each($("#container .party .info > .contents > .popularpeople > .contents > .ppevent > .exist .pic"),function() {
		 
				   if($.browser.msie && $.browser.version == "8.0" ) {
					   
								 $(this).mouseenter(function() {
										
										$(this).children(".nametext").css("visibility","visible");
										$(this).children(".namebg").css("visibility","visible");
										 
								 });
								 
								 $(this).mouseleave(function() {
									 
										$(this).children(".nametext").css("visibility","hidden");
										$(this).children(".namebg").css("visibility","hidden");
									 
								 });
					   
				   } else {
					   
								 $(this).mouseenter(function() {
										
										$(this).children(".nametext").animate({bottom: "15px",opacity: "1"},{duration:200});
										$(this).children(".namebg").animate({bottom: "10px",opacity: ".7"},{duration:200});
										 
								 });
								 
								 $(this).mouseleave(function() {
									 
									 $(this).children(".nametext").animate({bottom: "25px",opacity: "0"},{duration:200});
									 $(this).children(".namebg").animate({bottom: "10px", opacity: "0"},{duration:200});
									 
								 });
									   
				   }
		 
	 });
	 
	 // info member name EVENT
	 
	 $.each($("#container .party .info > .contents > .member > .contents"),function() {
		 $(this).children(".have").mouseenter(function() {
			 $(this).children(".name_position").css("visibility","visible");
		 });
		 $(this).children(".have").mouseleave(function() {
			 $(this).children(".name_position").css("visibility","hidden");
		 });
	 });
	 
	// INFOPAGE MEMBER 로 가는 EVENT
	
	/**/$.each($("#container .party .info > .contents > .member > .title > .more"),function() {
		
		$(this).click(function() {
			if($.browser.msie && $.browser.version == "8.0" ) {
			
				$(".info_area, #container > .board").css("display","none");
            	$("#info_memberpage").css("display","block");
			
			} else {
				$(".info_area, #container > .board").css("display","none");
				$(".info_area, #container > .board").css("opacity","0");
				$("#info_memberpage").css("display","block");
				$("#info_memberpage").fadeTo(400,1);
			}
        });
		
	});
	
	/* 130227 */
	
	/**/$.each($("#info_memberpage > .contents > .title > .position"),function() {
		
		$(this).mouseup(function() {
            $("#info_memberpage > .header").css("background-image","url(../../images/partyplay/info_memberpage_sub.png)")
            $("#info_memberpage").css("display","none");
			$("#info_memberpage").css("opacity","0");
			$(".info_area, #container > .board").css("display","block");
			$(".info_area, #container > .board").fadeTo(400,1);		
		});
		
	});
	 
	// INFOPAGE MEMBER PINVITE 친구초대 EVENT
	
	$.each($("#info_memberpage > .contents > .subtitle > a"),function() {
		
		$(this).mouseup(function(){
			$("#fullscreen_bg").css("display","block");
			$("#win_friend_invite").css("display","block");
			$("#wrapbox").addClass("changewrapBox");
		});
		
	});
	
	// INFOPAGE MEMBER 친구추가버튼 EVENT
	
	$.each($("#info_memberpage > .contents > .container > .cards > .button > .Button_gray"),function() {
		
		$(this).mouseleave(function() {
			$(this).css("background-image","url(../images/party/Container/buttongraybg.png)");
		});
		$(this).mousedown(function() {
			$(this).css("background-image","url(../images/party/Container/buttongraybgck.png)");
		});
		$(this).mouseup(function() {
			
			if($.browser.msie && $.browser.version == "8.0" ) {
				$(this).css("background-image","url(../images/party/Container/buttongraybg.png)");
				$(this).html("요청 완료<div class=\"Button_gray_word\">요청 완료</div>");
				$(this).addClass("Button_gray_selected_ie8");
				$(this).children(".Button_gray_word").addClass("Button_gray_selected_word_ie8");			
			} else {
				$(this).css("background-image","url(../images/party/Container/buttongraybg.png)");
				$(this).html("요청 완료<div class=\"Button_gray_word\">요청 완료</div>");
				$(this).addClass("Button_gray_selected");
				$(this).children(".Button_gray_word").addClass("Button_gray_selected_word");
			}
		});
		
	});
	
	// INFOPAGE Anounce 제목글 클릭하였을 시 공지 원문 보기
	
	$.each($("#container .party .info > .contents > .anounce > .contents > .exist > .subtitle"),function() {
		
		$(this).mouseup(function(){
			$("#fullscreen_bg").css("display","block");
			$("#win_anounce_original").css("display","block");
			$("#wrapbox").addClass("changewrapBox");
		});
		
	});
	
	// INFOPAGE ANOUNCE 로 가는 EVENT
	
	$.each($("#container .party .info > .contents > .anounce > .title > .more"),function() {
		
		$(this).click(function() {
			
			if($.browser.msie && $.browser.version == "8.0" ) {
			
				$(".info_area, #container > .board").css("display","none");
            	$("#info_anouncepage").css("display","block");
			
			} else {
				$(".info_area, #container > .board").css("display","none");
				$(".info_area, #container > .board").css("opacity","0");
            	$("#info_anouncepage").css("display","block");
				$("#info_anouncepage").fadeTo(400,1);
			}
			
        });
		
	});
	
	/**/$.each($("#info_anouncepage > .contents > .title > .position"),function() {
		
		$(this).click(function() {
			
			if($.browser.msie && $.browser.version == "8.0" ) {
				$("#info_anouncepage").css("display","none");
				$(".info_area, #container > .board").css("display","block");
			} else {
				$("#info_anouncepage").css("display","none");
				$("#info_anouncepage").css("opacity","0");
				$(".info_area, #container > .board").css("display","block");
				$(".info_area, #container > .board").fadeTo(400,1);
			}
		});
		
	});
	
	// INFOPAGE ANOUNCE 스킬부분 오버 EVENT
	
	$.each($("#info_anouncepage > .contents > .container > .post > .title > .skill"),function() {
			$(this).children(".candy").mouseover(function() {
            	$(this).css("color","#aaa");
       		});
			$(this).children(".candy").mousedown(function() {
            	$(this).css("color","#c1c1c1");
				$(this).html("- Candy");
       		});
	});
	
	// INFOPAGE ANOUNCE 코멘트부분 DELETE 창 뜨는 EVENT
	
	$.each($("#info_anouncepage > .contents > .container > .post > .contents > .comment > .list > .comments"),function() {
		
		$(this).mouseenter(function() {
            $(this).children(".delete").css("visibility","visible");
        });
		$(this).mouseleave(function() {
            $(this).children(".delete").css("visibility","hidden");
        });
		
	});
	
	// INFOPAGE ANOUNCE 펼치기 EVENT
	
	$.each($("#info_anouncepage > .contents > .container > .post > .title"),function() {
		
		$("#anounce1").mouseup(function() {
			$("#anounce1c").css("display","block");
			$("#anounce1t").css("border-bottom-color","#dc5457");
			$("#anounce1a").html("<img src=..//\"../images/party/Container/anouncearrowck.png/\" alt=\"\" />");
		});
		$("#anounce2").mouseup(function() {
			$("#anounce2c").css("display","block");
			$("#anounce2t").css("border-bottom-color","#dc5457");
			$("#anounce2a").html("<img src=..//\"../images/party/Container/anouncearrowck.png/\" alt=\"\" />");
		});
		
	});
	
	// INFOPAGE ANOUNCE 속 스크랩 EVENT
	
	$.each($("#info_anouncepage > .contents > .container > .post > .title > .skill > .scrap"),function() {
		$(this).mouseup(function() {
			$(this).siblings(".scrapbox").css("display","block");
		});
	});
	
	$.each($("#info_anouncepage > .contents > .container > .post > .title > .skill > .scrapbox > .selectbox"),function() {
		$(this).mouseup(function() {
			$(this).children(".window").css("display","block");
		});
	});
	
	// 파티미리보기 (pre_party)클릭시 페이지 전환효과
	
	$.each($("#pre_party > .contents > .section > ul"),function() {
		
		$(this).mouseup(function(){
			
			if($.browser.msie && $.browser.version == "8.0") {
			
				if ( party_trans_defence == 0 ) {
				
						loading_circuling = setInterval("unlimited()",25);
						$("#container").css("display","none");	// container hidden
						$("#loaderDiv").fadeTo(200,1);	// loader open!
						
						$("#loaderDiv").delay(500).fadeTo(200,0); // loader hidden?
						$("#container").delay(900).css("visibility","visible"); // container open!
						
						party_trans_defence = 1;
						setTimeout('loading_Notshake()',1400);
				}
				
			} else {

					if ( party_trans_defence == 0 ) {
					
							loading_circuling = setInterval("unlimited()",25);
							$("#container").css("display","none")	// container hidden
							$("#loaderDiv").delay(50).fadeTo(200,1);	// loader open!
							
							$("#loaderDiv").delay(500).fadeTo(200,0); // loader hidden?
							$("#container").delay(800).fadeTo(400,1); // container open!
							
							party_trans_defence = 1;
							setTimeout('loading_Notshake()',1400);
					}
			
			}
			
		});
		
	});
    
});

var party_trans_count = 1;
var party_trans_defence = 0;

function unlimited() {
		document.getElementById("loadimg").setAttribute('src','../loading/'+party_trans_count+'.gif');
	if ( party_trans_count == 18 ) {
		party_trans_count = 1;
	} else {
		party_trans_count = party_trans_count + 1;
	}
}

function loading_Notshake() {
	clearInterval(loading_circuling);
	party_trans_defence = 0;
}

// Pre_Party moving EVENT

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

/**/$(document).ready(function(e) {
    
	$("#info_memberpage > .contents > .container > .cards:even").css("background-color","#f6f6f6");
	$("#info_anouncepage > .contents > .container > .post").css("background-color","#f6f6f6");
});