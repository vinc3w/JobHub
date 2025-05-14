<?php

$errors = [];

if (is_post_request()) {

	if ($_POST['type'] === 'profile-picture') {

		$fields = [
			'profile-picture' => 'url | url | max: 255',
		];
		
		[$inputs, $errors] = filter($_POST, $fields);

		if (!$errors) {

			db()->exec(
				'UPDATE user SET ' . 
				'profile_picture = \'' . $inputs['profile-picture'] . '\' ' .
				'WHERE id = ' . $_SESSION['user']['id']
			);
			$_SESSION['user'] = get_user('id', $_SESSION['user']['id']);
			flash('profile-picture-saved', 'Profile picture saved. 😭', FLASH_SUCCESS, true);

		} else {
			
			flash('profile-picture-fail', 'Saving profile picture failed. 😭', FLASH_ERROR, true);

		}

	}

}

?>

<section class="shadow mt-5 p-9 w-full rounded-2xl bg-white">

	<form class="mt" autocomplete="off" method="post">

		<!-- Remove autocomplete and autosave fill -->
		<input autocomplete="false" name="hidden" type="text" style="display:none;">
		
		<div class="flex w-full">

			<div class="h-36 min-w-36 mr-5 bg-red bg-center bg-cover bg-no-repeat" style="background-image: url('<?= $_SESSION['user']['profile_picture']  ? $_SESSION['user']['profile_picture'] : '../assets/pfp.png' ?>');"></div>

			<div class="w-full">
				<?php
					view('input', [
						'label' => 'Profile Picture URL',
						'name' => 'profile-picture',
						'placeholder' => $_SESSION['user']['profile_picture'],
						'errors' => $errors
					])
				?>
				<button class="primary-button mt-2 w-fit" type="submit" name="type" value="profile-picture">Save</button>
			</div>

		</div>
			

	</form>

</section>
