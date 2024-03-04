<?php

$placeholder_text = $placeholder;

if (gettype($placeholder) !== 'string') {

	if (count($placeholder) === 1) {

		$placeholder_text = $placeholder[0];

	} else {

		$placeholder_text = count($placeholder) . ' selected';

	}

}

?>
<div class="w-full input-container relative">

	<div class="input-label input-focus-label"><?= $label ?></div>
	
	<div class="relative">
		<div class="select input flex items-center" type='select'>
			<div class="w-full placeholder"><?= quick_sanitize($placeholder_text)  ?></div>
			<button class="select-button flex items-center justify-center h-[10px] ml-[10px]" type="button">
				<div class="border-black triangle-down transition-transform"></div>
			</button>
		</div>
		<div class="absolute top-[calc(100%+3px)] w-full left-0 z-40 bg-white py-[10px] px-[5px] border rounded-lg" style="display:none;">
			<?php
				foreach ($options as $key => $value) {
					$is_checked = gettype($placeholder) === 'array' && in_array($value, $placeholder);
					echo '
						<div class="flex items-center gap-2 p-[5px] hover:bg-gray-50 active:bg-gray-100 transition-colors rounded">
							<input class="mt-1" type="checkbox" name="' . $name . '[]" value="' . $value . '" ' . ($is_checked ? 'checked' : '') . '>
							<div>' . $key . '</div>
						</div>
					';
				}
			?>
		</div>
	</div>

</div>