<?php

$errors = [];

if (is_post_request()) {

	if ($_POST['type'] === 'password') {

		$fields = [
			'current-password' => 'string | required',
			'new-password' => 'string | required | same: confirm-new-password | max: 255',
		];
		
		[$inputs, $errors] = filter($_POST, $fields);

		if (!$errors) {

			$stmt = db()->prepare(
				'SELECT * FROM user ' .
				'WHERE id = ' . $_SESSION['user']['id'] . ' ' .
				'AND password = \'' . $inputs['current-password'] . '\''
			);
			$stmt->execute();

			if (count($stmt->fetchAll())) {
	
				db()->exec(
					'UPDATE user SET password = \'' . $inputs['new-password'] . '\' ' . 
					'WHERE id = ' . $_SESSION['user']['id']
				);
				$_SESSION['user'] = get_user('id', $_SESSION['user']['id']);
				flash('password-saved', 'Password saved. 😭', FLASH_SUCCESS, true);

			} else {
			
				flash('password-wrong', 'Current password is incorrect. 😭', FLASH_ERROR, true);

			}

		} else {
			
			flash('password-fail', 'Saving password failed. 😭', FLASH_ERROR, true);

		}
			
	}

}

?>

<section class="shadow mt-5 p-9 w-full rounded-2xl bg-white">

	<div class="text-xl font-semibold text-left">Password</div>

	<form class="mt-4 flex flex-col items-end space-y-4" autocomplete="off" method="post">

		<!-- Remove autocomplete and autosave fill -->
		<input autocomplete="false" name="hidden" type="text" style="display:none;">

		<div class="flex gap-4 w-full">

			<div class="flex w-full flex-col space-y-4">
			
				<?php
					view('input', [
						'label' => 'New Password',
						'name' => 'new-password',
						'type' => 'password',
						'errors' => $errors,
					])
				?>
				<?php
					view('input', [
						'label' => 'Confirm New Password',
						'name' => 'confirm-new-password',
						'type' => 'password',
						'errors' => $errors,
					])
				?>

			</div>

			<div class="flex w-full flex-col space-y-4">
		
				<?php
					view('input', [
						'label' => 'Current Password',
						'name' => 'current-password',
						'type' => 'password',
						'errors' => $errors,
					])
				?>

			</div>

		</div>
			
		<div>
			<a class="text-sm mr-2 opacity-70 hover:underline" href="../auth/forgot-password.php">Forgot password?</a>
			<button class="primary-button" type="submit" name="type" value="password">Save</button>
		</div>

	</form>

</section>
