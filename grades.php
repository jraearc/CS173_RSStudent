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

	$sql = "SELECT * FROM users WHERE username = '$current_user'";
	$result = mysqli_query($db,$sql);

	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	$uid = $row['id'];

	$sql = "SELECT * FROM grades WHERE studentid = $uid";

	$result = mysqli_query($db,$sql);

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_POST['getgrades'])) {
			$sem = $_POST['semester'];
			$yr = $_POST['year'];
		}
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
					<tr>
					<form action="" method="POST">
					<table class="enlistcourse">
					<th>Enter semester:</th>
					<td>
					<select class="semester" name="semester" id="semester">
						<option value="1">1st</option>
						<option value="2">2nd</option>
					</select>
					</td>
					<th>Enter year:</th>
					<td>
					<select class="year" name="year" id="year">
					<?php
						$sql2 = "SELECT DISTINCT year FROM grades";
						$result2 = mysqli_query($db, $sql2);
						while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
							$ayear = $row2['year'];
							echo "<option value=\"$ayear\">$ayear - " . ($ayear+1) . "</option>";
						}
						if(mysqli_num_rows($result2) == 0)
							printf("<option value=\"%d\">%d - %d</option>", date("Y"), date("Y"), date("Y") + 1);
					?>
					</select>
					</td>
					<td><input type="submit" id="getgrades" name="getgrades" value="Display"></td>
					</tr>
					</table>
					</form>
					<?php
						echo "<table class=\"displaygrades\">";
						echo "<tr><th>Course Name</th>";
						echo "<th>Instructor</th>";
						echo "<th>Units</th>";
						echo "<th>Grade</th></tr>";
						$n_units = 0.0;
						if($_SERVER["REQUEST_METHOD"] == "POST") {
							$gwa = 0.0;
							$n_units = 0.0;
							if(isset($_POST['getgrades'])) {
								$sql2 = "SELECT * FROM grades WHERE studentid = $uid AND semester = $sem AND year = $yr";

								$result2 = mysqli_query($db,$sql2);
								if(mysqli_num_rows($result2) == 0) echo "<tr><td colspan=4><i>No grades in record</i></td></tr>";
								while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)) {
									$coid = $row2['courseid'];
									$getquery = "SELECT * FROM courses WHERE id = $coid";
									$cres = mysqli_query($db, $getquery);
									$carr = mysqli_fetch_array($cres,MYSQLI_ASSOC);
									echo "<tr>";
									$title = $carr['title'];
									$units = $carr['units'];
									$grade = $row2['grade'];
									$gwa += $units * $grade;
									$n_units += $units;
									echo "<td>$title</td>";
									$iid = $row2['instructorid'];
									$getquery = "SELECT * FROM faculty WHERE id = $iid";
									$cres = mysqli_query($db, $getquery);
									$carr = mysqli_fetch_array($cres,MYSQLI_ASSOC);
									$iidusers = $carr['uid'];
									$getquery = "SELECT * FROM user_info WHERE id = $iidusers";
									$cres = mysqli_query($db, $getquery);
									$carr = mysqli_fetch_array($cres,MYSQLI_ASSOC);
									$lname = $carr['lastname'];
									$fname = $carr['firstname'];
									echo "<td>$lname, $fname</td>";
									printf("<td>%.1f</td>", $units);
									printf("<td>%.2f</td>", $grade);
									echo "</tr>";
								}
								echo "</table>";

								if($n_units > 0.0) {
									$gwa /= $n_units;
									printf("<p><b>GWA: %.4f</b></p>", $gwa);
								}
							}
					    }
					    else {
							if(mysqli_num_rows($result) == 0) echo "<tr><td colspan=4><i>No grades in record</i></td></tr>";
							while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
								$coid = $row['courseid'];
								$getquery = "SELECT * FROM courses WHERE id = $coid";
								$cres = mysqli_query($db, $getquery);
								$carr = mysqli_fetch_array($cres,MYSQLI_ASSOC);
								echo "<tr>";
								$title = $carr['title'];
								$units = $carr['units'];
								$grade = $row['grade'];
								echo "<td>$title</td>";
								$iid = $row['instructorid'];
								$getquery = "SELECT * FROM faculty WHERE id = $iid";
								$cres = mysqli_query($db, $getquery);
								$carr = mysqli_fetch_array($cres,MYSQLI_ASSOC);
								$iidusers = $carr['uid'];
								$getquery = "SELECT * FROM user_info WHERE id = $iidusers";
								$cres = mysqli_query($db, $getquery);
								$carr = mysqli_fetch_array($cres,MYSQLI_ASSOC);
								$lname = $carr['lastname'];
								$fname = $carr['firstname'];
								echo "<td>$lname, $fname</td>";
								printf("<td>%.1f</td>", $units);
								printf("<td>%.2f</td>", $grade);
								echo "</tr>";
							}
							mysqli_free_result($result);
							mysqli_close($db);
							echo "</table>";
						}
					?>
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
