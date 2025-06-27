<?php
	include'includes/database.php';
	require 'session.php';

	
	$uquery=mysqli_query($con,"SELECT * FROM `user` WHERE user_id='".$_SESSION['id']."'");
	$urow=mysqli_fetch_assoc($uquery);
?>
<!DOCTYPE html>
<html>
<head>
<title>Chatbox | Archive</title>
<link rel="stylesheet" href="css/chatbox.css">
	
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
	</div>

<script src="jquery-3.1.1.js"></script>	
<script src="js/home.js"></script>
<script type="text/javascript">

$(document).keypress(function(e){ //using keyboard enter key
	displayResult();
	/* Send Message	*/	
	
		if(e.which === 13){ 
				if($('#msg').val() == ""){
				alert('Please write message first');
			}else{
				$msg = $('#msg').val();
				$id = $('#id').val();
				$.ajax({
					type: "POST",
					url: "send_message.php",
					data: {
						msg: $msg,
						id: $id,
					},
					success: function(){
						displayResult();
						$('#msg').val(''); //clears the textarea after submit
					}
				});
			}	

			/* $("form").submit(); 
			 alert('You press enter key!'); */
		} 
	}
); 


$(document).ready(function(){ //using send button
	displayResult();
	/* Send Message	*/	
		
		$('#send_msg').on('click', function(){
			if($('#msg').val() == ""){
				alert('Please write message first');
			}else{
				$msg = $('#msg').val();
				$id = $('#id').val();
				$.ajax({
					type: "POST",
					url: "send_message.php",
					data: {
						msg: $msg,
						id: $id,
					},
					success: function(){
						displayResult();
						$('#msg').val(''); //clears the textarea after submit
					}
				});
			}	
		});
	/* END */
	});
	
	function displayResult(){
		$id = $('#id').val();
		$.ajax({
			url: 'send_message.php',
			type: 'POST',
			async: false,
			data:{
				id: $id,
				res: 1,
			},
			success: function(response){
				$('#result').html(response);
			}
		});
	}
</script>

</head>

<body style="font-family: tahoma;">
<table id="chat_room" align="center">
	
	<div id="chat-text">
	<!--<tr>
	<th><h4>Hi, <a style="color: white;"href="timeline.php"><?php echo $urow['firstname']; ?></a>
		<a href="logout.php" onclick="return confirm_logout();">Logout</a></h4></th>
	</tr>-->
	<?php
		$query=mysqli_query($con,"select * from `chat_room`");
		$row=mysqli_fetch_array($query);
	?>
				<div>
				<tr>
					<td style="background-color: #303841; color: #ffffff;">
						<?php 

						echo $row['chat_room_name'];


						
						?>
						<div class='float-time';> <?php require ('time.php') ?></div>
					</td>
					<br>
				</tr>
				</div>
			<tr>
				<td>
				<div id="result" style="overflow-y:scroll; height:300px; width: 605px;"></div>
				<form class="form">
					<!--<input type="text" id="msg">--><br/>
					<textarea id="msg" rows="4" cols="85" placeholder="Chat here!"></textarea>
					<input type="hidden" value="<?php echo $row['chat_room_id']; ?>" id="id"> 
					<button type="button" id="send_msg" class="button button2">Send</button>
				</form>
				</td>
			</tr>
			</div>
</table>
	<div id="footer" style="font-family:Calibri"> <a href="#">About</a> | Archive 2021 </div>
<br>


</body>
</html>