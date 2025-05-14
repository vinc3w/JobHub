<?php

require __DIR__ . '/../../src/bootstrap.php';

if (is_user_logged_in()) {
	redirect_to('../home/dashboard.php');
}

flash('registration-successful');
flash('password-reset-success');

$inputs = [];
$errors = [];

if (is_post_request()) {

	$fields = [
		'email' => 'string | required | email | max: 255',
		'password' => 'string | required | max: 255',
	];
	
	[$inputs, $errors] = filter($_POST, $fields);

	if (!$errors) {

		$stmt = db()->prepare(
			'SELECT * FROM user ' .
			'WHERE email = \'' . $inputs['email'] . '\' ' .
			'AND password = \'' . $inputs['password'] . '\''
		);
		$stmt->execute();
		
		if (!$stmt->fetchColumn()) {
			flash('incorrect-credentials', 'Either email or password is incorrect. Please try again.', FLASH_ERROR, true);
		}
		else {
			insert_user_token(get_user('email', $inputs['email'])['id'], isset($_POST['remember']));
			redirect_to('../home/dashboard.php');
		}
	
	}

}

?>
<?php view('header', ['title' => 'Login']) ?>

<div class="min-h-[calc(100vh-124px)] py-7 px-5 flex justify-center items-center">

	<div class="shadow p-9 w-96 rounded-2xl bg-white">

		<div class="text-3xl font-bold text-center">Login</div>

		<div class="mt-4 mx-4 text-center">Hey, Enter your details below to log in to your account!</div>

		<form class="mt-4 flex flex-col items-center space-y-4" autocomplete="off" method="post">

			<!-- Remove autocomplete and autosave fill -->
			<input autocomplete="false" name="hidden" type="text" style="display:none;">
		
				<?php
					view('input', [
						'label' => 'Email',
						'name' => 'email',
						'inputs' => $inputs,
						'errors' => $errors,
					])
				?>
				<?php
					view('input', [
						'label' => 'Password',
						'name' => 'password',
						'type' => 'password',
						'errors' => $errors,
					])
				?>

			<div class="w-full flex justify-between">

				<div>
					<input type="checkbox" name="remember" id="remember">
					<label for="remmeber">Remember me</label>
				</div>

				<a class="font-semibold hover:underline text-sm" href="./forgot-password.php">Forgot password?</a>

			</div>
			
			<button class="primary-button w-full" type="submit">Log in</button>

			<div class="text-xs">
				Don't have an account?
				<a class="font-semibold hover:underline" href="./register.php">Register here</a>
			</div>

		</form>

	</div>

</div>

<?php view('footer') ?>
