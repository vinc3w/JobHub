<?php

function get_notification(): array {

	$stmt = db()->prepare(
		'SELECT n.*, u.username, u.profile_picture FROM notification n, user u ' .
		'WHERE n.from_user = u.id ' .
		'AND n.to_user = ' . $_SESSION['user']['id']
	);
	$stmt->execute();
	return $stmt->fetchAll();

}

function insert_notification(int $to_user, string $message, string $description = ''): void {

	db()->exec(
		'INSERT INTO notification(to_user, from_user, message, description, time_created) VALUES (' .
			'\'' . $to_user . '\', ' .
			'\'' . $_SESSION['user']['id'] . '\', ' .
			'\'' . $message . '\', ' .
			'\'' . $description . '\', ' .
			'NOW()' .
		')'
	);

}

function delete_notification(int $user_id, int $notification_id): void {

	db()->exec(
		'DELETE FROM notification ' .
		'WHERE to_user = ' . $user_id . ' ' .
		'AND id = ' . $notification_id
	);
	
}

function delete_all_notification(int $user_id): void {

	db()->exec(
		'DELETE FROM notification ' . 
		'WHERE to_user = ' . $user_id
	);

}
