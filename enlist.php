<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	session_start();

	if(isset($_GET["action"])) {
		if(!strcmp($_GET["action"],"logout")) {
			session_unset();
			session_destroy();
			header("location: login.php");
		}
	}

	$db = mysqli_connect("localhost", "root", "cs173ggez", "student_is");

	if(!isset($_SESSION["userlogin"])) {
		header("location: login.php");
	}
	else {
		$current_user = $_SESSION["userlogin"];
	}

	if($_SERVER["REQUEST_METHOD"] == "POST") {

		$searchstring = $_POST['coursename'];

    }

	$sql = "SELECT * FROM user_info WHERE username = '$current_user'";

	$result = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	$curr_user_id = $row['id'];

	mysqli_free_result($result);

	$sql = "SELECT * FROM enlistment WHERE uid = $curr_user_id";
	$result = mysqli_query($db,$sql);
?>


<!DOCTYPE html>
<html>

<head>
  <title>UP RS | Student | Enrollment</title>
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
				<li><b><a href="enlist.php">Enrollment</a></b></li>
				<li><a href="grades.php">Grades</a></li>
			</ul>
			</div>
		</nav>
		<article>
			<div id="homepage">
				<p><b>Enrollment</b></p>
				<hr>
				<p>Enlisted Courses</p>
				<table class="schedule">
					<tr>
						<th>Course Name</th>
						<th>Room</th>
						<th>Schedule</th>
						<th>Approved?</th>
					</tr>
					<?php

/*					if(isset($_GET['action'])) {
						if(!strcmp($_GET['action'], "enlist")) {
							if(isset($_GET['courseid'])) {
								$cid = $_GET['courseid'];
								$conquery = "SELECT * FROM course_schedules WHERE course_id = $cid";
								$conres = mysqli_query($db, $conquery);

								while($conrow = mysqli_fetch_array($conres, MYSQLI_ASSOC)) {
									$testday = $conrow['day_of_week'];
									$teststart = $conrow['schedule_start'];
									$testend = $conrow['schedule_end'];
									$enlistquery = "SELECT * FROM enlistment WHERE uid = $curr_user_id";
									$enlistres = mysqli_query($db, $enlistquery);
									while($enrow = mysqli_fetch_array($enlistres, MYSQLI_ASSOC))) {
										$currcid = $enrow['course_id'];
										$schedquery = "SELECT * FROM course_schedules WHERE course_id = $currcid";
										$schedres = mysqli_query($db, $schedquery);
										while($schedrow = mysqli_fetch_array($schedres, MYSQLI_ASSOC)) {

										}
									}
								}
							}
						}
					}*/

					while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
						echo "<tr>";
						$courseid = $row['courseid'];
						$sql2 = "SELECT * FROM courses WHERE id = $courseid";
						$result2 = mysqli_query($db, $sql2);
						$row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
						$title = $row2['title'];
						$room = $row2['room'];
						$approved = $row['approved'];
						echo "<td>$title</td>";
						echo "<td>$room</td>";
						$sql3 = "SELECT * FROM course_schedules WHERE course_id = $courseid";
						mysqli_free_result($result2);
						$result2 = mysqli_query($db, $sql3);
						echo "<td>";
						while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)) {
							$day = $row2['day_of_week'];
							$strtimestart = $row2['schedule_start'];
							$strtimeend = $row2['schedule_end'];
							$timestart = strtotime($strtimestart);
							$timeend = strtotime($strtimeend);
							echo "$day " . date("h:ia", $timestart) . "-" . date("h:ia", $timeend) . "<br>";
						}
						echo "</td>";
						if($approved) echo "<td>Yes</td>";
						else echo "<td>No | <a href=\"?action=deletefromlist&courseid=$courseid\">Delete</a></td>";
						echo "</tr>";
					}
					if(mysqli_num_rows($result) == 0) echo "<tr><td colspan=4>No courses enlisted</td></tr>";

					if(mysqli_num_rows($result) > 0) {
						$result = mysqli_query($db,$sql);

						$schedarr = array();

						while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
							$courseid = $row['courseid'];
							$sql2 = "SELECT * FROM courses WHERE id = $courseid";
							$result2 = mysqli_query($db, $sql2);
							$row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
							$title = $row2['title'];
							$room = $row2['room'];
							$approved = $row['approved'];
							$sql3 = "SELECT * FROM course_schedules WHERE course_id = $courseid";
							$result2 = mysqli_query($db, $sql3);
							while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)) {
								$day = $row2['day_of_week'];
								$iday = -1;
								if($day == 'S') $iday = 0;
								if($day == 'M') $iday = 1;
								if($day == 'T') $iday = 2;
								if($day == 'W') $iday = 3;
								if($day == 'H') $iday = 4;
								if($day == 'F') $iday = 5;
								if($day == 'A') $iday = 6;
								$strtimestart = $row2['schedule_start'];
								$strtimeend = $row2['schedule_end'];
								$timestart = strtotime($strtimestart);
								$timeend = strtotime($strtimeend);
								$hourstart = idate('H', $timestart);
								$hourend = idate('H', $timeend);
								$minstart = idate('i', $timestart);
								$minend = idate('i', $timeend);
								$inttstart = ($hourstart*100) + $minstart;
								$inttend = ($hourend*100) + $minend;
								$hr1 = 700;
								$hr2 = 730;							
								for($i = 0; $i < 28; $i++) {
									if($hr1 >= $inttstart and $hr2 <= $inttend) 
										$schedarr[$i][$iday] = "<td>" . $title . "</td>";
									$hr1 = $hr1 + 30;
									if($hr1 % 100 == 60) $hr1 = $hr1 + 40;
									$hr2 = $hr2 + 30;
									if($hr2 % 100 == 60) $hr2 = $hr2 + 40;
								}
							}
							for($i = 0; $i < 28; $i++) {
								for($j = 0; $j < 7; $j++) {
									if(!isset($schedarr[$i][$j])) $schedarr[$i][$j] = "<td></td>";
								}
							}
						}
					}
					else {
						for($i = 0; $i < 28; $i++) {
							for($j = 0; $j < 7; $j++) {
								$schedarr[$i][$j] = "<td></td>";
							}
						}
					}
					?>
				</table>
				<hr>
				<p>My Schedule</p>
				<table class="schedule">
						<tr>
							<th>Time</th>
							<th>Sun</th>
							<th>Mon</th>
							<th>Tue</th>
							<th>Wed</th>
							<th>Thu</th>
							<th>Fri</th>
							<th>Sat</th>
						</tr>
						<tr>
							<th>7:00 - 7:30 AM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[0][$i];
							}
							?>
						</tr>
						<tr>
							<th>7:30 - 8:00 AM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[1][$i];
							}
							?>
						</tr>
						<tr>
							<th>8:00 - 8:30 AM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[2][$i];
							}
							?>
						</tr>
						<tr>
							<th>8:30 - 9:00 AM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[3][$i];
							}
							?>
						</tr>
						<tr>
							<th>9:00 - 9:30 AM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[4][$i];
							}
							?>
						</tr>
						<tr>
							<th>9:30 - 10:00 AM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[5][$i];
							}
							?>
						</tr>
						<tr>
							<th>10:00 - 10:30 AM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[6][$i];
							}
							?>
						</tr>
						<tr>
							<th>10:30 - 11:00 AM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[7][$i];
							}
							?>
						</tr>
						<tr>
							<th>11:00 - 11:30 AM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[8][$i];
							}
							?>
						</tr>
						<tr>
							<th>11:30 AM - 12:00 PM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[9][$i];
							}
							?>
						</tr>
						<tr>
							<th>12:00 - 12:30 PM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[10][$i];
							}
							?>
						</tr>
						<tr>
							<th>12:30 - 1:00 PM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[11][$i];
							}
							?>
						</tr>
						<tr>
							<th>1:00 - 1:30 PM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[12][$i];
							}
							?>
						</tr>
						<tr>
							<th>1:30 - 2:00 PM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[13][$i];
							}
							?>
						</tr>
						<tr>
							<th>2:00 - 2:30 PM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[14][$i];
							}
							?>
						</tr>
						<tr>
							<th>2:30 - 3:00 PM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[15][$i];
							}
							?>
						</tr>
						<tr>
							<th>3:00 - 3:30 PM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[16][$i];
							}
							?>
						</tr>
						<tr>
							<th>3:30 - 4:00 PM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[17][$i];
							}
							?>
						</tr>
						<tr>
							<th>4:00 - 4:30 PM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[18][$i];
							}
							?>
						</tr>
						<tr>
							<th>4:30 - 5:00 PM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[19][$i];
							}
							?>
						</tr>
						<tr>
							<th>5:00 - 5:30 PM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[20][$i];
							}
							?>
						</tr>
						<tr>
							<th>5:30 - 6:00 PM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[21][$i];
							}
							?>
						</tr>
						<tr>
							<th>6:00 - 6:30 PM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[22][$i];
							}
							?>
						</tr>
						<tr>
							<th>6:30 - 7:00 PM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[23][$i];
							}
							?>
						</tr>
						<tr>
							<th>7:00 - 7:30 PM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[24][$i];
							}
							?>
						</tr>
						<tr>
							<th>7:30 - 8:00 PM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[25][$i];
							}
							?>
						</tr>
						<tr>
							<th>8:00 - 8:30 PM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[26][$i];
							}
							?>
						</tr>
						<tr>
							<th>8:30 - 9:00 PM</th>
							<?php
							for($i = 0; $i < 7; $i++) {
								echo $schedarr[27][$i];
							}
							?>
						</tr>
					</table>
					<hr>
					<p>Search for courses</p>
					<form action="" method="POST">
					<table class="enlistcourse">
						<tr>
							<th>Enter course name:</th>
							<td><input type="text" id="coursename" name="coursename" required></td>
							<td><input type="submit" id="searchcourse" value="Search"></td>
						</tr>
					</table>
					</form>
					<?php


					if(isset($searchstring)) {
						$sqls = "SELECT * FROM courses WHERE title LIKE '%$searchstring%'";

						$sresult = mysqli_query($db,$sqls);

						echo "<table class=\"searchres\">";
						echo "<tr><th colspan=4>Search results</th></tr>";
						while($row = mysqli_fetch_array($sresult, MYSQLI_ASSOC)) {
							$restitle = $row['title'];
							$resroom = $row['room'];
							$rescourseid = $row['id'];
							echo "<tr>";
							echo "<td>$restitle</td>";
							echo "<td>$resroom</td>";
							$sql4 = "SELECT * FROM course_schedules WHERE course_id = $rescourseid";
							$result2 = mysqli_query($db, $sql4);
							echo "<td>";
							while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)) {
								$day = $row2['day_of_week'];
								$strtimestart = $row2['schedule_start'];
								$strtimeend = $row2['schedule_end'];
								$timestart = strtotime($strtimestart);
								$timeend = strtotime($strtimeend);
								echo "$day " . date("h:ia", $timestart) . "-" . date("h:ia", $timeend) . "<br>";
							}
							echo "</td>";
							echo "<td><a href=\"?action=enlist&courseid=$rescourseid\">Enlist</a></td>";
							echo "</tr>";
						}
						if(mysqli_num_rows($sresult) == 0) echo "<tr><td colspan=4><i>No results</i></td></tr>";
						echo "</table>";
					}
					?>
			</div>
		</article>
		</div>
		<div id="footer">
			Copyright (c) 2016 CS173 Productions. All rights reserved.
		</div>
		</div>
</body>

</html>
