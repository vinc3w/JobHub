<?php

require __DIR__ . '/../../src/bootstrap.php';

$user_is_logged_in = is_user_logged_in();
$inputs = [];
$errors = [];

if (is_post_request()) {

	if ($_POST['type'] === 'send-code') {

		$fields = [
			'email' => 'string | required | email | exist: user, email | max: 255',
		];
		
		[$inputs, $errors] = filter($_POST, $fields);

		if (!$errors) {
			
			$code = random_str(6);

			send_forgot_password_email($inputs['email'], $code);
			store_reset_password_code($inputs['email'], $code);

		}
				
		flash('forgot-password-code-email-sent', 'Sent forgot password code email. 👍.', FLASH_SUCCESS, true);

	}
	else if ($_POST['type'] === 'change-password') {

		$fields = [
			'email' => 'string | required | email | exist: user, email | max: 255',
			'code' => 'string | required',
			'password' => 'string | required | min: 8 | same: confirm-password | max: 255',
		];
		
		[$inputs, $errors] = filter($_POST, $fields);

		if (!$errors) {

			if (!validate_password_reset_code($inputs)) {
				
				flash('password-reset-code-invalid', 'Incorrect code or has expired.', FLASH_ERROR, true);

			}
			else {
			
				db()->exec('UPDATE user SET password = \'' . $inputs['password']. '\' WHERE email = \'' . $inputs['email'] . '\'');
				delete_password_reset_code($inputs);
				
				redirect_with_message(
					$user_is_logged_in ? '../home/profile.php' : 'login.php',
					'password-reset-success',
					'Password has been updated.'
				);

			}

		}

	}

}

?>
<?php view('header', ['title' => 'Forgot Password']) ?>

<div class="min-h-[calc(100vh-124px)] py-7 px-5 flex justify-center items-center">

	<div class="shadow p-9 w-96 rounded-2xl bg-white">

		<div class="text-3xl font-bold text-center">Forgot Password</div>

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
			
			<button class="primary-button w-full" name="type" value="send-code" type="submit">Send Code</button>
			
			<?php
				view('input', [
					'label' => 'Code',
					'name' => 'code',
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
			
			<button class="primary-button w-full" name="type" value="change-password" type="submit">Change Password</button>

			<div class="text-xs w-full">
				<?=
					$user_is_logged_in ? 
					'<a class="font-semibold hover:underline" href="../home/profile.php">Back to profile page</a>' :
					'<a class="font-semibold hover:underline" href="./login.php">Back to login page</a>'
				?>
			</div>

		</form>

	</div>

</div>

<?php view('footer') ?>
