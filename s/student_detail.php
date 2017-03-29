<?php
	session_start();
	if(!isset($_SESSION["name"])){
        echo " <script> alert('Please Login first');
                window.location = ('adminlogins.php');</script>";
    }



?>


<html>
	<head>
		<title>Student Details</title>
		<style>
			body{
				background-color:bisque;
			}
		</style>
	</head>
	<body>
		<center>
			<h1><u>Student Details</u></h1>
			<?php
				include('connection.php');
				$sql = "select "
			?>
		</center>
	</body>
</html>