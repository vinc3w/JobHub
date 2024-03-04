<?php

require __DIR__ . '/../../src/bootstrap.php';

if (is_user_logged_in()) {
	redirect_to('../home/dashboard.php');
}

$inputs = [];
$errors = [];

if (is_post_request()) {

	$fields = [
		'username' => 'string | required | alphanumeric | max: 25',
		'email' => 'string | required | email | unique: user, email | max: 255',
		'password' => 'string | required | min: 8 | same: confirm-password | max: 255',
	];
	
	[$inputs, $errors] = filter($_POST, $fields);

	if (!$errors) {

		db()->exec('
			INSERT INTO user (username, email, password, date_joined) VALUE
			(\'' . $inputs['username'] . '\', \'' . $inputs['email'] . '\', \'' . $inputs['password'] . '\', NOW())
		');
		redirect_with_message('login.php', 'registration-successful', 'Registration is successful.');
		
	}

}

?>
<?php view('header', ['title' => 'Register']) ?>

<div class="min-h-[calc(100vh-124px)] py-7 px-5 flex justify-center items-center">

	<div class="shadow p-9 w-96 rounded-2xl bg-white">

		<div class="text-3xl font-bold text-center">Register</div>

		<div class="mt-4 mx-4 text-center">Hello, please enter your details below to register an account!</div>

		<form class="mt-4 flex flex-col items-center space-y-4" autocomplete="off" method="post">

			<!-- Remove autocomplete and autosave fill -->
			<input autocomplete="false" name="hidden" type="text" style="display:none;">

			<?php
				view('input', [
					'label' => 'Username',
					'name' => 'username',
					'inputs' => $inputs,
					'errors' => $errors,
				])
			?>
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
			<?php
				view('input', [
					'label' => 'Confirm Password',
					'name' => 'confirm-password',
					'type' => 'password',
					'errors' => $errors,
				])
			?>

			<button class="primary-button w-full" type="submit">Register</button>

			<div class="text-xs">
				Already have an account?
				<a class="font-semibold hover:underline" href="./login.php">Login here</a>
			</div>

		</form>

	</div>

</div>

<?php view('footer') ?>
