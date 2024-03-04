<?php 

function filter_portfolio(array $portfolios, array $options): array {

	return array_filter($portfolios, function ($portfolio) use ($options) {

		$like_current_educational_level = true;
		$like_preferred_work_type = true;
		$like_gender = true;
		$like_username = true;
		$like_preferred_position = true;
		$like_preferred_location = true;

		if (isset($options['current-educational-level'])) {
			$like_current_educational_level = in_array(
				$portfolio['current_educational_level'],
				$options['current-educational-level']
			);
		}

		if (isset($options['preferred-work-type'])) {
			$like_preferred_work_type = in_array(
				$portfolio['preferred_work_type'],
				$options['preferred-work-type']
			);
		}

		if (isset($options['gender'])) {
			$like_gender = in_array(
				$portfolio['gender'],
				$options['gender']
			);
		}

		if (isset($options['username'])) {
			$like_username = str_contains(
				strtolower($portfolio['username']),
				strtolower($options['username'])
			);
		}

		if (isset($options['preferred-position'])) {
			$like_preferred_position = str_contains(
				strtolower($portfolio['preferred_position']),
				strtolower($options['preferred-position'])
			);
		}

		if (isset($options['preferred-location'])) {
			$like_preferred_location = str_contains(
				strtolower($portfolio['preferred_location']),
				strtolower($options['preferred-location'])
			);
		}

		return $like_current_educational_level && $like_preferred_work_type && $like_gender &&
			   $like_username && $like_preferred_position && $like_preferred_location;

	});

}

function get_all_portfolios(array $options): array {

	$stmt = db()->prepare(
		'SELECT * FROM user'
	);
	$stmt->execute();

	return filter_portfolio($stmt->fetchAll(), $options);

}

function get_portfolios(int $page = 1, array $options = []): array {

	$sort_by = ' ORDER BY ' . (
				isset($options['sort-by']) ?
					($options['sort-by'] === 'Date' ? 'date_joined' : 'username') :
					'date_joined'
	);
	$order = isset($_GET['order']) ? 
				' ' . ($_GET['order'] === 'asc' ? 'asc' : 'desc') :
				'';
	$stmt = db()->prepare('SELECT * FROM user' . $sort_by . $order);
	$stmt->execute();

	return array_slice(
		filter_portfolio($stmt->fetchAll(), $options),
		($page - 1) * 10, 10
	);

}

function update_portfolio(int $user_id, array $portfolio, bool $need_reason = false): array {

	$fields = [
		'preferred-position' => 'string | max: 35',
		'preferred-location' => 'string | max: 255',
		'preferred-work-type' => 'string',
		'about' => 'string | max: 255',
		'ability' => 'string | max: 255',
		'knowledge' => 'string | max: 255',
		'current-educational-level' => 'string',
		'educational-background' => 'string | max: 255',
		'more-info' => 'string | max: 255',
		'reason' => 'string' . ($need_reason ? ' | required | max:255' : ''),
	];
	
	[$inputs, $errors] = filter($portfolio, $fields);

	if ($errors) {
		return [$inputs, $errors];
	}

	db()->exec(
		'UPDATE user SET ' . 
		'preferred_position = \'' . $inputs['preferred-position'] . '\', ' .
		'preferred_location = \'' . $inputs['preferred-location'] . '\', ' .
		'preferred_work_type = \'' . $inputs['preferred-work-type'] . '\', ' .
		'about = \'' . $inputs['about'] . '\', ' .
		'ability = \'' . $inputs['ability'] . '\', ' .
		'knowledge = \'' . $inputs['knowledge'] . '\', ' .
		'current_educational_level = \'' . $inputs['current-educational-level'] . '\', ' .
		'educational_background = \'' . $inputs['educational-background'] . '\', ' .
		'more_info = \'' . $inputs['more-info'] . '\' ' .
		'WHERE id = ' . $user_id
	);

	return [$inputs, $errors];

}

function update_skills(int $user_id, array $skills, bool $need_reason = false, string $reason = null): array {

	$inputs = [];
	$errors = [];

	if ($need_reason && !trim($reason)) {
		$errors['reason'] = sprintf(DEFAULT_VALIDATION_ERRORS['required'], 'Reason of Editing');
	}

	if (strlen(trim($reason)) > 255) {
		$errors['reason'] = sprintf(DEFAULT_VALIDATION_ERRORS['max'], 'Reason of Editing', '225');
	}

	if ($errors) {
		return [$inputs, $errors];
	}

	for ($i = 0; $i < count($skills); $i++) {
	
		if (strlen($skills[$i]) > 255) {
			array_push($errors, sprintf(DEFAULT_VALIDATION_ERRORS['max'], 'skill', '255'));
		} else {
			array_push($errors, '');
		}
		$sanitized = quick_sanitize($skills[$i]);
		array_push($inputs, strlen($sanitized) > 255 ? '' : $sanitized);

	}
	
	$errors = array_filter($errors, fn($e) => $e !== '');
	if ($errors) {
		return [$inputs, $errors];
	}
	
	db()->exec("
		DELETE FROM user_skill
		WHERE user_id = $user_id
	");
	if (array_filter($inputs, fn($e) => $e !== '')) {
		$sql = 'INSERT INTO user_skill (skill, user_id) VALUES ';
		foreach ($inputs as $input) {
			if (trim($input) === '') {
				continue;
			}
			$sql .= "('$input', $user_id),";
		}
		db()->exec(substr($sql, 0, strlen($sql) - 1));
	}

	return [$inputs, $errors]; 

}
