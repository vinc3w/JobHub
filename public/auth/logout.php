<?php

require __DIR__ . '/../../src/bootstrap.php';

if (isset($_COOKIE['token'])) {
	delete_token($_COOKIE['token']);
}

redirect_to('login.php');
