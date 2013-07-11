// window 크기가 1462보다 작으면 Tap메뉴 왼쪽으로 튀어나오게 ~

function win_check() {

	wid = $(window).width()
	
	if ( wid < 1462 ) {
		
		$("#header > .Tap > .invite-party > .win-party").css("left","-240px");
		$("#header > .Tap > .setting > .win-setting").css("left","-81px");
		$("#header > .Tap > .invite-member > .win-member").css("left","-240px");
		
	} else {
		
		$("#header > .Tap > .invite-party > .win-party").css("left","36px");
		$("#header > .Tap > .setting > .win-setting").css("left","36px");
		$("#header > .Tap > .invite-member > .win-member").css("left","36px");
		
	}
	
}
	
$(document).ready(function(e) { // 초기 새로고침시
    
	win_check();
	
});

$(window).resize(function(e) { // 윈도우가 resize 될시
	
	win_check();
	
});