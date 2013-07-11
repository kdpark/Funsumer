$(window).scroll(function(){
	de = document.documentElement;
	b = document.body;			
	now = document.all ? (!de.scrollTop ? b.scrollTop : de.scrollTop) : (window.pageYOffset ? window.pageYOffset : window.scrollY);
});

//partyload
var f1=0, f1v=0, f2=0, f2v=0, f3=0, f3v=0;

function partyload(){
	
	tText1 = "";
	tText2 = "";
	tText3 = "";
	for(i=0;i<gradenum;i++){		
		newDiv1 = document.createElement('DIV');
		$(newDiv1).attr("class","box");
		newDiv2 = document.createElement('DIV');
		$(newDiv2).attr("class","box");
		newDiv3 = document.createElement('DIV');
		$(newDiv3).attr("class","box");		
		//alert(top1_id[i] + " / " + top2_id[i] + " / " + top3_id[i]);
		//**************************************************************************************************************************************************************************//
		
		tText1 += "<div class=\"cards\" alt=\""+first_id[i]+"\"><div class=\"img\"><img src=\"../../"+first_pic[i]+"\" alt=\"\" />";
		
		if(top1_id[i]!=0){
			tText1 += "<div class=\"starsumer\"><div class=\"left\"><div class=\"img\"><img src=\"../../"+top1_pic[i]+"\" alt=\"\" /></div></div><div class=\"right\"><div class=\"title\"><img src=\"../images/event/crown.png\" height=\"15\" alt=\"\" /></div><div class=\"name\"><a>"+top1_name[i]+"</a></div></div></div>"
		}
		
		tText1 += "</div><div class=\"name nanumbold\"><div class=\"left\">"+first_name[i]+"</div><div class=\"right\"><img src=\"../images/party/Container/heart.png\" alt=\"\"/>"+first_vote[i]+"</div></div></div>";
		
		//**************************************************************************************************************************************************************************//
		
		tText2 += "<div class=\"cards\" alt=\""+second_id[i]+"\"><div class=\"img\"><img src=\"../../"+second_pic[i]+"\" alt=\"\" />";

		if(top2_id[i]!=0){
			tText2 += "<div class=\"starsumer\"><div class=\"left\"><div class=\"img\"><img src=\"../../"+top2_pic[i]+"\" alt=\"\" /></div></div><div class=\"right\"><div class=\"title\"><img src=\"../images/event/crown.png\" height=\"15\" alt=\"\" /></div><div class=\"name\"><a>"+top2_name[i]+"</a></div></div></div>";
		}
		
		tText2 += "</div><div class=\"name nanumbold\"><div class=\"left\">"+second_name[i]+"</div><div class=\"right\"><img src=\"../images/party/Container/heart.png\" alt=\"\"/>"+second_vote[i]+"</div></div></div>";
		
		//**************************************************************************************************************************************************************************//
		
		tText3 += "<div class=\"cards\" alt=\""+third_id[i]+"\"><div class=\"img\"><img src=\"../../"+third_pic[i]+"\" alt=\"\" />";
		
		if(top3_id[i]!=0){
			tText3 += "<div class=\"starsumer\"><div class=\"left\"><div class=\"img\"><img src=\"../../"+top3_pic[i]+"\" alt=\"\" /></div></div><div class=\"right\"><div class=\"title\"><img src=\"../images/event/crown.png\" height=\"15\" alt=\"\" /></div><div class=\"name\"><a>"+top3_name[i]+"</a></div></div></div>";
		}
		
		tText3 += "</div><div class=\"name nanumbold\"><div class=\"left\">"+third_name[i]+"</div><div class=\"right\"><img src=\"../images/party/Container/heart.png\" alt=\"\"/>"+third_vote[i]+"</div></div></div>";		
		
		$(newDiv1).html(tText1);
		$(newDiv2).html(tText2);
		$(newDiv3).html(tText3);
		
		$("#stu1").append(newDiv1);
		$("#stu2").append(newDiv2);
		$("#stu3").append(newDiv3);		
		
		tText1 = "";
		tText2 = "";
		tText3 = "";
		
		if(first_vote[i] > f1v){ f1v = first_vote[i]; f1=i }
		if(second_vote[i] > f2v){ f2v = second_vote[i]; f2=i }
		if(third_vote[i] > f3v){ f3v = third_vote[i]; f3=i }
		
	}
	$("#container > .partylist > .list").find(".cards").mousedown(function(){
		post_to_url('../../partyplay/',{'mynoteid':me[4], 'partyid':$(this).attr("alt")});
	});
	
	if(f1v!=0){
		$("#rank_stu1 > .content > .nonexist").css("display","none");
		$("#rank_stu1 > .content > .exist").css("display","block");
		$("#rank_stu1 > .content > .exist > .cards > .img > img").attr("src","../../"+first_pic[f1]);
		$("#rank_stu1 > .content > .exist > .cards > .img > .starsumer > .left > .img > img").attr("src","../../"+top1_pic[f1]);
		$("#rank_stu1 > .content > .exist > .cards > .img > .starsumer > .right > .name").html(top1_name[f1]);
		$("#rank_stu1 > .content > .exist > .cards > .name > .left").html(first_name[f1]);
		$("#rank_stu1 > .content > .exist > .cards > .name > .right").html("<img src=\"../images/party/Container/heart.png\" />"+f1v);
		$("#rank_stu1").mousedown(function(){	
			post_to_url('../../partyplay/',{'partyid':first_id[f1]});
		});
	}
	
	if(f2v!=0){
		$("#rank_stu2 > .content > .nonexist").css("display","none");
		$("#rank_stu2 > .content > .exist").css("display","block");
		$("#rank_stu2 > .content > .exist > .cards > .img > img").attr("src","../../"+second_pic[f2]);
		$("#rank_stu2 > .content > .exist > .cards > .img > .starsumer > .left > .img > img").attr("src","../../"+top2_pic[f2]);
		$("#rank_stu2 > .content > .exist > .cards > .img > .starsumer > .right > .name").html(top2_name[f2]);
		$("#rank_stu2 > .content > .exist > .cards > .name > .left").html(second_name[f2]);
		$("#rank_stu2 > .content > .exist > .cards > .name > .right").html("<img src=\"../images/party/Container/heart.png\" />"+f2v);
		$("#rank_stu2").mousedown(function(){		
			post_to_url('../../partyplay/',{'partyid':second_id[f2]});
		});
	}
	
	if(f3v!=0){
		$("#rank_stu3 > .content > .nonexist").css("display","none");
		$("#rank_stu3 > .content > .exist").css("display","block");
		$("#rank_stu3 > .content > .exist > .cards > .img > img").attr("src","../../"+third_pic[f3]);
		$("#rank_stu3 > .content > .exist > .cards > .img > .starsumer > .left > .img > img").attr("src","../../"+top3_pic[f3]);
		$("#rank_stu3 > .content > .exist > .cards > .img > .starsumer > .right > .name").html(top3_name[f3]);
		$("#rank_stu3 > .content > .exist > .cards > .name > .left").html(third_name[f3]);
		$("#rank_stu3 > .content > .exist > .cards > .name > .right").html("<img src=\"../images/party/Container/heart.png\" />"+f3v);
		$("#rank_stu3").mousedown(function(){
			post_to_url('../../partyplay/',{'partyid':third_id[f3]});
		});
	}
}	//partyload

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
	
})

$(document).ready(function(e) {
    
	$("#container > .partylist > .list > .student3 > .box:first").css("border","none").css("border-top-left-radius","5px").css("border-top-right-radius","5px")
	$("#container > .partylist > .list > .student2 > .box:first").css("border","none").css("border-top-left-radius","5px").css("border-top-right-radius","5px")
	$("#container > .partylist > .list > .student1 > .box:first").css("border","none").css("border-top-left-radius","5px").css("border-top-right-radius","5px")
	
	$("#container > .partylist > .list > .student3 > .box:last").css("border-bottom-left-radius","5px").css("border-bottom-right-radius","5px")
	$("#container > .partylist > .list > .student2 > .box:last").css("border-bottom-left-radius","5px").css("border-bottom-right-radius","5px")
	$("#container > .partylist > .list > .student1 > .box:last").css("border-bottom-left-radius","5px").css("border-bottom-right-radius","5px")
	
});;	//before

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
			
			if(tvalue==1){				
				if(evnum==1 || evnum==2){
					new ajax.xhr.Request("../../ev3.php","evnum="+evnum,ev3go,'POST');
					//post_to_url('../../event3/',{'eventnumber':evnum});
				}
				else{
					post_to_url('../../party/',{});
				}
			}
			else if(tvalue==2){
				if(evnum==1){
					post_to_url('../../event2/',{'eventnumber':1});
				}				
				else{
					post_to_url('../../party/',{});
				}
			}
			new ajax.xhr.Request("../../endevent.php","",nothingdo,'POST');
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
		if(tvalue==1){				
			if(evnum==1 || evnum==2){				
				new ajax.xhr.Request("../../ev3.php","evnum="+evnum,ev3go,'POST');
				//post_to_url('../../event3/',{'eventnumber':evnum});
			}
			else{
				post_to_url('../../party/',{});
			}
		}
		else if(tvalue==2){
			if(evnum==1){
				post_to_url('../../event2/',{'eventnumber':1});
			}				
			else{
				post_to_url('../../party/',{});
			}
		}
		
	}
}	//countdown

$(document).ready(function(e) {
	$("#container > .partylist > .title > .way").mousedown(function(){
		$(document).scrollTop(3000);
	});
});
function ev3go(){
	post_to_url('../../event3/',{'eventnumber':evnum});
}