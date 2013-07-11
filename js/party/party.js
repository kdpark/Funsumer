var startindex = 0; var lastindex = 0; var lastcreate=0; var lastoffset=0;

//Before
function kimsclub_nondis() {
	$("#container > .partylist > .title > .pop").css("display","none")
}

$(document).ready(function() {

		// nav-menu EVENT.
		
		var SDDw = $(".SDD-wassup"), SDDn = $(".SDD-note"), SDDp = $(".SDD-party");
		var navw = $(".nav-wassup"), 	navn = $(".nav-note"), 	navp = $(".nav-party");
		
		navn.mouseenter(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_noteov.png)")});
		navp.mouseenter(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_wassupov.png)")});
		
		navn.mouseleave(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_note.png)")});
		navp.mouseleave(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_wassup.png)")});
		
		navn.mousedown(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_noteck.png)")});
		navp.mousedown(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_wassupck.png)")});
		
		navn.mouseup(function() { 	SDDn.css("background-image","url(../images/party/Header/header_menu_noteov.png)")
													post_to_url('../../note/',{'mynoteid':user[4]});
												});
		navp.mouseup(function() { 	SDDp.css("background-image","url(../images/party/Header/header_menu_wassupov.png)")
													post_to_url('../../wassup/',{});
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

$(document).ready(function(e) {
    
	$("#container > .partylist > .title > .button > .all").mouseup(function(e) {
        $(this).addClass("selected");
		$(this).siblings(".my").removeClass("selected")
		check_party();
    });
	$("#container > .partylist > .title > .button > .my").mouseup(function(e) {
		$(this).addClass("selected");
		$(this).siblings(".all").removeClass("selected")
		check_party();
    });
	
});	//before

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

//Load Party Info
function loadpartyinfo(){
	//alert(user[4]);
	$("#container > .partylist > .title > .pic > img").attr("src","../../"+user[11]);
	if(user[1]){ a = user[0]+"("+user[1]+")"; }else{ a = user[0]; }
	$("#container > .partylist > .title > .namediv > .name").html(a);
	$("#container > .partylist > .title > .pop > .content > .name").html(a);
	if(user[14]){ a = user[14]; }else{ a="등록된 대학이 없습니다"; }
	if(user[6]){ b = user[6]; }else{ b="생일을 등록하세요"; }
	$("#container > .partylist > .title > .pop > .content > .info").html(a + " / " + b);		
	new ajax.xhr.Request("../../RequestAjax/RelationShip.php","mynoteid="+mynoteid,fstatconfirm,'POST');
}
function fstatconfirm(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{			
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");				
				
				f = data.Fstat;
				if(f==0){ //본인
					$("#container > .partylist > .title > .Button_red").html("본인<div class=\"Button_red_word\">본인</div>");
				}
				else if(f==1){	//친구
					$("#container > .partylist > .title > .Button_red").html("친구<div class=\"Button_red_word\">친구</div>");
				}
				else if(f==2){ //요청 보냄
					$("#container > .partylist > .title > .Button_red").html("요청중<div class=\"Button_red_word\">요청중</div>");
				}
				else if(f==3){	//요청 받음
					$("#container > .partylist > .title > .Button_red").html("친구수락<div class=\"Button_red_word\">친구수락</div>");
				}
				else if(f==4){	// 모름
					$("#container > .partylist > .title > .Button_red").html("친구하기<div class=\"Button_red_word\">친구하기</div>");
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

} // Load Party info

//partyload
function partyload(){	
	aText="";	
	if(isthismypage==1){		
		if(conorev==0){	
			if(concount){
				if(startindex+24 <= concount) lastindex = startindex+24;
				else lastindex = concount;	
				
				for(i=startindex;i<lastindex;i++){
					newDiv = document.createElement('DIV');
					$(newDiv).attr("class","cards pie");
					$(newDiv).attr("alt",conparty_id[i]);
					$(newDiv).html("<div class=\"img\"><img src=\"../../"+conparty_pic[i]+"_m\"/></div><div class=\"name nanumbold\">"+conparty_name[i]+"</div>");
					//aText += "<div class=\"cards pie\" alt=\""+conparty_id[i]+"\"><div class=\"img\"><img src=\"../../"+conparty_pic[i]+"_m\"/></div><div class=\"name nanumbold\">"+conparty_name[i]+"</div></div>";
					$("#wrapbox > #container > .partylist > .list").append(newDiv);
				}
				/*if(lastindex==concount && lastcreate==0){
				if(user[4]==me[4]){
					newDiv = document.createElement('DIV');
					$(newDiv).attr("class","create nanumbold");
					$(newDiv).attr("onclick","crparty_display();");
					$(newDiv).html("새로운 파티 만들기 ...");
					//aText += "<div class=\"create nanumbold\" onClick=\"crparty_display();\">새로운 파티 만들기 ...</div>";
					$("#wrapbox > #container > .partylist > .list").append(newDiv);
				}
				lastcreate=1;
				}*/
				//$("#wrapbox > #container > .partylist > .list").html(aText);
			}
			else{
				/*if(user[4]==me[4]){					
					$("#wrapbox > #container > .partylist > .list").html("<div class=\"create nanumbold\" onClick=\"crparty_display();\">새로운 파티 만들기 ...</div>");		
				}*/
			}
			startindex = lastindex;
			for(i=0;i<lastindex;i++){
				if(i==0){
					ddiv = $("#wrapbox > #container > .partylist > .list").find(".cards").first();
				}
				else{
					ddiv = ddiv.next(".cards");
				}
			}
			lastoffset = $(ddiv).offset().top;
		}
		else{			
			if(u_pnum){
				for(i=0;i<u_pnum;i++){
					if(u_ppub[i]==0 || or[i]==1){		
					newDiv = document.createElement('DIV');
					$(newDiv).attr("class","cards pie");
					$(newDiv).attr("alt",u_pid[i]);
					$(newDiv).html("<div class=\"img\"><img src=\"../../"+u_ppic[i]+"_m\"/></div><div class=\"name nanumbold\">"+u_pname[i]+"</div>");					
					$("#wrapbox > #container > .partylist > .list").append(newDiv);				
						//aText += "<div class=\"cards pie\" alt=\""+u_pid[i]+"\"><div class=\"img\"><img src=\"../../"+u_ppic[i]+"_m\"/></div><div class=\"name nanumbold\">"+u_pname[i]+"</div></div>";
					}
				}
				if(user[4]==me[4]){
					
					newDiv = document.createElement('DIV');
					$(newDiv).attr("class","create nanumbold");
					$(newDiv).attr("onclick","crparty_display();");
					$(newDiv).html("<h1>+</h1><br>새로운 파티 만들기 ...");					
					$("#wrapbox > #container > .partylist > .list").append(newDiv);
					//aText += "<div class=\"create nanumbold\" onClick=\"crparty_display();\">새로운 파티 만들기 ...</div>";
				}
				//$("#wrapbox > #container > .partylist > .list").html(aText);
			}
			else{
				if(user[4]==me[4]){					
					$("#wrapbox > #container > .partylist > .list").html("<div class=\"create nanumbold\" onClick=\"crparty_display();\">새로운 파티 만들기 ...</div>");		
				}
			}
			
		}		
	}	//mine
	else{	
		if(u_pnum){
				for(i=0;i<u_pnum;i++){
					if(u_ppub[i]==0 || or[i]==1){		
					newDiv = document.createElement('DIV');
					$(newDiv).attr("class","cards pie");
					$(newDiv).attr("alt",u_pid[i]);
					$(newDiv).html("<div class=\"img\"><img src=\"../../"+u_ppic[i]+"_m\"/></div><div class=\"name nanumbold\">"+u_pname[i]+"</div>");					
					$("#wrapbox > #container > .partylist > .list").append(newDiv);				
						//aText += "<div class=\"cards pie\" alt=\""+u_pid[i]+"\"><div class=\"img\"><img src=\"../../"+u_ppic[i]+"_m\"/></div><div class=\"name nanumbold\">"+u_pname[i]+"</div></div>";
					}
				}
				if(user[4]==me[4]){
					newDiv = document.createElement('DIV');
					$(newDiv).attr("class","create nanumbold");
					$(newDiv).attr("onclick","crparty_display();");
					$(newDiv).html("새로운 파티 만들기 ...");					
					$("#wrapbox > #container > .partylist > .list").append(newDiv);
					//aText += "<div class=\"create nanumbold\" onClick=\"crparty_display();\">새로운 파티 만들기 ...</div>";
				}
				//$("#wrapbox > #container > .partylist > .list").html(aText);
			}
			else{
				if(user[4]==me[4]){					
					$("#wrapbox > #container > .partylist > .list").html("<div class=\"create nanumbold\" onClick=\"crparty_display();\">새로운 파티 만들기 ...</div>");		
				}
			}
		$("#check_party_div").css("display","none");
		$("#nonminebutton").css("display","block");
	}
	$.each($("#container > .partylist > .list"),function(){
		$(this).children(".cards").mousedown(function(){
			post_to_url('../partyplay/',{'mynoteid':user[4], 'partyid':$(this).attr("alt") });			
		});
	});
} //partyload

function crparty_display(){
	tempnow = now;
	$("#fullscreen_bg").css("display","block");
	$("#win_add_party").css("visibility","visible");
	$("#wrapbox").addClass("changewrapBox");
	Party_Invite_MyFriend();
}

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

function check_party(){
	if(!$("#container > .partylist > .title > .button > .all").hasClass("selected")){
		$("#wrapbox > #container > .partylist > .list").children(".cards").fadeOut(300,0);
		$("#wrapbox > #container > .partylist > .list").children(".create").fadeOut(300,0);
		setTimeout('$("#wrapbox > #container > .partylist > .list").html("");conorev = 1;partyload();',300);
	}
	else{
		$("#wrapbox > #container > .partylist > .list").children(".cards").fadeOut(300,0);
		$("#wrapbox > #container > .partylist > .list").children(".create").fadeOut(300,0);
		startindex=0; lastindex=0; lastcreate=0;
		setTimeout('$("#wrapbox > #container > .partylist > .list").html("");conorev = 0;partyload();',300);		
	}
}

$(window).scroll(function(){
	de = document.documentElement;
	b = document.body;			
	now = document.all ? (!de.scrollTop ? b.scrollTop : de.scrollTop) : (window.pageYOffset ? window.pageYOffset : window.scrollY);
	
	if(conorev==0){
		if(now > (lastoffset-700)){
			partyload();
		}
	}
});