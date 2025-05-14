<div class="w-full">
	<div class="input-container relative">
		<div class="textarea-label"><?= $label ?></div>
		<textarea class="input h-32 w-full [&]:pr-[36px] resize-none"
				  id="<?= $name ?>"
				  name="<?= $name ?>" ><?= $placeholder ?? $inputs[$name] ?? '' ?></textarea>
	</div>
	<div class="text-red-500"><?= $errors[$name] ?? '' ?></div>
</div>