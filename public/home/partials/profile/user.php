<?php

$errors = [];

if (is_post_request()) {

	if ($_POST['type'] === 'user') {

		$fields = [
			'username' => 'string | required | max: 25',
			'email' => 'string | required | email | max: 255',
			'date-of-birth' => 'string',
			'gender' => 'string',
		];
		
		[$inputs, $errors] = filter($_POST, $fields);

		if (!$errors) {

			db()->exec(
				'UPDATE user SET ' . 
				'username = \'' . $inputs['username'] . '\', ' .
				'email = \'' . $inputs['email'] . '\', ' .
				'date_of_birth = \'' . $inputs['date-of-birth'] . '\', ' .
				'gender = \'' . $inputs['gender'] . '\' ' .
				'WHERE id = ' . $_SESSION['user']['id']
			);
			$_SESSION['user'] = get_user('id', $_SESSION['user']['id']);
			flash('user-saved', 'Users saved. 😭', FLASH_SUCCESS, true);

		} else {
			
			flash('user-fail', 'Saving users failed. 😭', FLASH_ERROR, true);

		}

	}

}

?>

<section class="shadow mt-5 p-9 w-full rounded-2xl bg-white">

	<div class="text-xl font-semibold text-left">User</div>

	<form class="mt-4 flex flex-col items-end space-y-4" autocomplete="off" method="post">

		<!-- Remove autocomplete and autosave fill -->
		<input autocomplete="false" name="hidden" type="text" style="display:none;">

		<div class="flex gap-4 w-full">

			<div class="flex w-full flex-col space-y-4">
		
				<?php
					view('input', [
						'label' => 'Username',
						'name' => 'username',
						'placeholder' => $_SESSION['user']['username'],
						'errors' => $errors,
					])
				?>
				<?php
					view('select-menu', [
						'label' => 'Gender',
						'name' => 'gender',
						'placeholder' => $_SESSION['user']['gender'],
						'default_value' => $_SESSION['user']['gender'],
						'options' => [
							'Male' => 'Male',
							'Female' => 'Female',
						]
					])
				?>

			</div>

			<div class="flex w-full flex-col space-y-4">

				<?php
					view('input', [
						'label' => 'Date of Birth',
						'name' => 'date-of-birth',
						'type' => 'date',
						'placeholder' => $_SESSION['user']['date_of_birth'],
						'errors' => $errors,
					])
				?>
				<?php
					view('input', [
						'label' => 'Email',
						'name' => 'email',
						'placeholder' => $_SESSION['user']['email'],
						'errors' => $errors,
					])
				?>

			</div>

		</div>
			
		<button class="primary-button" type="submit" name="type" value="user">Save</button>

	</form>

</section>
