<?session_start();
	session_unregister('userid');
    session_unregister('mynoteid');
	setcookie("usercookie");
	echo("
		<script>
			top.location.href = 'index.php';
		</script>
		");
		
?>