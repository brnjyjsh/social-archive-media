<!DOCTYPE html>
<html>

	<head>
		<title>Profile | Archive</title>
		<link rel="stylesheet" type="text/css" href="css/profile.css">
	</head>

<body style="font-family: tahoma;">
<?php include ('session.php');?>

	<div id="header"> <!--HEADER-->
		<div class="small_logo">
		<div class="head-view">

			<ul>
				<li><a href="timeline.php" title="<?php echo $username ?>"><label><?php echo $username ?></label></a></li>
				<li><a href="home.php" title="Home"><label class="active">Home</label></a></li>
				<li><a href="chatbox.php" title="Home"><label class="active">Chatbox</label></a></li>
				<!--
				<li><a href="profile.php" title="Home"><label>Profile</label></a></li>
				<li><a href="photos.php" title="Settings"><label>Photos</label></a></li>
				-->
				<li><a href="logout.php" title="Log out"><button class="btn-sign-in" value="Log out">Log out</button></a></li>
			</ul>
		</div>
	</div>

	<div id="container">
	
		<div id="left-nav">
				
				<div class="clip1">
				<a href="updatephoto.php" title="Change Profile Picture"><img src="<?php echo $row['profile_picture'] ?>"><button>Update Picture</button></a>
				
				</div>

				<div class="user-details">
					<h3><?php echo $firstname ?>&nbsp;<?php echo $lastname ?></h3>
					<h2><?php echo $username ?></h2>
				</div>
		</div>
		
		
		
		<div id="right-nav">
			<center><h1>Personal Info</h1></center>
			<hr />
			<br />
			<?php
			include('includes/database.php');

			$result=mysqli_query($con,"SELECT * FROM user where user_id='$id' ");
			
			while($test = mysqli_fetch_array($result))
			{
				$id = $test['user_id'];	
				echo " <div class='info-user'>";
				echo " <div>";
				echo " <label>Firstname</label>&nbsp;&nbsp;&nbsp;<b>".$test['firstname']."</b>";
				echo "</div> ";
				echo "<hr /> ";		
				echo "<br /> ";		
				echo " <div>";
				echo " <label>Lastname</label>&nbsp;&nbsp;&nbsp;&nbsp;<b>".$test['lastname']."</b>";
				echo "</div> ";
				echo "<hr /> ";	
				echo "<br /> ";		
				echo " <div>";
				echo " <label>Username</label>&nbsp;&nbsp;&nbsp;<b>".$test['username']."</b>";
				echo "</div> ";
				echo "<hr /> ";	
				echo "<br /> ";		
				echo " <div>";
				echo " <label>Birthday</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>".$test['birthday']."</b>";
				echo "</div> ";
				echo "<hr /> ";	
				echo "<br /> ";		
				echo " <div>";
				echo " <label>Gender</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>".$test['gender']."</b>";
				echo "</div> ";
				echo "<hr /> ";	
				echo "<br /> ";		
				echo " <div>";
				echo " <label>Number</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>".$test['number']."</b>";
				echo "</div> ";
				echo "<hr /> ";	
				echo "<br /> ";	
				echo "</div> ";
				echo "<br /> ";		
				echo " <div class='edit-info'>";
				echo " <a href ='edit_profile.php?user_id=$id'><button>Edit Profile</button></a>";
				echo "</div> ";
				echo "<br /> ";	
				echo "<br /> ";	
			}
			?>
			
		</div>

	
		</div>
		

	
		
	</div>

</body>

</html>