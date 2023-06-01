<?php
//
// hide errors
//live applications should not show too much detailed error info 
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);

include("PDO.php");
include("MySQLI.php");

// Start session control
session_start();
//
// Present element for authentication as default
if (!empty($_REQUEST["login"])) {
	//
	// Check if correct username and password given
	$user = $_REQUEST["user"];
	$pass = $_REQUEST["pass"];

	if (strlen($pass) && strlen($user)) { // Check if username and password not empty
		//
		// Connect to the mysql database and check for user
		//$databaseConn = new PDODBIO("mysql", "localhost", "test", "test", "frest");
		$databaseConn = new mysqliDBIO("localhost", "test", "test", "frest");

		$result = $databaseConn->checkUserCredentials($user, $pass);

		// If ONE username exists with the correct password take the user further		
		if ($result != null) {

			// Create session variable "username" if authenticated user (eg. exist in db)
			$_SESSION["username"] = $user;
			//
			// Transfer logged in user to another page ==> User is logged in ... we are ready to take off!!!
			header("Location: inside.php");
		}
	} // end of empty string element check
} // end of "login" button pressed

?>
<!DOCTYPE html>

<head>
	<title>SQL Injection Test</title>
	<meta charset='utf-8' />
	<style>
	</style>
</head>

<body>
	<form method="POST" action='<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>'>
		<p>
			Användarnamn <input type="text" name="user" placeholder="Usename" /> <br />
			Lösenord <input type="password" name="pass" placeholder="Password" />
		</p>
		<p>
			<input type="submit" name="login" value="Sign In" />
		</p>
</body>

</html>