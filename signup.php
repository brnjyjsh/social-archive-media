<!DOCTYPE html>
<html>

	<head>
		<title>Sign Up | Archive</title>
		<link rel="stylesheet" type="text/css" href="css/signup.css">
	</head>

<body style="font-family: tahoma;">
	<div id="bar">
			<div class="logo"></div>
	</div>

	<div id="container">
		<div class="sign-in-form">
			<br>
			<b>All fields are required.</b>
		<br/>
		<fieldset class="sign-up-form-1">
		<legend>Sign Up</legend>
		<form method="post" action="signup_form.php" enctype="multipart/form-data">
			<table cellpadding="5" cellspacing="5">
				<tr>
					<td><label>First Name</label></td>
					<td><label>Last Name</label></td>
				</tr>
				<tr>
					<td><input type="text" name="firstname" placeholder="Enter your first name" class="form-1" title="Enter your firstname" required /></td>
					<td><input type="text" name="lastname" placeholder="Enter your last name" class="form-1" title="Enter your lastname" required /></td>
				</tr>
				<tr>
					<td><label>Username</label></td>
					<!--<td><label>Repeat Username</label></td>-->
				</tr>
				<tr>
					<td><input type="text" name="username" placeholder="Enter your username" class="form-1" title="Enter your username" required /></td>
					<!--<td><input type="text" name="username2" class="form-1" title="Enter your username" required /></td>-->
				</tr>
			</table>
		</fieldset>
		
		<br />		
		
		<fieldset class="sign-up-form-1">
			<table cellpadding="5" cellspacing="5">
				<tr>
					<td><label>Birthdate</label></td>
					<td>
					Year:
					<select name=year style="font-size:18px;" required>
					<?php
					$year=1901;
					while($year<=2020)
					  {
					  echo "<option> $year
					  </option>";
					  $year++;
					  }
					?>
					</select>
					Month:
					<select name=month style="font-size:18px;" required>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
						<option>6</option>
						<option>7</option>
						<option>8</option>
						<option>9r</option>
						<option>10</option>
						<option>11</option>
						<option>12</option>
					</select>
					Day:
					<select name=day style="font-size:18px;" required>
					<?php

					$day=1;
					while($day<=31)
					  {
					  echo "<option> $day
					  </option>";
					  $day++;
					  }
					?>
					</select>
					</td>
				</tr>
				<tr>
					<td><label>Gender</label></td>
					<td>
					<label>Male</label><input type="radio" name="gender" value="Male" required />
					<label>Female</label><input type="radio" name="gender" value="Female" required />
					<label>Other</label><input type="radio" name="gender" value="Other" required />
					</td>
				</tr>
				<tr>
					<td><label>Mobile Number</label></td>
					<td><input type="text" name="number" placeholder="" maxlength="13" class="form-1" title="Enter your mobile number" required /></td>
				</tr>
			</table>
		</fieldset>
		
		<br />
		
		<fieldset class="sign-up-form-1">
			<table cellpadding="5" cellspacing="5">
				<tr>
					<td><label>Email Address</label></td>
					<!--<td><label>Repeat Email</label></td>-->
				</tr>
				<tr>
					<td><input type="text" name="email" placeholder="Enter your Email Address" class="form-1" title="Enter your firstname" required /></td>
					<!--<td><input type="text" name="email2" class="form-1" title="Enter your lastname" required /></td>-->
				</tr>
				<tr>
					<td><label>Password</label></td>
					<td><label>Repeat Password</label></td>
				</tr>
				<tr>
					<td><input type="password" name="password" id="pass" placeholder="Enter your Password" class="form-1" title="Enter your username" required /></td>
					<td><input type="password" name="password2" id="pass2" class="form-1" title="Enter your username" required /></td>
					
				</tr>

				<td>
						

					<input type="checkbox" onclick="myFunction()" style="font-weight: normal;">Show Password

		        <script>
		          function myFunction()
		          {
		            var x = document.getElementById("pass");
		            var y = document.getElementById("pass2");

		            if (x.type === "password") 
		            {
		                x.type = "text";
		                y.type = "text";
		            } 

		            else 
		            {
		              x.type = "password";
		              y.type = "password";
		            }
		          }
		        </script>
			
					</td>
				
			</table>
		</fieldset>
		<strong><center>Already have a account? <a href="signin.php">Log In</a></a></center></strong>
		<br />
		
			<center><input type="submit" name="submit" value="Continue" class="btn-sign-in" title="Log in" /></center>
					<div id="footer" style="font-family:Calibri"> <a href="#">About</a> | Archive 2021 </div>

		<br />

		</form>
		
		</div>
	</div>
	
</body>

</html>