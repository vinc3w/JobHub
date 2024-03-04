<?php

require __DIR__ . '/../../src/bootstrap.php';

if (!is_user_logged_in()) {
	redirect_to('../auth/login.php');
}

$portfolio_inputs = $_SESSION['user'];
$portfolio_errors = [];
$skill_inputs = $_SESSION['user']['skills'];
$skill_errors = [];

if (is_post_request()) {

	if ($_POST['type'] === 'portfolio') {
		
		[$portfolio_inputs, $portfolio_errors] = update_portfolio($_SESSION['user']['id'], $_POST);

		// $_POST have data that are '-' instead of '_', so the code here resets it to '_'
		$portfolio_inputs = get_user('id', $_SESSION['user']['id']); 

		$_SESSION['user'] = $portfolio_inputs;

		flash('portfolio-saved', 'Portfolio saved. 😭', FLASH_SUCCESS, true);
			
	} else if ($_POST['type'] === 'skills') {
		
		[$skill_inputs, $skill_errors] = update_skills($_SESSION['user']['id'], isset($_POST['skills']) ? $_POST['skills'] : []);

		$_SESSION['user'] = get_user('id', $_SESSION['user']['id']);
		
		flash('skills-saved', 'Skills saved. 😭', FLASH_SUCCESS, true);

	}

}

view('header', ['title' => 'Profile']);

echo '
	<div class="my-5">
		<div class="text-3xl font-semibold">My Profile</div>
		<a href="dashboard.php" class="text-sm opacity-70 hover:underline">Back to Dashboard</a>
	</div>
';

require __DIR__ . '/partials/profile/profile-picture.php';
require __DIR__ . '/partials/profile/user.php';
require __DIR__ . '/partials/profile/password.php';
require __DIR__ . '/partials/profile/portfolio.php';
require __DIR__ . '/partials/profile/skills.php';
require __DIR__ . '/partials/profile/logout.php';

view('footer');

?>
