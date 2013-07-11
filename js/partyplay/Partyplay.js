
function partypre_func() {	
		
		var SDDw = $(".SDD-wassup"), SDDn = $(".SDD-note"), SDDp = $(".SDD-party");
		var navw = $(".nav-wassup"), 	navn = $(".nav-note"), 	navp = $(".nav-party");
		
		navp.mouseenter(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_wassupov.png)")});
		navn.mouseenter(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_noteov.png)")});
		
		navp.mouseleave(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_wassup.png)")});
		navn.mouseleave(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_note.png)")});
		
		navp.mousedown(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_wassupck.png)")});
		navn.mousedown(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_noteck.png)")});
		
		navp.mouseup(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_wassupov.png)");
			post_to_url('../../wassup/',{});
		});
		navn.mouseup(function() { 	SDDn.css("background-image","url(../images/party/Header/header_menu_noteov.png)");
		
													post_to_url('../../note/',{'mynoteid':user[4]});
		});
		
		// nav-search EVENT.
	
	// 밖에서 친구초대
	
	
		
	$(".basepic > .invite_friend > .text > h1").mouseup(function(){
		if(joined==1){
			tempnow = now;
			$("#fullscreen_bg").css("display","block");
			$("#win_friend_invite").css("display","block");
			$("#wrapbox").addClass("changewrapBox");
			Party_Invite_MyFriend();
		}
		else{
			alert('파티에 가입하시면 이용하실 수 있습니다');
		}
	});
		
	
	
	//안에서 친구초대
 	
		
	$("#info_memberpage > .contents > .title > .text > h1").mouseup(function(){			
		if(joined==1){
			tempnow = now;
			$("#fullscreen_bg").css("display","block");
			$("#win_friend_invite").css("display","block");
			$("#wrapbox").addClass("changewrapBox");
			Party_Invite_MyFriend();
		}
		else{
			alert('파티에 가입하시면 이용하실 수 있습니다');
		}
	});
		
	
	 
	// 멤버보기
	
	$.each($("#container .party .info > .contents > .member > .title > .more"),function() {
		
		$(this).click(function() {
			if(typeof pageYOffset != 'undefined'){
				$(".info_area, #container > .board").css("display","none");
				$(".info_area, #container > .board").css("opacity","0");
				Party_Members_All_Load();
				$("#info_memberpage").css("display","block");
				$("#info_memberpage").fadeTo(400,1);
			}
			else{
				Party_Members_All_Load();
				$(".info_area, #container > .board").css("display","none");
            	$("#info_memberpage").css("display","block");
			}
			
        });
		
	});
	
	$.each($("#info_memberpage > .contents > .title > .back"),function() {
		
		$(this).click(function() {
            $("#info_memberpage").css("display","none");
			$("#info_memberpage").css("opacity","0");
			$(".info_area, #container > .board").css("display","block");
			$(".info_area, #container > .board").fadeTo(400,1);
		});
		
	});
	 
	// INFOPAGE MEMBER PINVITE 친구초대 EVENT
	
	$.each($("#info_memberpage > .contents > .subtitle > a"),function() {
		
		$(this).mouseup(function(){
			tempnow = now;
			$("#fullscreen_bg").css("display","block");
			$("#win_friend_invite").css("display","block");
			$("#wrapbox").addClass("changewrapBox");
			 Party_Invite_MyFriend();
		});
		
	});
	
	
	// INFOPAGE Anounce 제목글 클릭하였을 시 공지 원문 보기
	
	$.each($("#container .party .info > .contents > .anounce > .contents > .exist > .subtitle"),function() {
		
		$(this).mouseup(function(){
			if(notjoined==0){
				$("#fullscreen_bg").css("display","block");
				$("#win_anounce_original").css("display","block");
				tempnow = now;		
				$("#wrapbox").addClass("changewrapBox");			
				MakeWinAnounce();
			}
			else{
				alert('파티에 가입한 멤버만 이용할 수 있습니다');
			}
		});
		
	});
	
	// INFOPAGE ANOUNCE 로 가는 EVENT
	
	$.each($("#container .party .info > .contents > .anounce > .title > .more"),function() {
		
		$(this).click(function() {
			if(notjoined==0){
				if(nonotice==0){
					if(typeof pageYOffset != 'undefined'){
						$(".info_area, #container > .board").css("display","none");
						$(".info_area, #container > .board").css("opacity","0");
						$("#info_anouncepage").css("display","block");
						$("#info_anouncepage").fadeTo(400,1);
						//MakeAnounces();
					}
					else{
						$(".info_area, #container > .board").css("display","none");
						$("#info_anouncepage").css("display","block");
						//MakeAnounces();
					}			
				}
			}
			else{
				alert('파티에 가입한 멤버만 이용할 수 있습니다');
			}
        });
		
	});
	
	$.each($("#info_anouncepage > .contents > .title > .back"),function() {
		
		$(this).click(function() {
			if(typeof pageYOffset != 'undefined'){
				$("#info_anouncepage").css("display","none");
				$("#info_anouncepage").css("opacity","0");
				$(".info_area, #container > .board").css("display","block");
				$(".info_area, #container > .board").fadeTo(400,1);
			}
			else{
				$("#info_anouncepage").css("display","none");
				$(".info_area, #container > .board").css("display","block");
			}			
		});
		
	});
}
/**/$(document).ready(function(e) {

	$("#info_memberpage > .contents > .container > .cards:first").css("border-top-left-radius","4px").css("border-top-right-radius","4px");
	$("#info_memberpage > .contents > .container > .cards:last").css("border-bottom-left-radius","4px").css("border-bottom-right-radius","4px");

}); // 가입한 멤버 목록 전체보기 첫번째 마지막 css변경


$(document).ready(function() {
    
	$("#container > .party > .info_area > .pic > .basepic > .setting > .ico").mouseenter(function() {
		
		$(this).children(".explain").css("display","block")
		
	});
	
	$("#container > .party > .info_area > .pic > .basepic > .setting > .ico").mouseleave(function() {
		
		$(this).children(".explain").css("display","none")
		
	});
	
}); // 파티설정하기 버튼 hover : 설명보여주기 0411


function kim_menu_display_none() {
	
	$("#container > .party > .info_area > .pic > .basepic > .setting > .menu").css("display","none")
	$("#container > .party > .info_area > .pic > .basepic > .setting > .ico").addClass("Onoff_basepic_setting_ico_menu")
	
}

$(document).ready(function() {
    
	$("#container > .party > .info_area > .pic > .basepic > .setting > .ico").click(function() {
		
		if ($(this).hasClass("Onoff_basepic_setting_ico_menu") == true ) {
		
			$(this).siblings(".menu").css("display","block").css("opacity","1")
			$(this).removeClass("Onoff_basepic_setting_ico_menu")
			
		} else {
		
			$(this).siblings(".menu").fadeTo(600,0)
			setTimeout(kim_menu_display_none,600)

		}
		
	});
	
}); // 파티설정하기 버튼 hover : 설명보여주기 0411

$(document).ready(function() {

	$("#partyadminpage > .power > .contents > .container > .show > .container > .button > .on").click(function() {
        authchanged=1;
		$(this).addClass("selected")
		$(this).siblings(".off").removeClass("selected")
		$(this).parent(".button").siblings(".explain").children(".off").removeClass("selected")
		$(this).parent(".button").siblings(".explain").children(".on").addClass("selected")
		$("#partyadminpage > .power > .contents > .container > .allow").css("display","block")
		
    }); // 권한 관리 > 파티명 노출 여부 : 공개 클릭시
    
	$("#partyadminpage > .power > .contents > .container > .show > .container > .button > .off").click(function() {
        authchanged=1;
		$(this).addClass("selected")
		$(this).siblings(".on").removeClass("selected")
		$(this).parent(".button").siblings(".explain").children(".on").removeClass("selected")
		$(this).parent(".button").siblings(".explain").children(".off").addClass("selected")
		$("#partyadminpage > .power > .contents > .container > .allow").css("display","none")
		
    }); // 권한 관리 > 파티명 노출 여부 : 비공개 클릭시
	
}); // 파티명 노출 여부 0411

$(document).ready(function() {

	$("#partyadminpage > .power > .contents > .container > .allow > .container > .button > .on").click(function() {
        authchanged=1;
		$(this).addClass("selected")
		$(this).siblings(".off").removeClass("selected")
		$(this).parent(".button").siblings(".explain").children(".off").removeClass("selected")
		$(this).parent(".button").siblings(".explain").children(".on").addClass("selected")
		
    }); // 권환관리 : 가입 권한 관리 : 자유 클릭시
    
	$("#partyadminpage > .power > .contents > .container > .allow > .container > .button > .off").click(function() {
        authchanged=1;
		$(this).addClass("selected")
		$(this).siblings(".on").removeClass("selected")
		$(this).parent(".button").siblings(".explain").children(".on").removeClass("selected")
		$(this).parent(".button").siblings(".explain").children(".off").addClass("selected")
		
    }); // 권한관리 : 가입 권한 관리 : 승인 클릭시
	
}); // 가입 권한 관리 0411

$(document).ready(function() {
	//save
    $("#partyadminpage > .power > .contents > .header > .save").click(function() {
		
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
	});
	
	//close
	$("#partyadminpage > .power > .contents > .header > .close").click(function() {
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
				$("#partyadminpage").children(".power").animate({top:'-250px'},300)	;;			
			}
			else{
				authchanged=0;
				$("#fullscreen_bg").css("display","none");
				$("#wrapbox").removeClass("changewrapBox");
				$("#partyadminpage").children(".power").animate({top:'-250px'},300);
			}
		}
		else{
			$("#fullscreen_bg").css("display","none");
			$("#wrapbox").removeClass("changewrapBox");
			$("#partyadminpage").children(".power").animate({top:'-250px'},300)
		}
	});
	
}); // 권한 설정하기 취소하기 / 닫기 / close 0411
var authchanged=0;
$(document).ready(function() {
    
	$("#container > .party > .info_area > .pic > .basepic > .setting > .menu > .power").click(function() {
        
		$("#fullscreen_bg").css("display","block")
		$("#wrapbox").addClass("changewrapBox");
		$("#partyadminpage").css("display","block")
		$("#partyadminpage").children(".power").css("display","block").animate({top:'0'},400);
		new ajax.xhr.Request("../../RequestAjax/Party_Information.php","req_party="+partyid,partyauthwindow,'POST');	
		//partyauthwindow
function partyauthwindow(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{			
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");				
							
				a = data.p_public;
				b = data.p_permission;
				
				if(a==0){
					$("#partyadminpage > .power > .contents > .container > .show > .container > .button > .on").addClass("selected")
					$("#partyadminpage > .power > .contents > .container > .show > .container > .button > .on").siblings(".off").removeClass("selected")
					$("#partyadminpage > .power > .contents > .container > .show > .container > .button > .on").parent(".button").siblings(".explain").children(".off").removeClass("selected")
					$("#partyadminpage > .power > .contents > .container > .show > .container > .button > .on").parent(".button").siblings(".explain").children(".on").addClass("selected")
					$("#partyadminpage > .power > .contents > .container > .allow").css("display","block")
					if(b==0){
						$("#partyadminpage > .power > .contents > .container > .allow > .container > .button > .on").addClass("selected")
						$("#partyadminpage > .power > .contents > .container > .allow > .container > .button > .on").siblings(".off").removeClass("selected")
						$("#partyadminpage > .power > .contents > .container > .allow > .container > .button > .on").parent(".button").siblings(".explain").children(".off").removeClass("selected")
						$("#partyadminpage > .power > .contents > .container > .allow > .container > .button > .on").parent(".button").siblings(".explain").children(".on").addClass("selected")
					}
					else{
						$("#partyadminpage > .power > .contents > .container > .allow > .container > .button > .off").addClass("selected")
						$("#partyadminpage > .power > .contents > .container > .allow > .container > .button > .off").siblings(".on").removeClass("selected")
						$("#partyadminpage > .power > .contents > .container > .allow > .container > .button > .off").parent(".button").siblings(".explain").children(".on").removeClass("selected")
						$("#partyadminpage > .power > .contents > .container > .allow > .container > .button > .off").parent(".button").siblings(".explain").children(".off").addClass("selected")
					}
				}
				else{
					$("#partyadminpage > .power > .contents > .container > .show > .container > .button > .off").addClass("selected")
					$("#partyadminpage > .power > .contents > .container > .show > .container > .button > .off").siblings(".on").removeClass("selected")
					$("#partyadminpage > .power > .contents > .container > .show > .container > .button > .off").parent(".button").siblings(".explain").children(".on").removeClass("selected")
					$("#partyadminpage > .power > .contents > .container > .show > .container > .button > .off").parent(".button").siblings(".explain").children(".off").addClass("selected")
					$("#partyadminpage > .power > .contents > .container > .allow").css("display","none")
				}
			}
			else{
				alert("실패");
			}
			
		}
		else{
			alert("에러발생");	
		}
	}
	else
	{
		//alert("로딩중");		
	}
}
    });
	
}); // 권한 설정하기 열기

$(document).ready(function() {
    
	$("#partyadminpage > .member > .contents > .header > .close").click(function() {
		
		$("#fullscreen_bg").css("display","none");
		$("#wrapbox").removeClass("changewrapBox");
		$("#partyadminpage").children(".member").animate({top:'-480px'},300)
		
	});
	
}); // 파티 멤버 닫기 / close 0411

$(document).ready(function() {
    
	$("#container > .party > .info_area > .pic > .basepic > .setting > .menu > .member").click(function() {
        
		$("#fullscreen_bg").css("display","block")
		$("#wrapbox").addClass("changewrapBox");
		$("#partyadminpage").css("display","block")
		$("#partyadminpage").children(".member").animate({top:'0'},400)
		new ajax.xhr.Request("../../RequestAjax/Party_MemberList.php","req_party="+partyid,admin_present_party_mem,'POST');
		//alert('준비중입니다');
		
    });
	
}); // 파티 멤버 관리하기 열기

$(document).ready(function() {
    
	$("#partyadminpage > .request > .contents > .header > .close").click(function() {
		
		$("#fullscreen_bg").css("display","none");
		$("#wrapbox").removeClass("changewrapBox");
		$("#partyadminpage").children(".request").animate({top:'-480px'},300)	//328
		
	});
	
}); // 가입 승인 요청 닫기 / close 0411

function admin_present_party_mem(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{			
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");				
				FID = new Array();
				FNAME = new Array();
				FPIC = new Array();
				FNOTICE = new Array();
				MNum = data.MemberNum;
				padmin = data.Admin;
				for(i=0;i<MNum;i++){
					FID[i] = data.Member[i].Fid;
					FNAME[i] = data.Member[i].Fname;
					FPIC[i] = data.Member[i].Fpic;
					FNOTICE[i] = data.Member[i].Fnotice;
				}
				admin_Present_Party_Member(MNum, FID, FNAME, FPIC, padmin,FNOTICE);
						
			}
			else{
				alert("실패");
			}
			
		}
		else{
			alert("에러발생");	
		}
	}
	else
	{
		//alert("로딩중");		
	}
}

function admin_Present_Party_Member(a, b, c, d, e, f){
	aaText = "";
	$("#partyadmin_member_container > .ScrollBox > .container > .content > .listwrap").html("");
	for(i=0;i<a;i++){		
		newDiv = document.createElement('DIV');
		$(newDiv).attr("class","list");
		aaText += " <div class=\"pic\" alt=\""+b[i]+"\"><img src=\"../../"+d[i]+"\" height=\"50\" width=\"50\" alt=\"\" class=\"pie\" /></div><div class=\"name\"><h1>"+c[i]+"</h1></div><div class=\"score\">Score : 준비중입니다</div>";
		if(padmin==b[i]){
			
		}
		else{
			if(f[i]==1){				
				aaText += "<div class=\"button\"><div class=\"Button_gray margin Button_gray_selected\" alt=\"2\">권한 취소<div class=\"Button_gray_word Button_gray_selected_word\">권한 취소</div></div><div class=\"Button_red\">강제 탈퇴<div class=\"Button_red_word\">강제 탈퇴</div></div></div>";
			}
			else{
				aaText += "<div class=\"button\"><div class=\"Button_gray margin\" alt=\"1\">공지 권한 주기<div class=\"Button_gray_word\">공지 권한 주기</div></div><div class=\"Button_red\">강제 탈퇴<div class=\"Button_red_word\">강제 탈퇴</div></div></div>";
			}
		}
		$(newDiv).html(aaText);
		aaText = "";
		$("#partyadmin_member_container > .ScrollBox > .container > .content > .listwrap").append(newDiv);
	}
	$("#partyadmin_member_container").mCustomScrollbar("vertical",400,"easeOutCirc",1.05,"auto","yes","yes",10);
	
	// BUTTON2_GRAY OVER CLICK
	
	$.each($("#partyadmin_member_container  > .ScrollBox > .container > .content > .listwrap > .list > .button > .Button_gray"),function() {

		$(this).mousedown(function() {
			$(this).css("background-image","url(../images/party/Container/buttongraybgck.png)");
		});
		$(this).mouseup(function() {
			$(this).css("background-image","url(../images/base/buttongray2bg.png)");
			
			if($(this).attr("alt")==1){
				if(confirm('이 회원에게 파티에 공지글을 게시할 수 있는 권한을 주시겠습니까?')){
					if(typeof pageYOffset != 'undefined'){
						$(this).css("background-image","url(../images/party/Container/buttongraybg.png)");
						$(this).html("권한 취소<div class=\"Button_gray_word\">권한 취소</div>");
						$(this).addClass("Button_gray_selected");
						$(this).children(".Button_gray_word").addClass("Button_gray_selected_word");
						$(this).attr("alt","2");
					}
					else{
						$(this).css("background-image","url(../images/party/Container/buttongraybg.png)");
						$(this).html("권한 취소<div class=\"Button_gray_word\">권한 취소</div>");
						$(this).addClass("Button_gray_selected_ie8");
						$(this).children(".Button_gray_word").addClass("Button_gray_selected_word_ie8");		
						$(this).attr("alt","2");						
					}
					new ajax.xhr.Request("../../RequestAjax/Party_Notice_Auth.php","position=1&pid="+partyid+"&fid="+$(this).parent(".button").siblings(".pic").attr("alt"),nothingdo,'POST');				
				}
			}
			else{
				if(confirm('이 회원의 공지글을 게시할 수 있는 권한을 해지하시겠습니까?')){
					if(typeof pageYOffset != 'undefined'){
						$(this).css("background-image","url(../images/base/buttongray2bg.png)");
						$(this).html("공지 권한 주기<div class=\"Button_gray_word\">공지 권한 주기</div>");
						$(this).removeClass("Button_gray_selected");
						$(this).children(".Button_gray_word").removeClass("Button_gray_selected_word");
						$(this).attr("alt","1");
					}
					else{
						$(this).css("background-image","url(../images/base/buttongray2bg.png)");
						$(this).html("공지 권한 주기<div class=\"Button_gray_word\">공지 권한 주기</div>");
						$(this).removeClass("Button_gray_selected_ie8");
						$(this).children(".Button_gray_word").removeClass("Button_gray_selected_word_ie8");		
						$(this).attr("alt","1");
					}
					new ajax.xhr.Request("../../RequestAjax/Party_Notice_Auth.php","position=2&pid="+partyid+"&fid="+$(this).parent(".button").siblings(".pic").attr("alt"),nothingdo,'POST');	
				}
			}
			//alert('준비중입니다');
			
		});
		
	}); // BUTTON_GRAY OVER CLICK END
	
	// BUTTON_RED OVER CLICK	
	$.each($("#partyadmin_member_container  > .ScrollBox > .container > .content > .listwrap > .list > .button > .Button_red"),function() {
		
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
			if(confirm('정말 이 회원을 파티에서 추방하시겠습니까? (추방된 회원은 다시 파티에 가입이 불가능 합니다)')){
				alert('준비중입니다');
			}
			else{
				//nothing do
			}
			$(this).css("background-image","url(../images/party/Container/buttonbgov.png)");
		});
		
	}); // BUTTON_RED OVER CLICK END
}	//324

$(document).ready(function() {
    
	$("#container > .party > .info_area > .pic > .basepic > .setting > .menu > .request").click(function() {
        
		$("#fullscreen_bg").css("display","block");
		$("#wrapbox").addClass("changewrapBox");
		$("#partyadminpage").css("display","block");
		$("#partyadminpage").children(".request").animate({top:'0'},400);		
		new ajax.xhr.Request("../../RequestAjax/Party_join_auth.php","opt=1&pid="+partyid,joinauthDis,'POST');
		//joinauthDis
		function joinauthDis(req){
			if(req.readyState==4)
			{
				if(req.status == 200)
				{			
					var docXML = req.responseXML;
					var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;
		
					if(code =='success') {
					
						var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
						data = eval("("+dataJSON+")");				
									
						num = data.num;
						mid = new Array();
						mname = new Array();
						mpic = new Array();
						
						for(i=0;i<num;i++){
							mid[i] = data.member[i].mid;
							mname[i] = data.member[i].mname;
							mpic[i] = data.member[i].mpic;
						}
						
						Disjoinauth(num, mid, mname, mpic);
						
					}
					else{
						alert("실패");
					}
					
				}
				else{
					alert("에러발생");	
				}
			}
			else
			{
				//alert("로딩중");		
			}
		}
		function Disjoinauth(a,b,c,d){
			$("#partyadmin_invite_container > .ScrollBox > .container > .content > .listwrap").html(" <div class=\"noinvite\">가입요청이 없습니다.</div>");
			auText = "";
			if(a){		
				for(i=0;i<a;i++){
					newDiv = document.createElement("DIV");
					$(newDiv).attr("class","list");
					auText += "<div class=\"pic\"><img src=\"../../"+d[i]+"\" height=\"50\" width=\"50\" alt=\"\" class=\"pie\" /></div><div class=\"name\"><h1>"+c[i]+"</h1>&nbsp;님이 파티에 가입하고 싶어 합니다.</div><div class=\"button\"><div class=\"Button_red margin\" onClick=\"CanJoin("+b[i]+", this);\">수락<div class=\"Button_red_word\">수락</div></div><div class=\"Button_gray\" onClick=\"DisJoin("+b[i]+", this);\">거절<div class=\"Button_gray_word\">거절</div></div></div>";
					
					$(newDiv).html(auText);
					$("#partyadmin_invite_container > .ScrollBox > .container > .content > .listwrap").append(newDiv);
					auText = "";
				}
				//red_b
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
				});			
				//gray_b
				$.each($(".Button_gray"),function() {	
					$(this).mousedown(function() {
						$(this).css("background-image","url(../images/party/Container/buttongraybg.png)");
						$(this).css("border","1px solid #a1a1a1");
						$(this).css("box-shadow","inset 0 1px 5px #c9c9c9")
						$(this).addClass("Button_gray_selected");
					});
					$(this).mouseup(function() {
						$(this).css("background-image","url(../../images/base/buttongray3bg.png)");
						$(this).css("box-shadow","none")
						$(this).removeClass("Button_gray_selected");
						$(this).css("border","1px solid #ddd").css("border-bottom-color","#aaa").css("border-top-color","#e1e1e1")
					});				
				});
			}
			else{
				$("#partyadmin_invite_container > .ScrollBox > .container > .content > .listwrap > .noinvite").css("display","block");
			}
		}
    });
}); // 가입 승인 요청 열기

//Join/Dis
function  CanJoin(ind, obj){
	if(confirm('이 멤버의 파티가입 요청을 수락하시겠습니까?')){
		new ajax.xhr.Request("../../RequestAjax/Party_join_auth.php","opt=2&pid="+partyid+"&mid="+ind,nothingdo,'POST');		
		$(obj).parent(".button").parent(".list").fadeOut(300,0);		
		setTimeout("joinwantcheck();",500);
	}
}
function DisJoin(ind, obj){	
	if(confirm('이 멤버의 파티가입 요청을 거절하시겠습니까?')){
		new ajax.xhr.Request("../../RequestAjax/Party_join_auth.php","opt=3&pid="+partyid+"&mid="+ind,nothingdo,'POST');
		$(obj).parent(".button").parent(".list").fadeOut(300,0);
		setTimeout("joinwantcheck();",500);
	}
}
function joinwantcheck(){
	dison = 0;
	for(i=0;i<$("#partyadmin_invite_container > .ScrollBox > .container > .content > .listwrap").children(".list").size();i++){
		if(i==0){
			ot = $("#partyadmin_invite_container > .ScrollBox > .container > .content > .listwrap").children(".list").first();
			if($(ot).css("display")=="block"){
				dison = 1;					
			}				
		}
		else{
			ot = $(ot).next(".list");
			if($(ot).css("display")=="block"){
				dison = 1;					
			}
		}
		
	}	
	if(dison!=1){
		$("#partyadmin_invite_container > .ScrollBox > .container > .content > .listwrap > .noinvite").css("display","block");
	}
}

$(document).ready(function() {
    
	$("#container > .party > .info_area > .pic > .party_title > .join").mouseup(function() {
        
		if ( $(this).hasClass("before_click") == true && $(this).html()!="파티 탈퇴하기" ) {
						
			if(permis==0){
				if(confirm('파티에 가입하시겠습니까?')){
					partyjoinquery();
				}
			}
			else{
				if(confirm('파티에 가입하려면 파티쉐의 승인이 필요합니다. 가입 신청을 보내시겠습니까?')){
					partyjoinquery();					
				}
			}
		}
		else if( $(this).hasClass("before_click") == true && $(this).html()=="파티 탈퇴하기"){
			if(confirm('해당 파티에서 탈퇴하시겠습니까?')){
				partyoutquery();
			}
		}
		
    });
	
}); // 파티가입하기 -> 가입 됨

$(document).ready(function() {
    
	$("#container > .party > .info_area > .pic > .basepic > .invite_friend > .close").click(function() {

		$("#container > .party > .info_area > .pic > .basepic > .invite_friend").animate({bottom:'0',opacity:'0'},500)
		
	});
	
}); // 가입 되면 친구초대하기 올라오는 animation

$(document).ready(function() {

	$("#container > .party > .info_area > .info > .contents > .popularpeople > .title > .questionmark").click(function() {
	
			$(this).css("background-image","none").css("background-color","#dc5457").css("color","#fff").css("border","1px solid #CE0005")
			
			$(this).siblings(".pop").css("opacity","1").css("display","block")
		
    });
	
	$("#container > .party > .info_area > .info > .contents > .popularpeople > .title > .pop > .close").click(function() {
		
			$(this).parent(".pop").css("display","none")
		
			$(this).parent(".pop").siblings(".questionmark").css("background-image","url(../../images/base/questionmarkbg.png)")
					.css("background-color","inherit")
					.css("color","#aaa")
					.css("border","1px solid #e1e1e1")
					.css("border-bottom-color","#c8c8c8")
					
					return false;

	});
	
	 var kim_starsumer_work_num_male = 0;
	 var kim_starsumer_work_num_female = 0;
	 
	 
	 function kim_starsumer_work_num_m() {
		 
		 kim_starsumer_work_num_male = 0;
		 
	 }
	 
	 function kim_starsumer_work_num_f() {

		 kim_starsumer_work_num_female = 0;
		 
	 }
	 
	 
	 $.each($("#container .party .info > .contents > .popularpeople > .contents"),function() {

								 $(this).children(".male").children(".exist").mouseenter(function() {
									 
									 if ( kim_starsumer_work_num_male == 0 ) {
										
										kim_starsumer_work_num_male = 1;
										
										$(this).children(".pic").children(".namebg").animate({right: "10px",opacity: ".7"},{duration:200});
										$(this).children(".pic").children(".nametext").delay(200).animate({right: "10px",opacity: "1"},{duration:100});
										
									 }
										 
								 });
								 
								 $(this).children(".male").children(".exist").mouseleave(function() {
									 
									 if ( kim_starsumer_work_num_male == 1 ) {
									 
										 $(this).children(".pic").children(".namebg").delay(200).animate({right: "0", opacity: "0"},{duration:100});
										 $(this).children(".pic").children(".nametext").animate({right: "0",opacity: "0"},{duration:200});
										 
										 setTimeout(kim_starsumer_work_num_m,300)
									 
									 }
									 
								 });	// 남자일경우
								 
								 $(this).children(".female").children(".exist").mouseenter(function() {
									 
									 if ( kim_starsumer_work_num_female == 0 ) {
										
										kim_starsumer_work_num_female = 1;
										
										$(this).children(".pic").children(".namebg").animate({right: "10px",opacity: ".7"},{duration:200});
										$(this).children(".pic").children(".nametext").delay(200).animate({right: "10px",opacity: "1"},{duration:100});
										
									 }
										 
								 });
								 
								 $(this).children(".female").children(".exist").mouseleave(function() {
									 
									 if ( kim_starsumer_work_num_female == 1 ) {
									 
									 $(this).children(".pic").children(".namebg").delay(200).animate({right: "0", opacity: "0"},{duration:100});
									 $(this).children(".pic").children(".nametext").animate({right: "0",opacity: "0"},{duration:200});
									 
										 setTimeout(kim_starsumer_work_num_f,300)
									 
									 }
									 
								 });	// 여자일경우
		 
	 }); // 0411
	
}); // 스타슈머 pop 설명 켜기 끄기 0411

