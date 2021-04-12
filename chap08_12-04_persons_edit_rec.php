<?php
	$pageTitle = "Edit A Record (Confirmation) - Persons";
?>	
<!doctype html>
<html>
<head>
<title>CIS265-7H1</title>
	<link rel="stylesheet" type="text/css" href="./styles/styles.css">
<!--
	Name: Joe Rae
	Project Creation Date: December 7, 2019
	Overview: This page will create a list of all of the records entered into the Persons table, and print that out into an HTML table for the user. The user can then make an edit to a record or delete a record.
-->	
</head>
<body>
<?php
	echo "<h1>" . $pageTitle . "</h1>";

	require_once("./includes/chap08_12-04_persons_credentials.php");
	require_once("./includes/make_db_connection.php");

	// Step 2 - Build the SQL statement.
	$sql = "select * from Persons;";

	echo "<p>For debugging..." . $sql . "</p>";

	// Step 3 - Process the SQL result.
	$sql = mysqli_query($databaseConnection, $sql);
	if ($sql === FALSE) {
		echo "<p>Sorry, but no records were found.</p>";
	} else {
		echo "<p>Number of records found in Persons: " 
			. mysqli_num_rows($sql) . "</p>";
		echo "<table>";
		echo "<tr>";
		echo "<th>Person ID</th>";
		echo "<th>Last Name</th>";
		echo "<th>First Name</th>";
		echo "<th>Age</th>";
		echo "<th>Edit</th>";
		echo "<th>Delete</th>";
		echo "</tr>";

		// Output the records in the resultset, one at a time,
		// one per row in the table.
		$toggleRowColor = TRUE;
		while ($row = mysqli_fetch_assoc($sql)) {
			if ($toggleRowColor == TRUE) {
				echo "<tr class=\"oddRow\">";
				$toggleRowColor = FALSE;
			} else {
				echo "<tr class=\"evenRow\">";
				$toggleRowColor = TRUE;
			}
			echo "<td>" . $row["PersonID"] . "</td>";
			echo "<td>" . $row["LastName"] . "</td>";
			echo "<td>" . $row["FirstName"] . "</td>";
			if (($row["Age"] >= 30) && ($row["Age"] <=39)) {
				echo "<td class =\"specialAge\">" . $row["Age"] . "</td>";
			} else {
				echo "<td>" . $row["Age"] . "</td>";
			}
			echo "<td><a href=\"chap08_12-04_persons_edit_rec_handler.php?idToEdit=" .
				$row["PersonID"] . "\">edit</a></td>";
			echo "<td><a href=\"chap08_12-04_persons_delete_rec_handler.php?idToDelete=" . 
				$row["PersonID"] . "\">delete</a></td>";
			echo "</tr>";
	}
		echo "</table>";
	}
	
	// Step 4 = Release the query results.
	// Note: This is not needed for INSERT, UPDATE, and DELETE queries	
	mysqli_free_result($sql);

	require_once("./includes/close_db_connection.php");
?>
	<p><a href="chap08_12-04_persons_main_menu.php">Return to main menu.</a></p>

</body>
</html>
