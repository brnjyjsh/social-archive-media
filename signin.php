<!DOCTYPE html>
<html>

	<head>
		<title>Log in | Archive</title>
		<link rel="stylesheet" type="text/css" href="css/signin.css">
	</head>

<body style="font-family: tahoma;">
	<div id="bar">
			<div class="logo"></div>
	</div>

	<div id="container">

			<h2>Log in</h2>
	<form method="post" action="signin_form.php" enctype="multipart/form-data">
				<tr>
					<td><input type="email" name="email" placeholder="Email" class="form-1" title="Enter your email" required /></td>
				</tr>
				<tr>
					<br><br>
					<td></td>
					<td><input type="password" name="password" id="pass" placeholder="Password" class="form-1" title="Enter your password" required /></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<td>
					<br>
					<br>
					<input type="checkbox" onclick="myFunction()" style="font-weight: normal;">Show Password

		        <script>
		          function myFunction()
		          {
		            var x = document.getElementById("pass");

		            if (x.type === "password") 
		            {
		                x.type = "text";
		            } 

		            else 
		            {
		              x.type = "password";
		            }
		          }
		        </script>
			
					</td>
				<tr>
					<br><br>
					<td colspan="2">
					<input type="submit" name="submit" value="Log in" class="btn-sign-in" title="Log in" />
					<input type="reset" name="cancel" value="Sign up" class="btn-sign-up" onclick="location.href='signup.php'" title="Sign up" />
					</td>
				</tr>
				<br><br><br>
	</form>
			
			
		</div>
		<div id="footer" style="font-family:Calibri"> <a href="#">About</a> | Archive 2021 </div>
	</div>
	

</body>

</html>