$(document).ready(function() {
	
	// background click event
	
	$("#fullscreen_bg").click(function() {		
			//$("#fullscreen_bg").css("display","none");
			$("#win_friend_invite").css("display","none");
			$("#win_anounce_original").css("display","none");
			$("#win_board_original").css("display","none");
			$("#win_alarm").css("display","none");
			//$("#wrapbox").removeClass("changewrapBox");
			$("#win_add_party").css("visibility","hidden");
			$("#fullscreen_bg").css("display","none");
			$("#wrapbox").removeClass("changewrapBox");
			// 0411 ▼
			$("#partyadminpage").children(".request").animate({top:'-480px'},300)			
			$("#partyadminpage").children(".member").animate({top:'-480px'},300)			
			invCount=0;
			invArray="";
			$(document).scrollTop(tempnow);

			if(authchanged==1){
				if(confirm('변경된 사항을 저장하시겠습니까?')){
					
					if($("#partyadminpage > .power > .contents > .container > .allow > .container > .button > .on").hasClass("selected")==true){	permis = 0;	}
					else{ permis = 1;	}
					
					if($("#partyadminpage > .power > .contents > .container > .show > .container > .button > .on").hasClass("selected")==true)	{	publik = 0;		}
					else{	publik = 1; permis = 1; }		
			
					new ajax.xhr.Request("../../RequestAjax/Party_Permission.php","req_party="+partyid+"&permis="+permis+"&publik="+publik,nothingdo,'POST');
					
					alert('변경된 사항이 성공적으로 저장되었습니다');		
					authchanged=0;			
					$("#fullscreen_bg").css("display","none");
					$("#wrapbox").removeClass("changewrapBox");
					$("#partyadminpage").children(".power").animate({top:'-250px'},300)							
				}
				else{
					authchanged=0;
					$("#fullscreen_bg").css("display","none");
					$("#wrapbox").removeClass("changewrapBox");
					$("#partyadminpage").children(".power").animate({top:'-250px'},300);
				}
			}
			else{
				$("#partyadminpage").children(".power").animate({top:'-250px'},300)
				$("#fullscreen_bg").css("display","none");
				$("#wrapbox").removeClass("changewrapBox");
			}	
    });
	
	// ESC close event
	
	$(document).keydown(function (e) {
	
		if (e.keyCode == 27) {
			
			//$("#fullscreen_bg").css("display","none");
			$("#win_friend_invite").css("display","none");
			$("#win_anounce_original").css("display","none");
			$("#win_board_original").css("display","none");
			$("#win_alarm").css("display","none");
			//$("#wrapbox").removeClass("changewrapBox");
			$("#win_add_party").css("visibility","hidden");
			$("#fullscreen_bg").css("display","none");
			$("#wrapbox").removeClass("changewrapBox");
			// 0411 ▼			
			$("#partyadminpage").children(".member").animate({top:'-480px'},300)
			$("#partyadminpage").children(".request").animate({top:'-480px'},300)
			invCount=0;
			invArray="";
			$(document).scrollTop(tempnow);
			if(authchanged==1){
				if(confirm('변경된 사항을 저장하시겠습니까?')){

					if($("#partyadminpage > .power > .contents > .container > .allow > .container > .button > .on").hasClass("selected")==true){	permis = 0;	}
					else{ permis = 1;	}
					
					if($("#partyadminpage > .power > .contents > .container > .show > .container > .button > .on").hasClass("selected")==true)	{	publik = 0;		}
					else{	publik = 1; permis = 1; }		
			
					new ajax.xhr.Request("../../RequestAjax/Party_Permission.php","req_party="+partyid+"&permis="+permis+"&publik="+publik,nothingdo,'POST');
					
					alert('변경된 사항이 성공적으로 저장되었습니다');
					authchanged=0;
					$("#fullscreen_bg").css("display","none");
					$("#wrapbox").removeClass("changewrapBox");
					$("#partyadminpage").children(".power").animate({top:'-250px'},300)						
				}
				else{
					authchanged=0;
					$("#fullscreen_bg").css("display","none");
					$("#wrapbox").removeClass("changewrapBox");
					$("#partyadminpage").children(".power").animate({top:'-250px'},300);
				}
			}
			else{
				$("#partyadminpage").children(".power").animate({top:'-250px'},300)
				$("#fullscreen_bg").css("display","none");
				$("#wrapbox").removeClass("changewrapBox");
			}			
		}
	
	});
	
	
	
	
})