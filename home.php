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
			<i>Logged in as user.</i>
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
					<p><b>Welcome user!</b></p>
					<table class="accountstatus">
						<tr>
							<td>Student No.:</td>
							<td>201600000</td>
						</tr>
						<tr>
							<td>Registration Status:</td>
							<td>Enrolled</td>
						</tr>
						<tr>
							<td>Accountabilities:</td>
							<td>None</td>
						</tr>
						<tr>
							<td>ST Bracket:</td>
							<td>No Discount</td>
						</tr>
						<tr>
							<td>Scholarships:</td>
							<td>None</td>
						</tr>
						<tr>
							<td>Grade Notifications:</td>
							<td>None</td>
						</tr>
					</table>
				</div>
			</article>
		</div>
		<div id="footer">
			Copyright (c) 2016 CS173 Productions. All rights reserved.
		</div>
		<?php if(isset($_GET["action"]) == "logout") header("location: login.php"); ?>
	</div>
</body>

</html>
