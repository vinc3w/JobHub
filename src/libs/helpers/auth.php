<?php

function delete_token(string $token) {

	db()->exec("
		DELETE FROM user_token
		WHERE token = '$token'
	");
	setcookie('token', '', time() - 3600, '/');

}

function get_user_skills(int $id) {

	$stmt = db()->prepare("
		SELECT id, skill FROM user_skill
		WHERE user_id = $id
	");
	$stmt->execute();
	return array_map(fn($skill) => $skill['skill'], $stmt->fetchAll());

}

function get_user(string $identifier, string $value): array | null {

	$stmt = db()->prepare("
		SELECT * FROM user
		WHERE $identifier = '$value'
	");
	$stmt->execute();
	$user = $stmt->fetchAll();
	if (!count($user)) {
		return null;
	}
	$user = $user[0];
	$user['skills'] = get_user_skills($user['id']);
	return $user;

}

function is_user_logged_in(): bool {

    if (!isset($_COOKIE['token'])) {
        return false;
    }

    $token = $_COOKIE['token'];

	$stmt = db()->prepare("
		SELECT * FROM user_token
		WHERE token = '$token'
		AND (expiry > NOW() OR expiry IS NULL)
	");
	$stmt->execute();
	$rows = $stmt->fetchAll();
	
	if (!count($rows)) {
		return false;
	}

	$_SESSION['user'] = get_user('id', $rows[0]['user_id']);
	return true;

}

function insert_user_token(string $email, bool $remember = false) {

	$token = random_str(40);
	$expiry = $remember ? 'NULL' : 'NOW() + INTERVAL 1 DAY';

	db()->exec("
		INSERT INTO user_token (user_id, token, expiry) VALUES
		('$email', '$token', $expiry)
	");

	setcookie('token', $token, 0, '/');

}

function store_reset_password_code(string $email, string $code) {

	db()->exec("
		INSERT INTO password_reset_code (email, code, expiry) VALUES
		('$email', '$code', NOW() + INTERVAL 1 HOUR)
	");

}

function validate_password_reset_code(array $inputs): bool {

	$stmt = db()->prepare('
		SELECT * FROM password_reset_code
		WHERE email = \'' . $inputs['email'] .
		'\' AND code = \'' . $inputs['code'] .
		'\' AND (expiry > NOW() OR expiry IS NULL)
	');
	$stmt->execute();

	return !!$stmt->fetchColumn();

}

function delete_password_reset_code(array $inputs): void {

	db()->exec('
		DELETE FROM password_reset_code
		WHERE email = \'' . $inputs['email'] .
		'\' AND code = \'' . $inputs['code'] . '\'
	');

}
