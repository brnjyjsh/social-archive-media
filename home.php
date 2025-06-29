<?php
function time_stamp($session_time)
{
	$time_difference = time() - $session_time;
	$seconds = $time_difference;
	$minutes = round($time_difference / 60);
	$hours = round($time_difference / 3600);
	$days = round($time_difference / 86400);
	$weeks = round($time_difference / 604800);
	$months = round($time_difference / 2419200);
	$years = round($time_difference / 29030400);

	if ($seconds <= 60) {
		return "$seconds seconds ago";
	} else if ($minutes <= 60) {
		return $minutes == 1 ? "one minute ago" : "$minutes minutes ago";
	} else if ($hours <= 24) {
		return $hours == 1 ? "one hour ago" : "$hours hours ago";
	} else if ($days <= 7) {
		return $days == 1 ? "one day ago" : "$days days ago";
	} else if ($weeks <= 4) {
		return $weeks == 1 ? "one week ago" : "$weeks weeks ago";
	} else if ($months <= 12) {
		return $months == 1 ? "one month ago" : "$months months ago";
	} else {
		return $years == 1 ? "one year ago" : "$years years ago";
	}
}


include('includes/database.php');
include('session.php');
?>
<!DOCTYPE html>
<html>

<head>
	<title>Archive</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="css/style.css">
</head>

<body class="font-[Tahoma] bg-gray-50">

	<?php if (isset($_SESSION['signup_success'])): ?>
		<div id="signupToast" class="fixed top-5 right-5 z-50 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-md">
			<div class="flex justify-between items-center">
				<span><?php echo $_SESSION['signup_success']; ?></span>
				<button onclick="document.getElementById('signupToast').remove()" class="ml-4 font-bold text-xl leading-none">&times;</button>
			</div>
		</div>
		<script>
			setTimeout(() => {
				document.getElementById('signupToast')?.remove();
			}, 5000);
		</script>
		<?php unset($_SESSION['signup_success']); ?>
	<?php endif; ?>

	<div id="header" class="bg-white shadow p-4">
		<div class="max-w-6xl mx-auto flex justify-between items-center">
			<div class="text-xl font-bold">Archive</div>
			<ul class="flex gap-4 text-sm">
				<li><a href="timeline.php" class="hover:underline"><?php echo $username ?></a></li>
				<li><a href="home.php" class="font-semibold text-blue-600">Home</a></li>
				<li><a href="chatbox.php" class="font-semibold text-blue-600">Chatbox</a></li>
				<li><a href="logout.php"><button class="px-3 py-1 bg-red-500 text-white rounded">Log out</button></a></li>
			</ul>
		</div>
	</div>

	<div class="max-w-6xl mx-auto flex flex-col lg:flex-row gap-4 mt-6">
		<!-- Left Profile -->
		<div class="lg:w-1/4 bg-white p-4 rounded shadow">
			<div class="mb-4">
				<button onclick="document.getElementById('photoModal').classList.remove('hidden')">
					<img src="<?php echo $row['profile_picture'] ?>" alt="Profile" class="w-full rounded hover:opacity-80">
				</button>
				<!-- Profile Upload Modal -->
				<div id="photoModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
					<div class="bg-white p-6 rounded shadow-lg w-80 relative">
						<button onclick="document.getElementById('photoModal').classList.add('hidden')" class="absolute top-2 right-2 text-gray-500 hover:text-black">&times;</button>
						<h2 class="text-lg font-bold mb-4">Update Profile Picture</h2>
						<form id="photoForm" enctype="multipart/form-data">
							<input type="file" name="image" accept="image/*" required class="mb-4 w-full text-sm">
							<button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">Upload</button>
						</form>
					</div>
				</div>

				<!-- Success Toast -->
				<div id="photoToast" class="fixed top-5 right-5 bg-green-100 text-green-800 border border-green-400 px-4 py-2 rounded shadow hidden">
					Profile picture updated!
				</div>


			</div>
			<h3 class="text-center font-bold text-lg"><?php echo $firstname . ' ' . $lastname ?></h3>
		</div>

		<!-- Post Form and Feed -->
		<div class="flex-1">
			<form method="post" action="post.php" enctype="multipart/form-data" class="bg-white p-4 rounded shadow mb-4">
				<textarea name="content" placeholder="What's on your mind?" class="w-full border rounded p-2 mb-2" required></textarea>
				<input type="file" name="image" class="mb-2">
				<button type="submit" name="Submit" class="px-4 py-2 bg-blue-500 text-white rounded">Share</button>
			</form>

			<?php
			$query = mysqli_query($con, "SELECT * FROM post LEFT JOIN user ON user.user_id = post.user_id ORDER BY post_id DESC");
			while ($row = mysqli_fetch_array($query)) {
			?>
				<div class="bg-white p-4 rounded shadow mb-4">
					<div class="flex gap-4 items-center">
						<img src="<?php echo $row['profile_picture'] ?>" class="w-12 h-12 rounded-full">
						<div>
							<p class="font-bold"><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></p>
							<p class="text-xs text-gray-500"><?php echo time_stamp($row['created']); ?></p>
						</div>
					</div>
					<p class="my-3"><?php echo $row['content']; ?></p>
					<?php if ($row['post_image']): ?>
						<img src="<?php echo $row['post_image'] ?>" class="w-full rounded mb-2">
					<?php endif; ?>
					<div class="flex justify-between items-center">
						<div>
							<?php
							$liked = mysqli_query($con, "SELECT * FROM `like` WHERE post_id='{$row['post_id']}' AND user_id='{$_SESSION['id']}'");
							$likeBtnClass = mysqli_num_rows($liked) > 0 ? 'unlike' : 'like';
							$likeBtnText = mysqli_num_rows($liked) > 0 ? 'Unlike' : 'Like';
							?>
							<button value="<?php echo $row['post_id']; ?>" class="<?php echo $likeBtnClass; ?> text-blue-500"><?php echo $likeBtnText; ?></button>
							<span id="show_like<?php echo $row['post_id']; ?>">
								<?php
								$likes = mysqli_query($con, "SELECT * FROM `like` WHERE post_id='{$row['post_id']}'");
								echo mysqli_num_rows($likes);
								?>
							</span>
						</div>
						<?php if ($row['user_id'] == $_SESSION['id']): ?>
							<a href="delete_post.php?id=<?php echo $row['post_id']; ?>" class="text-red-500">Delete</a>
						<?php endif; ?>
					</div>

					<!-- Comments -->
					<?php
					$comments = mysqli_query($con, "SELECT * FROM comments WHERE post_id='{$row['post_id']}' ORDER BY comment_id ASC");
					while ($c = mysqli_fetch_array($comments)) {
					?>
						<div class="ml-12 mt-2 p-2 bg-gray-100 rounded relative">
							<div class="flex items-center gap-2">
								<img src="<?php echo $c['image']; ?>" class="w-8 h-8 rounded-full">
								<p class="text-sm font-bold"><?php echo $c['name']; ?></p>
							</div>
							<p class="text-sm mt-1"><?php echo $c['content_comment']; ?></p>
							<div class="text-xs text-gray-500 flex gap-2 mt-1">
								<span><?php echo time_stamp($c['created']); ?></span>
								<?php if ($c['user_id'] == $_SESSION['id']): ?>
									<a href="delete_comment.php?id=<?php echo $c['comment_id']; ?>" class="text-red-500">Delete</a>
								<?php endif; ?>
							</div>
						</div>
					<?php } ?>

					<!-- Add Comment -->
					<form method="POST" action="comment.php" class="mt-2 ml-12 flex flex-wrap gap-2">
						<input type="hidden" name="post_id" value="<?php echo $row['post_id']; ?>">
						<input type="text" name="content_comment" placeholder="Write a comment..." class="flex-1 border rounded px-2 py-1 text-sm">
						<input type="submit" name="post_comment" value="Comment" class="text-sm px-3 py-1 bg-blue-500 text-white rounded">
					</form>
				</div>
			<?php } ?>
		</div>
	</div>

	<script src="jquery-3.1.1.js"></script>
	<script>
		$(document).on('click', '.like, .unlike', function() {
			const id = $(this).val();
			const btn = $(this);
			btn.toggleClass('like unlike');
			btn.text(btn.hasClass('like') ? 'Like' : 'Unlike');
			$.post('like.php', {
				id: id,
				like: 1
			}, () => showLike(id));
		});

		function showLike(id) {
			$.post('show_like.php', {
				id: id,
				showlike: 1
			}, function(response) {
				$('#show_like' + id).html(response);
			});
		}

		$('#photoForm').on('submit', function(e) {
			e.preventDefault();
			const formData = new FormData(this);

			$.ajax({
				url: 'upload_photo.php',
				type: 'POST',
				data: formData,
				contentType: false,
				processData: false,
				success: function(imagePath) {
					$('#photoModal').addClass('hidden');
					$('#photoToast').removeClass('hidden');

					// Optionally update the profile picture instantly
					$('img[alt="Profile"]').attr('src', imagePath);

					setTimeout(() => {
						$('#photoToast').fadeOut();
					}, 3000);
				},
				error: function() {
					alert("Failed to upload. Please try again.");
				}
			});
		});
	</script>
</body>

</html>