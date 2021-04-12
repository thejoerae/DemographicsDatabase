<!doctype html>
<html>
<head>
<title>CIS265-7H1</title>
</head>
<body>

<?php

	// Step 5 - Close the database
	if (mysqli_close($databaseConnection) === TRUE) {
		echo "Database connection closed.<br>";
	} else {
		echo "Database connection not closed.<br>";
	}

	?>
	
</body>
</html>
