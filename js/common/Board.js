//before
var sc_o;		//scrap p div - onClick=\"onoffscrap(this);\"    //selectbox div - onClick=\"scraplistonoff(this);\"	//origin div - onClick=\"onofforiginal(this);\"

// 스크랩클릭시 스크랩창 띄우기
function onoffscrap(obj){	
	if($(obj).siblings(".scrapbox").css("visibility")=="visible"){
		$(obj).siblings(".scrapbox").css("visibility","hidden");			
	}
	else{
		if($(sc_o).css("visibility")=="visible"){
			sc_o.css("visibility","hidden");				
		}			
		$(obj).siblings(".scrapbox").css("visibility","visible");
		sc_o = $(obj).siblings(".scrapbox");
	}
}
// 스크랩창안에 스크랩박스 클릭시 선택목록띄우기
function scraplistonoff(obj){
	$(obj).children(".window").css("display","block");
	new ajax.xhr.Request("../../RequestAjax/Scrap_MyParty.php","",loadedmyparty,'POST');
}

function ScrapArticle(a,obj){
	toid = $(obj).parent(".button").siblings(".selectbox").children(".scrapselected").attr("alt");
	if(toid==0 || !toid){
		toid = me[4];
		new ajax.xhr.Request("../../write.php","opt=7&oopt=1&origin_article="+a+"&toid="+toid+"&content="+$(obj).parent(".button").siblings(".contentbox").children("textarea").val(),nothingdo,'POST');	
		alert('스크랩이 완료되었습니다');
		$(obj).parent(".button").siblings(".contentbox").children("textarea").val("");
		$(sc_o).css("visibility","hidden");
	}
	else{
		new ajax.xhr.Request("../../write.php","opt=7&oopt=2&origin_article="+a+"&toid="+toid+"&content="+$(obj).parent(".button").siblings(".contentbox").children("textarea").val(),nothingdo,'POST');	
		alert('스크랩이 완료되었습니다');
		$(obj).parent(".button").siblings(".contentbox").children("textarea").val("");
		$(sc_o).css("visibility","hidden");
	}
}

// 게시판안에서 open the original ... 클릭시 원문 띄우기
var origin_obj;
function onofforiginal(obj){	
	origin_obj = obj;
	new ajax.xhr.Request("../../RequestAjax/Board_origin_auth.php","articleID="+$(obj).attr("alt"),checkoriginauth,'POST');
}
function checkoriginauth(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{			
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");				
				
				aauth = data.Auth;				
				if(aauth==1){
					new ajax.xhr.Request("../../RequestAjax/Board_LoadOrigin.php","articleID="+$(origin_obj).attr("alt"),loadedorigin,'POST');
					tempnow = now;	
					$("#wrapbox").addClass("changewrapBox");
					$("#fullscreen_bg").css("display","block");
					$("#win_board_original").css("display","block");
				}
				else{
					alert('해당 글을 볼 수 있는 권한이 없습니다');
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

function onClickListener_ETC() {    
	
		
	// 게시판에서 프로필사진 클릭시 노트이동
	$.each($("#board_contents"),function(){
		//저자 이름
		$(this).children(".posts").children(".header").children(".info").children(".top").children(".writer").mousedown(function(){
			post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});
		});
		//저자 사진
		$(this).children(".posts").children(".header").children(".pic").mousedown(function(){
			post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});
		});
		
		//댓글 이름
		$(this).children(".posts").children(".comment").children(".list").children(".comments").children(".contents").children(".name").mousedown(function(){
			post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});
		});
		//댓글 사진
		$(this).children(".posts").children(".comment").children(".list").children(".comments").children(".pic").mousedown(function(){
			post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});
		});
		
	});
	
	// 출처 클릭시 해당 파티로 이동
	$.each($("#board_contents > .posts > .header > .info > .top > .place"),function(){
		$(this).mousedown(function(){
			if(isparty[$(this).attr("alt")]==0){
				post_to_url('../../note/',{'mynoteid':belongID[$(this).attr("alt")]});
			}
			else{							
				post_to_url('../../partyplay/',{'mynoteid':me[4]/*AuthorID[$(this).attr("alt")]*/,'partyid':belongID[$(this).attr("alt")]});
			}
		});
	});
}	//before

//alarm article load
function loadedalarm(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{			
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");				

				n = data.NumberOfArticle;				

				/*o_LoveMemName[i] = new Array();
				o_LoveMemName[i] = new Array();
				o_LoveMemName = new Array();*/
				if(n){					
					o_Author = data.article[0].author; //글쓴이
					o_AuthorID = data.article[0].authorID;	//글쓴이ID
					o_AuthorProfile = data.article[0].authorProfile; //글쓴이Pic
					o_arrCommentLength = data.article[0].NumberOfComment; //코멘트수
					o_GesiTime = (data.article[0].time).substr(5,11); //글쓴시간
					o_GesiInfo = data.article[0].content;	//글쓴내용
					o_ArticleID = data.article[0].articleID;	//글ID					
					o_isVote = data.article[0].vote;	//투표여부
					o_LoveNum = data.article[0].likenum;	//좋은수
					o_afrom = data.article[0].belong;	//출처
					o_aPic = data.article[0].apic;	//글Pic
					o_scrapperID = data.article[0].scrapID;	//스크랩ID
					o_scrapperName = data.article[0].scrapName;	//스크랩name
					o_scrapperPic = data.article[0].scrapPic;	//스크랩Pic
					o_isparty = data.article[0].isparty;	//파티인가
					o_belongID = data.article[0].belongID;	//출처정보
					o_belongAdmin = data.article[0].belongAdmin;	//파티admin
					o_notice = data.article[0].notice;		//공지		
					o_caption = data.article[0].caption;
					o_scrapnum = data.article[0].ScrapNum;
					
						/*if(LoveNum[i] > 10){LoveLength[i] = 10;} else{ LoveLength[i]=LoveNum[i]}
						ShowLoveNum[i] = LoveLength[i];
						for(j=0;j<LoveLength[i];j++)
						{
							LoveMemName[i][j] = data.article[i].like[j].name;						
							LoveMemID[i][j] = data.article[i].like[j].id;
							LoveMemProfile[i][j] = data.article[i].like[j].profile;
						}			*/						
					MakeAlarm();					
				}
				else{
					alert('삭제된 글입니다');
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

function MakeAlarm(){			
	if(o_scrapperID){
		scrapimg="../../images/board/scrapico.png";
	}
	else{
		scrapimg = "../../images/board/writeico.png";
	}
	
	if(o_isVote){
		voted="-";
	}
	else{
		voted="+";
	}

	orText = "";	
	orText += "<div class=\"posts\" alt=\""+o_ArticleID+"\"><div class=\"header\"><div class=\"pic\" style=\"cursor:pointer;\" alt=\""+o_AuthorID+"\"><img src=\"../../"+o_AuthorProfile+"\" alt=\"\" /></div><div class=\"info\"><div class=\"top\"><div class=\"writer\" style=\"cursor:pointer;\" alt=\""+o_AuthorID+"\">"+o_Author+"</div><div class=\"path\"><img src=\""+scrapimg+"\" alt=\"\" /></div><div class=\"place redcolor\" style=\"cursor:pointer;\">"+o_afrom+"</div><div class=\"time\">"+o_GesiTime+"</div></div></div><div class=\"button\"><div class=\"delete\">Delete</div><div class=\"scrap\"><p>Scrap</p><div class=\"scrapbox\"><div class=\"arrow\"></div><div class=\"whiteline1\"></div><div class=\"selectbox\"><div class=\"scrapselected\">"+me[0]+" 님의 마이노트</div><div class=\"window\"><div class=\"board_scrapbox_window\"><div class=\"list\"></div></div></div></div><div class=\"whiteline2\"></div><div class=\"contentbox\"><textarea placeholder=\"Add Caption ...\"></textarea></div><div class=\"whiteline3\"></div><div class=\"button\"><div class=\"Button2_red\" onClick=\"ScrapArticle("+o_ArticleID+",this)\">Scrap It<div class=\"Button2_red_word\">Scrap It</div></div></div></div></div><div class=\"candy\" onClick=\"likequery("+o_ArticleID+",this);\" alt=\""+o_LoveNum+"\">"+voted+" Candy</div></div></div><div class=\"container\">";
	scrapimg = "../../images/board/writeico.png";

	if(o_caption!=""){	
		orText += "<div class=\"caption\">"+o_caption+"</div>";
	}
	
	orText += "<div class=\"text\">";
	
	if(o_notice!=0){
		orText += "<div class=\"title\">공지글입니다!!</div>";
	}
	orText += "<div id=\"autolinkdiv_alarm\" class=\"contents\">"+o_GesiInfo+"</div></div>";
	
	if(o_aPic!=""){
        orText += "<div class=\"pic\"><div class=\"noneframe\"><img src=\"../../"+o_aPic+"\" alt=\"\" /></div></div>";
	}

	orText += "<div class=\"info\"><div class=\"comment\">+ "+o_arrCommentLength+" Comments</div><div class=\"candy\">+ "+o_LoveNum+" Candys</div><div class=\"scrap\">+ "+o_scrapnum+" Scraps</div></div></div>";
	
	    
    orText += "<div class=\"comment\">";
	
	if(o_arrCommentLength > 10){ o_arrCommentShowLength=3; }else{ o_arrCommentShowLength = o_arrCommentLength; }
	
	if(o_arrCommentLength > 10 && o_arrCommentLength <= 50){
		orText += "<div class=\"allview\" alt=\""+i+"\" style=\"cursor:pointer;\" onClick=\"CommentMore(this,2);\">+ All "+(o_arrCommentLength-3)+" Comments ...</div>";
	}
	else if(o_arrCommentLength > 50){
		orText += "<div class=\"moreview\" alt=\""+i+"\" style=\"cursor:pointer;\" onClick=\"CommentMore(this,6);\">+ 50 Comments ...</div>";
	}
	
	orText += "<div class=\"list\">";
	
	
	for(j=0;o_arrCommentShowLength>j;j++)		//댓글
	{				
		o_arrCommentID[j] = data.article[0].comment[j].rid;
		o_arrCommentMemID[j] = data.article[0].comment[j].mid;
		o_arrCommentName[j] = data.article[0].comment[j].name;
		o_arrCommentInfo[j] = data.article[0].comment[j].text;
		o_arrCommentTime[j] = (data.article[0].comment[j].time).substr(5,11);
		o_arrCommentProfile[j] = data.article[0].comment[j].profile;	
	}
	for(i=o_arrCommentShowLength-1;i>=0;i--){
		if(o_arrCommentMemID[i]==me[4]) accep=1;
		else accep=0;
		
		orText += "<div class=\"comments\" onMouseover=\"deleteonoff(2,this,"+accep+");\" onMouseOut=\"deleteonoff(3,this,"+accep+")\"><div class=\"pic\" style=\"cursor:pointer;\" alt=\""+o_arrCommentMemID[i]+"\"><img src=\"../../"+o_arrCommentProfile[i]+"\" width=\"38\" height=\"38\" alt=\"\" class=\"pie\" /></div><div class=\"contents\"><div class=\"name\" style=\"cursor:pointer;\" alt=\""+o_arrCommentMemID[i]+"\">"+o_arrCommentName[i]+"</div><div class=\"time\">"+o_arrCommentTime[i]+"</div><div class=\"text\">"+o_arrCommentInfo[i]+"</div></div><div class=\"delete\" onClick=\"deletequery(1,"+o_arrCommentID[i]+",this)\"></div></div>";
	}
               
                
	orText += "</div><div class=\"write\"><div class=\"pic\"><img src=\"../../"+me[11]+"\" width=\"38\" height=\"38\" alt=\"\" class=\"pie\" /></div><div class=\"text pie\"><textarea placeholder=\"이 글에 댓글 달기 ...\" onKeyDown=\"writecomment(this);\" alt=\""+i+"\"></textarea></div></div></div></div>";

		$("#win_alarm").html(orText);
		autolink("autolinkdiv_alarm");
		// WIN_BOARD_ORGINAL 에서 스크랩클릭시 
	
	// 스크랩클릭시 스크랩창 띄우기
	
	$.each($("#win_alarm > .posts > .header > .button > .scrap"),function() {
		$(this).children("p").mouseup(function() {
			if($(this).siblings(".scrapbox").css("visibility")=="visible"){
				$(this).siblings(".scrapbox").css("visibility","hidden");
			}
			else{
				if($(sc_o).css("visibility")=="visible"){
					sc_o.css("visibility","hidden");
				}
				$(this).siblings(".scrapbox").css("visibility","visible");
				sc_o = $(this).siblings(".scrapbox");
			}			
		});
	});
	
	// 스크랩창안에 스크랩박스 클릭시 선택목록띄우기
	
	$.each($("#win_alarm > .posts > .header > .button > .scrap > .scrapbox > .selectbox"),function() {
		$(this).mouseup(function() {
			$(this).children(".window").css("display","block");
			new ajax.xhr.Request("../../RequestAjax/Scrap_MyParty.php","",loadedmyparty,'POST');
		});
	});	
	
	// origin window안에 마이노트전환
	
	//작성자 이름
	$.each($("#win_alarm > .posts > .header > .info > .top > .writer"),function(){
		$(this).mousedown(function(){
			post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});		
		});
	});
	//작성자사진
	$.each($("#win_alarm > .posts > .header > .pic"),function(){
		$(this).mousedown(function(){
			post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});		
		});	
	});
	//코멘트사진
	$.each($("#win_alarm > .posts > .comment > .list > .comments > .pic"),function(){
		$(this).mousedown(function(){
			post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});		
		});	
	});
	//코멘트이름
	$.each($("#win_alarm > .posts > .comment > .list > .comments > .contents > .name"),function(){
		$(this).mousedown(function(){
			post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});		
		});	
	});
	
	//출처
	$.each($("#win_alarm > .posts > .header > .info > .top > .place"),function(){
		$(this).mousedown(function(){
			if(o_isparty==0){
				post_to_url('../../note/',{'mynoteid':o_belongID });
			}
			else{
				post_to_url('../../partyplay/',{'mynoteid':me[4]/*o_AuthorID*/, 'partyid':o_belongID});
			}
		});
	});
	
}	//alarm article load	//alarm article load

//origin article load
function loadedorigin(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{			
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");				
								
				n = data.NumberOfArticle;				

				/*o_LoveMemName[i] = new Array();
				o_LoveMemName[i] = new Array();
				o_LoveMemName = new Array();*/
				n = data.NumberOfArticle;
				if(n){					
					o_Author = data.article[0].author; //글쓴이
					o_AuthorID = data.article[0].authorID;	//글쓴이ID
					o_AuthorProfile = data.article[0].authorProfile; //글쓴이Pic
					o_arrCommentLength = data.article[0].NumberOfComment; //코멘트수
					o_GesiTime = (data.article[0].time).substr(5,11); //글쓴시간
					o_GesiInfo = data.article[0].content;	//글쓴내용
					o_ArticleID = data.article[0].articleID;	//글ID					
					o_isVote = data.article[0].vote;	//투표여부
					o_LoveNum = data.article[0].likenum;	//좋은수
					o_afrom = data.article[0].belong;	//출처
					o_aPic = data.article[0].apic;	//글Pic
					o_scrapperID = data.article[0].scrapID;	//스크랩ID
					o_scrapperName = data.article[0].scrapName;	//스크랩name
					o_scrapperPic = data.article[0].scrapPic;	//스크랩Pic
					o_isparty = data.article[0].isparty;	//파티인가
					o_belongID = data.article[0].belongID;	//출처정보
					o_belongAdmin = data.article[0].belongAdmin;	//파티admin
					o_notice = data.article[0].notice;		//공지		
					o_caption = data.article[0].caption;
					o_scrapnum = data.article[0].ScrapNum;
					
						/*if(LoveNum[i] > 10){LoveLength[i] = 10;} else{ LoveLength[i]=LoveNum[i]}
						ShowLoveNum[i] = LoveLength[i];
						for(j=0;j<LoveLength[i];j++)
						{
							LoveMemName[i][j] = data.article[i].like[j].name;						
							LoveMemID[i][j] = data.article[i].like[j].id;
							LoveMemProfile[i][j] = data.article[i].like[j].profile;
						}			*/						
					MakeOrigin();					
				}
				else{
					alert('삭제된 글입니다');
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

function MakeOrigin(){		
	if(o_isVote){
		voted="-";
	}
	else{
		voted="+";
	}
	orText = "";
	orText += "<div class=\"posts\" alt=\""+o_ArticleID+"\"><div class=\"header\"><div class=\"pic\" style=\"cursor:pointer;\" alt=\""+o_AuthorID+"\"><img src=\"../../"+o_AuthorProfile+"\" alt=\"\" /></div><div class=\"info\"><div class=\"top\"><div class=\"writer\" style=\"cursor:pointer;\" alt=\""+o_AuthorID+"\">"+o_Author+"</div><div class=\"path\"><img src=\"../images/board/writeico.png\" alt=\"\" /></div><div class=\"place redcolor\" style=\"cursor:pointer;\">"+o_afrom+"</div><div class=\"time\">"+o_GesiTime+"</div></div></div><div class=\"button\"><div class=\"delete\">Delete</div><div class=\"scrap\"><p>Scrap</p><div class=\"scrapbox\"><div class=\"arrow\"></div><div class=\"whiteline1\"></div><div class=\"selectbox\"><div class=\"scrapselected\">"+me[0]+" 님의 마이노트</div><div class=\"window\"><div class=\"board_scrapbox_window\"><div class=\"list\"></div></div></div></div><div class=\"whiteline2\"></div><div class=\"contentbox\"><textarea placeholder=\"Add Caption ...\"></textarea></div><div class=\"whiteline3\"></div><div class=\"button\"><div class=\"Button2_red\" onClick=\"ScrapArticle("+o_ArticleID+",this)\">Scrap It<div class=\"Button2_red_word\">Scrap It</div></div></div></div></div><div class=\"candy\" onClick=\"likequery("+o_ArticleID+",this);\" alt=\""+o_LoveNum+"\">"+voted+" Candy</div></div></div><div class=\"container\">";
		
	if(o_caption!=""){	
		orText += "<div class=\"caption\">"+o_caption+"</div>";
	}
	
	orText += "<div class=\"text\">";
	
	if(o_notice!=0){
		orText += "<div class=\"title\">공지글입니다!!</div>";
	}
	orText += "<div id=\"autolinkdiv_origin\" class=\"contents\">"+o_GesiInfo+"</div></div>";
	
	if(o_aPic!=""){
        orText += "<div class=\"pic\"><div class=\"noneframe\"><img src=\"../../"+o_aPic+"\" alt=\"\" /></div></div>";
	}
	
	
	orText += "<div class=\"info\"><div class=\"comment\">+ "+o_arrCommentLength+" Comments</div><div class=\"candy\">+ "+o_LoveNum+" Candys</div><div class=\"scrap\">+ "+o_scrapnum+" Scraps</div></div></div>";
	
	    
    orText += "<div class=\"comment\">";
	
	if(o_arrCommentLength > 10){ o_arrCommentShowLength=3; }else{ o_arrCommentShowLength = o_arrCommentLength; }
	
	if(o_arrCommentLength > 10 && o_arrCommentLength <= 50){
		orText += "<div class=\"allview\" alt=\""+i+"\" style=\"cursor:pointer;\" onClick=\"CommentMore(this,2);\">+ All "+(o_arrCommentLength-3)+" Comments ...</div>";
	}
	else if(o_arrCommentLength > 50){
		orText += "<div class=\"moreview\" alt=\""+i+"\" style=\"cursor:pointer;\" onClick=\"CommentMore(this,6);\">+ 50 Comments ...</div>";
	}
	
	orText += "<div class=\"list\">";
	
	
	for(j=0;o_arrCommentShowLength>j;j++)		//댓글
	{				
		o_arrCommentID[j] = data.article[0].comment[j].rid;
		o_arrCommentMemID[j] = data.article[0].comment[j].mid;
		o_arrCommentName[j] = data.article[0].comment[j].name;
		o_arrCommentInfo[j] = data.article[0].comment[j].text;
		o_arrCommentTime[j] = (data.article[0].comment[j].time).substr(5,11);
		o_arrCommentProfile[j] = data.article[0].comment[j].profile;	
	}
	for(i=o_arrCommentShowLength-1;i>=0;i--){
		if(o_arrCommentMemID[i]==me[4]) accep=1;
		else accep=0;
		
		orText += "<div class=\"comments\" onMouseover=\"deleteonoff(2,this,"+accep+");\" onMouseOut=\"deleteonoff(3,this,"+accep+")\"><div class=\"pic\" style=\"cursor:pointer;\" alt=\""+o_arrCommentMemID[i]+"\"><img src=\"../../"+o_arrCommentProfile[i]+"\" width=\"38\" height=\"38\" alt=\"\" class=\"pie\" /></div><div class=\"contents\"><div class=\"name\" style=\"cursor:pointer;\" alt=\""+o_arrCommentMemID[i]+"\">"+o_arrCommentName[i]+"</div><div class=\"time\">"+o_arrCommentTime[i]+"</div><div class=\"text\">"+o_arrCommentInfo[i]+"</div></div><div class=\"delete\" onClick=\"deletequery(1,"+o_arrCommentID[i]+",this)\"></div></div>";
	}
               
                
	orText += "</div><div class=\"write\"><div class=\"pic\"><img src=\"../../"+me[11]+"\" width=\"38\" height=\"38\" alt=\"\" class=\"pie\" /></div><div class=\"text pie\"><textarea placeholder=\"이 글에 댓글 달기 ...\" onKeyDown=\"writecomment(this);\" alt=\""+i+"\"></textarea></div></div></div></div>";
	
	
		$("#win_board_original").html(orText);
		autolink("autolinkdiv_origin");
		// WIN_BOARD_ORGINAL 에서 스크랩클릭시 
	
	// 스크랩클릭시 스크랩창 띄우기
	
	$.each($("#win_board_original > .posts > .header > .button > .scrap"),function() {
		$(this).children("p").mouseup(function() {
			if($(this).siblings(".scrapbox").css("visibility")=="visible"){
				$(this).siblings(".scrapbox").css("visibility","hidden");
			}
			else{
				if($(sc_o).css("visibility")=="visible"){
					sc_o.css("visibility","hidden");
				}
				$(this).siblings(".scrapbox").css("visibility","visible");
				sc_o = $(this).siblings(".scrapbox");
			}			
		});
	});
	
	// 스크랩창안에 스크랩박스 클릭시 선택목록띄우기
	
	$.each($("#win_board_original > .posts > .header > .button > .scrap > .scrapbox > .selectbox"),function() {
		$(this).mouseup(function() {
			$(this).children(".window").css("display","block");
			new ajax.xhr.Request("../../RequestAjax/Scrap_MyParty.php","",loadedmyparty,'POST');
		});
	});	
	
	// origin window안에 마이노트전환
	
	//작성자 이름
	$.each($("#win_board_original > .posts > .header > .info > .top > .writer"),function(){
		$(this).mousedown(function(){
			post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});		
		});
	});
	//작성자사진
	$.each($("#win_board_original > .posts > .header > .pic"),function(){
		$(this).mousedown(function(){
			post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});		
		});	
	});
	//코멘트사진
	$.each($("#win_board_original > .posts > .comment > .list > .comments > .pic"),function(){
		$(this).mousedown(function(){
			post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});		
		});	
	});
	//코멘트이름
	$.each($("#win_board_original > .posts > .comment > .list > .comments > .contents > .name"),function(){
		$(this).mousedown(function(){
			post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});		
		});	
	});
	
	//출처
	$.each($("#win_board_original > .posts > .header > .info > .top > .place"),function(){
		$(this).mousedown(function(){
			if(o_isparty==0){
				post_to_url('../../note/',{'mynoteid':o_belongID });
			}
			else{
				post_to_url('../../partyplay/',{'mynoteid':me[4]/*o_AuthorID*/, 'partyid':o_belongID});
			}
		});
	});
	
}	//origin article load

//Scrap List Click
function loadedmyparty(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{			
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");				
				
				Num = data.NumberOfParty;
				mpid = new Array();
				mpname = new Array();
				
				if(Num){
					for(i=0;i<Num;i++){						
						mpid[i] = data.Party[i].pid;
						mpname[i] = data.Party[i].pname;									
					}					
				}				
				MakeScrapList(Num,mpid,mpname);				
				
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

function MakeScrapList(a,b,c){
	scText = "<div class=\"list\" alt=\"0\">"+me[0]+" 님의 마이노트</div>";
	sc_o.children(".selectbox").children(".window").children(".board_scrapbox_window").html("");	
	if(!a){ // No Party List
		
	}
	else{
		for(i=0;i<a;i++){			
			scText += "<div class=\"list\" alt=\""+b[i]+"\">"+c[i]+"</div>";
		}
		sc_o.children(".selectbox").children(".window").children(".board_scrapbox_window").html(scText);
	}
	//board scrap window click
	$.each($("#container .board > .Rfield > .contents > .posts > .header > .button > .scrap > .scrapbox > .selectbox > .window > .board_scrapbox_window"),function() {
		$(this).children(".list").mouseenter(function(){
			$(this).css("background-color","#D7D7D7");
		});
		$(this).children(".list").mouseleave(function(){
			$(this).css("background-color","#fff");
		});
		$(this).children(".list").mousedown(function(){
			$(this).parent(".board_scrapbox_window").parent(".window").parent(".selectbox").children(".scrapselected").text($(this).html());			
			$(this).parent(".board_scrapbox_window").parent(".window").parent(".selectbox").children(".scrapselected").attr("alt",$(this).attr("alt"));
			$(this).parent(".board_scrapbox_window").parent(".window").css("display","none");	
		});
	});
	//origin scrap window click
	$.each($("#win_board_original > .posts > .header > .button > .scrap > .scrapbox > .selectbox > .window > .board_scrapbox_window"),function() {
		$(this).children(".list").mouseenter(function(){
			$(this).css("background-color","#D7D7D7");
		});
		$(this).children(".list").mouseleave(function(){
			$(this).css("background-color","#fff");
		});
		$(this).children(".list").mousedown(function(){
			$(this).parent(".board_scrapbox_window").parent(".window").parent(".selectbox").children(".scrapselected").text($(this).html());
			$(this).parent(".board_scrapbox_window").parent(".window").parent(".selectbox").children(".scrapselected").attr("alt",$(this).attr("alt"));
			$(this).parent(".board_scrapbox_window").parent(".window").css("display","none");
		});		
	});
	//win anounce scrap window click
	$.each($("#win_anounce_original > .posts > .header > .button > .scrap > .scrapbox > .selectbox > .window > .board_scrapbox_window"),function() {
		$(this).children(".list").mouseenter(function(){
			$(this).css("background-color","#D7D7D7");
		});
		$(this).children(".list").mouseleave(function(){
			$(this).css("background-color","#fff");
		});
		$(this).children(".list").mousedown(function(){
			$(this).parent(".board_scrapbox_window").parent(".window").parent(".selectbox").children(".scrapselected").text($(this).html());
			$(this).parent(".board_scrapbox_window").parent(".window").parent(".selectbox").children(".scrapselected").attr("alt",$(this).attr("alt"));
			$(this).parent(".board_scrapbox_window").parent(".window").css("display","none");
		});		
	});
	//anounce scrap window click
	$.each($("#info_anouncepage > .contents > .container > .post > .title > .skill >.scrap > .scrapbox > .selectbox > .window > .board_scrapbox_window"),function() {
		$(this).children(".list").mouseenter(function(){
			$(this).css("background-color","#D7D7D7");
		});
		$(this).children(".list").mouseleave(function(){
			$(this).css("background-color","#fff");
		});
		$(this).children(".list").mousedown(function(){
			$(this).parent(".board_scrapbox_window").parent(".window").parent(".selectbox").children(".scrapselected").text($(this).html());
			$(this).parent(".board_scrapbox_window").parent(".window").parent(".selectbox").children(".scrapselected").attr("alt",$(this).attr("alt"));
			$(this).parent(".board_scrapbox_window").parent(".window").css("display","none");
		});		
	});
	
	//alarm scrap window click
	$.each($("#win_alarm > .posts > .header > .button > .scrap > .scrapbox > .selectbox > .window > .board_scrapbox_window"),function() {
		$(this).children(".list").mouseenter(function(){
			$(this).css("background-color","#D7D7D7");
		});
		$(this).children(".list").mouseleave(function(){
			$(this).css("background-color","#fff");
		});
		$(this).children(".list").mousedown(function(){
			$(this).parent(".board_scrapbox_window").parent(".window").parent(".selectbox").children(".scrapselected").text($(this).html());
			$(this).parent(".board_scrapbox_window").parent(".window").parent(".selectbox").children(".scrapselected").attr("alt",$(this).attr("alt"));
			$(this).parent(".board_scrapbox_window").parent(".window").css("display","none");
		});		
	});
	
}	//Scrap List Click

//write Article
function writeArticle(){
	PreviewNum = 1;
	$(".Lfield > .preview > .controll > .white > .midposition > .num").html("01");
	if($(".Rfield > .write > .contents > .mid > textarea").val()==""){
		alert('내용을 입력하세요');
		$(".Rfield > .write > .contents > .mid > textarea").focus();
	}
	else{
		if(note==1){
			if($('.cameraspace > .photopart > .photo > .photo1 > .img > img').attr('alt')==''){				
				new ajax.xhr.Request("../../write.php","opt=1&toid="+user[4]+"&content="+$(".Rfield > .write > .contents > .mid > textarea").val()+"&aopen="+$("#container .board > .Rfield > .write > .buttons > .publicsetting > .button").attr("alt"),writedarticle,'POST');
			}
			else{
				new ajax.xhr.Request("../../write.php","opt=1&toid="+user[4]+"&content="+$(".Rfield > .write > .contents > .mid > textarea").val()+"&pic="+$('.cameraspace > .photopart > .photo > .photo1 > .img > img').attr('alt')+"&aopen="+$("#container .board > .Rfield > .write > .buttons > .publicsetting > .button").attr("alt"),writedarticle,'POST');				
			}
		}
		else{			
			if($('.Rfield > .write > .buttons > .anounce > img').attr("alt")==""){	//공지글 아님
				if($('.cameraspace > .photopart > .photo > .photo1 > .img > img').attr('alt')==''){
					new ajax.xhr.Request("../../write.php","opt=2&toid="+partyid+"&content="+$(".Rfield > .write > .contents > .mid > textarea").val()+"&aopen="+$("#container .board > .Rfield > .write > .buttons > .publicsetting > .button").attr("alt"),writedarticle,'POST');
				}
				else{
					new ajax.xhr.Request("../../write.php","opt=2&toid="+partyid+"&content="+$(".Rfield > .write > .contents > .mid > textarea").val()+"&pic="+$('.cameraspace > .photopart > .photo > .photo1 > .img > img').attr('alt')+"&aopen="+$("#container .board > .Rfield > .write > .buttons > .publicsetting > .button").attr("alt"),writedarticle,'POST');
				}
			}
			else{	//공지글
				if($('.cameraspace > .photopart > .photo > .photo1 > .img > img').attr('alt')==''){
					new ajax.xhr.Request("../../write.php","opt=2&notice=1&toid="+partyid+"&content="+$(".Rfield > .write > .contents > .mid > textarea").val()+"&title="+$(".Rfield > .write > .title > .mid > input").val()+"&aopen="+$("#container .board > .Rfield > .write > .buttons > .publicsetting > .button").attr("alt"),writedarticle,'POST');
				}
				else{
					new ajax.xhr.Request("../../write.php","opt=2&notice=1&toid="+partyid+"&content="+$(".Rfield > .write > .contents > .mid > textarea").val()+"&title="+$(".Rfield > .write > .title > .mid > input").val()+"&pic="+$('.cameraspace > .photopart > .photo > .photo1 > .img > img').attr('alt')+"&aopen="+$("#container .board > .Rfield > .write > .buttons > .publicsetting > .button").attr("alt"),writedarticle,'POST');
				}
			}
		}		
	}
	$("#container .board > .Rfield > .write > .buttons > .publicsetting > .button").html("<img src=\"../images/board/public.png\" height=\"12\" alt=\"\" />공개 설정");
	$("#container .board > .Rfield > .write > .buttons > .publicsetting > .button").attr("alt","0");
	$("#container .board > .Rfield > .write > .buttons > .publicsetting > .menu > li:first > img").attr("src","../../../images/board/checked.png");
	$("#container .board > .Rfield > .write > .buttons > .publicsetting > .menu > li:first").attr("class","checked");
	$("#container .board > .Rfield > .write > .buttons > .publicsetting > .menu > li:last > img").attr("src","../../../images/board/nonechecked.png");
	$("#container .board > .Rfield > .write > .buttons > .publicsetting > .menu > li:last").attr("class","");
	$("#container .board > .Rfield > .write > .buttons > .publicsetting > .menu").css("display","none");
	$("#container .board > .Rfield > .write > .buttons > .publicsetting > .button").removeClass("kims_public_button_up");
	$("#container .board > .Rfield > .write > .buttons > .publicsetting > .button").removeClass("kims_public_button_over");
	$("#container .board > .Rfield > .write > .buttons > .publicsetting > .button").removeClass("clicked");
	
}	
function writedarticle(req){
	$('.Rfield > .write > .buttons > .anounce > img').attr("alt","");
	$('.Rfield > .write > .buttons > .anounce > img').attr("src","../../images/board/button_anounce.png");
	$(".Rfield > .write > .title").css("display","none");
	$(".Rfield > .write > .title > .mid > input").val("");
	$('.cameraspace > .photopart > .photo > .photo1 > .img > img').attr('alt','');
	$('.cameraspace > .photopart > .photo > .photo1 > .img > img').attr('src','');
	$('.cameraspace').css('display','none');
	articlestart=0;
	articlelength=0;
	$(".Rfield > .write > .contents > .mid > textarea").val("");	
	$('.Rfield > .write > .buttons > .camera > img').attr("src","../../images/board/button_camera.png");
	$('.Rfield > .write > .buttons > .camera > img').attr("alt","");
	$('.cameraspace > .photopart > .photo > .photo1 > .close').css('display','none');
	$("#board_contents").html("");
	//$(".Rfield > .write > .contents > .mid > textarea").focus();
	tempnow = now;
	setTimeout("LoadArticle()",100);
	setTimeout("$(document).scrollTop(tempnow)",110);
} //write Article

// Comment More
var objj;
function CommentMore(obj,ind){	
	if(ind==1){	//전체보기
		objj = obj;
		$(obj).attr("class","list");
		$(obj).html("");
		$(obj).css("cursor","default");
		new ajax.xhr.Request("../../RequestAjax/Board_Comment.php","cases=1&opt=1&articleID="+ArticleID[$(obj).attr("alt")],loadedComments,'POST');
		
	}
	else if(ind==2){	//스크랩글원본 윈도우 댓글 전체보기
		objj = obj;
		$(obj).attr("class","list");
		$(obj).html("");
		$(obj).css("cursor","default");
		new ajax.xhr.Request("../../RequestAjax/Board_Comment.php","cases=2&opt=1&articleID="+o_ArticleID,loadedComments,'POST');		
		
	}
	else if(ind==3){	//공지글목록 댓글 전체보기	
		objj = obj;
		$(obj).attr("class","list");
		$(obj).css("cursor","default");
		$(obj).html("");
		new ajax.xhr.Request("../../RequestAjax/Board_Comment.php","cases=3&opt=1&articleID="+n_ArticleID[$(obj).attr("alt")],loadedComments,'POST');
	}
	else if(ind==4){ //공지글 윈도우 댓글 전체보기
		objj = obj;
		$(obj).attr("class","list");
		$(obj).css("cursor","default");
		$(obj).html("");		
		new ajax.xhr.Request("../../RequestAjax/Board_Comment.php","cases=4&opt=1&articleID="+$(obj).attr("alt"),loadedComments,'POST');
		
	}
	else if(ind==5){	//MoreView
		objj = obj;
		if(arrCommentShowLength[$(objj).attr("alt")]==3){
			c_st_ind = 0;
		}
		else{
			c_st_ind = arrCommentShowLength[$(objj).attr("alt")];
		}

		new ajax.xhr.Request("../../RequestAjax/Board_Comment.php","cases=1&opt=2&articleID="+ArticleID[$(obj).attr("alt")]+"&startindex="+c_st_ind,loadedMoreComments,'POST');
	}
	else if(ind==6){	//MoreView 스크랩글 원본 윈도우
		objj = obj;
		if(o_arrCommentShowLength==3){
			c_st_ind = 0;
		}
		else{
			c_st_ind = o_arrCommentShowLength;
		}
		
		new ajax.xhr.Request("../../RequestAjax/Board_Comment.php","cases=2&opt=2&articleID="+o_ArticleID+"&startindex="+c_st_ind,loadedMoreComments,'POST');
	}
	else if(ind==7){	//공지글목록 MoreView
		objj = obj;
		if(n_arrCommentShowLength[$(objj).attr("alt")]==3){
			c_st_ind = 0;
		}
		else{
			c_st_ind = n_arrCommentShowLength[$(objj).attr("alt")];
		}
		new ajax.xhr.Request("../../RequestAjax/Board_Comment.php","cases=3&opt=2&articleID="+ArticleID[$(objj).attr("alt")]+"&startindex="+c_st_ind,loadedMoreComments,'POST');
	}
	else if(ind==8){
		objj = obj;
		if(n_arrCommentShowLength[0]==3){
			c_st_ind=0;
		}
		else{
			c_st_ind=n_arrCommentShowLength[0];
		}
		new ajax.xhr.Request("../../RequestAjax/Board_Comment.php","cases=4&opt=2&articleID="+$(objj).attr("alt")+"&startindex="+c_st_ind,loadedMoreComments,'POST');
	}
}

function loadedMoreComments(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{		
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {		
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");
				
				num = data.NumberOfComment;				
				st = data.ST;
				ed = data.ED;
				cases = data.cases;
				$(objj).html("");
				
				for(j=ed;j>st;j--)		//댓글
				{							
					arrCommentID[j-1] = data.comment[j-1].rid;
					arrCommentMemID[j-1] = data.comment[j-1].mid;
					arrCommentName[j-1] = data.comment[j-1].name;
					arrCommentInfo[j-1] = data.comment[j-1].text;
					arrCommentTime[j-1] = (data.comment[j-1].time).substr(5,11);
					arrCommentProfile[j-1] = data.comment[j-1].profile;	
					newDiv = document.createElement('DIV');
					$(newDiv).attr("class","comments");
					
					if(arrCommentMemID[j-1]==me[4]) accep=1;
					else accep=0;					
					
					$(newDiv).attr("onmouseover","deleteonoff(2,this, "+accep+")");
					$(newDiv).attr("onmouseout","deleteonoff(3,this, "+accep+")");
					
					$(newDiv).html("<div class=\"pic\" style=\"cursor:pointer;\" alt=\""+arrCommentMemID[j-1]+"\"><img src=\"../../"+arrCommentProfile[j-1]+"38\" width=\"38\" height=\"38\" alt=\"\" class=\"pie\" /></div><div class=\"contents\"><div class=\"name\" style=\"cursor:pointer;\" alt=\""+arrCommentMemID[j-1]+"\">"+arrCommentName[j-1]+"</div><div class=\"time\">"+arrCommentTime[j-1]+"</div><div class=\"text\">"+arrCommentInfo[j-1]+"</div></div><div class=\"delete\" onClick=\"deletequery(1, "+arrCommentID[j-1]+", this);\"></div>");
					
					$(objj).append(newDiv);					
					
				}
				if(cases==1){
					arrCommentShowLength[$(objj).attr("alt")] = ed;
				}
				else if(cases==2){
					o_arrCommentShowLength = ed;
				}
				else if(cases==3){
					n_arrCommentShowLength[$(objj).attr("alt")] = ed;
				}
				else if(cases==4){
					n_arrCommentShowLength[0] = ed;
				}
				
				$(objj).siblings(".list").html($(objj).html()+$(objj).siblings(".list").html());
				
				if((num-ed) > 50){ 
					$(objj).html("+ 50 Comments...");
				}else{
					$(objj).attr("class","allview");	
					$(objj).attr("onClick","CommentMore(this,"+cases+");");
					$(objj).html("+ All " + (num-ed) + " Comments...");
				}
				
				onClickListener_ETC();
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


function loadedComments(req){	
	if(req.readyState==4)
	{
		if(req.status == 200)
		{		
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {		
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");
				
				num = data.NumberOfComment;
				cases = data.cases;	
				if(cases==1){
					ed = arrCommentShowLength[$(objj).attr("alt")];	
				}
				else if(cases==2){
					ed = o_arrCommentShowLength;
				}
				else if(cases==3){
					ed = n_arrCommentShowLength[$(objj).attr("alt")];
				}
				else if(cases==4){
					ed = n_arrCommentShowLength[0];
				}
				
				for(j=num;j>ed;j--)		//댓글
				{							
					arrCommentID[j-1] = data.comment[j-1].rid;
					arrCommentMemID[j-1] = data.comment[j-1].mid;
					arrCommentName[j-1] = data.comment[j-1].name;
					arrCommentInfo[j-1] = data.comment[j-1].text;
					arrCommentTime[j-1] = (data.comment[j-1].time).substr(5,11);
					arrCommentProfile[j-1] = data.comment[j-1].profile;	
					newDiv = document.createElement('DIV');
					$(newDiv).attr("class","comments");
					
					if(arrCommentMemID[j-1]==me[4]) accep=1;
					else accep=0;					
					
					$(newDiv).attr("onmouseover","deleteonoff(2,this, "+accep+")");
					$(newDiv).attr("onmouseout","deleteonoff(3,this, "+accep+")");
					
					$(newDiv).html("<div class=\"pic\" style=\"cursor:pointer;\" alt=\""+arrCommentMemID[j-1]+"\"><img src=\"../../"+arrCommentProfile[j-1]+"38\" width=\"38\" height=\"38\" alt=\"\" class=\"pie\" /></div><div class=\"contents\"><div class=\"name\" style=\"cursor:pointer;\" alt=\""+arrCommentMemID[j-1]+"\">"+arrCommentName[j-1]+"</div><div class=\"time\">"+arrCommentTime[j-1]+"</div><div class=\"text\">"+arrCommentInfo[j-1]+"</div></div><div class=\"delete\" onClick=\"deletequery(1, "+arrCommentID[j-1]+", this);\"></div>");
					$(objj).append(newDiv);					
					
				}
				arrCommentShowLength[$(objj).attr("alt")] = num;
				$(objj).siblings(".list").html($(objj).html()+$(objj).siblings(".list").html());
				$(objj).remove(".list");
				
				onClickListener_ETC();
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
}	//Comment More

//write comment ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
var commentextarea;
//textarea alt=i ??
function writecomment_anounce(txt){	//공지글 따로
	commentextarea = txt;
	if(event.keyCode==13){
		if($(txt).val()==""){
			alert('댓글 내용을 입력하세요');
			$(txt).val("");
			$(txt).focus();
		}		
		else{					
			new ajax.xhr.Request("../../write.php","opt=3&toid="+$(txt).parent(".text").parent(".write").parent(".comment").parent(".contents").parent(".post").attr("alt")+"&content="+$(txt).val(),writedcomment($(txt).parent(".text").parent(".write").parent(".comment").parent(".contents").parent(".post").attr("alt")),'POST');					
		}		
	}	
}

function writecomment_win_anounce(txt){	//공지글 윈도우
	commentextarea = txt;
	if(event.keyCode==13){
		if($(txt).val()==""){
			alert('댓글 내용을 입력하세요');
			$(txt).val("");
			$(txt).focus();
		}		
		else{					
			new ajax.xhr.Request("../../write.php","opt=3&toid="+$(txt).parent(".text").parent(".write").parent(".comment").parent(".contents").parent(".container").attr("alt")+"&content="+$(txt).val(),writedcomment($(txt).parent(".text").parent(".write").parent(".comment").parent(".contents").parent(".container").attr("alt")),'POST');					
		}		
	}	
}


function writecomment(txt){	
	commentextarea = txt;
	if(event.keyCode==13){
		if($(txt).val()==""){
			alert('댓글 내용을 입력하세요');
			$(txt).val("");
			$(txt).focus();
		}		
		else{					
			new ajax.xhr.Request("../../write.php","opt=3&toid="+$(txt).parent(".text").parent(".write").parent(".comment").parent(".posts").attr("alt")+"&content="+$(txt).val(),writedcomment($(txt).parent(".text").parent(".write").parent(".comment").parent(".posts").attr("alt")),'POST');					
		}		
	}	
}

function writedcomment(param){	
	$(commentextarea).val("");
	$(commentextarea).focus();
	setTimeout("ajaxreadcomment("+param+");",100);
}
function ajaxreadcomment(param){	
	new ajax.xhr.Request("../../RequestAjax/Board_Comment.php","cases=1&opt=1&articleID="+param,displaywritedcomment,'POST');
}
function displaywritedcomment(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{			
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");		
				
					cID = data.comment[0].rid;
					cMemID = data.comment[0].mid;
					cName = data.comment[0].name;
					cInfo = data.comment[0].text;
					cTime = (data.comment[0].time).substr(5,11);
					cProfile = data.comment[0].profile;	
					newDiv = document.createElement('DIV');
					$(newDiv).attr("class","comments");
					
					if(cMemID==me[4]) accep=1;
					else accep=0;
		
					$(newDiv).attr("onmouseover","deleteonoff(2,this, "+accep+")");
					$(newDiv).attr("onmouseout","deleteonoff(3,this, "+accep+")");
					
					
					$(newDiv).html("<div class=\"pic\" style=\"cursor:pointer;\" alt=\""+cMemID+"\"><img src=\"../../"+cProfile+"38\" width=\"38\" height=\"38\" alt=\"\" class=\"pie\" /></div><div class=\"contents\"><div class=\"name\" style=\"cursor:pointer;\" alt=\""+cMemID+"\">"+cName+"</div><div class=\"time\">"+cTime+"</div><div class=\"text\">"+cInfo+"</div></div><div class=\"delete\" onClick=\"deletequery(1,"+cID+",this);\"></div>");
					$(commentextarea).parent(".text").parent(".write").siblings(".list").append(newDiv);
				
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
} //write comment

//delete onoff
function deleteonoff(ind, obj, accep){
	if(note==1){	//Note
		if(ind==0){
			if(accep == 1){
				$(obj).children(".header").children(".button").children(".delete").css("display","block");
			}
		}
		else if(ind==1){
			$(obj).children(".header").children(".button").children(".delete").css("display","none");
		}
		else if(ind==2){	//comment over
			if(accep==1){
				$(obj).children(".delete").css("display","block");
			}
		}
		else if(ind==3){	//comment out
			$(obj).children(".delete").css("display","none");
		}
	}
	else if(note=2){	//Partyplay
		if(ind==0){				//post over
			if(accep == 1 || $(".partyadmin_position").css("display")=="block"){				
				$(obj).children(".header").children(".button").children(".delete").css("display","block");
			}
		}
		else if(ind==1){	//post out
			$(obj).children(".header").children(".button").children(".delete").css("display","none");
		}
		else if(ind==2){	//comment over
			if(accep==1 || $(".partyadmin_position").css("display")=="block"){
				$(obj).children(".delete").css("display","block");
			}
		}
		else if(ind==3){	//comment out
			$(obj).children(".delete").css("display","none");
		}
	}
	else if(note==3){	//wassup
		if(ind==2){	//comment over
			if(accep==1){
				$(obj).children(".delete").css("display","block");
			}
		}
		else if(ind==3){	//comment out
			$(obj).children(".delete").css("display","none");
		}
	}
}	//delete onoff

//delete query
function deletequery(typ, ind, obj){
	if(typ==0){	//글
		if(confirm('정말 삭제하시겠습니까?')){
			$(obj).parent(".button").parent(".header").parent(".posts").remove(".posts");
			new ajax.xhr.Request("../../write.php","opt=4&toid="+ind,nothingdo,'POST');
		}
		else{
			
		}
	}
	else{	//댓글
		if(confirm('정말 삭제하시겠습니까?')){						
			$(obj).parent(".comments").remove(".comments");			
			new ajax.xhr.Request("../../write.php","opt=5&toid="+ind,nothingdo,'POST');
		}
		else{
			
		}
	}
		
}

//like query
function likequery(ind, obj){
	num = Number($(obj).attr("alt"));
	new ajax.xhr.Request("../../like_query.php","aid="+ind,nothingdo,'POST');
	if($(obj).html()=="+ Candy"){
		$(obj).html("- Candy");	
		$(obj).parent(".button").parent(".header").siblings(".container").children(".info").children(".candy").html("+ "+Number(num+1)+" Candys");
		$(obj).attr("alt",Number(num)+1);
		
	}
	else{
		$(obj).html("+ Candy");
		$(obj).parent(".button").parent(".header").siblings(".container").children(".info").children(".candy").html("+ "+Number(num-1)+" Candys");
		$(obj).attr("alt",Number(num)-1);
		
	}
}	//like query