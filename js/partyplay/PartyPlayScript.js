var partynoticeauth = 0;	var permis=0;
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

//Party Load Init**************************************************************************************************************************************************//
function Upartyload(){	
	new ajax.xhr.Request("../../RequestAjax/visit_query.php","pid="+partyid,nothingdo,'POST');
	partypre_func();
} // Party Load

//PartyInfo Load init**************************************************************************************************************************************************//
function LoadPartyInfo(){	
	new ajax.xhr.Request("../../RequestAjax/Party_Information.php","req_party="+partyid,present_party_info,'POST');
}
function present_party_info(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{			
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");				
				
				Since = data.Since;
				AdminID = data.AdminID;
				AdminName = data.AdminName;
				AdminPic = data.AdminPic;
				PPic = data.PPic;
				widey = data.widey;
				pname = data.pname;
				joined = data.joined;
				partynoticeauth = data.pn;
				publik = data.p_public;
				permis = data.p_permission;
				Present_Party_Information(Since, AdminID, AdminName, AdminPic, PPic, widey, joined, pname, publik);
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

function Present_Party_Information(a,b,c,d,e,f,g,h,i){	

	if(g!=0){
		$("#container > .party > .title > .Button_red").css("display","none");
		$(".Rfield > .write > .contents > .mid > textarea").attr("placeholder","포스트 작성하기 ...");
		$(".Rfield > .write > .contents > .mid > textarea").removeAttr("disabled");		
//		$("#container > .party > .info_area > .pic > .party_title > .join").removeClass("before_click");
//		$("#container > .party > .info_area > .pic > .party_title > .join").addClass("Button_red_9pt_selected");
		$("#container > .party > .info_area > .pic > .party_title > .join").html("파티 탈퇴하기");		
		$("#container > .party > .info_area > .pic > .basepic > .invite_friend").css("display","block");
		$("#container > .party > .info_area > .pic > .basepic > .invite_friend").delay(500).animate({bottom:'15px',opacity:'1'},500);
		notjoined=0;
	}
	else{
		if(pj!=0){
			$("#container > .party > .title > .Button_red").css("display","none");			
			$("#container > .party > .info_area > .pic > .party_title > .join").removeClass("before_click");
			$("#container > .party > .info_area > .pic > .party_title > .join").addClass("Button_red_9pt_selected");
			$("#container > .party > .info_area > .pic > .party_title > .join").html("가입 요청 보냄");
			$(".Rfield > .write > .contents > .mid > textarea").attr("placeholder","파티에 가입하시면 글을 작성할 수 있습니다 ...");
			$(".Rfield > .write > .contents > .mid > textarea").attr("disabled","false");		
		}
		else{
			$("#container > .party > .title > .Button_red").css("display","block");
			$(".Rfield > .write > .contents > .mid > textarea").attr("placeholder","파티에 가입하시면 글을 작성할 수 있습니다 ...");
			$(".Rfield > .write > .contents > .mid > textarea").attr("disabled","false");				
		}
		notjoined=1;
	}
	$(".partyssier").attr("alt",b);
	$(".party_name > h1").html("");
	$(".partyssier > h1").html(c);
	$(".party_name > h1").html(h);
	$(".since > h1").html(a.substr(0,10));
	$("#box").css("background-image","url(../../"+e+")");
	$("#box").css("margin-top","-"+f+"px");
	$("#box").css("height",(252+user[13])+"px");
	/*
	$("#box").css("background-image","url(../../"+e+")");
	$("#box").css("margin-top","-"+f+"px");
	$("#box").css("height",(560+user[13])+"px");*/
	
	if(i==0){
		$("#partyadminpage > .power > .contents > .container > .show > .container > .button > .on").addClass("selected");
		$("#partyadminpage > .power > .contents > .container > .show > .container > .button > .on").siblings(".off").removeClass("selected");
		$("#partyadminpage > .power > .contents > .container > .show > .container > .button > .on").parent(".button").siblings(".explain").children(".off").removeClass("selected");
		$("#partyadminpage > .power > .contents > .container > .show > .container > .button > .on").parent(".button").siblings(".explain").children(".on").addClass("selected");
		$("#partyadminpage > .power > .contents > .container > .allow").css("display","block");		
	}
	else{
		$("#partyadminpage > .power > .contents > .container > .show > .container > .button > .off").addClass("selected");
		$("#partyadminpage > .power > .contents > .container > .show > .container > .button > .off").siblings(".on").removeClass("selected");
		$("#partyadminpage > .power > .contents > .container > .show > .container > .button > .off").parent(".button").siblings(".explain").children(".on").removeClass("selected");
		$("#partyadminpage > .power > .contents > .container > .show > .container > .button > .off").parent(".button").siblings(".explain").children(".off").addClass("selected");
		$("#partyadminpage > .power > .contents > .container > .allow").css("display","none");
	}
	
	if(me[4] == b){
		$(".basepic > .setting").css("display","block");		
	}
	else{
		$(".basepic > .setting").css("display","none");
	}
	new ajax.xhr.Request("../../RequestAjax/Party_MemberList.php","req_party="+partyid,present_party_mem,'POST');
}
function present_party_mem(req){
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
				MNum = data.MemberNum;
				for(i=0;i<MNum;i++){
					FID[i] = data.Member[i].Fid;
					FNAME[i] = data.Member[i].Fname;
					FPIC[i] = data.Member[i].Fpic;
				}
				Present_Party_Member(MNum, FID, FNAME, FPIC);
						
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

function Present_Party_Member(a,b,c,d){
	$(".member > h1").html(a);

	for(i=0;i<11;i++){
		if(b[i]){
			newImg = document.createElement('IMG');
			newImg.setAttribute("src","../../"+d[i]+"38");
			newImg.setAttribute("width","38");
			newImg.setAttribute("height","38");
			
			$(newImg).attr("alt",b[i]);
			$("#Party_Members_"+i).attr("alt","1");		
			$("#Party_Members_"+i).attr("class","pic pie have");
			document.getElementById('Party_Members_'+i).appendChild(newImg);
			$("#Party_Members_"+i+" > .name_position").children(".name").text(c[i]);		
		}
		else{			
			$("#Party_Members_"+i).attr("alt","0");
			$("#Party_Members_"+i).attr("class","pic pie");
			$("#Party_Members_"+i+" > .name_position").children(".name").text("");
		}		
		
	}
	
	// info member name EVENT
	 
	 $.each($("#container .party .info > .contents > .member > .contents"),function(){
		 $(this).children(".pic").mousedown(function(){
			 if($(this).css("cursor")=="pointer"){	
				post_to_url('../../note/',{'mynoteid':$(this).children("img").attr("alt")});
			 }
		 });
	 });
	 
	 $.each($("#container .party .info > .contents > .member > .contents"),function() {
		 $(this).children(".have").mouseenter(function() {			 
			 if($(this).attr("alt")==1){
			 	$(this).children(".name_position").css("display","block");
			 }
		 });
		 $(this).children(".have").mouseleave(function() {
			 $(this).children(".name_position").css("display","none");
		 });
	 });
} // Partyinfo load

//Popsumer
function Popsumer(){
	new ajax.xhr.Request("../../RequestAjax/Party_popsumer.php","pid="+partyid,displaypop,'POST');	
}
function displaypop(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{		
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {				
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");
			
				manid = data.manid;
				if(manid){
					manname = data.manname;
					manpic = data.manpic;
					manvote = data.manvote;
					$(".info_area > .info > .contents > .popularpeople > .contents > .male > .nonexist").css("display","none");
					$(".info_area > .info > .contents > .popularpeople > .contents > .male > .exist > .pic > img").attr("src","../../"+manpic);
					$(".info_area > .info > .contents > .popularpeople > .contents > .male > .exist > .pic > img").attr("onclick","post_to_url('../../note/',{'mynoteid':"+manid+"});");
					$(".info_area > .info > .contents > .popularpeople > .contents > .male > .exist > .pic > .nametext > .name").html(manname);
					$(".info_area > .info > .contents > .popularpeople > .contents > .male > .exist > .score").html("<img src=\"../images/party/Container/heart.png\" alt=\"\"/>"+manvote);
				}
				else{
					$(".info_area > .info > .contents > .popularpeople > .contents > .male > .nonexist").css("display","block");
				}
				womanid = data.womanid;
				if(womanid){
					womanname = data.womanname;
					womanpic = data.womanpic;
					womanvote = data.womanvote;
					$(".info_area > .info > .contents > .popularpeople > .contents > .female > .nonexist").css("display","none");
					$(".info_area > .info > .contents > .popularpeople > .contents > .female > .exist > .pic > img").attr("src","../../"+womanpic);
					$(".info_area > .info > .contents > .popularpeople > .contents > .female > .exist > .pic > img").attr("onclick","post_to_url('../../note/',{'mynoteid':"+womanid+"});");
					$(".info_area > .info > .contents > .popularpeople > .contents > .female > .exist > .pic > .nametext > .name").html(womanname);
					$(".info_area > .info > .contents > .popularpeople > .contents > .female > .exist > .score").html("<img src=\"../images/party/Container/heart.png\" alt=\"\"/>"+womanvote);
				}
				else{
					$(".info_area > .info > .contents > .popularpeople > .contents > .female > .nonexist").css("display","block");
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
} //popsumer

//LoadArticle**************************************************************************************************************************************************//
function LoadArticle(){
	new ajax.xhr.Request("../../RequestAjax/article.php","partyid="+partyid,loadedArticle,'POST');	
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
				$('#P_Ar_Num').html(numArticle);
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
						/*if(LoveNum[i] > 10){LoveLength[i] = 10;} else{ LoveLength[i]=LoveNum[i]}
						ShowLoveNum[i] = LoveLength[i];
						for(j=0;j<LoveLength[i];j++)
						{
							LoveMemName[i][j] = data.article[i].like[j].name;						
							LoveMemID[i][j] = data.article[i].like[j].id;
							LoveMemProfile[i][j] = data.article[i].like[j].profile;
						}	*/
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
	
	if(reset_Article==1){
		$("#board_contents").html("<div class=\"nonepost\" style=\"display:none;\"><img src=\"../images/basic/board/noneboard.png\"></div>");
		reset_Article=0;
	}
	$(".nonepost").css("display","block");
	for(i=0;i<6;i++){
		//$("#pre_card"+i).html("");	
		$("#pre_card"+i).parent(".pic").parent(".white").parent(".cards").css("cursor","default");					

		$("#pre_card"+i).parent(".pic").parent(".white").parent(".cards").addClass("nonecards");
		$("#pre_card"+i).parent(".pic").css("display","none");							
		$("#pre_card"+i).parent(".pic").parent(".white").parent(".cards").attr("alt","");		
		$("#pre_card"+(i%6)).parent(".pic").siblings(".text").children("a").html("");
	}		
	$("#anounce_contents > .exist").css("display","none");
	$("#anounce_contents > .nonexist").css("display","block");	
	
}


var randapic_count=1;
var nonotice=0;
function MakeArticle(){	
	//$(".preview").css("display","block");
	$(".nonepost").css("display","none");
	scrapimg = "../../images/board/writeico.png";
	bdText = "";
	//ancount = 0;
	if(reset_Article==1){
		$("#board_contents").html("");
		reset_Article=0;
	}
	
	for(i=articlestart;i<articlelength;i++){
		changeTime(i);
		newDiv = document.createElement('DIV');
		$(newDiv).attr("class","posts");
		$(newDiv).attr("id","bc_"+i);		
		$(newDiv).attr("alt",ArticleID[i]);
		
		if(AuthorID[i]==me[4] || me[4]==2 || me[4]==1) accep=1;
		else accep=0;
		
		if(isVote[i]){
			voted="-";
		}
		else{
			voted="+";
		}
		
		$(newDiv).attr("onmouseover","deleteonoff(0,this, "+accep+")");
		$(newDiv).attr("onmouseout","deleteonoff(1,this, "+accep+")");
		// Header
		if(scrapperID[i]){
			scrapimg="../../images/board/scrapico.png";
		}
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
				
		for(j=0;j<arrCommentShowLength[i];j++)	//댓글
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
			
			bdText += " <div class=\"comments\" onMouseover=\"deleteonoff(2,this,"+accep+");\" onMouseOut=\"deleteonoff(3,this,"+accep+")\"><div class=\"pic\" style=\"cursor:pointer;\" alt=\""+arrCommentMemID[j-1]+"\"><img src=\"../../"+arrCommentProfile[j-1]+"38\" width=\"38\" height=\"38\" alt=\"\" class=\"pie\" /></div><div class=\"contents\"><div class=\"name\" style=\"cursor:pointer;\" alt=\""+arrCommentMemID[j-1]+"\">"+arrCommentName[j-1]+"</div><div class=\"time\">"+arrCommentTime[j-1]+"</div><div class=\"text\">"+arrCommentInfo[j-1]+"</div></div><div class=\"delete\" onClick=\"deletequery(1,"+arrCommentID[j-1]+", this);\"></div></div>";
		}
        
		//Close List && write                    
        bdText += "</div><div class=\"write\"><div class=\"pic\"><img src=\"../../"+me[11]+"38\" width=\"38\" height=\"38\" alt=\"\" class=\"pie\" /></div><div class=\"text pie\"><textarea placeholder=\"이 글에 댓글 달기 ...\" onKeyDown=\"writecomment(this);\" alt=\""+i+"\"></textarea></div></div></div>";                       
							
		newDiv.innerHTML = bdText;           	
        document.getElementById('board_contents').appendChild(newDiv);
		autolink("autolinkdiv_"+i);
		bdText = "";                  
	}
	M_Notice();
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
}


function M_Notice(){
	new ajax.xhr.Request("../../RequestAjax/Party_Notice.php","partyid="+partyid,loadedNotice,'POST');	
}
function loadedNotice(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{		
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {				
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");
				
				n_Num = data.Num;	
				
				if(n_Num){							
					for(i=0;i<n_Num;i++)
					{
						n_Title[i] = data.article[i].Title;
						n_LoveMemName[i] = new Array();
						n_LoveMemID[i] = new Array();
						n_LoveMemProfile[i] = new Array();
						
						n_Author[i] = data.article[i].author;
						n_AuthorID[i] = data.article[i].authorID;
						n_AuthorProfile[i] = data.article[i].authorProfile;
						n_arrCommentLength[i] = data.article[i].NumberOfComment;
						n_GesiTime[i] = (data.article[i].time).substr(5,11);
						n_GesiInfo[i] = data.article[i].content;
						n_ArticleID[i] = data.article[i].articleID;
						n_isVote[i] = data.article[i].vote;
						n_LoveNum[i] = data.article[i].likenum;
						n_afrom[i] = data.article[i].belong;
						n_aPic[i] = data.article[i].apic;
						n_scrapperID[i] = data.article[i].scrapID;
						n_scrapperName[i] = data.article[i].scrapName;
						n_scrapperPic[i] = data.article[i].scrapPic;
						n_isparty[i] = data.article[i].isparty;
						n_belongID[i] = data.article[i].belongID;						
						n_scrapnum[i] = data.article[i].ScrapNum;
						
						/*// 좋아하는 사람 2차원 배열
						if(n_LoveNum[i] > 10){n_LoveLength[i] = 10;} else{ n_LoveLength[i]=LoveNum[i]}
						n_ShowLoveNum[i] = n_LoveLength[i];
						for(j=0;j<n_LoveLength[i];j++)
						{
							n_LoveMemName[i][j] = data.article[i].like[j].name;						
							n_LoveMemID[i][j] = data.article[i].like[j].id;
							n_LoveMemProfile[i][j] = data.article[i].like[j].profile;
						}	*/
					}	
				}
				else{
					
				}								
				MakeAnounces();
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
} // LoadArticle

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

//Anounce Display	**************************************************************************************************************************************************//
function MakeAnounces(){				
	document.getElementById('anounce_container').innerHTML = "";
	
	bdText = "";
	ancount=0;		
	if(n_Num != 0){
		for(i=0;i<n_Num;i++){			
			if(ancount==0){	
				$("#anounce_contents > .exist > .subtitle").html(n_Title[i]+"...");
				$("#anounce_contents > .exist > .info > .time").html(n_GesiTime[i]);				
				$("#anounce_contents").attr("alt",i);				
				$("#anounce_contents > .exist").css("display","block");
				$("#anounce_contents > .nonexist").css("display","none");
				ancount=1;
			}
			if(me[4]==2 || me[4]==1 || n_AuthorID[i]==me[4]) accep=1;
			else accep= 0;
			
			
				newDiv = document.createElement('DIV');
				$(newDiv).attr("class","posts closed");
				$(newDiv).attr("alt",n_ArticleID[i]);
				if(n_isVote[i]){
					voted="-";
				}
				else{
					voted="+";
				}
				
				$(newDiv).attr("onmouseover","deleteonoff(0,this, "+accep+")");
				$(newDiv).attr("onmouseout","deleteonoff(1,this, "+accep+")");
				// Header
				if(n_scrapperID[i]){
					scrapimg="../../images/board/scrapico.png";
				}
				bdText += "<div class=\"header\"><div class=\"pic\" style=\"cursor:pointer;\" alt=\""+n_AuthorID[i]+"\"><img src=\"../../"+n_AuthorProfile[i]+"50\" alt=\"\" /></div><div class=\"info\"><div class=\"top\"><div class=\"writer\" style=\"cursor:pointer;\" alt=\""+n_AuthorID[i]+"\">"+n_Author[i]+"</div><div class=\"path\"><img src=\""+scrapimg+"\" alt=\"\" /></div><div class=\"place redcolor\" style=\"cursor:pointer;\" alt=\""+i+"\">"+n_afrom[i]+"</div><div class=\"time\">"+n_GesiTime[i]+"</div></div></div><div class=\"button\"><div class=\"delete\" onClick=\"deletequery(0, "+n_ArticleID[i]+", this);\">Delete</div><div class=\"scrap\"><p onClick=\"onoffscrap(this);\">Scrap</p><div class=\"scrapbox\"><div class=\"arrow\"></div><div class=\"whiteline1\"></div><div class=\"selectbox\" onClick=\"scraplistonoff(this);\"><div class=\"scrapselected\">"+me[0]+"님의 마이노트</div><div class=\"window\"><div class=\"board_scrapbox_window\"><div class=\"list\">"+me[0]+"님의 마이노트</div></div></div></div><div class=\"whiteline2\"></div><div class=\"contentbox\"><textarea placeholder=\"Add Caption ...\"></textarea></div><div class=\"whiteline3\"></div><div class=\"button\"><div class=\"Button2_red\" onClick=\"ScrapArticle("+n_ArticleID[i]+",this)\">Scrap It<div class=\"Button2_red_word\">Scrap It</div></div></div></div></div>				<div class=\"candy\" onClick=\"likequery("+n_ArticleID[i]+",this);\" alt=\""+n_LoveNum[i]+"\">"+voted+" Candy</div></div></div>";
				scrapimg = "../../images/board/writeico.png";
				//Container
				bdText += "<div class=\"container\">";
				
				//Text - Contents                	
				bdText += "<div class=\"text\">";                    
				
				//Title - Notice Article
				
				bdText += "<div class=\"title\">공지글입니다!!</div>";			
				
				bdText += "<div id=\"autolinkdiv_anounce_"+i+"\" class=\"contents\">"+n_GesiInfo[i]+"</div></div>";
				
				//Container - Pic - APIC
				if(n_aPic[i]){
					bdText += "<div class=\"pic\"><div class=\"noneframe\"><div class=\"pic\"><img src=\"../../"+n_aPic[i]+"\" alt=\"\" /></div></div></div>";
					
				}

				bdText += "<div class=\"info board_cut\"><div class=\"comment\">+ "+n_arrCommentLength[i]+" Comments</div><div class=\"candy\">+ "+n_LoveNum[i]+" Candys</div> <div class=\"scrap\">+ "+n_scrapnum[i]+" Scraps</div></div>";					
				bdText += "<div class=\"info hover_express\"><div class=\"comment\">+ "+n_arrCommentLength[i]+" Comments</div><div class=\"candy\">+ "+n_LoveNum[i]+" Candys</div><div class=\"scrap\">+ "+n_scrapnum[i]+" Scraps</div></div></div>"					
			   
				//Board - Comment
				
				bdText += " <div class=\"comment\">";                      
				   
				//Comment - Length moreview                 

				if(n_arrCommentLength[i] > 10 && n_arrCommentLength[i] <= 50){
					bdText += "<div class=\"allview\" alt=\""+i+"\" style=\"cursor:pointer;\" onClick=\"CommentMore(this,3);\">+ All "+(n_arrCommentLength[i]-3)+" Comments ...</div>";
					n_arrCommentShowLength[i] = 3;
				}
				else if(n_arrCommentLength[i] > 50){
					bdText += "<div class=\"moreview\" alt=\""+i+"\" style=\"cursor:pointer;\" onClick=\"CommentMore(this,7);\">+ 50 Comments ...</div>";
					n_arrCommentShowLength[i] = 3;
				}
				else{
					n_arrCommentShowLength[i] = n_arrCommentLength[i];
				}
									
				//Comment - List
				bdText += "<div class=\"list\">";                    		

				for(j=0;j<n_arrCommentShowLength[i];j++)	//댓글
				{			
					n_arrCommentID[j] = data.article[i].comment[j].rid;
					n_arrCommentMemID[j] = data.article[i].comment[j].mid;
					n_arrCommentName[j] = data.article[i].comment[j].name;
					n_arrCommentInfo[j] = data.article[i].comment[j].text;
					n_arrCommentTime[j] = (data.article[i].comment[j].time).substr(5,11);
					n_arrCommentProfile[j] = data.article[i].comment[j].profile;	
				}	  
				
				for(j=n_arrCommentShowLength[i];j>0;j--){
					if(n_arrCommentMemID[j-1]==me[4]) accep=1;
					else accep=0;
					
					bdText += " <div class=\"comments\" onMouseover=\"deleteonoff(2,this,"+accep+");\" onMouseOut=\"deleteonoff(3,this,"+accep+")\"><div class=\"pic\" style=\"cursor:pointer;\" alt=\""+n_arrCommentMemID[j-1]+"\"><img src=\"../../"+n_arrCommentProfile[j-1]+"38\" width=\"38\" height=\"38\" alt=\"\" class=\"pie\" /></div><div class=\"contents\"><div class=\"name\" style=\"cursor:pointer;\" alt=\""+n_arrCommentMemID[j-1]+"\">"+n_arrCommentName[j-1]+"</div><div class=\"time\">"+n_arrCommentTime[j-1]+"</div><div class=\"text\">"+n_arrCommentInfo[j-1]+"</div></div><div class=\"delete\" onClick=\"deletequery(1,"+n_arrCommentID[j-1]+", this);\"></div></div>";
				}
				
				//Close List && write                    
				bdText += "</div><div class=\"write\"><div class=\"pic\"><img src=\"../../"+me[11]+"38\" width=\"38\" height=\"38\" alt=\"\" class=\"pie\" /></div><div class=\"text pie\"><textarea placeholder=\"이 글에 댓글 달기 ...\" onKeyDown=\"writecomment(this);\" alt=\""+i+"\"></textarea></div></div></div>";                       

				$(newDiv).html(bdText);
				$(newDiv).mouseenter(function(){
					$(this).children(".container").children(".hover_express").css("display","block");
				});
				$(newDiv).mouseleave(function(){
					$(this).children(".container").children(".hover_express").css("display","none");
				});
				$(newDiv).click(function(){
					$(this).children(".container").children(".hover_express").css("visibility","hidden");
					$(this).removeClass("closed")
	
					$(this).next(".posts").css("border-top-color","#d5d5d5")
					
					$(this).find(".board_cut").css("display","block")
					
					$(this).css("height","auto");
				});

				
				document.getElementById('anounce_container').appendChild(newDiv);
				autolink("autolinkdiv_anounce_"+i);
				bdText = "";

		}
					
	$.each($("#anounce_container"),function(){
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
	$.each($("#anounce_container > .posts > .header > .info > .top > .place"),function(){
		$(this).mousedown(function(){
			if(isparty[$(this).attr("alt")]==0){
				post_to_url('../../note/',{'mynoteid':n_belongID[$(this).attr("alt")]});
			}
			else{							
				post_to_url('../../partyplay/',{'mynoteid':me[4]/*n_AuthorID[$(this).attr("alt")]*/,'partyid':n_belongID[$(this).attr("alt")]});
			}
		});
	});
	}
	if(ancount==0){
		$("#anounce_contents > .exist").css("display","none");
		$("#anounce_contents > .nonexist").css("display","block");	
	}
	if(ancount==0){
		nonotice=1;
	}
	else{
		nonotice=0;
	}
		$("#info_anouncepage > .contents > .container > .Rfield > .contents > .posts:first").css("border-top-left-radius","5px").css("border-top-right-radius","5px")
	$("#info_anouncepage > .contents > .container > .Rfield > .contents > .posts:last").css("border-bottom-left-radius","5px").css("border-bottom-right-radius","5px")
	
		
		// INFOPAGE ANOUNCE 스킬부분 오버 EVENT
		
		$.each($("#info_anouncepage > .contents > .container > .post > .title > .skill"),function() {
				$(this).children(".candy").mouseover(function() {
					$(this).css("color","#aaa");
				});
				$(this).children(".candy").mousedown(function() {
					$(this).css("color","#c1c1c1");
					$(this).html("- Candy");
				});
		});
		
		// INFOPAGE ANOUNCE 코멘트부분 DELETE 창 뜨는 EVENT
		
		$.each($("#info_anouncepage > .contents > .container > .post > .contents > .comment > .list > .comments"),function() {
			
			$(this).mouseenter(function() {
				$(this).children(".delete").css("visibility","visible");
			});
			$(this).mouseleave(function() {
				$(this).children(".delete").css("visibility","hidden");
			});
			
		});
		
		// INFOPAGE ANOUNCE 펼치기 EVENT
		
		$.each($("#info_anouncepage > .contents > .container"),function() {		
			$(".post > .title > .summary > .text").mouseup(function() {			
				if($(this).parent(".summary").parent(".title").parent(".post").children(".contents").css("display")=="none"){
					$(this).parent(".summary").parent(".title").parent(".post").children(".contents").css("display","block");
					$(this).parent(".summary").parent(".title").children(".arrow").html("<img src=\"../images/party/Container/anouncearrowck.png\" alt=\"\" />");
					$(this).parent(".summary").parent(".title").css("border-bottom-color","#dc5457");
				}
				else{
					$(this).parent(".summary").parent(".title").parent(".post").children(".contents").css("display","none");
					$(this).parent(".summary").parent(".title").children(".arrow").html("<img src=\"../images/party/Container/anouncearrow.png\" alt=\"\" />");
					$(this).parent(".summary").parent(".title").css("border-bottom-color","#d9d9d9");
				}		
			});
			
			
		});
		
		// INFOPAGE ANOUNCE 속 스크랩 EVENT
		
		$.each($("#info_anouncepage > .contents > .container > .post > .title > .skill > .scrap"),function() {
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
		
		$.each($("#info_anouncepage > .contents > .container > .post > .title > .skill >.scrap > .scrapbox > .selectbox"),function() {
			$(this).mouseup(function() {				
				new ajax.xhr.Request("../../RequestAjax/Scrap_MyParty.php","",loadedmyparty,'POST');
				$(this).children(".window").css("display","block");
			});
		});
		
		$.each($("#info_anouncepage > .contents > .container > .post > .contents > .comment >.list > .comments"),function(){
			$(this).children(".pic").mousedown(function(){
				post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});
			});
			
			$(this).children(".contents").children(".name").mousedown(function(){
				post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});
			});
		});
}



function MakeWinAnounce(){
	new ajax.xhr.Request("../../RequestAjax/Board_Comment.php","cases=4&opt=1&articleID="+n_ArticleID[0],MAKEWINANOUNCEREAL,'POST');
}

function MAKEWINANOUNCEREAL(req){	
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

				if(num!=0){
					for(j=0;j<n_arrCommentShowLength[0];j++)		//댓글
					{							
						n_arrCommentID[j] = data.comment[j].rid;
						n_arrCommentMemID[j] = data.comment[j].mid;
						n_arrCommentName[j] = data.comment[j].name;
						n_arrCommentInfo[j] = data.comment[j].text;
						n_arrCommentTime[j] = (data.comment[j].time).substr(5,11);
						n_arrCommentProfile[j] = data.comment[j].profile;
						//alert(n_arrCommentID[j] + " / " + n_arrCommentMemID[j] + " / " + n_arrCommentName[j] + " / " + n_arrCommentInfo[j] + " / " + n_arrCommentTime[j] + " / " + n_arrCommentProfile[j]);
					}
				}

			if(n_isVote[0]){
				voted="-";
			}
			else{
				voted="+";
			}

	waText = "";
	waText += "<div class=\"posts\" alt=\""+n_ArticleID[0]+"\"><div class=\"header\"><div class=\"pic\" style=\"cursor:pointer;\" alt=\""+n_AuthorID[0]+"\"><img src=\"../../"+n_AuthorProfile[0]+"\" alt=\"\" /></div><div class=\"info\"><div class=\"top\"><div class=\"writer\" style=\"cursor:pointer;\" alt=\""+n_AuthorID[0]+"\">"+n_Author[0]+"</div><div class=\"path\"><img src=\"../images/board/writeico.png\" alt=\"\" /></div><div class=\"place redcolor\" style=\"cursor:pointer;\">"+n_afrom[0]+"</div><div class=\"time\">"+n_GesiTime[0]+"</div></div></div><div class=\"button\"><div class=\"delete\">Delete</div><div class=\"scrap\"><p>Scrap</p><div class=\"scrapbox\"><div class=\"arrow\"></div><div class=\"whiteline1\"></div><div class=\"selectbox\"><div class=\"scrapselected\">"+me[4]+" 님의 마이노트</div><div class=\"window\"><div class=\"board_scrapbox_window\"><div class=\"list\"></div></div></div></div><div class=\"whiteline2\"></div><div class=\"contentbox\"><textarea placeholder=\"Add Caption ...\"></textarea></div><div class=\"whiteline3\"></div><div class=\"button\"><div class=\"Button2_red\" onClick=\"ScrapArticle("+n_ArticleID+",this)\">Scrap It<div class=\"Button2_red_word\">Scrap It</div></div></div></div></div><div class=\"candy\" onClick=\"likequery("+n_ArticleID[0]+",this);\" alt=\""+n_LoveNum[0]+"\">"+voted+" Candy</div></div></div><div class=\"container\">";

	waText += "<div class=\"text\">";

	waText += "<div class=\"title\">공지글입니다!!</div>";

	waText += "<div id=\"anounce_links\" class=\"contents\">"+n_GesiInfo[0]+"</div></div>";

	if(n_aPic[0]!=""){
        waText += "<div class=\"pic\"><div class=\"noneframe\"><img src=\"../../"+n_aPic[0]+"\" alt=\"\" /></div></div>";
	}

	waText += "<div class=\"info\"><div class=\"comment\">+ "+n_arrCommentLength[0]+" Comments</div><div class=\"candy\">+ "+n_LoveNum[0]+" Candys</div><div class=\"scrap\">+ "+n_scrapnum[0]+" Scraps</div></div></div>";
	
	    
    waText += "<div class=\"comment\">";
	
	if(n_arrCommentLength[0] > 10){ n_arrCommentShowLength[0]=3; }else{ n_arrCommentShowLength[0] = n_arrCommentLength[0]; }
	
	if(n_arrCommentLength[0] > 10 && n_arrCommentLength[0] <= 50){
		waText += "<div class=\"allview\" alt=\""+i+"\" style=\"cursor:pointer;\" onClick=\"CommentMore(this,2);\">+ All "+(n_arrCommentLength[0]-3)+" Comments ...</div>";
	}
	else if(n_arrCommentLength[0] > 50){
		waText += "<div class=\"moreview\" alt=\""+i+"\" style=\"cursor:pointer;\" onClick=\"CommentMore(this,6);\">+ 50 Comments ...</div>";
	}
	
	waText += "<div class=\"list\">";
	
	
	/*for(j=0;n_arrCommentShowLength[0]>j;j++)		//댓글
	{				
		n_arrCommentID[j] = data.article[0].comment[j].rid;
		n_arrCommentMemID[j] = data.article[0].comment[j].mid;
		n_arrCommentName[j] = data.article[0].comment[j].name;
		n_arrCommentInfo[j] = data.article[0].comment[j].text;
		n_arrCommentTime[j] = (data.article[0].comment[j].time).substr(5,11);
		n_arrCommentProfile[j] = data.article[0].comment[j].profile;	
	}*/
	for(i=n_arrCommentShowLength[0]-1;i>=0;i--){
		if(n_arrCommentMemID[i]==me[4]) accep=1;
		else accep=0;
		
		waText += "<div class=\"comments\" onMouseover=\"deleteonoff(2,this,"+accep+");\" onMouseOut=\"deleteonoff(3,this,"+accep+")\"><div class=\"pic\" style=\"cursor:pointer;\" alt=\""+n_arrCommentMemID[i]+"\"><img src=\"../../"+n_arrCommentProfile[i]+"\" width=\"38\" height=\"38\" alt=\"\" class=\"pie\" /></div><div class=\"contents\"><div class=\"name\" style=\"cursor:pointer;\" alt=\""+n_arrCommentMemID[i]+"\">"+n_arrCommentName[i]+"</div><div class=\"time\">"+n_arrCommentTime[i]+"</div><div class=\"text\">"+n_arrCommentInfo[i]+"</div></div><div class=\"delete\" onClick=\"deletequery(1,"+n_arrCommentID[i]+",this)\"></div></div>";
	}
               
                
	waText += "</div><div class=\"write\"><div class=\"pic\"><img src=\"../../"+me[11]+"\" width=\"38\" height=\"38\" alt=\"\" class=\"pie\" /></div><div class=\"text pie\"><textarea placeholder=\"이 글에 댓글 달기 ...\" onKeyDown=\"writecomment(this);\" alt=\""+i+"\"></textarea></div></div></div></div>";
	
	
		$("#win_anounce_original").html(waText);
		autolink("anounce_links");
	
	
	
	
	
	
	/*"<div class=\"container pie\" alt=\""+n_ArticleID[0]+"\"><div class=\"title\"><div class=\"summary\"><div class=\"pic\"><img src=\"../../"+n_AuthorProfile[0]+"50\" width=\"50\" height=\"50\" class=\"pie\" alt=\"\" /></div><div class=\"text text-color-chg2\" id=\"anounce\">"+n_GesiInfo[0].substr(0,10)+"...</div><div class=\"info\">"+n_GesiTime[0]+"&nbsp;&nbsp;+ "+n_arrCommentLength[0]+" Comments&nbsp;&nbsp;+ "+n_LoveNum[0]+" Candys</div></div><div class=\"skill\"><div class=\"candy\" onClick=\"likequery("+n_ArticleID[0]+",this);\" alt=\""+n_LoveNum[0]+"\">"+voted+" Candy</div><div class=\"scrap text-color-chg3\"><p>Scrap</p><div class=\"scrapbox\"><div class=\"arrow\"></div><div class=\"whiteline1\"></div><div class=\"selectbox\"><div class=\"scrapselected\">"+me[0]+"님의 마이노트</div><div class=\"window\"><div class=\"board_scrapbox_window\"><div class=\"list\">"+me[0]+"님의 마이노트</div></div></div></div><div class=\"whiteline2\"></div><div class=\"contentbox\"><textarea placeholder=\"Add Caption ...\"></textarea></div><div class=\"whiteline3\"></div><div class=\"button\"><div class=\"Button2_red\" onClick=\"ScrapArticle("+n_ArticleID[0]+",this)\">Scrap It<div class=\"Button2_red_word\">Scrap It</div></div></div></div></div><div class=\"delete text-color-chg3\">Delete</div></div></div><div class=\"contents\"><div class=\"container\">";
	
	waText += "<div class=\"text\"><div class=\"title\">공지글입니다!!</div><div id=\"autolinkdiv_0\" class=\"contents\">"+n_GesiInfo[0]+"</div></div>";
	if(n_aPic[0]){
		waText += "<div class=\"pic\"><div class=\"noneframe\"><img src=\"../../"+n_aPic[0]+"\" alt=\"\" /></div></div>";
	}
    waText += "</div>";  
	waText += "<div class=\"comment\">";          

	if(n_arrCommentLength[0] > 10 && n_arrCommentLength[0]<=50){
		waText += "<div class=\"allview\" style=\"cursor:pointer;\" onClick=\"CommentMore(this,4);\" alt=\""+n_ArticleID[0]+"\">+ All "+(n_arrCommentLength[0]-3)+" Comments ...</div>";		
	}
	else if(n_arrCommentLength[0] > 50){
		waText += " <div class=\"moreview\" style=\"cursor:pointer;\" onClick=\"CommentMore(this,8);\" alt=\""+n_ArticleID[0]+"\">+ 50 Comments ...</div>";
	}
    waText += "<div class=\"list\">";
	
   	for(i=(n_arrCommentShowLength[0]-1);i>=0;i--){
		if(n_arrCommentMemID[i]==me[4]) accep=1;
		else accep=0;
		
		waText += "<div class=\"comments\" onMouseover=\"deleteonoff(2,this,"+accep+");\" onMouseOut=\"deleteonoff(3,this,"+accep+")\"><div class=\"pic\" style=\"cursor:pointer;\" alt=\""+n_arrCommentMemID[i]+"\"><img src=\"../../"+n_arrCommentProfile[i]+"38\" width=\"38\" height=\"38\" alt=\"\" class=\"pie\" /></div><div class=\"contents\"><div class=\"name\" style=\"cursor:pointer;\" alt=\""+n_arrCommentMemID[i]+"\">"+n_arrCommentName[i]+"</div><div class=\"time\">"+n_arrCommentTime[i]+"</div><div class=\"text\">"+n_arrCommentInfo[i]+"</div></div><div class=\"delete\" onClick=\"deletequery(1, "+n_arrCommentID[i]+", this);\"></div></div>";
	}
    waText += " </div><div class=\"write\"><div class=\"pic\"><img src=\"../../"+me[11]+"38\" width=\"38\" height=\"38\" alt=\"\" class=\"pie\" /></div><div class=\"text pie\"><textarea placeholder=\"이 글에 댓글 달기 ...\" onKeyDown=\"writecomment_win_anounce(this);\"></textarea></div></div></div></div></div>";    $("#win_anounce_original").html(waText);                                  
            autolink("anounce");*/
     
	 
	$.each($("#win_anounce_original > .posts > .header > .button > .scrap"),function() {
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
	
	$.each($("#win_anounce_original > .posts > .header > .button > .scrap > .scrapbox > .selectbox"),function() {
		$(this).mouseup(function() {
			$(this).children(".window").css("display","block");
			new ajax.xhr.Request("../../RequestAjax/Scrap_MyParty.php","",loadedmyparty,'POST');
		});
	});	
	
	// anounce window안에 마이노트전환
	
	//작성자 이름
	$.each($("#win_anounce_original > .posts > .header > .info > .top > .writer"),function(){
		$(this).mousedown(function(){
			post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});		
		});
	});
	//작성자사진
	$.each($("#win_anounce_original > .posts > .header > .pic"),function(){
		$(this).mousedown(function(){
			post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});		
		});	
	});
	//코멘트사진
	$.each($("#win_anounce_original > .posts > .comment > .list > .comments > .pic"),function(){
		$(this).mousedown(function(){
			post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});		
		});	
	});
	//코멘트이름
	$.each($("#win_anounce_original > .posts > .comment > .list > .comments > .contents > .name"),function(){
		$(this).mousedown(function(){
			post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});		
		});	
	});
	
	//출처
	$.each($("#win_anounce_original > .posts > .header > .info > .top > .place"),function(){
		$(this).mousedown(function(){
			if(o_isparty==0){
				post_to_url('../../note/',{'mynoteid':n_belongID[0] });
			}
			else{
				post_to_url('../../partyplay/',{'mynoteid':me[4]/*o_AuthorID*/, 'partyid':n_belongID[0]});
			}
		});
	});
	
	
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
} // Announce Display and Script

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
		if(now > 550){
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
		if(now > 550){
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
	//	if(now > (($("#bc_"+last).offset().top)-50)) upchecking=1;
	//$("#a").html("now: "+now+"<br>Scroll: "+($("#bc_"+((PreviewNum*6)-1)).offset().top-700)+"<br>last: "+($("#bc_"+last).offset().top));
	
}); // Scrolling Event - Preview & ArticleMore

//PMemLoad All**************************************************************************************************************************************************//

function Party_Members_All_Load(){
	new ajax.xhr.Request("../../RequestAjax/Party_MemberList_All.php","req_party="+partyid,present_party_mem_alll,'POST');
}
function present_party_mem_alll(req){
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
				MNum = data.MemberNum;
				for(i=0;i<MNum;i++){
					FID[i] = data.Member[i].Fid;
					FNAME[i] = data.Member[i].Fname;
					FPIC[i] = data.Member[i].Fpic;
					FPARTY[i] = data.Member[i].Fparty;
					FSTAT[i] = data.Member[i].Fstat;
				}
				Present_Party_Member_All(MNum, FID, FNAME, FPIC, FPARTY, FSTAT);
						
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
function Present_Party_Member_All(a,b,c,d,e,f){
	ppmaText = "";
	for(i=0;i<a;i++){
		ppmaText += "<div class=\"cards\"><div class=\"pic\" style=\"cursor:pointer\" alt=\""+b[i]+"\"><img src=\"../"+d[i]+"50\" width=\"50\" height=\"50\" alt=\"\" /></div><div class=\"info\"><div class=\"name\" style=\"cursor:pointer;\" alt=\""+b[i]+"\">"+c[i]+"</div>";
		if(e[i]!=-1){
			ppmaText += "<div class=\"shareparty\">나와 공유하고 있는 파티 "+e[i]+" 개</div></div><div class=\"button\">";
		}
		else{
			ppmaText += "<div class=\"shareparty\">본인입니다</div></div><div class=\"button\">";
		}
				
		if(f[i]==1){
			ppmaText += "<div class=\"friendsbutton\">이미 친구<div class=\"word\">이미 친구</div></div></div></div>";
		}
		else if(f[i]==2){
			if(typeof pageYOffset != 'undefined'){
				ppmaText += "<div class=\"Button_gray Button_gray_selected\">요청 완료<div class=\"Button_gray_word Button_gray_selected_word\">요청 완료</div></div></div></div>";
			}
			else{
				ppmaText += "<div class=\"Button_gray Button_gray_selected_ie8\">요청 완료<div class=\"Button_gray_word Button_gray_selected_word_ie8\">요청 완료</div></div></div></div>";
			}
		}
		else if(f[i]==3){
			ppmaText += "<div class=\"Button_gray\">친구 수락<div class=\"Button_gray_word\">친구 수락</div></div></div></div>";
		}
		else if(f[i]==4){
			ppmaText += "<div class=\"Button_gray\">친구 추가<div class=\"Button_gray_word\">친구 추가</div></div></div></div>";
		}
		else{
			if(typeof pageYOffset != 'undefined'){
				ppmaText += "<div class=\"Button_gray Button_gray_selected\">본  인<div class=\"Button_gray_word Button_gray_selected_word\">본  인</div></div></div></div>";
			}
			else{
				ppmaText += "<div class=\"Button_gray Button_gray_selected_ie8\">본  인<div class=\"Button_gray_word Button_gray_selected_word_ie8\">본  인</div></div></div></div>";
			}
		}
	}
	document.getElementById('Party_MemberList_All').innerHTML = ppmaText;
	
	$.each($("#Party_MemberList_All"),function(){
		$(this).children(".cards").children(".pic").mousedown(function(){
			post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});
		});
		
		$(this).children(".cards").children(".info").children(".name").mousedown(function(){
			post_to_url('../../note/',{'mynoteid':$(this).attr("alt")});
		});
	});
	
	// INFOPAGE MEMBER 친구추가버튼 EVENT
	
	$.each($("#Party_MemberList_All > .cards > .button > .Button_gray"),function() {
		
		$(this).mouseleave(function() {
			$(this).css("background-image","url(../images/party/Container/buttongraybg.png)");
		});
		$(this).mousedown(function() {
			$(this).css("background-image","url(../images/party/Container/buttongraybgck.png)");
		});
		$(this).mouseup(function() {
			if($(this).html().substr(0,5)=="친구 수락"){
				if(confirm('새로운 친구의 친구요청을 수락하시겠습니까?')){
					new ajax.xhr.Request("../../RequestAjax/Friend_query.php","fopt=1&fid="+$(this).parent(".button").siblings(".pic").attr("alt"),nothingdo,'POST');
					new ajax.xhr.Request("../../RequestAjax/Friend_query.php","fopt=2&fid="+$(this).parent(".button").siblings(".pic").attr("alt"),nothingdo,'POST');
					ok=true;
				}
				else{
					ok=false;
				}
			}
			else if($(this).html().substr(0,5)=="친구 추가"){
				if(confirm('새로운 친구에게 친구요청을 보내시겠습니까?')){
					new ajax.xhr.Request("../../RequestAjax/Friend_query.php","fopt=1&fid="+$(this).parent(".button").siblings(".pic").attr("alt"),nothingdo,'POST');
					new ajax.xhr.Request("../../RequestAjax/Friend_query.php","fopt=2&fid="+$(this).parent(".button").siblings(".pic").attr("alt"),nothingdo,'POST');
				}
				else{
					ok=false;
				}
			}
			if(ok){
				if(typeof pageYOffset != 'undefined'){
					$(this).css("background-image","url(../images/party/Container/buttongraybg.png)");
					$(this).html("요청 완료<div class=\"Button_gray_word\">요청 완료</div>");
					$(this).addClass("Button_gray_selected");
					$(this).children(".Button_gray_word").addClass("Button_gray_selected_word");
				}
				else{
					$(this).css("background-image","url(../images/party/Container/buttongraybg.png)");
					$(this).html("요청 완료<div class=\"Button_gray_word\">요청 완료</div>");
					$(this).addClass("Button_gray_selected_ie8");
					$(this).children(".Button_gray_word").addClass("Button_gray_selected_word_ie8");	
				}
			}
		});
		
	});
	
}	//Party Member Load All

//PMemInvite List**************************************************************************************************************************************************//

function Party_Invite_MyFriend(){
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
var invArray = "";
function Present_Party_Member_All_Invite(a,b,c,d,e){
	ppmaiText = "";
	for(i=0;i<a;i++){
		ppmaiText += "<div class=\"list\" alt=\"0\"><div class=\"pic\"  alt=\""+b[i]+"\" ><img src=\"../"+d[i]+"50\" height=\"50\" width=\"50\" alt=\"\" class=\"pie\"/></div><div class=\"name\"><h1>"+c[i]+"</h1></div><div class=\"shareparty\">나와 공유하고 있는 파티 "+e[i]+"&nbsp;개</div><div class=\"button\"><div class=\"check\"></div></div></div>";		
	}
	$("#win_friend_invite > .container > .contents").html(ppmaiText);
	$("#Invite_Num_Text").html(invCount + "&nbsp;명에게 초대장을 보냅니다.");
	
	
	 // WIN_INVITATION 초대창에서 하나하나의 카드목록들 오버,클릭, 아웃시 EVENT
	 
	$.each($("#win_friend_invite > .container > .contents > .list"),function() {
		
		$(this).mouseenter(function() {
            $(this).css("background-color","#f9f9f9");
        });
		$(this).mouseleave(function() {
            $(this).css("background-color","#fff");
        });
		$(this).mousedown(function() {
            $(this).css("background-color","#f5f5f5");
        });
		$(this).mouseup(function() {
			//alert($(this).children(".button").css("background-image").charAt($(this).children(".button").css("background-image").length-10));
			if($(this).attr("alt")==1){
				$(this).children(".button").css("background-image","url(../images/party/Container/check.png)");
				$(this).css("background-color","#fff");
				invCount = invCount - 1;
				invArray = invArray.replace($(this).children(".pic").attr("alt")+",","");
				$("#Invite_Num_Text").html(invCount + "&nbsp;명에게 초대장을 보냅니다.");
				$(this).attr("alt","0");
			}
			else{			
				$(this).children(".button").css("background-image","url(../images/party/Container/checkck.png)");
				$(this).css("background-color","#f5f5f5");
				invCount = invCount + 1;
				invArray += $(this).children(".pic").attr("alt")+",";
				$("#Invite_Num_Text").html(invCount + "&nbsp;명에게 초대장을 보냅니다.");
				$(this).attr("alt","1");
			}								
		});
		
	});
} //Invite MyFriends to Party

//WidePicture Controll Script********************************************************************************************************************************//
function ysubmit(){
	new ajax.xhr.Request("../../RequestAjax/widey.php","y="+rey+"&pid="+partyid,yset,'POST');
}
function yset(){
	$("#boxok").css("display","none");
	$(".scrollbasepic").css("z-index","4");
}

	var dragFlag = false;	var x, y, pre_x, pre_y;	var fix_ena=0; var rey;
	$(function () {	$('.scrollbasepic').mousedown(	function (e) {		
	dragFlag = true; var obj = $(this); x = obj.scrollLeft(); y = obj.scrollTop(); pre_x = e.screenX; pre_y = e.screenY;	$(this).css("cursor", "pointer"); /*$('#result').text("x:" + x + "," + "y:" + y + "," + "pre_x:" + pre_x + "," + "pre_y:" + pre_y);
	$('#result').text(dragFlag);*/
	});
	$('.scrollbasepic').mousemove(function (e) {if (dragFlag) {
	var obj = $(this);	obj.scrollLeft(x - e.screenX + pre_x);	obj.scrollTop(y - e.screenY + pre_y);/*$('#result').text((x - e.screenX + pre_x) + "," + (y - e.screenY + pre_y));*/
	if(y + 512 <= wideheight){
		rey = obj.scrollTop();
	}
	$("#boxok").css("top",(100+obj.scrollTop())+"px");
		return false;
	}});
	$('.scrollbasepic').mouseup(	function () {
	dragFlag = false;	/*$('#result').text("x:" + x + "," + "y:" + y + "," + "pre_x:" + pre_x + "," + "pre_y:" + pre_y);	$('#result').text(dragFlag);*/
		$(this).css("cursor", "default");
	
	});
	$('body').mouseup(	function () {dragFlag = false;//$('#result').text(dragFlag);
		$(this).css("cursor", "default");
	});}); //Widepicture Controll script
	
//visit query
function visitquery(){
	new ajax.xhr.Request("../../RequestAjax/party_query.php","popt=5&pid="+partyid,nothingdo,'POST');
}	//visit query

//Party Invite Query
function invitefriendtomyparty(){	
	if(invArray!=""){
		if(confirm('선택한 친구들을 파티로 초대하시겠습니까?')){
			new ajax.xhr.Request("../../RequestAjax/Party_Invite.php","num="+invCount+"&array="+invArray+"&pid="+partyid,nothingdo,'POST');
			alert(invCount + "명을 파티로 초대하였습니다");
			$("#fullscreen_bg").css("display","none");
			$("#win_friend_invite").css("display","none");		
			$("#wrapbox").removeClass("changewrapBox");
			invCount=0;
			invArray="";
		}
	}
	else{
		alert('초대할 친구를 선택하세요');
	}
} //party invite query

//Party join query
function partyjoinquery(){	
	new ajax.xhr.Request("../../RequestAjax/party_query.php","popt=1&pid="+partyid,refreshthisparty,'POST');
	new ajax.xhr.Request("../../RequestAjax/party_query.php","popt=6&pid="+partyid,nothingdo,'POST');	
}	

function refreshthisparty(){
	post_to_url('../../partyplay/',{'mynoteid':me[4]/*mynoteid*/, 'partyid':partyid});
} //party join query

//Party out query
function partyoutquery(){
	new ajax.xhr.Request("../../RequestAjax/party_query.php","popt=2&pid="+partyid,checkadminparty,'POST');
}	//party out query

function checkadminparty(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{			
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");				
				
				result = data.Result;

				if(result==0){
					refreshthisparty();
				}
				else{
					alert('파티쉐가 파티를 탈퇴하려면 파티쉐를 다른 파티원에게 넘겨주어야 합니다. 이 기능은 잠시 준비중입니다.');
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

//friend search
function friendlist_search(obj){	
	if($(obj).val()==""){
		$("#Party_MemberList_All").children(".cards").fadeIn(300,0);
	}
	else{
		for(i=0;i<$("#Party_MemberList_All").children(".cards").size();i++){
			if(i==0){
				ot = $("#Party_MemberList_All").children(".cards").first();				
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
} // friend search

//member search
function memberlist_search(obj){
	if($(obj).val()==""){
		$("#partyadmin_member_container").children(".ScrollBox").children(".container").children(".content").children(".listwrap").children(".list").fadeIn(300,0);
	}
	else{
		for(i=0;i<$("#partyadmin_member_container").children(".ScrollBox").children(".container").children(".content").children(".listwrap").children(".list").size();i++){
			if(i==0){
				ot = $("#partyadmin_member_container").children(".ScrollBox").children(".container").children(".content").children(".listwrap").children(".list").first();				
				results = $(ot).children(".name").children("h1").html().indexOf($(obj).val());
				if(results!=-1){
					$(ot).fadeIn(300,0);
				}
				else{
					$(ot).fadeOut(300,0);
				}
			}
			else{
				ot = $(ot).next(".list");				
				results = $(ot).children(".name").children("h1").html().indexOf($(obj).val());
				if(results!=-1){
					$(ot).fadeIn(300,0);
				}
				else{
					$(ot).fadeOut(300,0);
				}
			}
		}		
	}
}	//member search
