<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/src/styles/output.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
	
	<link rel="apple-touch-icon" sizes="180x180" href="/public/assets/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/public/assets/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/public/assets/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<meta name="theme-color" content="#FFEDD5">

	<title><?= $title ?? 'Home' ?></title>
</head>
<body class="bg-orange-100 min-h-screen flex flex-col">

	<div class="min-h-16 w-full"></div>
	<header id="header" class="fixed top-0 left-0 w-screen px-10 z-50 bg-orange-200 duration-75">

		<div class="max-w-[1000px] mx-auto flex justify-between items-center h-16">

			<div class="text-2xl font-bold">
				<a href="<?= is_user_logged_in() ? '/public/home/dashboard.php' : '/' ?>">
				<?= APP_NAME ?>,
				<span class="text-sm font-semibold">Your Future Blown Wide Open!</span>
			</a>
			</div>

			<nav>
				<ul>
					<?php
						if (is_user_logged_in()) {
							$notification_count = count(get_notification());
							$notification_element = $notification_count ?
														' (' . ($notification_count > 9 ? '9+' : $notification_count) . ')' :
														'';
							echo '
								<li class="inline-block ml-4 hover:underline active:opacity-80 transition-opacity">
									<a href="/public/home/dashboard.php">Dashboard</a>
								</li>
								<li class="inline-block ml-4 hover:underline active:opacity-80 transition-opacity">
									<a href="/public/home/notification.php">Notification</a>' . $notification_element .
								'</li>
								<li class="inline-block ml-4 hover:underline active:opacity-80 transition-opacity">
									<a href="/public/home/profile.php">' . $_SESSION['user']['username'] . '</a>
								</li>
							';
						}
						else {
							echo '
								<li class="inline-block ml-4 hover:underline active:opacity-80 transition-opacity">
									<a href="/">Home</a>
								</li>
								<li class="inline-block ml-2 transition-all bg-orange-300 hover:opacity-80 active:opacity-60 rounded">
									<a class="inline-block px-3 py-2" href="/public/auth/login.php">Log In</a>
								</li>
								<li class="inline-block ml-2 transition-all bg-orange-300 hover:opacity-80 active:opacity-60 rounded">
									<a class="inline-block px-3 py-2" href="/public/auth/register.php">Register</a>
								</li>
							';
						}
					?>
				</ul>
			</nav>

		</div>

	</header>

	<main class="px-10">
		<div class="max-w-[1000px] w-full mx-auto">
