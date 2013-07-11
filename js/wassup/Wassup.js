function kimsclub_nondis() {
	$("#container > .headline > .pop").css("display","none")
}

$(document).ready(function() {

		// nav-menu EVENT.
		
		var SDDw = $(".SDD-wassup"), SDDn = $(".SDD-note"), SDDp = $(".SDD-party");
		var navw = $(".nav-wassup"), 	navn = $(".nav-note"), 	navp = $(".nav-party"); 
		
		navn.mouseenter(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_noteov.png)")});
		navw.mouseenter(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_partyov.png)")});
		
		navn.mouseleave(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_note.png)")});
		navw.mouseleave(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_party.png)")});
		
		navn.mousedown(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_noteck.png)")});
		navw.mousedown(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_partyck.png)")});
		
		navn.mouseup(function() { 	SDDn.css("background-image","url(../images/party/Header/header_menu_noteov.png)")
													post_to_url('../../note/',{'mynoteid':me[4]});
												});
		navw.mouseup(function() { 	SDDw.css("background-image","url(../images/party/Header/header_menu_partyov.png)");
													post_to_url('../../party/',{'mynoteid':me[4]});
												});
												
		// 상단 좌측 프로필 이벤트
		
		$("#container > .headline > .namediv").mouseenter(function() {
			$(this).addClass("container_headline_namedivOV");
		});
		$("#container > .headline > .namediv").mouseleave(function() {
			$(this).removeClass("container_headline_namedivOV");
		});
		$("#container > .headline > .namediv").mousedown(function() {
			$(this).addClass("container_headline_namedivCK");
		});
		$("#container > .headline > .namediv").mouseup(function() {
			$(this).removeClass("container_headline_namedivCK");
			$("#container > .headline > .pop").css("display","block")
			
			if(typeof pageYOffset != 'undefined'){
				
					$("#container > .headline > .pop").fadeTo(600,1);
					
			}
			
		});
		
		$(document).click(function() {																	// pop > content밖을 클릭시 pop > content 사라짐
			
			if(typeof pageYOffset != 'undefined'){
				
					$("#container > .headline > .pop").fadeTo(300,0);
					setTimeout(kimsclub_nondis,500);
						
			}	else { 
			
					kimsclub_nondis();
			
			}
		
		});
		
		$("#container > .headline > .namediv").click(function(e) {			// namediv는 클릭해도 무 반응
			e.stopPropagation();
			return false;        	
		});
		
		$("#container > .headline > .pop > .content").click(function(e) {	// pop 의 content에도 클릭해도 무 반응
			e.stopPropagation();		// 이전 method 중지
			return false;        		// 내가 원하기전까지는 이 div에는 하지말아야한다?
		});
		
		// 상단 버튼 2개 이벤트
		
		$.each($("#container > .headline > .button > ul"),function() {

					$(this).mouseenter(function() {
						$(this).animate({top: "-10px"},{queue:false,duration:200});
					});
					
					$(this).mouseleave(function() {
						$(this).animate({top: "-5px"},{queue:false,duration:200});
					});
					
			
			if(typeof pageYOffset != 'undefined'){
			
					
					$(this).mousedown(function() {
						$(this).animate({top: "-5px"},{queue:false,duration:80});
					});
					
					$(this).mouseup(function() {
						$(this).animate({top: "-10px"},{queue:false,duration:80});
					});
					
			}
			
		});
		
		// friendlist 버튼 클릭시 이벤트
		$("#container > .headline > .button > .friendlist").mouseup(function(){
			post_to_url('../../note/',{'mynoteid':me[4], 'friend':1});			
		});
		
		
		// wholist 버튼 클릭시 이벤트
		
		var kimsclub_wholist_number = 0; // 0이면 아래로 내리는것 1이면 위로 올리는것
		
		$("#container > .headline > .button > .friensumer").mouseup(function() {
			
				if(typeof pageYOffset != 'undefined'){
							
							if (kimsclub_wholist_number == 0) {
									kimsclub_wholist_number = 2;
									$("#container > .wholist").slideDown(500).queue(function() {
										$("#container > .wholist > .innerDiv").fadeTo(700,1);
										$(this).dequeue();
									});
									setTimeout(kimsclub_wholist_numF1,1200);
									
									function kimsclub_wholist_numF1() {
											kimsclub_wholist_number = 1;
									}
							}
							
							if (kimsclub_wholist_number == 1) {
									kimsclub_wholist_number = 2;
									$("#container > .wholist > .innerDiv").fadeTo(400,0).queue(function() {
										$("#container > .wholist").slideUp(500)
										$(this).dequeue();
									});
									setTimeout(kimsclub_wholist_numF2,900);
									
									function kimsclub_wholist_numF2() {
											kimsclub_wholist_number = 0;
									}
							}
							
				}	else  {
					
					$("#container > .wholist").slideToggle(500)
					
				}
			
		});
    
});//before kim

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

//ini wassup info
function loadwassupinfo(){
	$("#container > .headline > .pic > img").attr("src","../../"+me[11]+"50");
	$("#container > .headline > .pic > img").css("cursor","pointer");
	$("#container > .headline > .pic > img").click(function(){
		post_to_url('../../note/',{'mynoteid':me[4]});
	});
	if(me[1]){ a = me[0]+"("+me[1]+")"; }else{ a = me[0]; }
	$("#container > .headline > .namediv > .name").html(a);
	$("#container > .headline > .pop > .content > .name").html(a);
	if(me[14]){ a = me[14]; }else{ a="등록된 대학이 없습니다"; }
	if(me[6]){ b = me[6]; }else{ b="생일을 등록하세요"; }
	$("#container > .headline > .pop > .content > .info").html(a + " / " + b);	
	if(me[17]){
		
	}
	else{
		if(me[9] < 2){
			$("#find_friend").css("display","block");
		}
		else{
			$("#find_friend").css("display","block");
			$("#find_friend").children(".header").css("display","none");
			$("#find_friend > .container").css("background-image","none");
		}
	}		
}	// ini wassup info

//Friend Ranking
function frkloading(){
	new ajax.xhr.Request("../../RequestAjax/friendranking.php","",loadfrk,'GET');
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
				}
				making_ranking(rank_name, rank_id, rank_pic, rank_score);
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
				frText += "<div class=\"card\"><div class=\"pic pie\" style=\"cursor:pointer;\" alt=\""+b[i]+"\"><img src=\"../../"+c[i]+"50\" alt=\"\" class=\"pie\" /></div><div class=\"name nanumbold\">"+a[i]+"</div></div>";
			}
		}
	}
	
	$(".wholist > .innerDiv > .right").html(frText);
	
	$.each($(".wholist > .innerDiv > .right > .card"),function(){
		$(this).children(".pic").mousedown(function(){			
			post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});
		});
				
	});
	fansumer_divalign();
}

function making_ranking_nothing(){	// If don't have friendranking data
	
}	//Friend Ranking

//LoadArticle
function LoadArticle(){	
	new ajax.xhr.Request("../../RequestAjax/article.php","whatsup="+me[4],loadedArticle,'POST');			
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
	scrapimg = "../../images/board/writeico.png";
	bdText = "";
	//ancount = 0;
	
	for(i=articlestart;i<articlelength;i++){
		
		changeTime(i);
		
		newDiv = document.createElement('DIV');
		$(newDiv).attr("class","posts");
		$(newDiv).attr("id","bc_"+i);		
		$(newDiv).attr("alt",ArticleID[i]);
		
		if(me[4]==2 || me[4]==1) accep=1;
		else accep=0;
		
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
		
		$(newDiv).attr("onmouseover","deleteonoff(0,this, "+accep+")");
		$(newDiv).attr("onmouseout","deleteonoff(1,this, "+accep+")");
		
		bdText += "<div class=\"header\"><div class=\"pic\" style=\"cursor:pointer;\" alt=\""+AuthorID[i]+"\"><img src=\"../../"+AuthorProfile[i]+"50\" alt=\"\" /></div><div class=\"info\"><div class=\"top\"><div class=\"writer\" style=\"cursor:pointer;\" alt=\""+AuthorID[i]+"\">"+Author[i]+"</div><div class=\"path\"><img src=\""+scrapimg+"\" alt=\"\" /></div><div class=\"place redcolor\" style=\"cursor:pointer;\" alt=\""+i+"\">"+afrom[i]+"</div><div class=\"time\">"+GesiTime[i]+"</div></div></div><div class=\"button\"><div class=\"delete\" onClick=\"deletequery(0, "+ArticleID[i]+", this);\">Delete</div><div class=\"scrap\"><p onClick=\"onoffscrap(this);\">Scrap</p><div class=\"scrapbox\"><div class=\"arrow\"></div><div class=\"whiteline1\"></div><div class=\"selectbox\" onClick=\"scraplistonoff(this);\"><div class=\"scrapselected\">"+me[0]+"님의 마이노트</div><div class=\"window\"><div class=\"board_scrapbox_window\"><div class=\"list\">"+me[0]+"님의 마이노트</div></div></div></div><div class=\"whiteline2\"></div><div class=\"contentbox\"><textarea placeholder=\"Add Caption ...\"></textarea></div><div class=\"whiteline3\"></div><div class=\"button\"><div class=\"Button2_red\" onClick=\"ScrapArticle("+ArticleID[i]+",this)\">Scrap It<div class=\"Button2_red_word\">Scrap It</div></div></div></div></div>				<div class=\"candy\" onClick=\"likequery("+ArticleID[i]+",this);\" alt=\""+LoveNum[i]+"\">"+voted+" Candy</div></div></div>";
		scrapimg = "../../images/board/writeico.png";
		//Container
		bdText += "<div class=\"container\">";
        
		//Container - Caption - Scrapper
		if(caption[i]){
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
				
		for(j=0;j<arrCommentShowLength[i];j++)		//댓글
		{			
			arrCommentID[j] = data.article[i].comment[j].rid;
			arrCommentMemID[j] = data.article[i].comment[j].mid;
			arrCommentName[j] = data.article[i].comment[j].name;
			arrCommentInfo[j] = data.article[i].comment[j].text;
			arrCommentTime[j] = (data.article[i].comment[j].time).substr(5,11);
			arrCommentProfile[j] = data.article[i].comment[j].profile;	
		}	  
		
		for(j=arrCommentShowLength[i];j>0;j--){
			if(arrCommentMemID[j-1]==me[4]) accep=1;
			else accep=0;
			
			bdText += " <div class=\"comments\" onMouseover=\"deleteonoff(2,this,"+accep+");\" onMouseOut=\"deleteonoff(3,this,"+accep+");\"><div class=\"pic\" style=\"cursor:pointer;\" alt=\""+arrCommentMemID[j-1]+"\"><img src=\"../../"+arrCommentProfile[j-1]+"38\" width=\"38\" height=\"38\" alt=\"\" class=\"pie\" /></div><div class=\"contents\"><div class=\"name\" style=\"cursor:pointer;\" alt=\""+arrCommentMemID[j-1]+"\">"+arrCommentName[j-1]+"</div><div class=\"time\">"+arrCommentTime[j-1]+"</div><div class=\"text\">"+arrCommentInfo[j-1]+"</div></div><div class=\"delete\" onClick=\"deletequery(1, "+arrCommentID[j-1]+", this);\"></div></div>";
		}
        
		//Close List && write                    
        bdText += "</div><div class=\"write\"><div class=\"pic\"><img src=\"../../"+me[11]+"38\" width=\"38\" height=\"38\" alt=\"\" class=\"pie\" /></div><div class=\"text pie\"><textarea placeholder=\"이 글에 댓글 달기 ...\" onKeyDown=\"writecomment(this);\"></textarea></div></div></div>";                       
							
		newDiv.innerHTML = bdText;           	
        document.getElementById('board_contents').appendChild(newDiv);
		autolink("autolinkdiv_"+i);
		bdText = "";
		
	}
		
	onClickListener_ETC();
	setSidePreview();
} //Load Article

//Preview Controller
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
	
}
var z=0; 
function gotobyScroll(obj){
	if($(obj).css("cursor")=="pointer"){
		$('html,body').animate({scrollTop: ($("#bc_"+$(obj).attr("alt")).offset().top-10)},'slow');	
	}
}

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
		if(now > 150){
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
		if(now > 150){
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
	//$("#a").html("now: "+now+"<br>Scroll: "+($("#bc_"+((PreviewNum*6)-1)).offset().top-700)+"<br>last: "+($("#bc_"+last).offset().top));
}); // Scrolling Event - Preview & ArticleMore


function facebook(){
	window.open('../../facebookapi/?setting=1','','toolbar=no,menubar=no,location=no,height=1,width=1');	
}



// 친구추천 :: myfansumer :: pop 열고닫기

$(document).ready(function() {

	$("#container > .wholist > .innerDiv > .left > .questionmark").mousedown(function() {    
	
		$(this).css("background-image","none").css("background-color","#dc5457").css("color","#fff").css("border","1px solid #CE0005")
	
	});
	$("#container > .wholist > .innerDiv > .left > .questionmark").mouseup(function() {
        
		$("#container > .wholist > .innerDiv > .left > .pop").css("display","block").css("opacity","1")
		
    });
	
	$("#container > .wholist > .innerDiv > .left > .pop > .content > .list > .white > .close").click(function() {
        
		$("#container > .wholist > .innerDiv > .left > .pop").fadeTo(500,0)
		
		setTimeout(pop_close,500);
		
		$("#container > .wholist > .innerDiv > .left > .questionmark").css("background-image","url(../../images/base/questionmarkbg.png)")
																				.css("background-color","inherit")
																				.css("color","#aaa")
																				.css("border","1px solid #e1e1e1")
																				.css("border-bottom-color","#c8c8c8")
		
    });
	
});

function pop_close() {
	
	$("#container > .wholist > .innerDiv > .left > .pop").css("display","none")
	
}

// 친구추천 :: myfansumer :: namepop 열고닫기

$(document).ready(function() {
    
		$("#container > .wholist > .innerDiv > .left > .content > .list > .white > .card > .pic").mouseenter(function() {
			
			$(this).children(".namepop").css("display","block")
			
		});
	
		$("#container > .wholist > .innerDiv > .left > .content > .list > .white > .card > .pic").mouseleave(function() {
			
			$(this).children(".namepop").css("display","none")
			
		});
	
});

// fansumer 첫번째, 여섯번째 css조절
function fansumer_divalign() {

	$("#container > .wholist > .innerDiv > .right > .card:first").css("border-bottom-left-radius","3px").css("border-top-left-radius","3px")
	$("#container > .wholist > .innerDiv > .right > .card:eq(5)").css("border-top-right-radius","3px").css("border-bottom-right-radius","3px").css("width","129px").css("border-right","none")
	
}