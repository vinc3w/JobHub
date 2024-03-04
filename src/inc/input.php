<?php

$is_password = isset($type) && $type === 'password';
$is_date = isset($type) && $type === 'date';

?>

<div class="w-full">
	<div class="input-container relative">
		<div class="input-label <?= $is_date ? 'input-focus-label' : '' ?>"><?= $label ?></div>
		<input  type="<?= isset($type) ? $type : 'text' ?>"
				class="input w-full <?= $is_password ? '[&]:pr-[36px]' : '' ?>"
				id="<?= $name ?>"
				name="<?= $name ?>"
				value="<?= $placeholder ?? $inputs[$name] ?? '' ?>" >
		<?=
			$is_password ?
				'
					<button class="show-password-button show-password-button-hover" type="button">
						<i class="fa-regular fa-eye"></i>
					</button>
				' :
				''
		?>
	</div>
	<div class="text-red-500"><?= isset($error_message) ? $error_message : $errors[$name] ?? '' ?></div>
</div>