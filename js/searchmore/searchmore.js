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
function loadedalarm(){
}
function kimsclub_nondis() {
	$("#container > .headline > .pop").css("display","none")
}

$(document).ready(function() {

		// nav-menu EVENT.
		
		var SDDw = $(".SDD-wassup"), SDDn = $(".SDD-note"), SDDp = $(".SDD-party");
		var navw = $(".nav-wassup"), 	navn = $(".nav-note"), 	navp = $(".nav-party");
		
		navn.mouseenter(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_noteov.png)")});
		navw.mouseenter(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_partyov.png)")});
		navp.mouseenter(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_wassupov.png)")});
		
		navn.mouseleave(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_note.png)")});
		navw.mouseleave(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_party.png)")});
		navp.mouseleave(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_wassup.png)")});
		
		navn.mousedown(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_noteck.png)")});
		navw.mousedown(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_partyck.png)")});
		navp.mousedown(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_wassupck.png)")});
		
		navn.mouseup(function() { 	SDDn.css("background-image","url(../images/party/Header/header_menu_noteov.png)")
													post_to_url('../../note/',{'mynoteid':me[4]});
												});
		navw.mouseup(function() { 	SDDw.css("background-image","url(../images/party/Header/header_menu_partyov.png)");
													post_to_url('../../party/',{'mynoteid':me[4]});
												});
		navp.mouseup(function() { 	SDDp.css("background-image","url(../images/party/Header/header_menu_wassupov.png)")
													post_to_url('../../wassup/',{});
												});
												
	
	
});

function onsearch(){
	new ajax.xhr.Request("../../RequestAjax/Base_searchmore.php","opt="+$("#temp2").attr("alt")+"&value="+$("#temp").attr("alt"),onsearchresult,'POST');	
}
function onsearchresult(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval('('+dataJSON+')');
					
					Type = data.Type;
					if(Type==1){
						sch_name = new Array();	
						sch_id = new Array();	
						sch_pic = new Array();	
						sch_pcount = new Array();
						fstat = new Array();
						
						schnum = data.Numbers;
						for(i=0;i<schnum;i++){
							sch_name[i] = data.people[i].name;
							sch_id[i] = data.people[i].id;
							sch_pic[i] = data.people[i].pic;
							sch_pcount[i] = data.people[i].pcount;					
							fstat[i] = data.people[i].fstat;
						}
						
						makeonshowsearch(Type,schnum,sch_name,sch_id,sch_pic,sch_pcount,fstat);
					}
					else{
						schp_name = new Array();	
						schp_id = new Array();	
						schp_pic = new Array();		
						schp_admin = new Array();		
						schp_pcount = new Array();
						
						schpnum = data.Numberss;
						for(i=0;i<schpnum;i++){
							schp_name[i] = data.parties[i].pname;
							schp_id[i] = data.parties[i].pid;
							schp_pic[i] = data.parties[i].ppic;						
							schp_admin[i] = data.parties[i].padmin;
							schp_pcount[i] = data.parties[i].pcount;
						}
						
						makeonshowsearch(Type,schpnum,schp_name,schp_id,schp_pic,schp_admin,schp_pcount);
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

function makeonshowsearch(a,b,c,d,e,f,g){
	if(a==1){
		$("#container > .people").css("display","block");
		schText = "";
		for(i=0;i<b;i++){
			schText += "<div class=\"cards\"><div class=\"pic\"><img src=\"../"+e[i]+"\" width=\"50\" height=\"50\" style=\"cursor:pointer;\" alt=\""+d[i]+"\" class=\"pie\" /></div><div class=\"info\"><div class=\"name\" style=\"cursor:pointer;\">"+c[i]+"</div><div class=\"shareparty\">나와 공유한 파티 "+f[i]+" 개</div></div>";
			if(fstat[i]==0){	//본인
				schText += "<div class=\"button\" alt=\""+fstat[i]+"\"><div class=\"Button_gray Button_gray_selected\">본  인<div class=\"Button_gray_word Button_gray_selected_word\">본  인</div></div></div>";
			}
			else if(fstat[i]==1){	//친구
				schText += "<div class=\"button\" alt=\""+fstat[i]+"\"><div class=\"Button_red\">이미 친구<div class=\"Button_red_word\">이미 친구</div></div></div>";
			}
			else if(fstat[i]==2){	//요청보냄
				schText += "<div class=\"button\" alt=\""+fstat[i]+"\"><div class=\"Button_gray Button_gray_selected\">요청 완료<div class=\"Button_gray_word Button_gray_selected_word\">요청 완료</div></div></div>";
			}
			else if(fstat[i]==3){	//요청받음
				schText += "<div class=\"button\" alt=\""+fstat[i]+"\"><div class=\"Button_gray\">친구 수락<div class=\"Button_gray_word\">친구 수락</div></div></div>";
			}
			else{
				schText += "<div class=\"button\" alt=\""+fstat[i]+"\"><div class=\"Button_gray\">친구 요청<div class=\"Button_gray_word\">친구 요청</div></div></div>";
			}
			schText += "</div>";
		}
		$("#container > .people > .contents").html(schText);
		
		//노트 이동
		$.each($("#container > .people > .contents > .cards > .pic"),function(){
				$(this).mousedown(function(){
					post_to_url('../../note/',{'mynoteid':$(this).children("img").attr("alt")});
				});
			});
			$.each($("#container > .people > .contents > .cards > .info > .name"),function(){
				$(this).mousedown(function(){
					post_to_url('../../note/',{'mynoteid':$(this).parent(".info").siblings(".pic").children("img").attr("alt")});
				});
			});
			
			
		// 친구요청버튼 EVENT
	
	$.each($("#container > .people > .contents > .cards > .button > .Button_gray"),function() {
		
		$(this).mouseleave(function() {
			$(this).css("background-image","url(../images/party/Container/buttongraybg.png)");
		});
		$(this).mousedown(function() {
			$(this).css("background-image","url(../images/party/Container/buttongraybgck.png)");
		});
		$(this).mouseup(function() {
			
			if(typeof pageYOffset != 'undefined'){
				$(this).css("background-image","url(../images/party/Container/buttongraybg.png)");
				$(this).html("요청 완료<div class=\"Button_gray_word\">요청 완료</div>");
				$(this).addClass("Button_gray_selected");
				$(this).children(".Button_gray_word").addClass("Button_gray_selected_word");
				if($(this).parent(".button").attr("alt")==3){
					alert('친구요청을 수락하였습니다');
					new ajax.xhr.Request("../../RequestAjax/Friend_query.php","fopt=1=&fid="+$(this).parent(".button").siblings(".pic").children("img").attr("alt") ,nothingdo,'POST');
				}
				else if($(this).parent(".button").attr("alt")==4){
					alert('친구요청을 보냈습니다');
					new ajax.xhr.Request("../../RequestAjax/Friend_query.php","fopt=1=&fid="+$(this).parent(".button").siblings(".pic").children("img").attr("alt"),nothingdo,'POST');		
				}
				
			}	else  {
				$(this).css("background-image","url(../images/party/Container/buttongraybg.png)");
				$(this).html("요청 완료<div class=\"Button_gray_word\">요청 완료</div>");
				$(this).addClass("Button_gray_selected_ie8");
				$(this).children(".Button_gray_word").addClass("Button_gray_selected_word_ie8");			
				if($(this).parent(".button").attr("alt")==3){
					alert('친구요청을 수락하였습니다');
					new ajax.xhr.Request("../../RequestAjax/Friend_query.php","fopt=1=&fid="+$(this).parent(".button").siblings(".pic").attr("alt"),nothingdo,'POST');
				}
				else if($(this).parent(".button").attr("alt")==4){
					alert('친구요청을 보냈습니다');
					new ajax.xhr.Request("../../RequestAjax/Friend_query.php","fopt=1=&fid="+$(this).parent(".button").siblings(".pic").attr("alt"),nothingdo,'POST');		
				}
			} 			
		});
		
	});	
			
				
	}
	else{
		$("#container > .party").css("display","block");
		schText = "";
		for(i=0;i<b;i++){
			if(d[i]){
			schText += "<div class=\"cards\" alt=\""+d[i]+"\"><div class=\"pic\"><img src=\"../"+e[i]+"\" width=\"50\" height=\"50\" alt=\"\"/></div><div class=\"info\"><div class=\"name\">"+c[i]+"</div><div class=\"shareparty\">내가 아는 멤버 "+g[i]+" 명</div></div><div class=\"button\"><div class=\"Button_gray\" alt=\""+f[i]+"\">방문 하기<div class=\"Button_gray_word\">방문 하기</div></div></div></div> ";
			}
		}
		$("#container > .party > .contents").html(schText);
		
			// 방문하기 버튼 EVENT
		
			$.each($("#container > .party > .contents > .cards > .button > .Button_gray"),function() {
			
			$(this).mouseleave(function() {
				$(this).css("background-image","url(../images/party/Container/buttongraybg.png)");
			});
			$(this).mousedown(function() {
				$(this).css("background-image","url(../images/party/Container/buttongraybgck.png)");
			});
			$(this).mouseup(function() {
				$(this).css("background-image","url(../images/party/Container/buttongraybg.png)");					
				post_to_url('../../partyplay/',{'mynoteid':$(this).attr("alt"),'partyid':$(this).parent(".button").parent(".cards").attr("alt")});
			});
			
	});
		
	}
}



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
});