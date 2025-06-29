<?php include('includes/database.php');
session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sign Up | Archive</title>
	<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 font-sans">
	<div class="min-h-screen flex flex-col items-center justify-center p-6 gap-6">
		<div class="text-center">
			<img src="image/icon-black.png" alt="Archive Logo" class="w-auto h-20 mx-auto mb-2 noselect"
				draggable="false" oncontextmenu="return false;" />
			<h1 class="text-4xl font-bold">Archive</h1>
			<p class="text-gray-500">Join the community. Share your story.</p>
		</div>

		<div class="w-full max-w-2xl bg-white shadow-2xl rounded-2xl p-8">
			<form method="POST" action="signup_form.php" class="space-y-5">
				<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
					<input type="text" name="firstname" placeholder="First Name" value="<?php echo $_SESSION['form_data']['firstname'] ?? ''; ?>" required class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-black">
					<input type="text" name="lastname" placeholder="Last Name" value="<?php echo $_SESSION['form_data']['lastname'] ?? ''; ?>" required class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-black">
				</div>
				<input type="text" name="username" placeholder="Username" value="<?php echo $_SESSION['form_data']['username'] ?? ''; ?>" required class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-black">

				<div>
					<label class="text-sm text-gray-700 block mb-1">Date of Birth</label>
					<div class="grid grid-cols-3 gap-2">
						<select name="month" class="px-2 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-black" required>
							<option value="" disabled selected>Month</option>
							<?php
							$months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
							for ($m = 1; $m <= 12; $m++):
							?>
								<option value="<?php echo $m; ?>" <?php echo (($_SESSION['form_data']['month'] ?? '') == $m) ? 'selected' : ''; ?>><?php echo $months[$m - 1]; ?></option>
							<?php endfor; ?>
						</select>
						<select name="day" class="px-2 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-black" required>
							<option value="" disabled selected>Day</option>
							<?php for ($d = 1; $d <= 31; $d++): ?>
								<option value="<?php echo $d; ?>" <?php echo (($_SESSION['form_data']['day'] ?? '') == $d) ? 'selected' : ''; ?>><?php echo $d; ?></option>
							<?php endfor; ?>
						</select>
						<select name="year" class="px-2 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-black" required>
							<option value="" disabled selected>Year</option>
							<?php for ($y = date('Y') - 18; $y >= 1901; $y--): ?>
								<option value="<?php echo $y; ?>" <?php echo (($_SESSION['form_data']['year'] ?? '') == $y) ? 'selected' : ''; ?>><?php echo $y; ?></option>
							<?php endfor; ?>
						</select>
					</div>
				</div>

				<select name="gender" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-black">
					<option value="" disabled>Select Gender</option>
					<option value="Male" <?php echo (($_SESSION['form_data']['gender'] ?? '') == 'Male') ? 'selected' : ''; ?>>Male</option>
					<option value="Female" <?php echo (($_SESSION['form_data']['gender'] ?? '') == 'Female') ? 'selected' : ''; ?>>Female</option>
					<option value="Other" <?php echo (($_SESSION['form_data']['gender'] ?? '') == 'Other') ? 'selected' : ''; ?>>Other</option>
				</select>

				<input type="text" name="number" placeholder="Mobile Number" maxlength="13" required pattern="[0-9]+" title="Only numbers allowed" value="<?php echo $_SESSION['form_data']['number'] ?? ''; ?>" class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-black">

				<div class="relative">
					<input type="email" name="email" placeholder="Email" value="<?php echo $_SESSION['form_data']['email'] ?? ''; ?>" class="px-4 py-2 border <?php echo isset($_SESSION['email_error']) ? 'border-red-500' : ''; ?> rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-black">
					<?php if (isset($_SESSION['email_error'])): ?>
						<p class="text-red-500 text-sm mt-1"><?php echo $_SESSION['email_error'];
																unset($_SESSION['email_error']); ?></p>
					<?php endif; ?>
				</div>

				<div class="relative">
					<input type="password" name="password" id="pass1" placeholder="Password" required class="px-4 py-2 pr-10 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-black">
					<span class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer noselect" onclick="togglePassword('pass1', this)">🙈</span>
				</div>

				<div class="relative">
					<input type="password" name="password2" id="pass2" placeholder="Repeat Password" required class="px-4 py-2 pr-10 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-black">
					<span class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer noselect" onclick="togglePassword('pass2', this)">🙈</span>
				</div>

				<button type="submit" name="submit" class="w-full bg-black text-white py-3 rounded-lg text-lg hover:bg-gray-900 transition">Sign Up</button>
				<p class="text-center text-sm">Already have an account? <a href="index.php" class="text-blue-600 hover:underline">Log In</a></p>
			</form>
		</div>
	</div>

	<script>
		function togglePassword(inputId, iconEl) {
			const input = document.getElementById(inputId);
			const isHidden = input.type === 'password';

			input.type = isHidden ? 'text' : 'password';
			iconEl.textContent = isHidden ? '👁️' : '🙈';
		}
	</script>
</body>

</html>
<?php unset($_SESSION['form_data']); ?>