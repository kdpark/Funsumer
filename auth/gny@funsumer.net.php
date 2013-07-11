<? include "../dbconn.php";
						$sql = "update member set auth='Y' where email='$var'";
						mysql_query($sql, $connect);
						mysql_close();						
						echo(" <script> top.location.href='../main.php'; </script> ");
			 ?>