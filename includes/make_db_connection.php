<!doctype html>
<html>
<head>
<title>CIS265-7H1</title>
</head>
<body>

<?php

	$databaseConnection = mysqli_connect($databaseHost, 
										$databaseUser, 
										$databasePassword, 
										$databaseName);

	if (mysqli_connect_errno()) {
		echo "Database connection " . $databaseConnection .
			" <strong>failed</strong>.<br>";
			echo "Connect failed (error number): " . mysqli_connect_errno() . "<br>";
			echo "Connect failed (error message): " . mysqli_connect_error() . "<br>";
			return FALSE;
	}
	

	// Step 1c - select the database

	if (mysqli_select_db($databaseConnection, $databaseName) === FALSE) {
		echo "A connection was established with the server but" .
			"not with the database.<br>";
		echo "MySQL protocol version: " . 
			mysqli_get_proto_info($databaseConnection) . "<br>";
		echo "MySQL server version: " .
			mysqli_get_server_info($databaseConnection) . "<br>";
			return FALSE;		
	}

?>

</body>
</html>
