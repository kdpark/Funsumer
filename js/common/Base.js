var now; var tempnow; var notjoined=0;
function autolink(id) {
        var container = document.getElementById(id);
        var doc = container.innerHTML;
        var regURL = new RegExp("(http|https|ftp|telnet|news|irc)://([-/.a-zA-Z0-9_~#%$?&=:200-377()]+)","gi");
        var regEmail = new RegExp("([xA1-xFEa-z0-9_-]+@[xA1-xFEa-z0-9-]+\\.[a-z0-9-]+)","gi");
        container.innerHTML = doc.replace(regURL,"<a href='$1://$2' target='_blank'>$1://$2</a>").replace(regEmail,"<a href='mailto:$1'>$1</a>");
}

var now = 0;
var  focusout=0;
$(document).ready(function() {
	$.each($(".Tap2"),function(){
		$(this).children(".mynote").click(function(){
			post_to_url('../../note/',{});
		});
		$(this).children(".myparty").click(function(){
			post_to_url('../../party/',{'conorev':'1'});
		});
	});
	//글쓰기 포커싱
	$(".Rfield > .write > .contents > .mid > textarea").focus(function(){
		if(notjoined==0){
			$('.Rfield > .write > .buttons').css('display','block');
			$('.Rfield > .write > .buttons > .anounce').css('display','none'); 		
			
			if(partyid){ 		
				$('.Rfield > .write > .buttons > .anounce').css('display','block'); 
			}
		}
		
	});
	$('.Rfield > .write > .buttons').mouseenter(function(){
		focusout=1;
	});
	$('.Rfield > .write > .buttons').mouseleave(function(){
		focusout=0;
	});
	$(".Rfield > .write > .contents > .mid > textarea").focusout(function() {
		if(focusout==0){
			if($(".Rfield > .write > .contents > .mid > textarea").val()==""){
				$('.Rfield > .write > .buttons').css('display','none');
				$('.cameraspace').css('display','none');
			}
		}
    });
	//글쓰기 카메라
	$('.Rfield > .write > .buttons > .camera').mousedown(function(){
		if($(this).children("img").attr("alt")==""){
			$(this).children("img").attr("src","../../images/board/button_camerack.png");
			$(this).children("img").attr("alt","1");
			$('.cameraspace').css('display','block');	
		}
		else{
			if($('.cameraspace > .photopart > .photo > .photo1 > .img > img').attr('alt')==""){
				$(this).children("img").attr("src","../../images/board/button_camera.png");
				$(this).children("img").attr("alt","");
				$('.cameraspace').css('display','none');				
			}
			else{
				
			}
		}
		
	});

	//사진업로드 사진삭제 버튼
	$.each($('.cameraspace > .photopart > .photo > .photo1 > .close'),function(){
		$(this).mousedown(function(){			
			new ajax.xhr.Request("../../erase_upload_temp.php","er_file="+$('.cameraspace > .photopart > .photo > .photo1 > .img > img').attr('alt'),nothingdo,'POST');
			$(this).parent(".photo1").children(".img").children("img").attr("alt","");
			$(this).parent(".photo1").children(".img").children("img").attr("src","");
			$('.cameraspace > .photopart > .photo > .photo1 > .close').css('display','none');
			
			$('.cameraspace').css('display','none');
			setTimeout("$('.cameraspace').css('display','block');",10);
		});
	});
	
	// 공지글 버튼
	$('.Rfield > .write > .buttons > .anounce').mousedown(function(){
		if($(".partyssier").attr("alt")==me[4] || partynoticeauth==1){
			if($(this).children("img").attr("alt")==""){
				$(this).children("img").attr("src","../../images/board/button_anounceck.png");
				$(this).children("img").attr("alt","1");
				$(".Rfield > .write > .title").css("display","block");
				
			}
			else{
				$(this).children("img").attr("src","../../images/board/button_anounce.png");
				$(this).children("img").attr("alt","");
				$(".Rfield > .write > .title").css("display","none");
			}
		}
		else{
			alert('공지글 쓰기 권한이 없습니다');
		}		
	});
	
	
	
	
	$('input[placeholder], textarea[placeholder]').placeholder();
		
	$(function(){
		
	var input = $("#header > .nav > .nav-search > .text-search input"), ico_input = $(".ico-search"), ico_input2 = $(".ch-ico-search");
	var par_input = $(".nav-search"), wht_input = $(".wht-nav-search"), closed = $(".close-search");
	var sch = $(".win-search"); 
			input.focus(function() {
				sch_check=1;
				if(typeof pageYOffset != 'undefined'){
					input.animate({width:"130px"},{queue:false,duration:300});
					wht_input.animate({width:"160px"},{queue:false,duration:300});
					wht_input.fadeTo(400,1);
					ico_input2.fadeTo(400,1);
					ico_input.fadeTo(400.0);
					closed.fadeTo(400,1);	
					sch.css("display","block");					
				}
				else{
					par_input.css("background-image","url(../images/party/Header/IE_header_searchbgov.png)");
					ico_input.html('<img src="../../images/party/Header/header_searchICOov.png" height="12" alt="" />');
				}				  
		   		
			}); //input.focus
		
			input.focusout(function() {			
								
					if(typeof pageYOffset != 'undefined'){
						input.animate({width:"70px"},{queue:false,duration:300});
						wht_input.animate({width:"102px"},{queue:false,duration:300});
						wht_input.fadeTo(400,0.15);
						ico_input2.fadeTo(400,0);
						ico_input.fadeTo(400.1);
						closed.fadeTo(400,0);
					}
					else{
						par_input.css("background-image","url(../images/party/Header/IE_header_searchbg.png)");
						ico_input.html('<img src="../../images/party/Header/header_searchICO.png" height="12" alt="" />');
					}
					sch.css("display","none");		   				
								
			}); //input.focus
			
			
	 });  // function
	 
	 	 
	 // Tap Butto EVENT.
	 
	 $.each($("#header > .Tap"),function() {
		 
		 var arm	= $(this).children(".alarm-message").children(".ico_alarm"),			arm_w		= $(this).children(".alarm-message").children(".win-alarm"),				arm_n		= $(this).children(".alarm-message").children(".ico_alarm").children(".number-alarm");
		 var prt 	= $(this).children(".invite-party").children(".ico_pinvite"),  		prt_w 		= $(this).children(".invite-party").children(".win-party"), 				prt_n 		= $(this).children(".invite-party").children(".ico_pinvite").children(".number-party");
		 var mem = $(this).children(".invite-member").children(".ico_minvite"), 	mem_w 	= $(this).children(".invite-member").children(".win-member"),		mem_n 	= $(this).children(".invite-member").children(".ico_minvite").children(".number-member");
		 var set 	= $(this).children(".setting").children(".ico_set"),				set_w 		= $(this).children(".setting").children(".win-setting");
		 
		 arm.mousedown  (function()	{

/*0430*/													$(this).html("<img src=\"../images/party/Tap/alarm-messageck.png\" width=\"26\" alt=\"\" /><div class=\"number-alarm\"></div>")
															prt.css("background-image","url(../images/party/Tap/invite-party.png)");
															mem.css("background-image","url(../images/party/Tap/invite-member.png)");
															set.css("background-image","url(../images/party/Tap/setting.png)");
															
															prt_w.css("visibility","hidden");
															mem_w.css("visibility","hidden");															
															set_w.css("visibility","hidden");
															
															arm_n.css("display","none");
															
															if(arm_w.css("visibility")=="visible"){
																arm_w.css("visibility","hidden");
/*0430*/														$(this).html("<img src=\"../images/party/Tap/alarm-message.png\" width=\"26\" alt=\"\" /><div class=\"number-alarm\"></div>");															
															}
															else{
																arm_w.css("visibility","visible");																																																								
																new ajax.xhr.Request("../../RequestAjax/alarm_read.php","anum="+alarm_count+"&aid="+alarmid,nothingdo,'POST');																
															}
			 
		 											});
		 prt.mousedown	(function() 	{ 	
/*0430*/ 													arm.html("<img src=\"../images/party/Tap/alarm-message.png\" width=\"26\" alt=\"\" /><div class=\"number-alarm\"></div>");
															$(this).css("background-image","url(../images/party/Tap/invite-partyclick.png)");
															mem.css("background-image","url(../images/party/Tap/invite-member.png)");
															set.css("background-image","url(../images/party/Tap/setting.png)");					// Change
															
															mem_w.css("visibility","hidden");
															arm_w.css("visibility","hidden");
															set_w.css("visibility","hidden");  																		// Closed
															
															prt_n.css("display","none");																			// Open															
															
															if(prt_w.css("visibility")=="visible"){
																prt_w.css("visibility","hidden");
																$(this).css("background-image","url(../images/party/Tap/invite-party.png)");															
															}
															else{
																prt_w.css("visibility","visible");																
															}
															
		 		
													});
													
		 mem.mousedown	(function() 	{ 	
/*0430*/ 													arm.html("<img src=\"../images/party/Tap/alarm-message.png\" width=\"26\" alt=\"\" /><div class=\"number-alarm\"></div>");
															$(this).css("background-image","url(../images/party/Tap/invite-memberclick.png)");
															prt.css("background-image","url(../images/party/Tap/invite-party.png)");
															set.css("background-image","url(../images/party/Tap/setting.png)");	// Change
															
															prt_w.css("visibility","hidden");
															arm_w.css("visibility","hidden");
															set_w.css("visibility","hidden");  																		// Closed
															
															mem_n.css("display","none");
															if(mem_w.css("visibility")=="visible"){
																mem_w.css("visibility","hidden");	
																$(this).css("background-image","url(../images/party/Tap/invite-member.png)");																																													
															}
															else{
																mem_w.css("visibility","visible");									
																
															}
															
															
														
														});
														
		 set.mousedown	(function() 	{ 	
/*0430*/													arm.html("<img src=\"../images/party/Tap/alarm-message.png\" width=\"26\" alt=\"\" /><div class=\"number-alarm\"></div>");
															$(this).css("background-image","url(../images/party/Tap/settingclick.png)");
															prt.css("background-image","url(../images/party/Tap/invite-party.png)");
															mem.css("background-image","url(../images/party/Tap/invite-member.png)");	// Change
															
															prt_w.css("visibility","hidden");
															arm_w.css("visibility","hidden");
															mem_w.css("visibility","hidden");  																	// Closed
															
															if(set_w.css("visibility")=="visible"){
																set_w.css("visibility","hidden");	
																$(this).css("background-image","url(../images/party/Tap/setting.png)");																															
															}
															else{
																set_w.css("visibility","visible");																		// Open
															}
															
													});													
		
		 
	 });
	 
	
	 
	 $.each($(".Tap"),function() {
		 
		 var arm_w	= $("#alarm-message-contents"),     arm_w_drag	= $("#alarm-message-contents > .ScrollBox > .dragger_container");
		 var prt_w 	= $("#invite-party-contents"), 		prt_w_drag	= $("#invite-party-contents > .ScrollBox > .dragger_container");
		 var mem_w 	= $("#invite-member-contents"), 	mem_w_drag	= $("#invite-member-contents > .ScrollBox > .dragger_container");
		 
		 	if(typeof pageYOffset != 'undefined'){
								arm_w.mouseenter(function() {  arm_w_drag.css("visibility","visible");arm_w_drag.fadeTo(400,1); });
								arm_w.mouseleave(function() {	arm_w_drag.fadeTo(400,0); });	
						
								prt_w.mouseenter(function() {  prt_w_drag.css("visibility","visible");prt_w_drag.fadeTo(400,1); });
								prt_w.mouseleave(function() {	prt_w_drag.fadeTo(400,0); });							
								
								mem_w.mouseenter(function() { mem_w_drag.css("visibility","visible");mem_w_drag.fadeTo(400,1) });
								mem_w.mouseleave(function() {	mem_w_drag.fadeTo(400,0); });
			}
			else{
								arm_w.mouseenter(function() {  arm_w_drag.css("visibility","visible");arm_w_drag.fadeTo(400,1); });
								arm_w.mouseleave(function() {	arm_w_drag.fadeTo(400,0); });	
								
								prt_w.mouseenter(function() { prt_w_drag.css("visibility","visible") });
								prt_w.mouseleave(function() {	prt_w_drag.css("visibility","hidden") });
								 
								mem_w.mouseenter(function() { mem_w_drag.css("visibility","visible") });
								mem_w.mouseleave(function() {	mem_w_drag.css("visibility","hidden"); });
			}
			 
		 
	 }); //0430
	 
	 
	 
	 
	 
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
		 
		 $(this).mouseup(function(){
			 if($(this).attr("alt")==0){	//admin
				 post_to_url('../../account/',{});
			 }
			 else if($(this).attr("alt")==1){	//logout
				 location.href = '../../logout.php';
			 }
			 else{	//funsumer center
				 
			 }
		 });
		 
	 });
	
});

//Search Result Ajax**************************************************************************************************************************************************//
function ajax_search(){
	poop = document.getElementById('sch').value;
	if(poop!=""){				
		new ajax.xhr.Request("../RequestAjax/Base_search.php","value="+poop,searchresult,'POST');
	}
	else{
		$(".noresult").css("display","none");
		$(".pple-search, .party-search, .win-search > .footer").css("display","none");
	}
}
function searchresult(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval('('+dataJSON+')');
					sch_name = new Array();	
					sch_id = new Array();	
					sch_pic = new Array();	
					sch_pcount = new Array();
					schp_name = new Array();	
					schp_id = new Array();	
					schp_pic = new Array();		
					schp_admin = new Array();		
					schp_pcount = new Array();
								
					schnum = data.Numbers;
					schpnum = data.Numberss;
					
					more1 = data.More1;
					more2 = data.More2;
					for(i=0;i<schnum;i++){
						sch_name[i] = data.people[i].name;
						sch_id[i] = data.people[i].id;
						sch_pic[i] = data.people[i].pic;
						sch_pcount[i] = data.people[i].pcount;						
					}
					for(i=0;i<schpnum;i++){
						schp_name[i] = data.parties[i].pname;
						schp_id[i] = data.parties[i].pid;
						schp_pic[i] = data.parties[i].ppic;						
						schp_admin[i] = data.parties[i].padmin;
						schp_pcount[i] = data.parties[i].pcount;
					}
					showsearch(schnum,sch_name,sch_id,sch_pic,schpnum,schp_name,schp_id,schp_pic,more1,more2,schp_admin,sch_pcount, schp_pcount);
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

function showsearch(a,b,c,d,e,f,g,h,l,j,k,m,n){
	if(a==0 && e==0){
		$(".pple-search, .party-search, .win-search > .footer").css("display","none");
		$(".noresult").css("display","block");
	}
	else{	
		$(".noresult").css("display","none");
		sText = "";
		pText = "";
		for(i=0;i<4;i++){
			if(b[i]){
				sText += "<ul class=\"cards\" alt=\""+c[i]+"\"><li class=\"pic pie\"><img src=\"../"+d[i]+"38\" width=\"30\" height=\"30\" alt=\"\" class=\"pie\" /></li><li class=\"name\">"+b[i]+"</li><li class=\"shareparty\">나와 공유한 파티 "+m[i]+" 개</li></ul>";	
			}
			else{
				sText += "";	
			}
		}
		$(".pple-search > .contents").html(sText);
		$(".pple-search, .party-search, .win-search > .footer").css("display","block");
		for(i=0;i<4;i++){
			if(f[i]){			
				pText += "<ul class=\"cards\" alt=\""+g[i]+"\"><li class=\"outline30\" alt=\""+k[i]+"\"></li><li class=\"pic\"><img src=\"../"+h[i]+"_s\" height=\"30\" alt=\"\" class=\"pie\" /></li><li class=\"name\">"+f[i]+"</li><li class=\"shareparty\">내가 아는 멤버 "+n[i]+" 명</li></ul>";	
			}
			else{
				pText += "";	
			}
		}
		$(".win-search > .party-search > .contents").html(pText);	
	}
	
	if(l==1){
		$("#m_s_more").css("display","block"); 
	}
	else{
		$("#m_s_more").css("display","none");
	}
	
	if(j==1){
		$("#p_s_more").css("display","block");
	}
	else{
		$("#p_s_more").css("display","none");
	}
	
	// cards EVENT.
	 
	 $.each($("#m_s_more"),function(){
		 $(this).mousedown(function(){
		 	post_to_url('../../searchmore/',{'position':'1', 'keyword':$('#sch').val()});
		 })
	 });
	 $.each($("#p_s_more"),function(){
		 $(this).mousedown(function(){
			 post_to_url('../../searchmore/',{'position':'2', 'keyword':$('#sch').val()});
		 });
	 });
	 
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
		
		$(this).mousedown(function(){
			post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});
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
		
		$(this).mousedown(function(){
			post_to_url('../../partyplay/',{'mynoteid':me[4]/*$(this).children(".outline30").attr("alt")*/, 'partyid':$(this).attr("alt")});
		});
		 
	 });
} //Search

//InvPList Load****************************************************************************************************************************************//
function invmeparty(){
	new ajax.xhr.Request("../../RequestAjax/Party_invme.php","",partyinvme,'POST');
}
function partyinvme(req){
	
	if(req.readyState==4)
	{
		if(req.status == 200)
		{			
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");				
				
				
				invuserID = new Array();
				invuserName = new Array();
				invuserPic = new Array();
				invpID = new Array();
				invpName = new Array();
				invTime = new Array();
				Num = data.NumberOfInv;
				
				if(Num!=0){
					for(i=0;i<Num;i++){
						invuserID[i] = data.partyinv[i].invme_id;
						invuserName[i] = data.partyinv[i].invme_name;
						invuserPic[i] = data.partyinv[i].invme_pic;
						invpID[i] = data.partyinv[i].invparty_id;
						invpName[i] = data.partyinv[i].invparty_name;
						invTime[i] = data.partyinv[i].invtime;
					}
					Partyinvme_Show(Num, invuserID, invuserName, invuserPic, invpID, invpName, invTime);
				}
				else{
					$("#invite-party-contents > .ScrollBox > .container > .content").html("");
					$(".Tap > .invite-party > .ico_pinvite > .number-party").css("display","none");
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

function Partyinvme_Show(a,b,c,d,e,f,g){
	piText = "";
	$(".Tap > .invite-party > .ico_pinvite > .number-party").html(a);
	if(a!=0){
		$(".Tap > .invite-party > .ico_pinvite > .number-party").css("display","block");
		for(i=0;i<a;i++){
			piText += "<ul class=\"invitation\" alt=\""+e[i]+"\"><li class=\"pic\" alt=\""+b[i]+"\" style=\"cursor:pointer;\"><img src=\"../../"+d[i]+"38\" height=\"38\" width=\"38\" alt=\"\" class=\"pie\" /></li><li class=\"story\"><h1 style=\"cursor:pointer;\">"+c[i]+"</h1> 님이 <h2 style=\"cursor:pointer;\">"+f[i]+"</h2> 파티로 초대 하셨습니다.</li><li class=\"time\">"+g[i].substr(0,10)+"</li><li class=\"button\"><img src=\"../images/party/Tap/ok.png\" alt=\"0\" /><img src=\"../images/party/Tap/cancel.png\" alt=\"1\" /></li></ul>";			
		}
		$("#invite-party-contents > .ScrollBox > .container > .content").html(piText);
	}
	
	
	 $.each($("#invite-party-contents ul"),function() {
		 
		 $(this).mouseenter(function() {
			 
			 $(this).css("background-color","#f5f5f5");
			 $(this).children(".button").css("display","block");
			 
		 });
		 
		 $(this).mouseleave(function() {
			 
			 $(this).css("background-color","#fff");
			 $(this).children(".button").css("display","none");
			 
		 });
		 
		 $(this).children(".pic").mousedown(function(){
			 post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});
		 });
		 $(this).children(".story").children("h1").mousedown(function(){
			 post_to_url('../../note/',{'mynoteid':$(this).parent(".story").siblings(".pic").attr("alt") });
		 });
		 $(this).children(".story").children("h2").mousedown(function(){
			 post_to_url('../../partyplay/',{'mynoteid':me[4]/*$(this).parent(".story").siblings(".pic").attr("alt")*/, 'partyid':$(this).parent(".story").parent(".invitation").attr("alt")});
		 });
		 
	 });
	 $.each($("#invite-party-contents ul"),function(){
		 $(this).children(".button").children("img").mousedown(function(){
			 if($(this).attr("alt")==1){
				 if(confirm('파티초대장을 삭제하시겠습니까?')){
					$(this).parent(".button").parent("ul").css("background-color","#FF6F6F");
					$(this).parent(".button").parent("ul").fadeOut(300,0);
					mCustomScrollbars();
					new ajax.xhr.Request("../../RequestAjax/party_query.php","popt=6&pid="+$(this).parent(".button").parent("ul").attr("alt"),nothingdo,'POST');
				 }
			 }
			 else{
				 if(confirm('파티에 가입하시겠습니까?')){
					 $(this).parent(".button").parent("ul").css("background-color","#A4FFA4");				 
					 $(this).parent(".button").parent("ul").fadeOut(300,0);
					 mCustomScrollbars();
					 new ajax.xhr.Request("../../RequestAjax/party_query.php","popt=1&pid="+$(this).parent(".button").parent("ul").attr("alt"),nothingdo,'POST');
					 new ajax.xhr.Request("../../RequestAjax/party_query.php","popt=6&pid="+$(this).parent(".button").parent("ul").attr("alt"),nothingdo,'POST');
				 }
			 }
			 
			 //alert($(this).attr("alt") + " / " + $(this).parent(".button").parent("ul").attr("alt"));
		 });
	 });
	 $("#invite-party-contents").mCustomScrollbar("vertical",400,"easeOutCirc",1.05,"auto","yes","no",10); 
}	// Invite Party Messages

//InvMList Load****************************************************************************************************************************************//
function reqfriend(){
	new ajax.xhr.Request("../../RequestAjax/friend_reqme.php","",friendreqme,'POST');
}
function friendreqme(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{			
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");				
				
				
				reqID = new Array();
				reqName = new Array();
				reqPic = new Array();
				reqTime = new Array();
				
				Num = data.NumberOfReq;
				
				if(Num!=0){
					for(i=0;i<Num;i++){
						reqID[i] = data.friendreq[i].reqme_id;
						reqName[i] = data.friendreq[i].reqme_name;
						reqPic[i] = data.friendreq[i].reqme_pic;						
						reqTime[i] = data.friendreq[i].reqme_time;
					}					
					FriendReqme_Show(Num, reqID, reqName, reqPic, reqTime);
				}
				else{
					$("#invite-member-contents > .ScrollBox > .container > .content").html("");
					$(".Tap > .invite-member > .ico_minvite > .number-member").css("display","none");
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

function FriendReqme_Show(a,b,c,d,e){	
	frText = "";
	$(".Tap > .invite-member > .ico_minvite > .number-member").html(a);
	if(a!=""){
		$(".Tap > .invite-member > .ico_minvite > .number-member").css("display","block");
		for(i=0;i<a;i++){
			frText += "<ul class=\"invitation\" alt=\""+b[i]+"\"><li class=\"pic\" style=\"cursor:pointer;\"><img src=\"../../"+d[i]+"38\" height=\"38\" width=\"38\" alt=\"\" class=\"pie\" /></li><li class=\"story\"><h1 style=\"cursor:pointer;\">"+c[i]+"</h1> 님으로부터 친구요청이 도착했습니다.</li><li class=\"time\">"+e[i].substr(0,10)+"</li><li class=\"button\"><img src=\"../images/party/Tap/ok.png\" alt=\"0\" /><img src=\"../images/party/Tap/cancel.png\" alt=\"1\" /></li></ul>";
		}
		$("#invite-member-contents > .ScrollBox > .container > .content").html(frText);
	}
	
	
	$.each($("#invite-member-contents ul"),function() {
		 
		 $(this).mouseenter(function() {
			 
			 $(this).css("background-color","#f5f5f5");
			 $(this).children(".button").css("display","block");
			 
		 });
		 
		 $(this).mouseleave(function() {
			 
			 $(this).css("background-color","#fff");
			 $(this).children(".button").css("display","none");
			 
		 });
		 
		  $(this).children(".pic").mousedown(function(){
			post_to_url('../../note/',{'mynoteid':$(this).parent(".invitation").attr("alt")});
		 });
		 $(this).children(".story").children("h1").mousedown(function(){
			post_to_url('../../note/',{'mynoteid':$(this).parent(".story").parnet(".invitation").attr("alt") });
		 });		 
		
	 });
	 
	 $.each($("#invite-member-contents ul"),function(){
		 $(this).children(".button").children("img").mousedown(function(){
			 if($(this).attr("alt")==1){
				if(confirm('친구신청을 거절하시겠습니까?')){
					$(this).parent(".button").parent("ul").css("background-color","#FF6F6F");
					$(this).parent(".button").parent("ul").fadeOut(300,0);
					mCustomScrollbars();
					new ajax.xhr.Request("../../RequestAjax/Friend_query.php","fopt=2&fid="+$(this).parent(".button").parent("ul").attr("alt"),nothingdo,'POST');	
				}
			 }
			 else{
				 if(confirm('친구신청을 수락하시겠습니까?')){
					 $(this).parent(".button").parent("ul").css("background-color","#A4FFA4");				 
					 $(this).parent(".button").parent("ul").fadeOut(300,0);
					 mCustomScrollbars();
					 new ajax.xhr.Request("../../RequestAjax/Friend_query.php","fopt=1&fid="+$(this).parent(".button").parent("ul").attr("alt"),nothingdo,'POST');			 
				 }
			 }			
			
		 });
	 });
	 $("#invite-member-contents").mCustomScrollbar("vertical",400,"easeOutCirc",1.05,"auto","yes","no",10); 
} // Invite Friend Request 

//alarm
function alarm(){
	new ajax.xhr.Request("../../RequestAjax/alarm_new.php","",alarmDisplay,'POST');
}

function alarmDisplay(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{			
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");			
				
				mname = new Array();
				mid = new Array();
				mpic = new Array();
				arID = new Array();
				from = new Array();
				fromid = new Array();
				read = new Array();
				type = new Array();
				time = new Array();
				alarm_id = new Array();
				

				Num = data.Num;
				joinnum = data.joinnum;
				menum = data.menum;
				
				if(menum){
					mpid = new Array();
					mpname = new Array();
					mppic = new Array();
					mpcon = new Array();
					for(i=0;i<menum;i++){
						mpid[i] = data.mejoin[i].partyid;
						mpname[i] = data.mejoin[i].partyname;
						mppic[i] = data.mejoin[i].partypic;
						mpcon[i] = data.mejoin[i].confirms;						
					}
					DisplayAlarm_first(menum, mpid, mpname, mppic, mpcon);
				}
				
				if(joinnum){
					pjid = new Array();
					pjname = new Array();
					pjcount = new Array();
					pjpic = new Array();
					for(i=0;i<joinnum;i++){
						pjid[i] = data.joinwant[i].party_id;
						pjname[i] = data.joinwant[i].party_name;
						pjcount[i] = data.joinwant[i].party_join;
						pjpic[i] = data.joinwant[i].party_pic;
					}
					DisplayAlarm_second(joinnum, pjid, pjname, pjcount, pjpic);
				}
				
				if(Num){
					for(i=0;i<Num;i++){
						mname[i] = data.alarm[i].mname;
						mid[i] = data.alarm[i].mid;
						mpic[i] = data.alarm[i].mpic;
						arID[i] = data.alarm[i].articleID;
						from[i] = data.alarm[i].from;
						fromid[i] = data.alarm[i].fromid;
						read[i] = data.alarm[i].read;
						type[i] = data.alarm[i].type;
						time[i] = data.alarm[i].time;
						alarm_id[i] = data.alarm[i].alarm_id;
					}
					DisplayAlarm(Num, mname, mid, mpic, arID, from, fromid, read, type, time, alarm_id);
				}
				else{					
					$("#alarm-message-contents > .ScrollBox > .container > .content").html("");
					$(".Tap > .alarm-message > .ico_alarm > .number-alarm").css("display","none");
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
var alarm_count = 0;	var alarmid="";
function DisplayAlarm_first(a,b,c,d,e){
	aText = "";
	for(i=0;i<a;i++){
		newDiv = document.createElement('ul');
		$(newDiv).css("cursor","pointer");
		$(newDiv).attr("class","invitation");
		$(newDiv).attr("alt",b[i]);
		if(e[i]==1){
			TT = "수락";
		}
		else{
			TT = "거절";
		}
		aText += "<li class=\"pic\" style=\"cursor:pointer;\"><img src=\"../../"+d[i]+"_s\" height=\"38\" width=\"38\" alt=\"\" class=\"pie\" /></li><li class=\"story\"><h1>"+c[i]+"</h1> 파티에 보낸 가입요청이 <h2>"+TT+"</h2> 되었습니다.</li><li class=\"time\" style=\"width:150px\">이 메시지는 자동 삭제됩니다</li><li class=\"time\"></li><li class=\"button\"><img src=\"../images/party/Tap/ok.png\" alt=\"0\" /><img src=\"../images/party/Tap/cancel.png\" alt=\"1\" /></li>";
		$(newDiv).html(aText);
		$("#alarm-message-contents > .ScrollBox > .container > .content").append(newDiv);
		aText = "";
	}
	$(".Tap > .alarm-message > .ico_alarm > .number-alarm").html(a);
	$(".Tap > .alarm-message > .ico_alarm > .number-alarm").css("display","block");
	
	$.each($("#alarm-message-contents ul"),function() {
		
		 $(this).mousedown(function() {	
			post_to_url('../../partyplay/',{'partyid':$(this).attr("alt") });			
		 });
	});
}


function DisplayAlarm_second(a,b,c,d,e){
	aText = "";
	for(i=0;i<a;i++){
		newDiv = document.createElement('ul');
		$(newDiv).css("cursor","pointer");
		$(newDiv).attr("class","invitation");
		$(newDiv).attr("alt",b[i]);
		aText += "<li class=\"pic\" style=\"cursor:pointer;\"><img src=\"../../"+e[i]+"_s\" height=\"38\" width=\"38\" alt=\"\" class=\"pie\" /></li><li class=\"story\"><h1>"+c[i]+"</h1> 파티에 새로운 가입요청이 <h2>"+d[i]+"</h2>개 있습니다.</li><li class=\"time\"></li><li class=\"button\"><img src=\"../images/party/Tap/ok.png\" alt=\"0\" /><img src=\"../images/party/Tap/cancel.png\" alt=\"1\" /></li>";
		$(newDiv).html(aText);
		$("#alarm-message-contents > .ScrollBox > .container > .content").append(newDiv);
		aText = "";
	}
	$(".Tap > .alarm-message > .ico_alarm > .number-alarm").html(Number($(".Tap > .alarm-message > .ico_alarm > .number-alarm").html())+Number(a));
	$(".Tap > .alarm-message > .ico_alarm > .number-alarm").css("display","block");
	
	$.each($("#alarm-message-contents ul"),function() {
		 
		 $(this).mouseenter(function() {
			 
			 $(this).css("background-color","#f5f5f5");
			// $(this).children(".button").css("display","block");			 
		 });
		 
		 $(this).mouseleave(function() {
			 
			 $(this).css("background-color","#fff");
			 $(this).children(".button").css("display","none");
			 
		 });
		
		 $(this).mousedown(function() {	
			post_to_url('../../partyplay/',{'partyid':$(this).attr("alt") });			
		 });
	});
	
}

function DisplayAlarm(a,b,c,d,e,f,g,h,k,j){
	aText = "";
	alarm_count = 0;	
	
	if(a!=0){		
		for(i=0;i<a;i++){			
			if(k[i]==0){//post
				fromtext = "글을 작성하였습니다.";
			}
			else{//comment
				fromtext = "댓글을 작성하였습니다.";
			}
			
			newDiv = document.createElement('ul');
			$(newDiv).css("cursor","pointer");
			$(newDiv).attr("class","invitation");
			$(newDiv).attr("alt",e[i]);
			
			aText += "<li class=\"pic\" alt=\""+c[i]+"\" style=\"cursor:pointer;\"><img src=\"../../"+d[i]+"38\" height=\"38\" width=\"38\" alt=\"\" class=\"pie\" /></li><li class=\"story\"><h1 style=\"cursor:pointer;\">"+b[i]+"</h1> 님이 <h2 style=\"cursor:pointer;\">"+f[i]+"</h2>에 "+fromtext+"</li><li class=\"time\">"+j[i].substr(0,10)+"</li><li class=\"button\"><img src=\"../images/party/Tap/ok.png\" alt=\"0\" /><img src=\"../images/party/Tap/cancel.png\" alt=\"1\" /></li>";			
			
			$(newDiv).html(aText);
			
			if(h[i]==0){
				if(alarm_count>0) alarmid += ",";
				alarmid += alarm_id[i];
				alarm_count++;
			}
			else{
				$(newDiv).css("background-color","#E1E1E1");
			}
			
			//MouseEvent
			$.each($(newDiv),function() {
				if(h[i]==0){
					 $(this).mouseenter(function() {
						 
						 $(this).css("background-color","#f5f5f5");
						// $(this).children(".button").css("display","block");			 
					 });
					 
					 $(this).mouseleave(function() {
						 
						 $(this).css("background-color","#fff");
						 $(this).children(".button").css("display","none");
						 
					 });
				}
				 $(this).mousedown(function() {
					 new ajax.xhr.Request("../../RequestAjax/Load_Alarm.php","articleID="+$(this).attr("alt"),loadedalarm,'POST');			 
					 tempnow = now;
					$("#wrapbox").addClass("changewrapBox");
					$("#fullscreen_bg").css("display","block");
					$("#win_alarm").css("display","block");
				 });
				 
				  $(this).children(".pic").mousedown(function(){
					post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});
				 });
				 $(this).children(".story").children("h1").mousedown(function(){
					 post_to_url('../../note/',{'mynoteid':$(this).parent(".story").siblings(".pic").attr("alt")});
				 });
				 $(this).children(".story").children("h1").mousedown(function(){
					//post_to_url('../../partyplay/',{'mynoteid':me[4], 'partyid': });
				 });
				
			 });
			
			$("#alarm-message-contents > .ScrollBox > .container > .content").append(newDiv);
			aText = "";
		}
		if(alarm_count){
			$(".Tap > .alarm-message > .ico_alarm > .number-alarm").css("display","block");
		}
		//$("#alarm-message-contents > .ScrollBox > .container > .content").html(aText);
		$(".Tap > .alarm-message > .ico_alarm > .number-alarm").html(Number($(".Tap > .alarm-message > .ico_alarm > .number-alarm").html())+Number(alarm_count));
	}	
	
	
	 /*$.each($("#alarm-message-contents ul"),function(){
		 $(this).children(".button").children("img").mousedown(function(){
			 if($(this).attr("alt")==1){
				if(confirm('친구신청을 거절하시겠습니까?')){
					$(this).parent(".button").parent("ul").css("background-color","#FF6F6F");
					$(this).parent(".button").parent("ul").fadeOut(300,0);
					mCustomScrollbars();
					new ajax.xhr.Request("../../RequestAjax/Friend_query.php","fopt=2&fid="+$(this).parent(".button").parent("ul").attr("alt"),nothingdo,'POST');	
				}
			 }
			 else{
				 if(confirm('친구신청을 수락하시겠습니까?')){
					 $(this).parent(".button").parent("ul").css("background-color","#A4FFA4");				 
					 $(this).parent(".button").parent("ul").fadeOut(300,0);
					 mCustomScrollbars();
					 new ajax.xhr.Request("../../RequestAjax/Friend_query.php","fopt=1&fid="+$(this).parent(".button").parent("ul").attr("alt"),nothingdo,'POST');			 
				 }
			 }			
			
		 });
	 });*/
	 $("#alarm-message-contents").mCustomScrollbar("vertical",400,"easeOutCirc",1.05,"auto","yes","no",10);
}	//alarm

function nothingdo(){
}

/* ************************* 04/08 ****************************** */

$(document).ready(function() {
   
	var kim_window_width = $(window).width();

	if ( kim_window_width < 1460 ) {

		$("#header > .Tap > .alarm-message > .win-alarm").css("left","-237px");		/*0504*/
		$("#header > .Tap > .invite-party > .win-party").css("left","-237px");
		$("#header > .Tap > .invite-member > .win-member").css("left","-237px");
		$("#header > .Tap > .setting > .win-setting").css("left","-78px");
		
	}
	
	$(window).resize(function() {
	  
	  var kim_window_width = $(window).width();

		if ( kim_window_width < 1460 ) {
			
			$("#header > .Tap > .alarm-message > .win-alarm").css("left","-237px");		/*0504*/
			$("#header > .Tap > .invite-party > .win-party").css("left","-237px");
			$("#header > .Tap > .invite-member > .win-member").css("left","-237px");
			$("#header > .Tap > .setting > .win-setting").css("left","-78px");
			
		} else {
			
			$("#header > .Tap > .alarm-message > .win-alarm").css("left","36px");		/*0504*/
			$("#header > .Tap > .invite-party > .win-party").css("left","36px");
			$("#header > .Tap > .invite-member > .win-member").css("left","36px");
			$("#header > .Tap > .setting > .win-setting").css("left","36px");
			
		}

	});
   
});



// 0422 ScrollTop!!!!!!!!


$(document).ready(function() {
    
	$("#ScrollTop").click(function() {
       
		$('html, body').animate({scrollTop:0},400)
		now=0;
		tempnow =0;
		
    });
	
}); // 0420 스크롤탑


/*0507*/

$(document).ready(function() {
	
	$("#container .board > .Rfield > .write > .buttons > .publicsetting > .button").mouseenter(function() {
        
		if($(this).hasClass("clicked")==false) {
		
			$(this).addClass("kims_public_button_over")
		
		}
		
    });
	
	$("#container .board > .Rfield > .write > .buttons > .publicsetting > .button").mouseleave(function() {
        
		if($(this).hasClass("clicked")==false) {
		
			$(this).removeClass("kims_public_button_over")
		
		}
		
    });
    
	$("#container .board > .Rfield > .write > .buttons > .publicsetting > .button").mousedown(function() {
        
		if($(this).hasClass("clicked")==false) {
			
			$(this).addClass("kims_public_button_down").addClass("clicked")
		}
		
		else {
		
			$(this).removeClass("kims_public_button_up").addClass("kims_public_button_down")
			$(this).removeClass("clicked")
		}
		
    });
	
	$("#container .board > .Rfield > .write > .buttons > .publicsetting > .button").mouseup(function() {
        
		if($(this).hasClass("clicked")==true) {
		
			$(this).removeClass("kims_public_button_down").addClass("kims_public_button_up");
			$("#container .board > .Rfield > .write > .buttons > .publicsetting > .menu").css("display","block");			
		
		}
		
		else {
			
			$(this).removeClass("kims_public_button_down");
			$("#container .board > .Rfield > .write > .buttons > .publicsetting > .menu").css("display","none");			
			
		}
		
    }); 
	
	// 공개설정 메뉴 open / close
	
	$("#container .board > .Rfield > .write > .buttons > .publicsetting > .menu > li:last").css("border","none").css("border-bottom-left-radius","5px").css("border-bottom-right-radius","5px") /* 아래 css 조절 */
	
	$("#container .board > .Rfield > .write > .buttons > .publicsetting > .menu > li").mouseup(function() {
		
		$(this).parent(".menu").find(".checked").children("img").attr("src","../images/board/nonechecked.png")		
		$(this).parent(".menu").find(".checked").removeClass("checked");
		
		$(this).children("img").attr("src","../images/board/checked.png");
		$(this).addClass("checked");
		$(this).parent(".menu").siblings(".button").attr("alt",$(this).attr("alt"));
		$(this).parent(".menu").siblings(".button").removeClass("kims_public_button_over");
		$(this).parent(".menu").siblings(".button").removeClass("clicked");
		$(this).parent(".menu").siblings(".button").removeClass("kims_public_button_up");
		$("#container .board > .Rfield > .write > .buttons > .publicsetting > .menu").css("display","none");
		if($(this).attr("alt")==0){
			$(this).parent(".menu").siblings(".button").html("<img src=\"../images/board/checked.png\" alt=\"\" />전체 공개");
		}
		else if($(this).attr("alt")==1){
			$(this).parent(".menu").siblings(".button").html("<img src=\"../images/board/checked.png\" alt=\"\" />친구 공개");
		}
		else{
			$(this).parent(".menu").siblings(".button").html("<img src=\"../images/board/checked.png\" alt=\"\" />멤버 공개");
		}		
	}); // 공개설정 메뉴 checked
	
});