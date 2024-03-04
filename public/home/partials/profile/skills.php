<section class="shadow mt-5 p-9 w-full rounded-2xl bg-white">

	<div class="text-xl font-semibold text-left">Skills</div>

	<form id="skill" class="mt-4 flex flex-col items-end space-y-4" autocomplete="off" method="post">

		<!-- Remove autocomplete and autosave fill -->
		<input autocomplete="false" name="hidden" type="text" style="display:none;">
			
		<div id="skill-container" class="w-full space-y-4">
			<?php
				function skill_input($placeholder, $error_message) {
					echo '
						<div class="flex">
					';
					view('input', [
						'label' => 'Skill',
						'name' => 'skills[]',
						'placeholder' => $placeholder,
						'error_message' => $error_message,
					]);
					echo '
							<button class="danger-button ml-4" type="button">
								<i class="fa-solid fa-trash"></i>
							</button>
						
						</div>
					';
				}
				for ($i = 0; $i < count($skill_inputs); $i++) {
					skill_input($skill_inputs[$i], isset($skill_errors[$i]) ? $skill_errors[$i] : '');
				}
				if (!count($skill_inputs)) {
					skill_input('' , '');
				}
			?>
		</div>

		<?php
			isset($need_reason) && $need_reason ? view('input', [
				'label' => 'Reason of Editing',
				'name' => 'reason',
				'placeholder' => $_POST['reason'] ?? '',
				'errors' => $skill_errors,
			]) : ''
		?>
		
		<div>
			<button id="add-skill-button" class="secondary-button nt-4" name="type" type="button">
				<i class="fa-solid fa-plus"></i>
			</button>
			<button class="primary-button nt-4" name="type" value="skills">Save</button>
		</div>
		
		<script src="../../src/scripts/skills.js"></script>
	</form>

</section>
