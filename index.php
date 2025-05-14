<?php

require __DIR__ . '/src/bootstrap.php';

if (is_user_logged_in()) {
	redirect_to('public/home/dashboard.php');
} else {
	redirect_to('public/auth/login.php');
}
