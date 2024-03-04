<?php

function filter(array $data, array $fields): array {

	$sanitization_rules = [];
	$filter_rules = [];

	foreach ($fields as $field => $rules) {

		if (strpos($rules, '|')) {
			[$sanitization_rules[$field], $filter_rules[$field]] = array_map('trim', explode('|', $rules, 2));
		}
		else {
			$sanitization_rules[$field] = $rules;
		}

	}

	$inputs = sanitize($data, $sanitization_rules);
	$errors = validate($data, $filter_rules);

	return [$inputs, $errors];

}
