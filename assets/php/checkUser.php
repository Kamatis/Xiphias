<?php
	$servername = "localhost";
    $username = "xiphias";
    $password = "xiphias";
    $database = "xiphiasDB";
	$conn = new mysqli($servername,$username,$password,$database);
	
	$username = $_REQUEST["username"];
	$password = $_REQUEST["password"];
	$sql = "SELECT * FROM user WHERE username = '" . $username . "' AND password = md5('" . $password . "')";
	$table = $conn->query($sql);
	
	if($table->num_rows == 1)
		echo "ok";
	else
		echo "no";
?>