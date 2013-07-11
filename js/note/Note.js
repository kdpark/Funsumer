//POST****************************************************************************************************************************************//
function post_to_url(path, params, method) {
    method = method || "post"; // Set method to post by default, if not specified.
    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);
    for(var key in params) {
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", key);
        hiddenField.setAttribute("value", params[key]);
        form.appendChild(hiddenField);
    }
    document.body.appendChild(form);
    form.submit();
} // POST to URL

//before
$(document).ready(function() {
		
	
		// nav-menu EVENT.
		
		var SDDw = $(".SDD-wassup"), SDDn = $(".SDD-note"), SDDp = $(".SDD-party");
		var navw = $(".nav-wassup"), 	navn = $(".nav-note"), 	navp = $(".nav-party");
		
		navw.mouseenter(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_wassupov.png)")});
		navp.mouseenter(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_noteov.png)")});
		
		navw.mouseleave(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_wassup.png)")});
		navp.mouseleave(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_note.png)")});
		
		navw.mousedown(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_wassupck.png)")});
		navp.mousedown(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_noteck.png)")});
		
		navw.mouseup(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_wassupov.png)");
		
			post_to_url('../../party/',{'mynoteid':user[4]});
		});
		navp.mouseup(function() { 	SDDp.css("background-image","url(../images/party/Header/header_menu_noteov.png)");
													post_to_url('../../wassup/',{});
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
						LoadUserFriend();
					});
				
			}	else {
				
					$(this).mouseup(function() {
						$("#container").css("display","none");
						$("#container2").css("display","block");
						LoadUserFriend();
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
			if(isthismypage==1){
				$(this).children(".prof_over").css("display","block")
			}
		});
		
		$("#container > .baseinfo > .info > .prof_pic").mouseleave(function() {
			if(isthismypage==1){
				$(this).children(".prof_over").css("display","none")
			}
		});
		
		$("#container > .baseinfo > .info > .prof_pic").mousedown(function() {			
		if(isthismypage==1){
			frm = document.getElementById('imgiframe');
			if(frm==null) return;
			
			fDoc = frm.contentWindow || frm.contentDocument;
			if(fDoc.document){
				fDoc = fDoc.document;
			}
			
			fDoc.WideUpload.opt.value = 2;
											
			fDoc.WideUpload.imgupload.click();
		}
		});
		
		
		// 친구 추가 클릭시 요청완료로 변경
		
var add_friend_stop = 0;
var vote_stop = 0;
		
		$("#container > .baseinfo > .button > .add_friend").mouseup(function() {
			if ( add_friend_stop == 0 ) {
				$(this).css("opacity","0").fadeTo(500,1).html('<img src=\"../images/note/add_friending.png\" alt=\"\" />')
				add_friend_stop = 1;
				new ajax.xhr.Request("../../RequestAjax/Friend_query.php","fopt=1&fid="+user[4],nothingdo,'POST');
			}
		});
		
	// 인기투표 클릭시 색깔올라오기 
		
		$("#container > .baseinfo > .button > .vote").mouseup(function() {
			if($(this).children('img').attr('alt')!=1){
				if ( vote_stop == 0 ) {
					$(this).css("opacity","0").fadeTo(500,1).html('<img src=\"../images/note/voteok.png\" alt=\"\" />')
					vote_stop = 1;
					new ajax.xhr.Request("../../RequestAjax/votequery.php","opt=1&uid="+user[4],checkvotepossible,'POST');	
					alert(user[0]+'님에게 인기투표를 하셨습니다!!');
					infovotenum();
					$(".baseinfo > .info > .prof_info > .vote_number").css("display","block");
					$(".prof_info").css("margin-top","");
				}				
				//$(this).html('<img src=\"../images/note/voteok.png\" alt=\"1\" />');				
			}
			else{
				alert('인기투표는 하루에 한번만 가능합니다');
			}			
		});
	
	// 커버수정 클릭
	$.each($("#container > .baseinfo > .button > .modi_cover"),function() {
		$(this).children("img").mouseup(function(){
			frm = document.getElementById('imgiframe');
			if(frm==null) return;
			
			fDoc = frm.contentWindow || frm.contentDocument;
			if(fDoc.document){
				fDoc = fDoc.document;
			}
			
			fDoc.WideUpload.opt.value = 1;
					
			fDoc.WideUpload.imgupload.click();
		});
	});
	
	
	// 파티생성하기 버튼클릭시 전체 초대창 띄우는 이벤트
	
	$.each($("#container > .baseinfo > .button > .add_party"),function() {
		$(this).children("img").mouseup(function() {
			tempnow = now;
			$("#fullscreen_bg").css("display","block");
			$("#win_add_party").css("visibility","visible");
			$("#wrapbox").addClass("changewrapBox");
			Party_Invite_MyFriend();			
		});
	});
	
	if(isthismypage==0){
		$(".prof_info").css("margin-top","34px");
		$(".mine").css("display","none");
		new ajax.xhr.Request("../../RequestAjax/RelationShip.php","mynoteid="+user[4],ismypage,'POST');
		new ajax.xhr.Request("../../RequestAjax/votequery.php","opt=2&uid="+user[4],checkvotepossible,'POST');	
	}
	else{
		$(".yours").css("display","none");
		$(".noyours").css("display","none");
		$(".mine").css("display","block");
		$(".prof_info").css("margin-top","");
	}
	
});
function checkvotepossible(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{			
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");				
				
				p = data.P;
				
				if(p==0){
					$("#container > .baseinfo > .button > .vote").html('<img src=\"../images/note/voteok.png\" alt=\"1\" />');
					$(".baseinfo > .info > .prof_info > .vote_number").css("display","block");
					$(".prof_info").css("margin-top","");
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

function ismypage(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{			
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");				
				
				Fstat = data.Fstat;
				if(Fstat==1){
					$(".yours").css("display","block");
					$(".noyours").css("display","none");											
				}
				else{
					$(".yours").css("display","none");
					$(".noyours").css("display","block");
					if(Fstat==2){					
						$("#container > .baseinfo > .button > .add_friend").html('<img src=\"../images/note/add_friending.png\" alt=\"\" />');
					}
					else if(Fstat==3){						
						$("#container > .baseinfo > .button > .add_friend").html('<img src=\"../images/note/ok_friend.png\" alt=\"\" />');
					}
					else if(Fstat==4){
						$("#container > .baseinfo > .button > .add_friend").html('<img src=\"../images/note/add_friend.png\" alt=\"\" />');		
					}
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

function flg(ind){	
	if(ind==1){
		if(typeof pageYOffset != 'undefined'){					
			$("#container").css("display","none");
			$("#container").css("opacity","0");
			$("#container2").css("display","block");
			$("#container2").fadeTo(400,1)
			LoadUserFriend();			
		}	
		else {					
			$("#container").css("display","none");
			$("#container2").css("display","block");
			LoadUserFriend();			
		}
	}
} // before

//LoadNoteInfo
function loadnoteinfo(){
	if(user[0]){
		$("#container > .baseinfo > .info > .prof_pic > img").attr("src","../../"+user[11]);
		if(user[1]){		
			$("#container > .baseinfo > .info > .prof_info > .name").html(user[0] + "(" + user[1] + ")");
		}
		else{		
			$("#container > .baseinfo > .info > .prof_info > .name").html(user[0]);
		}
		if(user[14]){ a = user[14] }else{ a = "등록된 대학이 없습니다" }
		if(user[6]){ b = user[6] } else{ b = "등록된 생일이 없습니다" }
		
		$("#container > .baseinfo > .info > .prof_info > .info").html(a + " / " + b);
		$("#container > .baseinfo > .divbaseinfo").css("background-image","url(../../"+user[12]+")");
		$("#container > .baseinfo > .divbaseinfo").css("height",(560+user[13])+"px");	
		$("#container > .baseinfo > .divbaseinfo").css("margin-top","-"+user[13]+"px");	
	}
	else{
		alert('존재하지 않는 회원입니다');
		post_to_url('../../note/',{});
	}	
}	// LoadNoteInfo

//Party Load Init**************************************************************************************************************************************************//
var init_party_check=0; var init_party_slide_index=0; var init_party_i_index=0;
function Upartyload(){
	upText = "";
	init_party_check=0;	init_party_slide_index=0; init_party_i_index=0;	
	discounter_value = 0;
	
	for(i=0;i<u_partynum;i++){		
		if(u_ppub[i]==0 || or[i]==1){
			upText += "<ul alt=\""+u_partyid[i]+"\"><li class=\"party_thumb _86base_"+((i%8)+1)+" pie\"><img src=\"../"+u_partypic[i]+"_s\" height=\"86\" alt=\"\" /></li><li class=\"name\">"+u_partyname[i]+"</li><li class=\"frame_86thumb\"><img src=\"../images/party/Pre_party/base_radius5.png\" width=\"86\" height=\"86\" alt=\"\" /></li></ul>";
		}
		else{
			discounter_value++;
		}
			
	}
	if(((u_partynum-discounter_value)%8)!=0){
		for(i=((u_partynum-discounter_value)%8);i<8;i++){
			upText += "<ul><li class=\"party_thumb _86base_"+((i%8)+1)+" pie\"></li><li class=\"name\"></li><li class=\"frame_86thumb\"><img src=\"../images/party/Pre_party/base_radius5.png\" width=\"86\" height=\"86\" alt=\"\" /></li></ul>";
		}
	}	
	document.getElementById('section').innerHTML = upText;
	
	partypre_func();		
} // Party Load // Party Load

//Preparty
function partypre_func() {	
	
	$.each($("#pre_party"),function() {

			var 	aL = $(this).children(".arrow_L"), aR = $(this).children(".arrow_R"), aLR = $(this).children(".arrow");

			aL.mouseenter(function(){	$(this).css("background-image","url(../images/party/Pre_party/L-arrowov.png)")});
			aL.mousedown(function(){	$(this).css("background-image","url(../images/party/Pre_party/L-arrowck.png)");
													});
			aL.mouseup(function(){		$(this).css("background-image","url(../images/party/Pre_party/L-arrowov.png)")
														pmove_effect_L();
												});
			aL.mouseleave(function(){	$(this).css("background-image","url(../images/party/Pre_party/L-arrow.png)")});
			
			aR.mouseenter(function(){	$(this).css("background-image","url(../images/party/Pre_party/R-arrowov.png)")});
			aR.mousedown(function(){	$(this).css("background-image","url(../images/party/Pre_party/R-arrowck.png)")});
			aR.mouseup(function(){		$(this).css("background-image","url(../images/party/Pre_party/R-arrowov.png)")
														pmove_effect_R();
												});
			aR.mouseleave(function(){	$(this).css("background-image","url(../images/party/Pre_party/R-arrow.png)")});

			$(this).mouseenter(function() {
					if(typeof pageYOffset != 'undefined'){
						aL.fadeTo(400,1);
								aR.fadeTo(400,1);
					}
					else{
						aLR.css("opacity","1");
					}				   

            });

			$(this).mouseleave(function() {
					if(typeof pageYOffset != 'undefined'){
						aL.fadeTo(400,0);
								aR.fadeTo(400,0);
					}
					else{
						aLR.css("opacity","0");
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
			
			$(this).mouseup(function(){
				if($(this).attr("alt")){
					post_to_url('../../partyplay/',{'mynoteid':me[4]/*user[4]*/, 'partyid':$(this).attr("alt")});
				}
			});

	}); // each ul
	
}

var party_trans_count = 1;
var party_trans_defence = 0;
var pmove_num = 0;
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

function pmove_effect_L(){	
	if ( pmove_num < 0 ) {		
		pmove_num += 848;			
		pmove_num_px = pmove_num + "px";
		$("#pre_party > .contents > .section").animate({ left: ""+pmove_num_px },{queue:false,duration:1000});						
	}
}

function pmove_effect_R(index){
	if( pmove_num > -(parseInt((u_partynum-1)/8)*848) ){	
		pmove_num -= 848;
		pmove_num_px = pmove_num + "px";		
		$("#pre_party > .contents > .section").animate({ left: ""+pmove_num_px },{queue:false,duration:1000});				
	}
	
}	//Pre party

//Friend Ranking
function frkloading(){
	if(isthismypage==1){
		new ajax.xhr.Request("../../RequestAjax/friendranking.php","",loadfrk,'GET');		
	}
	else{
		
	}
}
function loadfrk(req){
	if(req.readyState==4)
	{

		if(req.status == 200)
		{
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;
			
			if(code =='success') {
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval('('+dataJSON+')');
				
				rank_name = new Array();
				rank_id = new Array();
				rank_pic = new Array();
				rank_score = new Array();
				if(data.friendnone){
					making_ranking_nothing();
				}
				else{					
					for(i=0;i<6;i++){
						rank_name[i] = data.friendrank[i].fname;
						rank_id[i] = data.friendrank[i].fid;
						rank_pic[i] = data.friendrank[i].fpic;
						rank_score[i] = data.friendrank[i].totalscore;													
					}					
					making_ranking(rank_name, rank_id, rank_pic, rank_score);
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
function making_ranking(a,b,c,d){	
	frText = "";
	for(i=0;i<6;i++){
		if(a[i]){
			if(d[i]!=0){
				frText += "<div class=\"card\" alt=\""+b[i]+"\"><div class=\"pic pie\"><img src=\"../../"+c[i]+"50\" alt=\"\" class=\"pie\" /></div><div class=\"name nanumbold\">"+a[i]+"</div></div>";
			}
		}
	}
	
	$(".wholist > .right").html(frText);
	$.each($(".wholist > .right"),function(){
		$(this).children(".card").mousedown(function(){			
			post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});
		});
	});
	fansumer_divalign();
}

function making_ranking_nothing(){	// If don't have friendranking data
	$('#container > .wholist > .right > .nonecard').css("display","block");
}	//Friend Ranking

//PMemInvite List**************************************************************************************************************************************************//

function Party_Invite_MyFriend(){	
	invCount=0;
	$("#win_add_party > .container > .footer > .number > h1").html(invCount);
	new ajax.xhr.Request("../../RequestAjax/UserFriendList.php","req_id="+me[4],present_party_mem_all,'POST');
}

function present_party_mem_all(req){
	
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
				FPARTY = new Array();				
				MNum = data.FriendNum;
				for(i=0;i<MNum;i++){
					FID[i] = data.Friend[i].Fid;
					FNAME[i] = data.Friend[i].Fname;
					FPIC[i] = data.Friend[i].Fpic;
					FPARTY[i] = data.Friend[i].Fparty;					
				}
				
				Present_Party_Member_All_Invite(MNum, FID, FNAME, FPIC, FPARTY);						
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
var invCount = 0;
function Present_Party_Member_All_Invite(a,b,c,d,e){
	
	ppmaiText = "";
	for(i=0;i<a;i++){		
		ppmaiText += "<ul class=\"invitation\" alt=\""+b[i]+"\"><li class=\"pic\"><img src=\"../../"+d[i]+"38\" height=\"38\" width=\"38\" alt=\"\" class=\"pie\" /></li><li class=\"name\">"+c[i]+"</li><li class=\"share\">나와 공유하고 있는 파티 "+e[i]+" 개</li> <li class=\"check\"><img src=\"../images/party/Container/check.png\" alt=\"\" class=\"check\"/></li></ul>";
	}
	
	$("#win_add_party_friends > .ScrollBox > .container > .content").html(ppmaiText);
	
	$("#win_add_party_friends").mCustomScrollbar("vertical",400,"easeOutCirc",1.05,"auto","yes","no",10); 
	// 파티생성하기 마우스 클릭이벤트
	
	$.each($("#win_add_party_friends  > .ScrollBox > .container > .content > ul"),function() {
		$(this).mouseup(function() {
			if ( $(this).children(".check").children("img").attr('alt') == 0 ) {
					$(this).css("border-bottom-color","#c9c9c9");
					$(this).children(".check").html("<img src=\"../images/party/Container/checkck.png\" alt=\"1\" />");
					$(this).children(".name").css("color","#dc5457");
					$(this).children(".share").css("color","#777");
					invCount++;
					$("#win_add_party > .container > .footer > .number > h1").html(invCount);
					cim += $(this).attr("alt") + ",";
			}	else { 
					$(this).css("border-bottom-color","#eee");
					$(this).children(".check").html("<img src=\"../images/party/Container/check.png\" alt=\"\" />");
					$(this).children(".name").css("color","#777");
					$(this).children(".share").css("color","#999");
					invCount--;
					$("#win_add_party > .container > .footer > .number > h1").html(invCount);
					cim = cim.replace($(this).attr("alt")+",","");					
			}
		});
	});
	
} //Invite MyFriends to Party

//Load User Friend
function LoadUserFriend(){
	new ajax.xhr.Request("../../RequestAjax/UserFriendList.php","req_id="+user[4],present_user_friend_all,'POST');
}

function present_user_friend_all(req){
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
				FPARTY = new Array();
				FSTAT = new Array();				
				MNum = data.FriendNum;
				for(i=0;i<MNum;i++){
					FID[i] = data.Friend[i].Fid;
					FNAME[i] = data.Friend[i].Fname;
					FPIC[i] = data.Friend[i].Fpic;
					FPARTY[i] = data.Friend[i].Fparty;					
					FSTAT[i] = data.Friend[i].Fstat;
				}
				
				Present_User_Friend_All(MNum, FID, FNAME, FPIC, FPARTY, FSTAT);
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

function Present_User_Friend_All(a,b,c,d,e,f){
	ufText = "";
	buttonText = "";
	button_text = "";
	$("#container2 > #friendlist > .contents > .container").html("");
	for(i=0;i<a;i++){
		if(f[i]==0){
			fstat = "본인";
			buttonText = "Button_gray Button_gray_selected";
			button_text = "Button_gray_word Button_gray_selected_word";
		}
		else if(f[i]==1){
			fstat = "친구";
			buttonText = "friendsbutton";
			button_text = "word";
		}
		else if(f[i]==2){
			fstat = "요청중";
			buttonText = "Button_gray Button_gray_selected";
			button_text = "Button_gray_word Button_gray_selected_word";
		}
		else if(f[i]==3){
			fstat = "친구요청수락";
			buttonText = "Button_gray";
			button_text = "Button_gray_word";
		}
		else if(f[i]==4){
			fstat = "추가";
			buttonText = "Button_gray";
			button_text = "Button_gray_word";
		}
		
		if(f[i]==0){
			ufText += "<div class=\"cards\" alt=\""+f[i]+"\"><div class=\"pic\" style=\"cursor:pointer;\" alt=\""+b[i]+"\"><img src=\"../../"+d[i]+"50\" width=\"50\" height=\"50\" alt=\"\" class=\"pie\" /></div><div class=\"info\"><div class=\"name\" style=\"cursor:pointer;\" alt=\""+b[i]+"\">"+c[i]+"</div><div class=\"shareparty\">본인입니다</div></div>		<div class=\"button\"><div class=\""+buttonText+"\">"+fstat+"<div class=\""+button_text+"\">"+fstat+"</div></div></div>		</div>";
		}
		else{
			ufText += "<div class=\"cards\" alt=\""+f[i]+"\"><div class=\"pic\" style=\"cursor:pointer;\" alt=\""+b[i]+"\"><img src=\"../../"+d[i]+"50\" width=\"50\" height=\"50\" alt=\"\" class=\"pie\" /></div><div class=\"info\"><div class=\"name\" style=\"cursor:pointer;\" alt=\""+b[i]+"\">"+c[i]+"</div><div class=\"shareparty\">나와 공유하고 있는 파티 "+e[i]+" 개</div></div>		<div class=\"button\"><div class=\""+buttonText+"\">"+fstat+"<div class=\""+button_text+"\">"+fstat+"</div></div></div>		</div>";
		}
	}
	$("#container2 > #friendlist > .contents > .container").html(ufText);
	
	$.each($("#container2 > #friendlist > .contents > .container > .cards"),function(){
		$(this).children(".button").children(".Button_gray").mouseleave(function() {
			$(this).css("background-image","url(../images/party/Container/buttongraybg.png)");
		});
		$(this).children(".button").children(".Button_gray").mousedown(function() {
			$(this).css("background-image","url(../images/party/Container/buttongraybgck.png)");
		});
		$(this).children(".button").children(".Button_gray").mouseup(function() {
			$(this).addClass("Button_gray_selected");
			$(this).html("요청완료<div class=\"Button_gray_word Button_gray_selected_word\">요청완료</div>");
			if($(this).parent(".button").parent(".cards").attr("alt")==3){	//친구요청 수락
				alert('친구요청을 수락하였습니다');
				new ajax.xhr.Request("../../RequestAjax/Friend_query.php","fopt=1=&fid="+$(this).parent(".button").siblings(".pic").attr("alt"),nothingdo,'POST');				
			}
			else if($(this).parent(".button").parent(".cards").attr("alt")==4){	//친구요청
				alert('친구요청을 보냈습니다');
				new ajax.xhr.Request("../../RequestAjax/Friend_query.php","fopt=1=&fid="+$(this).parent(".button").siblings(".pic").attr("alt"),nothingdo,'POST');				
			}
			
		});
	});
		
		
	
	
	//프로필사진 - 노트전환
	$.each($("#container2 > #friendlist > .contents > .container > .cards > .pic"),function(){
		$(this).mousedown(function(){
			post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});
		});
	});
	//이름 - 노트전환
	$.each($("#container2 > #friendlist > .contents > .container > .cards > .info > .name"),function(){
		$(this).mousedown(function(){
			post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});
		});
	});	
}	

function friendlist_search(obj){	
	if($(obj).val()==""){
		$("#container2 > #friendlist > .contents > .container").children(".cards").fadeIn(300,0);
	}
	else{
		for(i=0;i<$("#container2 > #friendlist > .contents > .container").children(".cards").size();i++){
			if(i==0){
				ot = $("#container2 > #friendlist > .contents > .container").children(".cards").first();				
				results = $(ot).children(".info").children(".name").html().indexOf($(obj).val());
				if(results!=-1){
					$(ot).fadeIn(300,0);
				}
				else{
					$(ot).fadeOut(300,0);
				}
			}
			else{
				ot = $(ot).next(".cards");				
				results = $(ot).children(".info").children(".name").html().indexOf($(obj).val());
				if(results!=-1){
					$(ot).fadeIn(300,0);
				}
				else{
					$(ot).fadeOut(300,0);
				}
			}
		}		
	}
} // Load user Friend

//LoadArticle
function LoadArticle(){	
	new ajax.xhr.Request("../../RequestAjax/article.php","mynoteid="+user[4],loadedArticle,'POST');	
}

function loadedArticle(req)
{
	if(req.readyState==4)
	{
		if(req.status == 200)
		{		
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {				
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");
				
				numArticle = data.NumberOfArticle;				
				
				articlestart = articlelength;
				articlelength = articlelength + 6;				
				if(numArticle){
					if(numArticle<articlelength) {	// init Loading Article Numbers
						articlelength = numArticle;
					}
					for(i=articlestart;i<articlelength;i++)
					{
						
						LoveMemName[i] = new Array();
						LoveMemID[i] = new Array();
						LoveMemProfile[i] = new Array();
						
						Author[i] = data.article[i].author;
						AuthorID[i] = data.article[i].authorID;
						AuthorProfile[i] = data.article[i].authorProfile;
						arrCommentLength[i] = data.article[i].NumberOfComment;
						GesiTime[i] = (data.article[i].time).substr(5,11);
						GesiInfo[i] = data.article[i].content;
						ArticleID[i] = data.article[i].articleID;
						isVote[i] = data.article[i].vote;
						LoveNum[i] = data.article[i].likenum;
						afrom[i] = data.article[i].belong;
						aPic[i] = data.article[i].apic;
						scrapperID[i] = data.article[i].scrapID;
						scrapperName[i] = data.article[i].scrapName;
						scrapperPic[i] = data.article[i].scrapPic;
						isparty[i] = data.article[i].isparty;
						belongID[i] = data.article[i].belongID;
						belongAdmin[i] = data.article[i].belongAdmin;
						notice[i] = data.article[i].notice;
						caption[i] = data.article[i].caption;
						scrapnum[i] = data.article[i].ScrapNum;
						
						//alert(Author[i]); // 파티에서 마지막 1번 안돔.
						// 좋아하는 사람 2차원 배열
						if(LoveNum[i] > 10){LoveLength[i] = 10;} else{ LoveLength[i]=LoveNum[i]}
						ShowLoveNum[i] = LoveLength[i];
						for(j=0;j<LoveLength[i];j++)
						{
							LoveMemName[i][j] = data.article[i].like[j].name;						
							LoveMemID[i][j] = data.article[i].like[j].id;
							LoveMemProfile[i][j] = data.article[i].like[j].profile;
						}	
					}	
					MakeArticle();
				}
				else{
					MakeNoArticle();
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
function MakeNoArticle(){
	//$(".preview").css("display","none");
	$(".nonepost").css("display","block");		
	if(reset_Article==1){
		$("#board_contents").html("");
		reset_Article=0;
	}
	for(i=0;i<6;i++){
		$("#pre_card"+i).html("");	
		$("#pre_card"+i).parent(".cards").css("cursor","default");				
	}
	
}



var randapic_count=1;
var nonotice=0;
function MakeArticle(){	
	//$(".preview").css("display","block");
	$(".nonepost").css("display","none");
	scrapimg = "../../images/board/writeico.png";
	bdText = "";
	//ancount = 0;
		
	for(i=articlestart;i<articlelength;i++){
		changeTime(i);
		newDiv = document.createElement('DIV');
		$(newDiv).attr("class","posts");
		$(newDiv).attr("id","bc_"+i);		
		$(newDiv).attr("alt",ArticleID[i]);
		if(AuthorID[i]==me[4] || user[4]==me[4] || me[4]==2 || me[4]==1) accep=1;
		else accep=0;
		
		$(newDiv).attr("onmouseover","deleteonoff(0,this, "+accep+")");
		$(newDiv).attr("onmouseout","deleteonoff(1,this, "+accep+")");
		
		// Header
		if(scrapperID[i]){
			scrapimg="../../images/board/scrapico.png";
		}		
		if(isVote[i]){
			voted="-";
		}
		else{
			voted="+";
		}
		bdText += "<div class=\"header\"><div class=\"pic\" style=\"cursor:pointer;\" alt=\""+AuthorID[i]+"\"><img src=\"../../"+AuthorProfile[i]+"50\" alt=\"\" /></div><div class=\"info\"><div class=\"top\"><div class=\"writer\" style=\"cursor:pointer;\" alt=\""+AuthorID[i]+"\">"+Author[i]+"</div><div class=\"path\"><img src=\""+scrapimg+"\" alt=\"\" /></div><div class=\"place redcolor\" style=\"cursor:pointer;\" alt=\""+i+"\">"+afrom[i]+"</div><div class=\"time\">"+GesiTime[i]+"</div></div></div><div class=\"button\"><div class=\"delete\" onClick=\"deletequery(0, "+ArticleID[i]+", this);\">Delete</div><div class=\"scrap\"><p onClick=\"onoffscrap(this);\">Scrap</p><div class=\"scrapbox\"><div class=\"arrow\"></div><div class=\"whiteline1\"></div><div class=\"selectbox\" onClick=\"scraplistonoff(this);\"><div class=\"scrapselected\">"+me[0]+"님의 마이노트</div><div class=\"window\"><div class=\"board_scrapbox_window\"><div class=\"list\">"+me[0]+"님의 마이노트</div></div></div></div><div class=\"whiteline2\"></div><div class=\"contentbox\"><textarea placeholder=\"Add Caption ...\"></textarea></div><div class=\"whiteline3\"></div><div class=\"button\"><div class=\"Button2_red\" onClick=\"ScrapArticle("+ArticleID[i]+",this)\">Scrap It<div class=\"Button2_red_word\">Scrap It</div></div></div></div></div>				<div class=\"candy\" onClick=\"likequery("+ArticleID[i]+",this);\" alt=\""+LoveNum[i]+"\">"+voted+" Candy</div></div></div>";
		scrapimg = "../../images/board/writeico.png";
		//Container
		bdText += "<div class=\"container\">";
        
		//Container - Caption - Scrapper
		if(scrapperID[i]){
			bdText += "<div class=\"caption\">"+caption[i]+"</div>";
		}
		
		//Text - Contents                
		bdText += "<div class=\"text\">";                    
		
		//Title - Notice Article
		if(notice[i]==1){
			bdText += "<div class=\"title\">공지글입니다!!</div>";			
		}
        bdText += "<div id=\"autolinkdiv_"+i+"\" class=\"contents\">"+GesiInfo[i]+"</div></div>";
		
		//Container - Pic - APIC
		if(aPic[i]){
			bdText += "<div class=\"pic\"><div class=\"noneframe\"><div class=\"pic\"><img src=\"../../"+aPic[i]+"\" alt=\"\" /></div></div></div>";
			
		}

		bdText += "<div class=\"info\"><div class=\"comment\">+ "+arrCommentLength[i]+" Comments</div><div class=\"candy\">+ "+LoveNum[i]+" Candys</div> <div class=\"scrap\">+ "+scrapnum[i]+" Scraps</div></div></div>";					
							
       
        //Board - Comment
		
		bdText += " <div class=\"comment\">";                      

		//Board - Original Scrapper
		
		if(scrapperID[i]){			
			bdText += "<div class=\"origin\" alt=\""+ArticleID[i]+"\" onClick=\"onofforiginal(this);\"><img src=\"../../images/board/scrapico.png\" alt=\"\"/>"+scrapperName[i]+" Open the Original...</div>";
		}
                       
        //Comment - Length moreview                 
		
		if(arrCommentLength[i] > 10 && arrCommentLength[i] <= 50){
			bdText += "<div class=\"allview\" alt=\""+i+"\" onClick=\"CommentMore(this,1);\">+ All "+(arrCommentLength[i]-3)+" Comments ...</div>";
			arrCommentShowLength[i] = 3;			
		}
		else if(arrCommentLength[i] > 50){
			bdText += "<div class=\"moreview\" alt=\""+i+"\" onClick=\"CommentMore(this,5);\">+ 50 Comments ...</div>";
			arrCommentShowLength[i] = 3;
		}
		else{
			arrCommentShowLength[i] = arrCommentLength[i];
		}
		
                        	
        //Comment - List
		bdText += "<div class=\"list\">";                    		
				
		for(j=arrCommentLength[i]-arrCommentShowLength[i];j<arrCommentLength[i];j++)		//댓글
		{			
			arrCommentID[j] = data.article[i].comment[j].rid;
			arrCommentMemID[j] = data.article[i].comment[j].mid;
			arrCommentName[j] = data.article[i].comment[j].name;
			arrCommentInfo[j] = data.article[i].comment[j].text;
			arrCommentTime[j] = (data.article[i].comment[j].time).substr(5,11);
			arrCommentProfile[j] = data.article[i].comment[j].profile;	
		}	  
		
		for(j=(arrCommentLength[i]-arrCommentShowLength[i])+1;j<arrCommentLength[i]+1;j++){
			if(arrCommentMemID[j-1]==me[4]) accep=1;
			else accep=0;
			
			bdText += " <div class=\"comments\" onMouseover=\"deleteonoff(2,this,"+accep+");\" onMouseOut=\"deleteonoff(3,this,"+accep+")\"><div class=\"pic\" style=\"cursor:pointer;\" alt=\""+arrCommentMemID[j-1]+"\"><img src=\"../../"+arrCommentProfile[j-1]+"38\" width=\"38\" height=\"38\" alt=\"\" class=\"pie\" /></div><div class=\"contents\"><div class=\"name\" style=\"cursor:pointer;\" alt=\""+arrCommentMemID[j-1]+"\">"+arrCommentName[j-1]+"</div><div class=\"time\">"+arrCommentTime[j-1]+"</div><div class=\"text\">"+arrCommentInfo[j-1]+"</div></div><div class=\"delete\" onClick=\"deletequery(1, "+arrCommentID[j-1]+", this);\"></div></div>";
		}
        
		//Close List && write                    
        bdText += "</div><div class=\"write\"><div class=\"pic\"><img src=\"../../"+me[11]+"38\" width=\"38\" height=\"38\" alt=\"\" class=\"pie\" /></div><div class=\"text pie\"><textarea placeholder=\"이 글에 댓글 달기 ...\" onKeyDown=\"writecomment(this)\" alt=\""+i+"\"></textarea></div></div></div>";                       
							
		newDiv.innerHTML = bdText;           	
        document.getElementById('board_contents').appendChild(newDiv);	
		autolink("autolinkdiv_"+i);	
		bdText = "";                  
	}
	
	onClickListener_ETC();
	setSidePreview();
}
var controllck=0;
var PreviewNum=1;	var endindex=0;
function setSidePreview(){
	if((PreviewNum*6)>=articlelength){
		if((articlelength%6) != 0){ endindex = ((PreviewNum-1)*6) + (articlelength%6); }
		else{ endindex = PreviewNum * 6 }		
	}
	else{
		endindex = PreviewNum * 6;	
	}
	if(controllck==0){
		for(i=0;i<6;i++){
			controllck=1;
			$("#pre_card"+(i%6)).parent(".pic").parent(".white").fadeOut(1);
		}
		for(i=0;i<6;i++){
			$("#pre_card"+(i%6)).parent(".pic").parent(".white").fadeIn(500);
			setTimeout("controllck=0",500);
		}
	}
	for(i=((PreviewNum-1)*6);i<endindex;i++){
		if(GesiInfo[i].substr(25,2)){
			etc = "...";
		}
		else{
			etc = "";
		}		
		if(aPic[i]){		
			$("#pre_card"+(i%6)).parent(".pic").siblings(".text").removeClass("nptext");
			$("#pre_card"+(i%6)).parent(".pic").parent(".white").parent(".cards").removeClass("nonecards");
			$("#pre_card"+(i%6)).parent(".pic").css("display","block");	
			$("#pre_card"+(i%6)).html("<img src=\"../../"+aPic[i]+"\" alt=\"\" />");
			$("#pre_card"+(i%6)).parent(".pic").parent(".white").parent(".cards").css("cursor","pointer");
			$("#pre_card"+(i%6)).parent(".pic").parent(".white").parent(".cards").attr("alt",i);
			$("#pre_card"+(i%6)).parent(".pic").siblings(".text").children("a").html(GesiInfo[i].replace(/<br>/gi,'').substr(0,22)+etc);
		}
		else{
			$("#pre_card"+(i%6)).parent(".pic").siblings(".text").addClass("nptext");
			$("#pre_card"+(i%6)).parent(".pic").parent(".white").parent(".cards").removeClass("nonecards");
			$("#pre_card"+(i%6)).parent(".pic").css("display","none");					
			$("#pre_card"+(i%6)).parent(".pic").parent(".white").parent(".cards").css("cursor","pointer");
			$("#pre_card"+(i%6)).parent(".pic").parent(".white").parent(".cards").attr("alt",i);
			$("#pre_card"+(i%6)).parent(".pic").siblings(".text").children("a").html(GesiInfo[i].replace(/<br>/gi,'').substr(0,35)+etc);
		}		
	}	
	if(endindex%6!=0){
		for(i=(endindex%6);i<6;i++){			
			$("#pre_card"+(i%6)).parent(".pic").parent(".white").parent(".cards").addClass("nonecards");
			$("#pre_card"+(i%6)).parent(".pic").css("display","none");
			$("#pre_card"+(i%6)).parent(".cards").css("cursor","default");
			$("#pre_card"+(i%6)).parent(".pic").parent(".white").parent(".cards").attr("alt","");
			$("#pre_card"+(i%6)).parent(".pic").siblings(".text").children("a").html("");
		}
	}	
	if(z==0) PreviewClickBNA();
	//$(document).scrollTop(tempnow);
}
function gotobyScroll(obj){
	if($(obj).css("cursor")=="pointer"){
		$('html,body').animate({scrollTop: ($("#bc_"+$(obj).attr("alt")).offset().top-10)},'slow');	
	}
}	// LoadArticle

//Preview Controller
var z=0;
function PreviewClickBNA(){
	z=1;
	$(".Lfield > .preview > .controll > .white > .midposition > .left").mouseup(function(){		
		if(PreviewNum > 1){
			PreviewNum = PreviewNum - 1; setSidePreview();
			if(PreviewNum < 10){
				$(".Lfield > .preview > .controll > .white > .midposition > .num").html("0"+PreviewNum);			
			}
			else{
				$(".Lfield > .preview > .controll > .white > .midposition > .num").html(PreviewNum)
			}
		}
	});
	$(".Lfield > .preview > .controll > .white > .midposition > .right").mouseup(function(){
		if(numArticle > (PreviewNum*6)){
			PreviewNum = PreviewNum + 1; //setSidePreview();
			if(PreviewNum < 10){
				$(".Lfield > .preview > .controll > .white > .midposition > .num").html("0"+PreviewNum);			
			}
			else{
				$(".Lfield > .preview > .controll > .white > .midposition > .num").html(PreviewNum)
			}
			if(ArticleID[((PreviewNum*6)-6)]){
				setSidePreview();
			}else{ LoadArticle(); }
		}
	});
}	// Preview Controller

//	Scrolling 	Event	**************************************************************************************************************************************************//
var upchecking=0;
$(window).scroll(function(){
	de = document.documentElement;
	b = document.body;			
	now = document.all ? (!de.scrollTop ? b.scrollTop : de.scrollTop) : (window.pageYOffset ? window.pageYOffset : window.scrollY);
	
	if ( now < 500 ) { 	
		$("#ScrollTop").animate({bottom:'-70px'},50)	
	}

	if ( now > 500 ) {	
		$("#ScrollTop").animate({bottom:'-1px'},50)	
	}	
	
	if(typeof pageYOffset!='undefined'){	//*************************CHROME
		if(now > 710){
			$(".Lfield").css("position","fixed");
			$(".Lfield").css("top","30px");
		}
		else{
			$(".Lfield").css("position","relative");
			$(".Lfield").css("top","0px");
		}
		
		
		
		if(PreviewNum > 1 && now < ($("#bc_"+(((PreviewNum-1)*6)-2)).offset().top-800) && upchecking==1){			
			PreviewNum = PreviewNum - 1;			 
			if(PreviewNum < 10){
				$(".Lfield > .preview > .controll > .white > .midposition > .num").html("0"+PreviewNum);			
			}
			else{
				$(".Lfield > .preview > .controll > .white > .midposition > .num").html(PreviewNum)
			}
			 setSidePreview();
			 upchecking=0;
		}
		
		if(now >($("#bc_"+((PreviewNum*6)-2)).offset().top-700)){	
			PreviewNum = PreviewNum + 1;
			if(PreviewNum < 10){
				$(".Lfield > .preview > .controll > .white > .midposition > .num").html("0"+PreviewNum);			
			}
			else{
				$(".Lfield > .preview > .controll > .white > .midposition > .num").html(PreviewNum)
			}
			if(Author[(PreviewNum*6)-1]){
				setSidePreview();
			}
			else{
				LoadArticle();			
			}
		}
		
	}//chrome
	else{		//**************************************************IE
		if(now > 710){
			$(".Lfield").css("position","fixed");
			$(".Lfield").css("top","30px");
		}
		else{
			$(".Lfield").css("position","relative");
			$(".Lfield").css("top","0px");
		}
				
		if(PreviewNum > 1 && now < ($("#bc_"+(((PreviewNum-1)*6)-2)).offset().top-800) && upchecking==1){			
			PreviewNum = PreviewNum - 1;			 
			if(PreviewNum < 10){
				$(".Lfield > .preview > .controll > .white > .midposition > .num").html("0"+PreviewNum);			
			}
			else{
				$(".Lfield > .preview > .controll > .white > .midposition > .num").html(PreviewNum)
			}
			 setSidePreview();
			 upchecking=0;
		}
		
		if(now >($("#bc_"+((PreviewNum*6)-2)).offset().top-700)){	
			PreviewNum = PreviewNum + 1;
			if(PreviewNum < 10){
				$(".Lfield > .preview > .controll > .white > .midposition > .num").html("0"+PreviewNum);			
			}
			else{
				$(".Lfield > .preview > .controll > .white > .midposition > .num").html(PreviewNum)
			}
			if(Author[(PreviewNum*6)-1]){
				setSidePreview();
			}
			else{
				LoadArticle();			
			}
		}
	}
	
	if(endindex%6!=0){
			last = (endindex-(endindex%6));					
		}
		else{			
			last = (((PreviewNum-1)*6)-1);					
		}
		
		if(now > (($("#bc_"+last).offset().top)-50)) upchecking=1;
	//if(now > (($("#bc_"+last).offset().top)-50)) upchecking=1; 
	//$("#a").html("now: "+now+"<br>Scroll: "+($("#bc_"+((PreviewNum*6)-1)).offset().top-700)+"<br>last: "+($("#bc_"+last).offset().top));
	
}); // Scrolling Event - Preview & ArticleMore

//WidePicture Controll Script********************************************************************************************************************************//
function ysubmit(){
	new ajax.xhr.Request("../../RequestAjax/wideym.php","y="+rey ,yset,'POST');	
}
function yset(){	
	$("#boxok").css("display","none");
	$(".divbaseinfo").css("z-index","0");
}

	var dragFlag = false;	var x, y, pre_x, pre_y;	var fix_ena=0; var rey;
	$(function () {	$('.divbaseinfo').mousedown(	function (e) {		
	dragFlag = true; var obj = $(this); x = obj.scrollLeft(); y = obj.scrollTop(); pre_x = e.screenX; pre_y = e.screenY;	$(this).css("cursor", "pointer"); /*$('#result').text("x:" + x + "," + "y:" + y + "," + "pre_x:" + pre_x + "," + "pre_y:" + pre_y);
	$('#result').text(dragFlag);*/
	
	});
		
	
	$('.divbaseinfo').mousemove(function (e) {if (dragFlag) {
	var obj = $(this);	obj.scrollLeft(x - e.screenX + pre_x);	obj.scrollTop(y - e.screenY + pre_y);/*$('#result').text((x - e.screenX + pre_x) + "," + (y - e.screenY + pre_y));*/
	
	if(y + 512 <= wideheight){
		rey = obj.scrollTop();
	}
		$("#boxok").css("top",(300+obj.scrollTop())+"px");
	
		return false;
	}});
	$('.divbaseinfo').mouseup(	function () {
	dragFlag = false;	/*$('#result').text("x:" + x + "," + "y:" + y + "," + "pre_x:" + pre_x + "," + "pre_y:" + pre_y);	$('#result').text(dragFlag);*/
		$(this).css("cursor", "default");
	
	});
	$('body').mouseup(	function () {dragFlag = false;//$('#result').text(dragFlag);
		$(this).css("cursor", "default");
	});});		 //Widepicture Controll script

//Visit Query
function visitquery(){
	new ajax.xhr.Request("../../RequestAjax/visit_query.php","pid="+user[4],nothingdo,'POST');
} //visit query

//create party
var cim="";
function createparty(){
	ok = false;
	if($("#win_add_party > .container > .partyname > .mid > input").val()==""){
		alert('파티명을 입력하세요');
	}
	else{
		checkname = $("#win_add_party > .container > .partyname > .mid > input").val();
		countlength = 0;
		for(i=0;i<checkname.length;i++){
			if(checkname.charCodeAt(i)>=65 && checkname.charCodeAt(i)<=90 || checkname.charCodeAt(i)>=97 && checkname.charCodeAt(i)<=122){
				countlength++;
			}
			else{
				countlength = countlength+2;
			}			
		}	
		if(countlength>24){ alert('파티이름은 한글로 12글자를 넘을 수 없습니다.'); ok=false }else{ ok=true }	
	}
	if(ok){		
	
		new ajax.xhr.Request("../../RequestAjax/party_query.php","popt=3&newname="+checkname,somethingread,'POST');			
	}
	
}
function somethingread(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{			
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");				
				
				if(data.pdouble){
					alert('이미 존재하는 파티입니다. 다른 이름을 사용해 주세요');
				}
				else{
					pid = data.pid;
					new ajax.xhr.Request("../../RequestAjax/Party_Invite.php","num="+invCount+"&array="+cim+"&pid="+pid,nothingdo,'POST');			
					alert('파티를 생성하였습니다');	
					
					post_to_url('../../partyplay/',{'mynoteid':me[4], 'partyid':pid});
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
} //create party

function facebook(){

		window.open('../../facebookapi/?setting=2','','toolbar=no,menubar=no,location=no,height=1,width=1');	
	
}

// *********************************** 04/06 *********************************** add parts.

$(document).ready(function() {

	$("#container > .wholist > .left > .questionmark").mousedown(function() {    
	
		$(this).css("background-image","none").css("background-color","#dc5457").css("color","#fff").css("border","1px solid #CE0005")
	
	});
	$("#container > .wholist > .left > .questionmark").mouseup(function() {
        
		$("#container > .wholist > .left > .pop").css("display","block").css("opacity","1")
		
    });
	
	$("#container > .wholist > .left > .pop > .content > .list > .white > .close").click(function() {
        
		$("#container > .wholist > .left > .pop").fadeTo(500,0)
		
		setTimeout(pop_close,500);
		
		$("#container > .wholist > .left > .questionmark").css("background-image","url(../../images/base/questionmarkbg.png)")
																				.css("background-color","inherit")
																				.css("color","#aaa")
																				.css("border","1px solid #e1e1e1")
																				.css("border-bottom-color","#c8c8c8")
		
    });
	
});

function pop_close() {
	
	$("#container > .wholist > .left > .pop").css("display","none")
	
} // 친구추천 :: myfansumer :: pop 열고닫기

$(document).ready(function() {
    
		$("#container > .wholist > .left > .content > .list > .white > .card > .pic").mouseenter(function() {
			
			$(this).children(".namepop").css("display","block")
			
		});
	
		$("#container > .wholist > .left > .content > .list > .white > .card > .pic").mouseleave(function() {
			
			$(this).children(".namepop").css("display","none")
			
		});
	
}); // 친구추천 :: myfansumer :: namepop 열고닫기

function fansumer_divalign() {
	
	$("#container > .wholist > .right > .card:first").css("border-bottom-left-radius","3px").css("border-top-left-radius","3px")
	$("#container > .wholist > .right > .card:eq(5)").css("border-top-right-radius","3px").css("border-bottom-right-radius","3px").css("width","129px").css("border-right","none")
	
} // fansumer 첫번째, 여섯번째 css조절

$(document).ready(function() {

				$("#container > .baseinfo > .info > .prof_info > .vote_number").mouseenter(function() {

			$("#container > .baseinfo > .info > .prof_info > .explain > .vote").css("display","block");
			
		});
		
		$("#container > .baseinfo > .info > .prof_info > .vote_number").mouseleave(function() {
			
			$("#container > .baseinfo > .info > .prof_info > .explain > .vote").css("display","none");
			
		});
	
}); // 득표수 부분 hover시에 설명 켜기

//infovotenum
function infovotenum(){
	new ajax.xhr.Request("../../RequestAjax/infovotenum.php","uid="+user[4],frvtnum,'POST');	
}
function frvtnum(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{			
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");				
				
				a = data.frnum;
				b = data.votenum;
				$(".baseinfo > .info > .prof_info > .vote_number").html("<img src=\"../images/note/heart.png\" height=\"12\" alt=\"\" />"+b);
				$(".baseinfo > .info > .prof_info > .friend_number").html("<img src=\"../images/note/friend.png\" height=\"12\" alt=\"\" />"+a + " 명의 친구");
				$(".baseinfo > .info > .prof_info > .friend_number").mousedown(function(e) {
                    $("#container").css("display","none");
					$("#container").css("opacity","0");
					$("#container2").css("display","block");
					$("#container2").fadeTo(400,1)
					LoadUserFriend();
                });				
				if(me[4]==2){	
					$("#container > .baseinfo > .info > .prof_info > .vote_number").css("display","block");	
					$(".prof_info").css("margin-top","");
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
} //infovotenum - 득표 수, 친구수 부분

// 0613시작
$(document).ready(function() {

	$("#win_add_party > .container > .partysetting > .container > .show > .container > .button > .on").click(function() {
        
		$(this).addClass("selected")
		$(this).siblings(".off").removeClass("selected")
		$(this).parent(".button").siblings(".explain").children(".off").removeClass("selected")
		$(this).parent(".button").siblings(".explain").children(".on").addClass("selected")
		$("#win_add_party > .container > .partysetting > .container > .allow").css("display","block")
		
    }); // 권한 설정 > 파티명 노출 여부 : 공개 클릭시
    
	$("#win_add_party > .container > .partysetting > .container > .show > .container > .button > .off").click(function() {
        
		$(this).addClass("selected")
		$(this).siblings(".on").removeClass("selected")
		$(this).parent(".button").siblings(".explain").children(".on").removeClass("selected")
		$(this).parent(".button").siblings(".explain").children(".off").addClass("selected")
		$("#win_add_party > .container > .partysetting > .container > .allow").css("display","none")
		
    }); // 권한 설정 > 파티명 노출 여부 : 비공개 클릭시
	
}); // 파티명 노출 여부 0411

$(document).ready(function() {

	$("#win_add_party > .container > .partysetting > .container > .allow > .container > .button > .on").click(function() {
        
		$(this).addClass("selected")
		$(this).siblings(".off").removeClass("selected")
		$(this).parent(".button").siblings(".explain").children(".off").removeClass("selected")
		$(this).parent(".button").siblings(".explain").children(".on").addClass("selected")
		
    }); // 권환설정 : 가입 권한 설정 : 자유 클릭시
    
	$("#win_add_party > .container > .partysetting > .container > .allow > .container > .button > .off").click(function() {
        
		$(this).addClass("selected")
		$(this).siblings(".on").removeClass("selected")
		$(this).parent(".button").siblings(".explain").children(".on").removeClass("selected")
		$(this).parent(".button").siblings(".explain").children(".off").addClass("selected")
		
    }); // 권한설정 : 가입 권한 설정 : 승인 클릭시
	
}); // 가입 권한 설정 0613
// 0613 끝