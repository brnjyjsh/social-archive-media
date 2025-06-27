<?php
	include('includes/database.php');
	require ('session.php');
	if(isset($_POST['msg'])){		
		$msg = addslashes($_POST['msg']);
		$id = $_POST['id'];
		mysqli_query($con,"insert into `chat` (chat_room_id, chat_msg, user_id, chat_date) values ('$id', '$msg' , '".$_SESSION['id']."', '$date')") or die(mysqli_error());
	}
?>
<?php
	if(isset($_POST['res']))
	{
		$id = $_POST['id'];
	?>
	<?php
		$query=mysqli_query($con,"select * from `chat` left join `user` on user.user_id=chat.user_id where chat_room_id='$id' order by chat_date asc") or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
	?>	
		<div>
			<?php echo $row['chat_date']; ?><br>
			<?php echo $row['firstname']; ?>: <?php echo $row['chat_msg']; ?><br>
		</div>
		<br>
	<?php
		}
	}	
?>

