<?php

function is_required(array $data, string $field): bool {

	return isset($data[$field]) && $data[$field] !== '';

}

function is_url(array $data, string $field): bool {

	if (empty($data[$field])) {
		return true;
	}

	return filter_var($data[$field], FILTER_VALIDATE_URL);

}

function is_email(array $data, string $field): bool {

	if (empty($data[$field])) {
		return true;
	}

	return filter_var($data[$field], FILTER_VALIDATE_EMAIL);

}

function is_min(array $data, string $field, int $min): bool {

	if (!isset($data[$field])) {
		return true;
	}

	return mb_strlen($data[$field]) >= $min;

}

function is_max(array $data, string $field, int $max): bool {

	if (!isset($data[$field])) {
		return true;
	}

	return mb_strlen($data[$field]) <= $max;

}

function is_between(array $data, string $field, int $min, int $max): bool {

	if (!isset($data[$field])) {
		return true;
	}

	$len = mb_strlen($data[$field]);
	return $len >= $min && $len <= $max;

}

function is_alphanumeric(array $data, string $field): bool {

	if (!isset($data[$field])) {
		return true;
	}

	return ctype_alnum($data[$field]);

}

function is_same(array $data, string $field, string $another_field): bool {

	if (!isset($data[$field], $data[$another_field])) {
		return true;
	}

	return $data[$field] === $data[$another_field];

}

function is_unique(array $data, string $field, string $table, string $column): bool {

	if (!isset($data[$field])) {
		return true;
	}

	$sql = "SELECT $column FROM $table WHERE $column = :value";

	$stmt = db()->prepare($sql);
	$stmt->bindValue(':value', $data[$field]);

	$stmt->execute();

	return $stmt->fetchColumn() === false;

}

function is_exist(array $data, string $field, string $table, string $column): bool {

	if (!isset($data[$field])) {
		return true;
	}

	$sql = "SELECT $column FROM $table WHERE $column = :value";

	$stmt = db()->prepare($sql);
	$stmt->bindValue(':value', $data[$field]);

	$stmt->execute();

	return $stmt->fetchColumn() !== false;

}

function validate(array $data, array $fields): array {

	$errors = [];

	$split = fn($separator, $str) => array_map('trim', explode($separator, $str));

	foreach ($fields as $field => $option) {

		$rules = $split('|', $option);
		foreach($rules as $rule) {

			if (strpos($rule, ':')) {
				[$rule_name, $param_str] = $split(':', $rule);
				$params = $split(',', $param_str);
			}
			else {
				$rule_name = trim($rule);
				$params = [];
			}

			$fn = 'is_' . $rule_name;
			if (is_callable($fn)) {
				$is_success = $fn($data, $field, ...$params);
				if (!$is_success) {
					$errors[$field] = sprintf(DEFAULT_VALIDATION_ERRORS[$rule_name], $field, ...$params);
					break;
				}
			}

		}

	}

	return $errors;

} 
