$(document).ready(function() {

	// TEXT COLOR CHANGE EVENT
	
	$.each($(".text-color-chg"),function() {

			$(this).mouseenter(function() {
					$(this).css("color","#999");	
			});
	
			$(this).mouseleave(function() {
					$(this).css("color","#777");	
			});
					
			$(this).mousedown(function() {
					$(this).css("color","#dc5457");
            });
	
	});
	
	// TEXT COLOR CHANGE EVENT_subtitole용
	
	$.each($(".text-color-chg2"),function() {

			$(this).mouseenter(function() {
					$(this).css("color","#777");	
			});
	
			$(this).mouseleave(function() {
					$(this).css("color","#333");	
			});
					
			$(this).mousedown(function() {
					$(this).css("color","#dc5457");
            });
	
	});
	
	// TEXT COLOR CHANGE EVENT_anounce skill용
	
	$.each($(".text-color-chg3"),function() {

			$(this).mouseenter(function() {
					$(this).css("color","#999");	
			});
	
			$(this).mouseleave(function() {
					$(this).css("color","#888");	
			});
					
			$(this).mousedown(function() {
					$(this).css("color","#dc5457");
            });
	
	});
	
	// BUTTON_RED OVER CLICK
	
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
		
	}); // BUTTON_RED OVER CLICK END
	
	// BUTTON2_RED OVER CLICK
	
	$.each($(".Button2_red"),function() {
		
		$(this).mouseenter(function() {
			$(this).css("background-image","url(../images/party/Container/button2bgov.png)");
		});
		$(this).mouseleave(function() {
			$(this).css("background-image","url(../images/party/Container/button2bg.png)");
		});
		$(this).mousedown(function() {
			$(this).css("background-image","url(../images/party/Container/button2bgck.png)");
		});
		$(this).mouseup(function() {
			$(this).css("background-image","url(../images/party/Container/button2bgov.png)");
		});
		
	}); // BUTTON2_RED OVER CLICK END
	
	// BasePic Button EVENT
	
	$.each($("#container .party .pic > .basepic > .chg_bg"),function() {
		
		$(this).mouseenter(function(e) {
			$(this).css("opacity",".7")
        });		
		$(this).mouseleave(function(e) {
			$(this).css("opacity","1")
        });		
		$(this).mousedown(function(e) {
			$(this).css("opacity",".5")
        });		
		$(this).mouseup(function(e) {      
			$(this).css("opacity",".7")
        });
		
		$("#container .party .pic > .basepic > .partyadmin_position").mouseup(function() {
			$("#container .party .pic > .partyadminpage").css("visibility","visible");
			$("#container .party .pic > .partyadminpage").fadeTo(800,1);
		});
		
	});

	// Button gray click
	
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
		
	})
	
	$(".basepic > .setting > .menu > .cover").mouseup(function() {
			frm = document.getElementById('imgiframe');
			if(frm==null) return;
			
			fDoc = frm.contentWindow || frm.contentDocument;
			if(fDoc.document){
				fDoc = fDoc.document;
			}
			
			fDoc.WideUpload.opt.value = 3;
			
			fDoc.WideUpload.partyidd.value = partyid;
					
			fDoc.WideUpload.imgupload.click();
	});
	
	
});

function tempimageupload(){
	frm = document.getElementById('imgiframe');
	if(frm==null) return;
	
	fDoc = frm.contentWindow || frm.contentDocument;
	if(fDoc.document){
		fDoc = fDoc.document;
	}
	
	fDoc.WideUpload.opt.value = 4;	
	
	fDoc.WideUpload.action = "../../tempimgupload.php";
	if($('.cameraspace > .photopart > .photo > .photo1 > .img > img').attr("src")!=""){
		new ajax.xhr.Request("../../erase_upload_temp.php","er_file="+$('.cameraspace > .photopart > .photo > .photo1 > .img > img').attr('alt'),nothingdo,'POST');		
	}	
	
	fDoc.WideUpload.imgupload.click();
	
}


var thumbvalue=0;
function UploadSetting(){
	if(!/(\.gif|\.jpg|\.jpeg|\.png)$/i.test(fDoc.WideUpload.imgupload.value)){
		alert('지원하는 형식의 파일이 아닙니다');
	}
	else{
		thumbvalue = fDoc.WideUpload.opt.value;				
		fDoc.WideUpload.submit();		
		if(thumbvalue!=4){	
			setTimeout("Picloading();",1000); 	
		}
	}
}


function Picloading(){	
	if(thumbvalue==1){
		new ajax.xhr.Request("../../Ajaxpicloading.php","opt=1",AjaxPicLoadReq,'POST');				
	}
	else if(thumbvalue==2){		
		new ajax.xhr.Request("../../Ajaxpicloading.php","opt=2",AjaxPicLoadReq,'POST');		
	}
	else if(thumbvalue==3){
		$(this).siblings(".menu").fadeTo(600,0)
		setTimeout(kim_menu_display_none,600)
		new ajax.xhr.Request("../../Ajaxpicloading.php","opt=3&partyid="+partyid,AjaxPicLoadReq,'POST');		
	}	
}
function AjaxPicLoadReq(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {			
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");				

				if(thumbvalue==1){	//note
					Widepic = data.Widepic;
					Height = data.Height;
					
					RePic1(Widepic, Height);											
				}
				else if(thumbvalue==2){	//profilepic
					Profilepic = data.Profilepic;
					$("#container > .baseinfo > .info > .prof_pic > img").attr("src","../../"+Profilepic);
					alert('사진이 변경되었습니다');	
				}
				else if(thumbvalue==3){	//partyplay
					Pic = data.Pic;
					Height = data.Height;
					
					RePic(Pic,Height);
				}
				
				$("#imgiframe").attr("src","../imgiframe.php");
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
var wideheight;
function RePic(a,b){
	$("#box").css("background-image","url(../../"+a+")");
	$("#box").css("margin-top","0px");
	$("#box").css("height",b+"px");
	$(".scrollbasepic").css("z-index","5");
	$("#boxok").css("display","block");
	wideheight = b;
}
function RePic1(a,b){
	$("#box").css("background-image","url(../../"+a+")");
	$(".divbaseinfo").css("margin-top","0px");
	$(".divbaseinfo").css("z-index","5");	
	$(".divbaseinfo").css("height","560px");	
	$("#box").css("height",b+"px");	
	$("#boxok").css("display","block");
	wideheight = b;
}