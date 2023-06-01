<?php

session_start();

?>
<!DOCTYPE html>

<head>
	<title>Valid User</title>
	<meta charset="utf-8" />
	<style></style>
</head>

<body>
	<?php
	//
	// Check if user is authenticated => Session variable 'username' is used for authentication

	if (isset($_SESSION["username"])) {
		print "<h2>Welcome " . $_SESSION["username"] . "!</h2>";
		$btn = "Logout";
	} else {
		print "<h2>You dont belong here!</h2>";
		$btn = "Go back";
	}
	?>

	<form method="POST" action="logout.php">
		<input type="submit" value="<?php echo $btn ?>">
	</form>


</body>

</html>