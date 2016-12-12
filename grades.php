<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	session_start();

	$db = mysqli_connect("localhost", "root", "cs173ggez", "student_is");

	if(!isset($_SESSION["userlogin"])) {
		header("location: login.php");
	}
	else {
		$current_user = $_SESSION["userlogin"];
	}
?>


<!DOCTYPE html>
<html>

<head>
  <title>UP RS | Student | Grades</title>
  <link rel="stylesheet" type="text/css" href="pagestyles.css">
  <link rel="shortcut icon" href="uplogo.png">
</head>

<body>
	<div id="wrapper">
		<div id="head2">
			<h1>
				<img src="uplogo.png" width="90" height="90">
				<br>Student Portal
			</h1>
		</div>
		<div id="userstat">
			<?php echo "<i>Logged in as $current_user.</i>"?>
			<a href="?action=logout">Log out</a>
		</div>
		<div id="defaultpage">
		<nav>
			<div id="bar">
			<ul>
				<li><a href="home.php">Home</a></li>
				<li><a href="announcements.php">Announcements</a></li>
				<li><a href="enlist.php">Enrollment</a></li>
				<li><b><a href="grades.php">Grades</a></b></li>
			</ul>
			</div>
		</nav>
		<article>
			<div id="homepage">
				<p><b>Grades</b></p>
			</div>
		</article>
		</div>
		<div id="footer">
			Copyright (c) 2016 CS173 Productions. All rights reserved.
		</div>
		<?php 
		if(isset($_GET["action"]) == "logout") {
			session_unset();
			session_destroy();
			header("location: login.php");
		}
		?>
		</div>
</body>

</html>
