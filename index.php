<?php include('includes/database.php');
session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Log In | Archive</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<style>
		.wave {
			position: fixed;
			bottom: 0;
			left: 0;
			width: 200%;
			height: 200px;
			background: url("data:image/svg+xml;utf8,<svg viewBox='0 0 1200 200' xmlns='http://www.w3.org/2000/svg'><path d='M0,100 C300,0 900,200 1200,100 L1200,200 L0,200 Z' fill='%23000000'/></svg>") repeat-x;
			background-size: 1200px 200px;
			animation: waveMove 20s linear infinite;
			z-index: -1;
			opacity: 0.8;
		}

		@keyframes waveMove {
			0% {
				background-position-x: 0;
			}

			100% {
				background-position-x: 1200px;
			}
		}

		.noselect {
			user-select: none;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			font-size: 20px;
		}
	</style>
</head>

<body class="bg-gray-100 text-gray-800 font-sans">
	<div class="min-h-screen flex flex-col items-center justify-center p-6 gap-6">
		<div class="text-center">
			<img src="image/icon-black.png" alt="Archive Logo" class="w-auto h-20 mx-auto mb-2 noselect"
				draggable="false" oncontextmenu="return false;" />
			<h1 class="text-4xl font-bold">Archive</h1>
			<p class="text-gray-500">Share your story. Connect with the world.</p>
		</div>

		<div class="w-full max-w-md bg-white shadow-2xl rounded-2xl p-8">
			<?php if (isset($_SESSION['signup_success'])): ?>
				<div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-center">
					<?php echo $_SESSION['signup_success'];
					unset($_SESSION['signup_success']); ?>
				</div>
			<?php endif; ?>

			<?php if (isset($_SESSION['login_error'])): ?>
				<div class="bg-red-100 text-red-800 p-3 rounded mb-4 text-center">
					<?php echo $_SESSION['login_error'];
					unset($_SESSION['login_error']); ?>
				</div>
			<?php endif; ?>

			<form method="POST" action="signin_form.php" class="space-y-5">
				<input type="email" name="email" placeholder="Email" value="<?php echo $_SESSION['login_data']['email'] ?? ''; ?>" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-black">

				<div class="relative">
					<input type="password" name="password" id="loginPass" placeholder="Password" required class="w-full px-4 py-2 pr-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-black">
					<span class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer noselect" onclick="togglePassword('loginPass', this)">🙈</span>
				</div>

				<button type="submit" name="submit" class="w-full bg-black text-white py-3 rounded-lg text-lg hover:bg-gray-900 transition">Sign In</button>
				<p class="text-center text-sm">Don't have an account? <a href="signup.php" class="text-blue-600 hover:underline">Sign Up</a></p>
			</form>
		</div>
	</div>

	<div class="wave"></div>

	<script>
		function togglePassword(inputId, trigger) {
			const input = document.getElementById(inputId);
			if (input.type === 'password') {
				input.type = 'text';
				trigger.textContent = '👁️';
			} else {
				input.type = 'password';
				trigger.textContent = '🙈';
			}
		}
	</script>
</body>

</html>
<?php unset($_SESSION['login_data']); ?>