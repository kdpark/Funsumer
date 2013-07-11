
        <link rel="stylesheet" type="text/css" href="../css/wassup/main-wassup-board-default.css">
        <script src="../js/placeholder.js"></script>
        <script src="../js/main-board.js"></script>
        <script language="javascript">
		var offbefore=0;
		var onoffwho = 0;
		function OnOfflike(ind){
			if(document.getElementById('likemembers_'+ind).style.display=='none'){
				document.getElementById('likemembers_'+offbefore).style.display='none';
				document.getElementById('likemembers_'+ind).style.display='block';
				offbefore=ind;
			}
			else{
				document.getElementById('likemembers_'+ind).style.display='none';
			}
		}
		
		function menu_overout(value,ind){
			if(ind==0){	//MouseOver
				if(value==0){	//LeftButton
					if(onoffwho==0){
						document.getElementById('menu_button_L').setAttribute("src","../images/main-wassup-menu1over.png");
					}
				}
				else{			//RightButton
					document.getElementById('menu_button_R').setAttribute("src","../images/main-wassup-menu2over.png");
				}
			}
			else{		//MouseOut
				if(value==0){	//LeftButton
					if(onoffwho==0){
						document.getElementById('menu_button_L').setAttribute("src","../images/main-wassup-menu1.png");
					}
				}
				else{			//RightButton
					document.getElementById('menu_button_R').setAttribute("src","../images/main-wassup-menu2.png");
				}
			}
		}
		
		function onoffWho(){
			if(onoffwho==0){
				document.getElementById('menu_button_L').setAttribute('src','../images/main-wassup-menu1click.png');
				onoffwho=1;
				document.getElementById('whoWin').style.display='block';
			}
			else{
				document.getElementById('menu_button_L').setAttribute('src','../images/main-wassup-menu1.png');
				onoffwho=0;
				document.getElementById('whoWin').style.display='none';
			}
		}
		
		</script>
        <!--[if IE 9]>
        <link rel="stylesheet" type="text/css" href="css/main-wassup-IE9.css">
        <![endif]-->
        
												        <!--// IE7 미만-->        
        <!--[if  lt IE 7]>
        <link rel="stylesheet" type="text/css" href="css/main-all-IE6.css">
        <meta http-equiv="refresh" content="0;URL=http://localhost/error-ie6.php">
        <![endif]-->

<div class="boardoutline pie">

<div class="boardpage">

    <div class="left">
    
        <div class="owner">
            
            <div class="name">
            </div>
            
            <div class="im">
            	<div class="pic">
                	<img src="<? echo '../'.$me[profilepic] ?>" width="111" height="111" alt="" >
                </div>
                <div class="frame">
                	<img src="../images/main-wassup-frame.png" class="pie" alt="" onclick="location.href='main-note.php'" style="cursor:pointer;">
                    
                    <div class="menu">
                        <img id="menu_button_L" style="cursor:pointer;" src="../images/main-wassup-menu1.png" alt="" class="floatL" onmouseover="menu_overout(0,0);" onmouseout="menu_overout(0,1)" onclick="onoffWho();">
                        <img id="menu_button_R" style="cursor:pointer;" src="../images/main-wassup-menu2.png" alt="" class="floatR" onmouseover="menu_overout(1,0);" onmouseout="menu_overout(1,1)" onclick="post_to_url('FriendPage.php',{'mynoteid':me[4]});">
                        
                        <div id="whoWin" class="whoWIN">
                            <img src="../images/main-wassup-whoWIN.png" alt="">
                            
                            <div class="title">
                            	who is this?
                            </div>
                            
                            <div class="explain">이 친구들을 아시나요?<br>다양한 친구와 파티하세요!
                            </div>
                            
                            <div class="contents">
                            	<div id="rank_0" class="user">
                                	<img id="rpic_0" src="" class="pie" alt="">
                                    <div id="rname_0" class="name">
                                    	
                                    </div>
                                </div>
                            	<div id="rank_1" class="user">
                                	<img id="rpic_1" src="" class="pie" alt="">
                                    <div id="rname_1" class="name">
                                    	
                                    </div>
                                </div>
                            	<div id="rank_2" class="user">
                                	<img id="rpic_2" src="" class="pie" alt="">
                                    <div id="rname_2" class="name">
                                    	
                                    </div>
                                </div>
                            	<div id="rank_3" class="user">
                                	<img id="rpic_3" src="" class="pie" alt="">
                                    <div id="rname_3" class="name">
                                    	
                                    </div>
                                </div>
                            	<div id="rank_4" class="user">
                                	<img id="rpic_4" src="" class="pie" alt="">
                                    <div id="rname_4" class="name">
                                    	
                                    </div>
                                </div>
                            	<div id="rank_5" class="user">
                                	<img id="rpic_5" src="" class="pie" alt="">
                                    <div id="rname_5" class="name">
                                    	
                                    </div>
                                </div>
                            	<div id="rank_6" class="user">
                                	<img id="rpic_6" src="" class="pie" alt="">
                                    <div id="rname_6" class="name">
                                    	
                                    </div>
                                </div>                                
                            </div> <!--// contents -->
                            
                        </div> <!--// whoWIN -->
                        
                    </div> <!--// menu -->
                    
                </div> <!--// frame -->
                
            </div> <!--// im -->
            
        </div> <!--// owner -->
<div style="width:210px;height:650px;float:left;position:relative;">
  <div id="preview_article" class="preview">
  
        <div id="pre_num" class="preview-number">
        01
        </div>
    
    	<div class="preview-top">
        	<a onClick="preview_button_click(0);" onMouseOut="imgre()" onMouseOver="imgchg('preview-top','','../images/main-board-previewtop-over.png',0)" onFocus="blur()"><img src="../images/main-board-previewtop.png" width="111" height="15" id="preview-top" alt=""></a>
        </div>
        
        <div id="pre_0" class="preview-contents">
       	  <img src="" width="105" height="75" alt="">
        </div>
            
        <div id="pre_1" class="preview-contents">
       	  <img src="" width="105" height="75" alt="">
        </div>
            
        <div id="pre_2" class="preview-contents">
       	  <img src="" width="105" height="75" alt="">
        </div>
            
        <div id="pre_3" class="preview-contents">
       	  <img src="" width="105" height="75" alt="">
        </div>
            
        <div id="pre_4" class="preview-contents">
       	  <img src="" width="105" height="75" alt="">
        </div>
            
        <div id="pre_5" class="preview-contents">
       	  <img src="" width="105" height="75" alt="">
        </div>
            
    <div class="preview-bottom">
        	<a  onClick="preview_button_click(1);"onMouseOut="imgre()" onMouseOver="imgchg('preview-bottom','','../images/main-board-previewbottom-over.png',0)" onFocus="blur()"><img src="../images/main-board-previewbottom.png" width="111" height="15" id="preview-bottom" alt=""></a>
        </div>
        
  </div> <!--// preview -->
  </div>
        
    </div> <!--// left -->
    
	<div id="board" class="board">
                
	</div> <!--// board -->

</div> <!--// boardpage -->

	<div class="boardoutline-bottomdiv"><img src="../images/main-all-bottombar.png" width="844" alt=""></div>

</div> <!--// boardoutline -->

<div class="copyright">
  <p><a style="cursor:pointer;" onclick="location.href='copyright-readpage1.php'" onFocus="blur()">서비스 이용약관</a> │ <a style="cursor:pointer;" onclick="loation.href'copryright-readpage2.php'" onFocus="blur()">개인정보/청소년보호정책</a> │ 광고문의 │ <a style="cursor:pointer;" onclick="location.href='customer_info.php'">펀슈머 고객센터</a></p>
  <p style="font-family:Arial, Helvetica, sans-serif;letter-spacing:0;">Copyright&nbsp; &copy; <a style="color:#FF3E43" href="#">Funsumer</a> All rights reserved</p>
</div>