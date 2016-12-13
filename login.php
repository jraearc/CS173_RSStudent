<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	session_start();

	$db = mysqli_connect("localhost", "root", "cs173ggez", "student_is");

	if($_SERVER["REQUEST_METHOD"] == "POST") {

		$username = mysqli_real_escape_string($db,$_POST['user']);
		$password = mysqli_real_escape_string($db,$_POST['pass']); 

		$sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

		$count = mysqli_num_rows($result);

		$sql = "SELECT * FROM user_info WHERE username = '$username'";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

		$is_approved = 0;

		if(isset($row['approved'])) {
			if($row['approved']) {
				$is_approved = 1;
			}
		}

		if($is_approved) {
			if($count == 1) {
				$_SESSION["userlogin"] = $username;
				header("location: home.php");
			}
		}
		else if($count == 0) {
			die(header("location:login.php?loginFailed=true&reason=password"));
		}
		else {
			die(header("location:login.php?loginFailed=true&reason=notapproved"));
		}
    }

?>

<html>

<head>
  <title>UP RS | Student | Login</title>
  <link rel="stylesheet" type="text/css" href="pagestyles.css">
  <link rel="shortcut icon" href="uplogo.png">
</head>

<body>
	<div id="wrapper">
		<div id="head">
			<h1>
				<img src="uplogo.png" width="128" height="128">
				<br>Student Portal
			</h1>
		</div>
		<div id="loginfrm">
		<p><b>Login to your account</b><br><br></p>
		<?php
		if (isset($_GET["loginFailed"]) && isset($_GET["reason"])) {
			if($_GET["reason"] == "password") echo "<div id=\"errormsg\">Wrong username or password</div>";
			else if($_GET["reason"] == "notapproved") echo "<div id=\"successmsg\">Account pending approval, please contact OUR</div>";
		}
		?>
		<form action="" method="POST">
			<p>
				<label>Username<br><br></label>
				<input type="text" id="user" name="user" required>
			</p>
			<p>
				<label>Password<br><br></label>
				<input type="password" id="pass" name="pass" required>
			</p>
			<p>
				<br>
				<input type="submit" id="clickbtn" value="Login">
			</p>
		</form>
		</div>
		<div id="createacct">
			<a href="createaccount.php">Create a new account</a>
		</div>
		<div id="footer">
			Copyright (c) 2016 CS173 Productions. All rights reserved.
		</div>
	</div>
</body>

</html>