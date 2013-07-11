
$(document).ready(function() {
	
	$('input[placeholder], textarea[placeholder]').placeholder();
		
	$(function(){
		
	var input = $("#header > .nav > .nav-search > .text-search input"), ico_input = $(".ico-search"), ico_input2 = $(".ch-ico-search");
	var par_input = $(".nav-search"), wht_input = $(".wht-nav-search"), closed = $(".close-search");
	
			input.focus(function() {
	
				   if($.browser.msie && $.browser.version == "8.0" ) {
					   
								par_input.css("background-image","url(../images/party/Header/IE_header_searchbgov.png)");
								ico_input.html('<img src="../../images/party/Header/header_searchICOov.png" height="12" alt="" />');
					   
				   } else {
					   
								input.animate({width:"130px"},{queue:false,duration:300});
								wht_input.animate({width:"160px"},{queue:false,duration:300});
								wht_input.fadeTo(400,1);
								ico_input2.fadeTo(400,1);
								ico_input.fadeTo(400.0);
								closed.fadeTo(400,1);
									   
				   }
		   
			}); //input.focus
			
			input.focusout(function() {
	
				   if($.browser.msie && $.browser.version == "8.0" ) {
					   
								par_input.css("background-image","url(../images/party/Header/IE_header_searchbg.png)");
								ico_input.html('<img src="../../images/party/Header/header_searchICO.png" height="12" alt="" />');
					   
				   } else {
					   
								input.animate({width:"70px"},{queue:false,duration:300});
								wht_input.animate({width:"102px"},{queue:false,duration:300});
								wht_input.fadeTo(400,0.15);
								ico_input2.fadeTo(400,0);
								ico_input.fadeTo(400.1);
								closed.fadeTo(400,0);
									   
				   }
		   
			}); //input.focus
			
			
	 });  // function
	 
	 // cards EVENT.
	 
	 $.each($(".pple-search > div > ul"),function() {
		 
		 $(this).mouseenter(function() {
            
			$(this).css("background-image","url(../images/party/Header/header_searchwin_selected.png)");
			$(this).children("li.name").css("color","#fff");
			$(this).children("li.shareparty").css("color","#e9e9e9");
			
        });
		
		 $(this).mouseleave(function() {
            
			$(this).css("background-image","none");
			$(this).children("li.name").css("color","#777");
			$(this).children("li.shareparty").css("color","#b1b1b1");
			
        });
		 
	 });
	 
	 $.each($(".party-search > div > ul"),function() {
		 
		 $(this).mouseenter(function() {
            
			$(this).css("background-image","url(../images/party/Header/header_searchwin_selected.png)");
			$(this).children("li.outline30").css("background-image","url(../images/party/Header/header_searchwin_partyframeov.png)");
			$(this).children("li.name").css("color","#fff");
			$(this).children("li.shareparty").css("color","#e9e9e9");
			
        });
		
		 $(this).mouseleave(function() {
            
			$(this).css("background-image","none");
			$(this).children("li.outline30").css("background-image","url(../images/party/Header/header_searchwin_partyframe.png)");
			$(this).children("li.name").css("color","#777");
			$(this).children("li.shareparty").css("color","#b1b1b1");
			
        });
		 
	 });
	 
	 // Tap Butto EVENT.
	 
	 $.each($("#header > .Tap"),function() {
		 
		 var prt 	= $(this).children(".invite-party"),  		prt_w 		= $(this).children(".invite-party").children(".win-party"), 				prt_n 		= $(this).children(".invite-party").children(".number-party")
		 var mem = $(this).children(".invite-member"), 	mem_w 	= $(this).children(".invite-member").children(".win-member"),		mem_n 	= $(this).children(".invite-member").children(".number-member"); 
		 var set 	= $(this).children(".setting"),				set_w 		= $(this).children(".setting").children(".win-setting");
		 
		 prt.mousedown	(function() 	{ 	
		 
															$(this).css("background-image","url(../../images/party/Tap/invite-partyclick.png)");
															mem.css("background-image","url(../images/party/Tap/invite-member.png)");
															set.css("background-image","url(../images/party/Tap/setting.png)");					// Change
															
															mem_w.css("visibility","hidden");
															set_w.css("visibility","hidden");  																		// Closed
															
															prt_n.css("display","none");																			// Open
															prt_w.css("visibility","visible");
															
																				
		 		
													});
													
		 mem.mousedown	(function() 	{ 	
														
															$(this).css("background-image","url(../images/party/Tap/invite-memberclick.png)");
															prt.css("background-image","url(../images/party/Tap/invite-party.png)");
															set.css("background-image","url(../images/party/Tap/setting.png)");	// Change
															
															prt_w.css("visibility","hidden");
															set_w.css("visibility","hidden");  																		// Closed
															
															mem_n.css("display","none");																			// Open
															mem_w.css("visibility","visible");										
														
														});
														
		 set.mousedown	(function() 	{ 	
		 
															$(this).css("background-image","url(../images/party/Tap/settingclick.png)");
															prt.css("background-image","url(../images/party/Tap/invite-party.png)");
															mem.css("background-image","url(../images/party/Tap/invite-member.png)");	// Change
															
															prt_w.css("visibility","hidden");
															mem_w.css("visibility","hidden");  																	// Closed
															
															set_w.css("visibility","visible");																		// Open

													});
		 
	 });
	 
	 // invitation EVENT.
	 
	 $.each($(".Tap"),function() {
		 
		 var prt_w 			= $("#invite-party-contents"), 													mem_w 			= $("#invite-member-contents");
		 var prt_w_drag	= $("#invite-party-contents > .ScrollBox > .dragger_container"), 	mem_w_drag	 	= $("#invite-member-contents > .ScrollBox > .dragger_container");
		 
			 if($.browser.msie && $.browser.version == "8.0" ) {
				 
								prt_w.mouseenter(function() { prt_w_drag.css("visibility","visible") });
								prt_w.mouseleave(function() {	prt_w_drag.css("visibility","hidden") });
								 
								mem_w.mouseenter(function() { mem_w_drag.css("visibility","visible") });
								mem_w.mouseleave(function() {	mem_w_drag.css("visibility","hidden"); });
				 
			 } else {
			 
								prt_w.mouseenter(function() {  prt_w_drag.css("visibility","visible");prt_w_drag.fadeTo(400,1); });
								prt_w.mouseleave(function() {	prt_w_drag.fadeTo(400,0); });
								 
								mem_w.mouseenter(function() { mem_w_drag.css("visibility","visible");mem_w_drag.fadeTo(400,1) });
								mem_w.mouseleave(function() {	mem_w_drag.fadeTo(400,0); });
			
			}
		 
	 });
	 
	 $.each($("#invite-party-contents ul"),function() {
		 
		 $(this).mouseenter(function() {
			 
			 $(this).css("background-color","#f5f5f5");
			 $(this).children(".button").css("display","block");
			 
		 });
		 
		 $(this).mouseleave(function() {
			 
			 $(this).css("background-color","#fff");
			 $(this).children(".button").css("display","none");
			 
		 });
		 
	 });
	 
	 $.each($("#invite-member-contents ul"),function() {
		 
		 $(this).mouseenter(function() {
			 
			 $(this).css("background-color","#f5f5f5");
			 $(this).children(".button").css("display","block");
			 
		 });
		 
		 $(this).mouseleave(function() {
			 
			 $(this).css("background-color","#fff");
			 $(this).children(".button").css("display","none");
			 
		 });
		 
	 });
	 
	 $.each($(".setting > .win-setting > .contents > div"),function() {
		 
		 $(this).mouseenter(function() {
			 
			 $(this).css("color","#444");
			 $(this).css("background-color","#f5f5f5");
			 $(this).children(".button").css("display","block");
			 
		 });
		 
		 $(this).mouseleave(function() {
			 
			 $(this).css("color","#666");
			 $(this).css("background-color","#fff");
			 $(this).children(".button").css("display","none");
			 
		 });
		 
	 });
	
});





/* ************************* 04/08 ****************************** */

$(document).ready(function() {
   
	var kim_window_width = $(window).width();

	if ( kim_window_width < 1400 ) {

		$("#header > .Tap > .invite-party > .win-party").css("left","-237px")
		$("#header > .Tap > .invite-member > .win-member").css("left","-237px")
		$("#header > .Tap > .setting > .win-setting").css("left","-78px")
		
	}
	
	$(window).resize(function() {
	  
	  var kim_window_width = $(window).width();

		if ( kim_window_width < 1400 ) {
			
			$("#header > .Tap > .invite-party > .win-party").css("left","-237px")
			$("#header > .Tap > .invite-member > .win-member").css("left","-237px")
			$("#header > .Tap > .setting > .win-setting").css("left","-80px")
			
		} else {
			
			$("#header > .Tap > .invite-party > .win-party").css("left","36px")
			$("#header > .Tap > .invite-member > .win-member").css("left","36px")
			$("#header > .Tap > .setting > .win-setting").css("left","36px")
			
		}

	});
   
});