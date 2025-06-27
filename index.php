<?php include('includes/database.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Archive</title>
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

		@keyframes slideDown {
			from {
				transform: translateY(-10%);
				opacity: 0;
			}

			to {
				transform: translateY(0);
				opacity: 1;
			}
		}

		.animate-slide-down {
			animation: slideDown 0.3s ease-out;
		}

		.fade-in {
			animation: fadeIn 0.3s ease-in;
		}

		@keyframes fadeIn {
			from {
				opacity: 0;
				transform: translateY(-4px);
			}

			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		.bounce {
			animation: bounce 0.4s ease;
		}

		@keyframes bounce {

			0%,
			100% {
				transform: translateY(0);
			}

			50% {
				transform: translateY(-5px);
			}
		}
	</style>
</head>

<body class="bg-gray-100 text-gray-800">
	<div class="min-h-screen flex flex-col items-center justify-center p-4">
		<div class="text-center mb-6">
			<img src="image/icon-black.png" alt="Archive Logo" class="w-25 h-20 mx-auto mb-3" />
			<h1 class="text-4xl font-bold text-gray-900">Welcome to Archive</h1>
			<p class="text-lg text-gray-600">Connect with your friends and the world around you.</p>
		</div>
		<div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6 space-y-4">
			<div class="flex justify-center space-x-4">
				<button id="toggleSignIn" class="transition-all duration-500 px-4 py-2 bg-black text-white rounded hover:bg-gray-800">Sign In</button>
				<button id="toggleSignUp" class="transition-all duration-500 px-4 py-2 bg-gray-200 text-black rounded hover:bg-gray-300">Sign Up</button>
			</div>
			<div id="signInForm" class="hidden animate-slide-down mt-4">
				<form method="POST" action="signin_form.php" class="space-y-4">
					<input type="email" name="email" placeholder="Email" required class="w-full px-4 py-2 border rounded">
					<div class="relative">
						<input type="password" name="password" id="pass" placeholder="Password" required class="w-full px-4 py-2 border rounded pr-10">
						<button type="button" onclick="togglePassword('pass', 'eyeIconLogin')" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-600 transition-transform duration-200 active:scale-90 hover:scale-110">
							<svg id="eyeIconLogin" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7" />
							</svg>
						</button>
					</div>
					<input type="submit" name="submit" value="Log In" class="w-full bg-black text-white py-2 rounded cursor-pointer">
				</form>
			</div>

			<div id="signUpForm" class="hidden animate-slide-down mt-4">
				<form method="POST" action="signup_form.php" class="space-y-4">
					<input type="text" name="firstname" placeholder="First Name" required class="w-full px-4 py-2 border rounded">
					<input type="text" name="lastname" placeholder="Last Name" required class="w-full px-4 py-2 border rounded">
					<input type="text" name="username" placeholder="Username" required class="w-full px-4 py-2 border rounded">

					<!-- Birthdate -->
					<div class="flex gap-2">
						<div>
							<label class="block text-sm">Year</label>
							<select name="year" required class="border px-2 py-1 rounded">
								<?php for ($year = 1901; $year <= 2020; $year++) echo "<option>$year</option>"; ?>
							</select>
						</div>
						<div>
							<label class="block text-sm">Month</label>
							<select name="month" required class="border px-2 py-1 rounded">
								<?php for ($m = 1; $m <= 12; $m++) echo "<option>$m</option>"; ?>
							</select>
						</div>
						<div>
							<label class="block text-sm">Day</label>
							<select name="day" required class="border px-2 py-1 rounded">
								<?php for ($d = 1; $d <= 31; $d++) echo "<option>$d</option>"; ?>
							</select>
						</div>
					</div>

					<!-- Gender -->
					<div>
						<label class="block text-sm">Gender</label>
						<div class="flex items-center gap-4">
							<label><input type="radio" name="gender" value="Male" required> Male</label>
							<label><input type="radio" name="gender" value="Female" required> Female</label>
							<label><input type="radio" name="gender" value="Other" required> Other</label>
						</div>
					</div>

					<!-- Mobile Number -->
					<input type="text" name="number" placeholder="Mobile Number" maxlength="13" required class="w-full px-4 py-2 border rounded">

					<!-- Email -->
					<input type="email" name="email" placeholder="Email" required class="w-full px-4 py-2 border rounded">

					<!-- Password -->
					<div>
						<div class="relative">
							<input type="password" name="password" id="pass1" placeholder="Password" required class="w-full px-4 py-2 border rounded pr-10" oninput="checkStrength()">
							<button type="button" onclick="togglePassword('pass1', 'eyeIcon1')" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-600 hover:scale-110 transition-transform">
								<svg id="eyeIcon1" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7" />
								</svg>
							</button>
						</div>
						<p id="strengthMessage" class="text-sm mt-1"></p>
					</div>

					<!-- Repeat Password -->
					<div class="relative">
						<input type="password" name="password2" id="pass2" placeholder="Repeat Password" required class="w-full px-4 py-2 border rounded pr-10">
						<button type="button" onclick="togglePassword('pass2', 'eyeIcon2')" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-600 hover:scale-110 transition-transform">
							<svg id="eyeIcon2" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7" />
							</svg>
						</button>
						<p id="formError" class="hidden text-red-600 text-sm text-center"></p>
					</div>

					<!-- Submit -->
					<input type="submit" name="submit" value="Sign Up" class="w-full bg-black text-white py-2 rounded cursor-pointer">
				</form>

			</div>
		</div>
	</div>

	<div class="wave"></div>

	<script>
		const signInBtn = document.getElementById('toggleSignIn');
		const signUpBtn = document.getElementById('toggleSignUp');
		const signInForm = document.getElementById('signInForm');
		const signUpForm = document.getElementById('signUpForm');

		signInBtn.addEventListener('click', () => {
			signInForm.classList.remove('hidden');
			signUpForm.classList.add('hidden');
		});

		signUpBtn.addEventListener('click', () => {
			signUpForm.classList.remove('hidden');
			signInForm.classList.add('hidden');
		});

		function togglePassword(inputId, iconId) {
			const passInput = document.getElementById(inputId);
			const eyeIcon = document.getElementById(iconId);

			if (passInput.type === "password") {
				passInput.type = "text";
				eyeIcon.innerHTML = `
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
					d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.054 10.054 0 013.543-4.458m4.572-2.266a5.985 5.985 0 014.06 1.71m1.61 1.89a5.985 5.985 0 01.51 6.235M9.88 9.88a3 3 0 104.24 4.24" />
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
					d="M3 3l18 18" />
			`;
			} else {
				passInput.type = "password";
				eyeIcon.innerHTML = `
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
					d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
					d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7" />
			`;
			}
		}

		function checkStrength() {
			const pass = document.getElementById('pass1').value;
			const message = document.getElementById('strengthMessage');
			let strength = '';
			let color = '';
			let icon = '';

			if (pass.length < 6) {
				strength = 'Too short';
				color = 'text-red-500';
				icon = '❌';
			} else if (!/[A-Z]/.test(pass) || !/\d/.test(pass)) {
				strength = 'Weak';
				color = 'text-yellow-500';
				icon = '⚠️';
			} else if (pass.length >= 8 && /[A-Z]/.test(pass) && /\d/.test(pass) && /[\W_]/.test(pass)) {
				strength = 'Strong';
				color = 'text-green-600';
				icon = '✅';
			} else {
				strength = 'Moderate';
				color = 'text-blue-500';
				icon = 'ℹ️';
			}

			message.innerHTML = `<span class="${color} fade-in bounce">${icon} ${strength}</span>`;

		}


		document.querySelector("form[action='signup_form.php']").addEventListener("submit", function(e) {
			const pass1 = document.getElementById("pass1").value;
			const pass2 = document.getElementById("pass2").value;
			const error = document.getElementById("formError");

			if (pass1 !== pass2) {
				error.textContent = "Passwords do not match!";
				error.classList.remove("hidden");
				e.preventDefault();
			} else {
				error.classList.add("hidden");
			}
		});
	</script>
</body>

</html>