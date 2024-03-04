<?php

/**
 * Connect to database
 */
function db(): PDO {

	static $pdo;
	if (!$pdo) {
		$dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=UTF8';
		$pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
	}
	return $pdo;

}
