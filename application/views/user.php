<?php
	$servername = "localhost";
    $username = "root";
    $password = "root";
    $database = "xiphias";
	$conn = new mysqli($servername,$username,$password,$database);
	
	$db_table = $_REQUEST["table"];
	$text = $_REQUEST["text"];
	$sql = "SELECT * FROM user WHERE " . $db_table . " = '" . $text . "'";
	$table = $conn->query($sql);
	
	if($table->num_rows > 0)
		echo "igwa na";
	else
		echo "mayo pa";
	
	$conn->close();
?>