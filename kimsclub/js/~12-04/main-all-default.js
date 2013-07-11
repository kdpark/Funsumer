// JavaScript Document

var rankname1v;

	function rankname1off() {
		rankname1v = setTimeout(rankname1f,200);			// 1. 이름에서 mouseout 시에 실행
	}
	
		function rankname1f() {
			$("#rankname1-pop").css("display","none");		// 2. setTimeout에서 걸린 함수
		}
		
	function rankname1offdelete() {						// 3. 오른쪽 문구에 mouseover 시에 setTimeout 함수 제거.
		clearTimeout(rankname1v);
	}
	
$(document).ready(function() {
	
	$("#rankname1").mouseover(function() {
		$("#rankname1-pop").css("display","block");			// 0. 초기 rankname으로 진입 시 css변경.
	});
	$("#rankname1-pop").mouseout(function() {
        $("#rankname1-pop").css("display","none");			// 4. 오른쪽 문구에서 mouseout 시에 실행
    });

});
	
var rankname2v;

	function rankname2off() {
		rankname2v = setTimeout(rankname2f,200);
	}
	
		function rankname2f() {
			$("#rankname2-pop").css("display","none");
		}
	
	function rankname2offdelete() {
		clearTimeout(rankname2v);
	}
	
$(document).ready(function() {
	
	$("#rankname2").mouseover(function() {
		$("#rankname2-pop").css("display","block");
	});
	$("#rankname2-pop").mouseout(function() {
        $("#rankname2-pop").css("display","none");
    });

});
	
var rankname3v;

	function rankname3off() {
		rankname3v = setTimeout(rankname3f,200);
	}
	
		function rankname3f() {
			$("#rankname3-pop").css("display","none");
		}
	
	function rankname3offdelete() {
		clearTimeout(rankname3v);
	}
	
$(document).ready(function() {
	
	$("#rankname3").mouseover(function() {
		$("#rankname3-pop").css("display","block");
	});
	$("#rankname3-pop").mouseout(function() {
        $("#rankname3-pop").css("display","none");
    });

});
	
	// rank부분 이름 over시에 공유문구 뜨는 스크립트
	
$(document).ready(function() {
	$("#container-party-rank-listbutton").click(function() {
        $("#container-party-rank-addview").css("display","block");
    });
	$("#container-party-rank-addview-close").click(function() {
        $("#container-party-rank-addview").css("display","none");
    });
});