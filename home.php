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

	$sql = "SELECT * FROM user_info WHERE username = '$current_user'";
	$result = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

	$firstname = $row['firstname'];
	$middlename = $row['middlename'];
	$lastname = $row['lastname'];
	$studentnumber = $row['studentnumber'];
	$bracket = $row['bracket'];
	$degreeprog = $row['degreeprog'];
	$college = $row['college'];
	$is_student = $row['is_student'];
	$is_enrolled = $row['is_enrolled'];

	mysqli_free_result($result);
	mysqli_close($db);
?>


<!DOCTYPE html>
<html>

<head>
  <title>UP RS | Student | Home</title>
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
					<li><b><a href="home.php">Home</a></b></li>
					<li><a href="announcements.php">Announcements</a></li>
					<li><a href="enlist.php">Enrollment</a></li>
					<li><a href="grades.php">Grades</a></li>
				</ul>
				</div>
			</nav>
			<article>
				<div id="homepage">
					<?php echo "<p><b>Welcome $firstname $middlename $lastname!</b></p>"; ?>
					<table class="accountstatus">
						<tr>
							<th>Student No.:</th>
							<?php echo "<td>$studentnumber</td>" ?>
						</tr>
						<tr>
							<th>Degree Program:</th>
							<?php echo "<td>$degreeprog</td>" ?>
						</tr>
						<tr>
							<th>College:</th>
							<?php echo "<td>$college</td>" ?>
						</tr>
						<tr>
							<th>Registration Status:</th>
							<?php
							if($is_enrolled == 1) echo "<td>Enrolled</td>";
							else echo "<td>Not Enrolled</td>"; ?>
						</tr>
						<tr>
							<th>Accountabilities:</th>
							<td>None</td>
						</tr>
						<tr>
							<th>ST Bracket:</th>
							<?php
							if(!strcmp($bracket,"A")) echo "<td>No Discount</td>";
							else if(!strcmp($bracket, "B")) echo "<td>Partial Discount - 33%</td>";
							else if(!strcmp($bracket, "C")) echo "<td>Partial Discount - 60%</td>";
							else if(!strcmp($bracket, "D")) echo "<td>Partial Discount - 80%</td>";
							else if(!strcmp($bracket, "E")) echo "<td>Full Discount</td>"; ?>
						</tr>
					</table>
				</div>
			</article>
		</div>
		<div id="footer">
			Copyright (c) 2016 CS173 Productions. All rights reserved.
		</div>
		<?php 
		if(isset($_GET["action"])) {
			if(!strcmp($_GET["action"],"logout")) {
				session_unset();
				session_destroy();
				header("location: login.php");
			}
		}
		?>
	</div>
</body>

</html>
