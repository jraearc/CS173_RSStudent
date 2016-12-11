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
			<form action="createaccount.php" method="POST">
				<table class="accountcreation">
					<tr>
						<td>Username:</td>
						<td><input type="text" id="ureg" name="ureg" required></td>
						<td>Student No.:</td>
						<td><input type="text" id="ureg" name="ureg" required></td>
						<td>Course:</td>
						<td><input type="text" id="ureg" name="ureg" required></td>
					</tr>
					<tr>
						<td>First Name:</td>
						<td><input type="text" id="firstname" name="ureg" required></td>
						<td>Middle Name:</td>
						<td><input type="text" id="midname" name="ureg" required></td>
						<td>Surname:</td>
						<td><input type="text" id="lastname" name="ureg" required></td>
					</tr>
					<tr>
						<td>College:</td>
						<td>
						<select>
							<option value="engg">Engineering</option>
							<option value="vsb">Virata School of Business</option>
							<option value="science">Science</option>
							<option value="econ">Economics</option>
						</select>
						</td>
					</tr>
				</table>
			</form>
		</div>
		<div id="footer">
			Copyright (c) 2016 CS173 Productions. All rights reserved.
		</div>
	</div>
</body>

</html>
