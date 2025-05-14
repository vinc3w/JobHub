<?php

require __DIR__ . '/../../src/bootstrap.php';

if (!is_user_logged_in()) {
	redirect_to('../../public/auth/login.php');
}

if (!$_SESSION['user']['is_admin']) {
	redirect_to('../../public/home/dashboard.php');
}

if (!isset($_GET['user-id'])) {

	view('header', ['title' => 'Profile']);
	view('footer');
	return;
}

$user_id = $_GET['user-id'];

if ($user_id == $_SESSION['user']['id']) {
	redirect_to('../../public/home/profile.php');
}

$user = get_user('id', $user_id);

if (!$user) {

	view('header', ['title' => 'Profile']);
	echo '<div class="text-3xl font-semibold my-5">No user with id: ' . $user_id . ' exist!</div>';
	view('footer');
	return;

}

view('header', ['title' => 'Profile']);

$portfolio_inputs = $user;
$portfolio_errors = [];
$skill_inputs = $user['skills'];
$skill_errors = [];
$need_reason = true;

if (is_post_request()) {

	if ($_POST['type'] === 'portfolio') {

		[$portfolio_inputs, $portfolio_errors] = update_portfolio($user_id, $_POST, $need_reason);

		// $_POST have data that are '-' instead of '_', so the code here resets it to '_'
		$portfolio_inputs = get_user('id', $user_id);

		if (count($portfolio_errors)) {
			flash('portfolio-failed', 'Error saving portfolio. 😭', FLASH_ERROR, true);
		} else {
			flash('portfolio-saved', 'Portfolio saved. 😭', FLASH_SUCCESS, true);
		}
			
	} else if ($_POST['type'] === 'skills') {
		
		[$skill_inputs, $skill_errors] = update_skills(
			$user_id,
			isset($_POST['skills']) ? $_POST['skills'] : [],
			$need_reason,
			$_POST['reason'] ?? null
		);

		if (count($skill_errors)) {
			flash('skill-failed', 'Error saving skill. 😭', FLASH_ERROR, true);
		} else {
			flash('skill-saved', 'Skills saved. 😭', FLASH_SUCCESS, true);
		}

	}

	insert_notification($user_id, 'edited your portfolio', $_POST['reason']);

}

echo '
	<div class="my-5">
		<div class="text-3xl font-semibold">' . $user['username'] . '\'s Profile</div>
		<a href="../home/dashboard.php" class="text-sm opacity-70 hover:underline">Back to Dashboard</a>
	</div>
';

?>

<?php

require __DIR__ . '/../home/partials/profile/portfolio.php';
require __DIR__ . '/../home/partials/profile/skills.php';

echo '<div class="mb-5"></div>';

view('footer');

?>
