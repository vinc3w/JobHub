<div class="w-full">
	<div class="input-container relative">

		<div class="input-label input-focus-label"><?= $label ?></div>

		<div class="relative">
			<div class="select input flex items-center" type='select'>
				<div class="w-full placeholder"><?= quick_sanitize($placeholder) ?></div>
				<button class="select-button flex items-center justify-center h-[10px] ml-[10px]" type="button">
					<div class="border-black triangle-down transition-transform"></div>
				</button>
				<input class="select-input" style="display:none;" name="<?= $name ?>" id="<?= $name ?>" value="<?= quick_sanitize($default_value) ?>">
			</div>
			<div class="absolute top-[calc(100%+3px)] w-full left-0 z-40 bg-white py-[10px] px-[5px] border rounded-lg" style="display:none;">
				<?php
					foreach ($options as $key => $value) {
						echo "<div class=\"p-[5px] hover:bg-gray-50 active:bg-gray-100 transition-colors rounded\" name=\"$key\" value=\"$value\">$key</div>";
					}
				?>
			</div>
		</div>

	</div>
</div>