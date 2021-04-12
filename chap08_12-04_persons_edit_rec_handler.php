<?php
	$pageTitle = "Edit A Record - Persons (confirmation)";
?>
<!doctype html>
<html>
<head>
<title>CIS265-7H1</title>
<!--
	Name: Joe Rae
	Project Creation Date: December 7, 2019
	Overview: The idToEdit value is passed into this form, a SQL statement is generated using that idToEdit, then the information is displayed to the user. The user can then go ahead and make any changes to the record, and either save the edited reocrd or opt to cancel if they do not want to make a change.	
-->
</head>

<body>
	<?php
	function displayConfirmationForm($idToEdit) {
		require_once("./includes/chap08_12-04_persons_credentials.php");
		require_once("./includes/make_db_connection.php");	
		
		// Step 2 - Build the SQL statement.
		$sql = "SELECT * FROM Persons ";
		$sql .= "WHERE PersonID = ";
		$sql .= $idToEdit;
		$sql .= " LIMIT 1";

		echo "<p>For debugging..." . $sql . "</p>";

		// Step 3 - Process the SQL result.
		$sql = mysqli_query($databaseConnection, $sql);
		$row = mysqli_fetch_assoc($sql);
	?>
		<form action="chap08_12-04_persons_edit_rec_handler.php" method="post">
	<?php 		
		echo "<p>The '*' denotes a read-only field. Make your desired edits below:</p>";
		echo "Person ID : " . $row["PersonID"] . " *<br>";
		echo "Last Name : <input name=\"LastName\" id=\"LastName\" type=\"text\" value=\"" . $row["LastName"] . "\" required><br>";
		echo "First Name : <input name=\"FirstName\" id=\"v\" type=\"text\" value=\"" . $row["FirstName"] . "\" required><br>";
		echo "Age : <input name=\"Age\" id=\"Age\" type=\"number\" min=18 value=\"" . $row["Age"] . "\"><br>";
		echo "<p>Do you want to save changes to the above record?</p>";
	?>
		<input type="hidden" name="idToEdit" id="idToEdit" value=<?php echo $idToEdit; ?>>
		<input type="submit" name="editButton" id="editButton" value="Yes">
		<input type="submit" name="editButton" id="editButton" value="No"><br><br>
		</form>	

		<?php
			// Step 4 - Release the query results.
			// Note: This is not needed for INSERT, UPDATE, and DELETE queries
			mysqli_free_result($sql);

			require_once("./includes/close_db_connection.php");
		}
	?>

	<?php
	function performRecordEdit($idToEdit) {
		require_once("./includes/chap08_12-04_persons_credentials.php");
		require_once("./includes/make_db_connection.php");	

		// Step 2 - Build the SQL statement.
		$sql = "UPDATE Persons ";
		$sql .= "SET LastName = \"" . $_POST["LastName"] . "\", ";
		$sql .= "FirstName = \"" . $_POST["FirstName"] . "\", ";
		$sql .= "Age = " . $_POST["Age"] . " ";
		$sql .= "WHERE PersonID = ";
		$sql .= $idToEdit;
		$sql .= " LIMIT 1";

		echo "<p>For debugging..." . $sql . "</p>";

		// Step 3 - Process the SQL result.
		$sql = mysqli_query($databaseConnection, $sql);

		// Step 4 - Release the query results.
		// Note: This is not needed for INSERT, UPDATE, and DELETE queries		
		// require_once("./includes/close_db_connection.php");

		require_once("./includes/close_db_connection.php");

		echo "<p>The record was edited.</p>";
	}

	echo "<h1>" . $pageTitle . "</h1>";

	// At this point, the PersonID has been submitted to this program.
	// A confirmation is needed for the edit to occur, so either
	// present the confirmation form or, if already confirmed, proceed
	// with the record edit.
	$idToEdit = "";
	$proceedWithEdit = "";
	if (isset($_GET["idToEdit"])) {
		$idToEdit = $_GET["idToEdit"];		
	}

	if (isset($_POST["editButton"])) {
		$proceedWithEdit = $_POST["editButton"];
		$idToEdit = $_POST["idToEdit"];
		if ($proceedWithEdit == "No") {
			echo "<p>The record was not edited / saved.</p>";
		} else {
			performRecordEdit($idToEdit);
		}
	} else {
		displayConfirmationForm($idToEdit);
	}	

?>
	<p><a href="chap08_12-04_persons_main_menu.php">Return to main menu.</a></p>
</body>
</html>
