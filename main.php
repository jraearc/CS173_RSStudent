<!DOCTYPE html>
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
		<form action="login.php" method="POST">
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
