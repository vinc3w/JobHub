<?php

function array_trim($items): array {

	return array_map(function ($item) {

		if (is_string($item)) return trim($item);
		if (is_array($item)) return array_trim($item);
		else return $item;

	}, $items);

}

function sanitize(array $inputs, array $fields): array {

	$options = array_map(fn($field) => FILTERS[$field], $fields);
	$filtered = filter_var_array($inputs, $options);
	return array_trim($filtered);

}

function quick_sanitize(mixed $input, string $type = 'string'): mixed {

    return filter_var($input, FILTERS[$type]);

}
