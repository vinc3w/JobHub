<?php

require __DIR__ . '/../../src/bootstrap.php';

if (!is_user_logged_in()) {
	redirect_to('../auth/login.php');
}

if (is_post_request()) {

	if ($_POST['type'] === 'delete-all') {

		delete_all_notification($_SESSION['user']['id']);

	}
	else if (str_starts_with($_POST['type'], 'delete:')) {
		
		$notification_id = explode(':', $_POST['type'])[1];
		delete_notification($_SESSION['user']['id'], $notification_id);

	}
	
}

$notifications = get_notification($_SESSION['user']['id']);

view('header', ['title' => 'Notification']);

require __DIR__ . '/partials/notification/delete-all-button.php';

if (count($notifications)) {

	require __DIR__ . '/partials/notification/notification-list.php';

}
else {

	require __DIR__ . '/partials/notification/no-notification.php';

}

view('footer');
