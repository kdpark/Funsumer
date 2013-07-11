function kimsclub_nondis() {
	$("#container > .partylist > .title > .pop").css("display","none")
}

$(document).ready(function() {

		// nav-menu EVENT.
		
		var SDDw = $(".SDD-wassup"), SDDn = $(".SDD-note"), SDDp = $(".SDD-party");
		var navw = $(".nav-wassup"), 	navn = $(".nav-note"), 	navp = $(".nav-party");
		
		navn.mouseenter(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_noteov.png)")});
		navw.mouseenter(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_wassupov.png)")});
		navp.mouseenter(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_partyov.png)")});
		
		navn.mouseleave(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_note.png)")});
		navw.mouseleave(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_wassup.png)")});
		navp.mouseleave(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_party.png)")});
		
		navn.mousedown(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_noteck.png)")});
		navw.mousedown(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_wassupck.png)")});
		navp.mousedown(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_partyck.png)")});
		
		navn.mouseup(function() { 	SDDn.css("background-image","url(../images/party/Header/header_menu_noteov.png)")
													post_to_url('../../note/',{'mynoteid':me[4]});
												});
		navw.mouseup(function() { 	SDDw.css("background-image","url(../images/party/Header/header_menu_wassupov.png)")
													post_to_url('../../party/',{'mynoteid':me[4]});
												});
		navp.mouseup(function() { 	SDDp.css("background-image","url(../images/party/Header/header_menu_wassupov.png)")
													post_to_url('../../wassup/',{});
												});

	
});

$(document).ready(function(e) {
    
	$("#container > .partylist > .rank > .card :first").css("border","none").css("border-top-left-radius","5px").css("border-top-right-radius","5px")
	
	$("#container > .partylist > .rank > .card:last").css("border-bottom-left-radius","5px").css("border-bottom-right-radius","5px").css("border","none")
	
});


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

//CountDown
var RemainTime

function showCountdown(ExpireTime)
{	

	if(ExpireTime >= 0){
		
		var day, hour, mi, sec, mod;
		var CountText;
		RemainTime = ExpireTime - 1;
	
		CountText = "";
	
		//    지나간자료는 나타내지않음
		if (RemainTime >= 0)
		{
			//    남은일수
			day = Math.floor(ExpireTime / (3600 * 24));
			mod = ExpireTime % (24 * 3600);
			//    남은시간
			hour = Math.floor(mod / 3600);
			mod = mod % 3600;
			//    남은분
			mi = Math.floor(mod / 60);
			//    남은초
			sec = mod % 60;
	
			CountText = (day > 0) ? day + "일 " : "";
			CountText = (hour > 0) ? CountText + hour + "시간 " : (CountText.length > 0) ? CountText + hour + "시간 " : CountText;
			CountText = (mi > 0) ? CountText + mi + "분 " : (CountText.length > 0) ? CountText + mi + "분 " : CountText;
			CountText = CountText + sec + "초"
		}		
	
		if (( sec <= 0 && CountText == "0초" ) || ( CountText == "" ))
		{
			// Complete
			CountText = "종료";
			$("#container > .partylist > .info > .left > .time > .day").html("0");
			$("#container > .partylist > .info > .left > .time > .hour").html("00");
			$("#container > .partylist > .info > .left > .time > .minute").html("00");
			$("#container > .partylist > .info > .left > .time > .second").html("00");
			
			post_to_url('../../party/',{});	
			
		}
	
		// Display
		$("#container > .partylist > .info > .left > .time > .day").html(day);
		if(hour < 10) $("#container > .partylist > .info > .left > .time > .hour").html("0" + hour);
		else $("#container > .partylist > .info > .left > .time > .hour").html(hour);
		if(mi < 10) $("#container > .partylist > .info > .left > .time > .minute").html("0"+mi);
		else $("#container > .partylist > .info > .left > .time > .minute").html(mi);
		if(sec < 10) $("#container > .partylist > .info > .left > .time > .second").html("0"+sec);
		else $("#container > .partylist > .info > .left > .time > .second").html(sec);
		
		if (CountText != "종료")
		{
			//    매 1초마다 재귀호출
			setTimeout("showCountdown(RemainTime)", 1000);
		}
	}
	else{		
		post_to_url('../../party/',{});	
		
	}
}	//countdown

var tempid; var objj; var one=0; var two=0;
function displaygogo(){
	t = "";
	for(i=0;i<6;i++){
		t = "";
		newDiv = document.createElement('DIV');
		if(fposi[i]==1){
			$(newDiv).attr("class","card hwi");
			one += fvote[i];
		}
		else if(fposi[i]==2){
			$(newDiv).attr("class","card hae");
			two += fvote[i];
		}
		//$(newDiv).attr("class","card hae");
		if(i==0){
			t += "<div class=\"left first\"></div>";
		}
		else if(i==1){
			t += "<div class=\"left second\"></div>";
		}
		else if(i==2){
			t += "<div class=\"left third\"></div>";
		}
		else{
			t += "<div class=\"left\">"+(i+1)+"</div>";
		}
		t += "<div class=\"right\"><div class=\"user\"><div class=\"pic\" alt=\""+fid[i]+"\"><img src=\"../../"+fpic[i]+"\" alt=\"\"/></div><div class=\"info\"><div class=\"name\"><a>"+fname[i]+"</a></div><Div class=\"loveit\"><img src=\"../images/party/Container/heart.png\" alt=\"\" />"+fvote[i]+"</Div></div></div>";
		
		if(fvoted[i]==1){
			t += "<div class=\"button\"><div class=\"Button_red_9pt\">인기투표</div></div>";
		}
		else{
			t += "";
		}
		t += "</div></div>";
		$(newDiv).html(t);
		$(".rank").append(newDiv);		
	}
	
	$("#leftscore").html(one);
	$("#rightscore").html(two);
	if(one > two){
		$(".vs > .left > .top").html("<img src=\"../images/event3/win.jpg\" alt=\"\" />");
		$(".vs > .right > .top").html("<img src=\"../images/event3/lose.jpg\" alt=\"\" />");
	}
	else if(one < two){
		$(".vs > .left > .top").html("<img src=\"../images/event3/lose.jpg\" alt=\"\" />");
		$(".vs > .right > .top").html("<img src=\"../images/event3/win.jpg\" alt=\"\" />");
	}
	else if(one==two){
		$(".vs > .left > .top").html("<img src=\"../images/event3/draw.jpg\" alt=\"\" />");
		$(".vs > .right > .top").html("<img src=\"../images/event3/draw.jpg\" alt=\"\" />");
	}
	
	$(".rank > .card > .right > .user > .pic").mousedown(function(){
		post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});
	});
	$(".rank > .card > .right > .user > .info > .name").mousedown(function(){
		post_to_url('../../note/',{'mynoteid':$(this).parent(".info").siblings(".pic").attr("alt")});
	});
	$(".rank > .card > .right > .button").mousedown(function(){
		tempid = $(this).siblings(".user").children(".pic").attr("alt");
		objj = $(this);	
		new ajax.xhr.Request("../../RequestAjax/votequery.php","opt=2&uid="+$(this).siblings(".user").children(".pic").attr("alt"),checkvotepossible,'POST');		
	});
}

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
					alert('투표는 하루에 한 번만 가능합니다');
				}
				else{
					new ajax.xhr.Request("../../RequestAjax/votequery.php","opt=1&uid="+tempid,nothingdo,'POST');	
					alert('투표를 실시했습니다');
					objj.css("display","none");
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