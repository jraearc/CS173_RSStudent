<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	session_start();

	$db = mysqli_connect("localhost", "root", "cs173ggez", "student_is");

	if($_SERVER["REQUEST_METHOD"] == "POST") {

		$username = $_POST['ureg'];
		$studentnumber = $_POST['snumber'];
		$course = $_POST['course'];
		$firstname = $_POST['firstname'];
		$middlename = $_POST['midname'];
		$surname = $_POST['lastname'];
		$college = $_POST['college'];
		$pass1 = $_POST['pass1'];
		$pass2 = $_POST['pass2'];

		if($pass1 != $pass2) {
			die(header("location:createaccount.php?regFailed=true&reason=passmismatch"));
		}

		$sql = "SELECT * FROM users WHERE username = '$username'";
		$result = mysqli_query($db, $sql);

		if(mysqli_num_rows($result) > 0) {
			die(header("location:createaccount.php?regFailed=true&reason=accounttaken"));
		}

		$sql = "INSERT INTO users (username, password) VALUES ('$username', '$pass1')";
		$sql2 = "INSERT INTO user_info (username, firstname, middlename, lastname, studentnumber, bracket, degreeprog, college, is_student, is_enrolled, approved) VALUES ('$username','$firstname','$middlename','$surname',$studentnumber,'A','$course','$college',1,0,0)";
		
		if(mysqli_query($db,$sql)) {
			if(mysqli_query($db,$sql2)) header("location: login.php");
		}

		else {
			die(header("location:createaccount.php?regFailed=true&reason=dataerror"));
		}
    }
?>

<!DOCTYPE html>
<html>

<head>
  <title>UP RS | Student | Create Account</title>
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
		<div id="returnlogin">
			<a href="login.php">Return to login page</a>
		</div>
		<div id="userreg">
			<p><b>Note: Account creation is subject to admin approval.</b></p>
			<?php
			if (isset($_GET["regFailed"]) && isset($_GET["reason"])) {
				if($_GET["reason"] == "passmismatch") echo "<div id=\"errormsg\">Password mismatch</div>";
				else if($_GET["reason"] == "dataerror") echo "<div id=\"errormsg\">Database error</div>";
				else if($_GET["reason"] == "accounttaken") echo "<div id=\"errormsg\">Username already taken</div>";
			}
			?>
			<form action="createaccount.php" method="POST">
				<table class="accountcreation">
					<tr>
						<td>Username:</td>
						<td><input type="text" id="ureg" name="ureg" required></td>
						<td>Student No.:</td>
						<td><input type="text" id="snumber" name="snumber" required></td>
						<td>Course:</td>
						<td><input type="text" id="course" name="course" required></td>
					</tr>
					<tr>
						<td>First Name:</td>
						<td><input type="text" id="firstname" name="firstname" required></td>
						<td>Middle Name:</td>
						<td><input type="text" id="midname" name="midname" required></td>
						<td>Surname:</td>
						<td><input type="text" id="lastname" name="lastname" required></td>
					</tr>
					<tr>
						<td>College:</td>
						<td>
						<select class="college" name="college" id="college">
							<option value="Engineering">Engineering</option>
							<option value="Virata School of Business">Virata School of Business</option>
							<option value="Science">Science</option>
							<option value="Economics">Economics</option>
							<option value="Architecture">Architecture</option>
							<option value="Fine Arts">Fine Arts</option>
							<option value="Music">Music</option>
							<option value="Arts and Letters">Arts and Letters</option>
							<option value="Social Sciences and Philosophy">Social Sciences and Philosophy</option>
							<option value="Social Work and Community Development">Social Work and Community Development</option>
							<option value="Asian Center">Asian Center</option>
							<option value="School of Statistics">School of Statistics</option>
							<option value="Education">Education</option>
							<option value="Law">Law</option>
							<option value="National College of Public Administration and Governance">NCPAG</option>
							<option value="Home Economics">Home Economics</option>
							<option value="Human Kinetics">Human Kinetics</option>
						</select>
						</td>
						<td>Password:</td>
						<td><input type="password" id="pass1" name="pass1" required></td>
						<td>Repeat password:</td>
						<td><input type="password" id="pass2" name="pass2" required></td>
					</tr>
				</table>
				<p><input type="submit" id="submitaccount" name="submitaccount" value="Submit"></p>
			</form>
		</div>
		<div id="footer">
			Copyright (c) 2016 CS173 Productions. All rights reserved.
		</div>
	</div>
</body>

</html>
