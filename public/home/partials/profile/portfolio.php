<section class="shadow mt-5 mb-5 p-9 w-full rounded-2xl bg-white">

	<div class="text-xl font-semibold text-left">Portfolio</div>

	<form class="mt-4 flex flex-col items-end space-y-4" autocomplete="off" method="post">

		<!-- Remove autocomplete and autosave fill -->
		<input autocomplete="false" name="hidden" type="text" style="display:none;">
		
		<?php
			view('input', [
				'label' => 'Preferred Position',
				'name' => 'preferred-position',
				'placeholder' => $portfolio_inputs['preferred_position'],
				'errors' => $portfolio_errors,
			])
		?>
		<?php
			view('input', [
				'label' => 'Preferred Location',
				'name' => 'preferred-location',
				'placeholder' => $portfolio_inputs['preferred_location'],
				'errors' => $portfolio_errors,
			])
		?>
		<?php
			view('select-menu', [
				'label' => 'Preferred Work Type',
				'name' => 'preferred-work-type',
				'placeholder' => $portfolio_inputs['preferred_work_type'],
				'default_value' => $portfolio_inputs['preferred_work_type'],
				'options' => [
					'Full Time' => 'Full Time',
					'Part Time' => 'Part Time',
					'Contract' => 'Contract',
					'Casual/Vacation' => 'Casual/Vacation',
				]
			])
		?>
		<?php
			view('textarea', [
				'label' => 'About',
				'name' => 'about',
				'placeholder' => $portfolio_inputs['about'],
				'errors' => $portfolio_errors,
			])
		?>
		<?php
			view('textarea', [
				'label' => 'Ability',
				'name' => 'ability',
				'placeholder' => $portfolio_inputs['ability'],
				'errors' => $portfolio_errors,
			])
		?>
		<?php
			view('textarea', [
				'label' => 'Knowledge',
				'name' => 'knowledge',
				'placeholder' => $portfolio_inputs['knowledge'],
				'errors' => $portfolio_errors,
			])
		?>
		<?php
			view('select-menu', [
				'label' => 'Current Educational Level',
				'name' => 'current-educational-level',
				'placeholder' => $portfolio_inputs['current_educational_level'],
				'default_value' => $portfolio_inputs['current_educational_level'],
				'options' => [
					'High School Graduate' => 'High School Graduate',
					'College Graduate' => 'College Graduate',
					'University Graduate' => 'University Graduate',
					'Master\'s' => 'Master\'s',
					'Doctorate' => 'Doctorate',
					'PhD' => 'PhD',
				]
			])
		?>
		<?php
			view('textarea', [
				'label' => 'Educational Background',
				'name' => 'educational-background',
				'placeholder' => $portfolio_inputs['educational_background'],
				'errors' => $portfolio_errors,
			])
		?>
		<?php
			view('textarea', [
				'label' => 'More Info',
				'name' => 'more-info',
				'placeholder' => $portfolio_inputs['more_info'],
				'errors' => $portfolio_errors,
			])
		?>

		<?php
			isset($need_reason) && $need_reason ? view('input', [
				'label' => 'Reason of Editing',
				'name' => 'reason',
				'placeholder' => $_POST['reason'] ?? '',
				'errors' => $portfolio_errors,
			]) : ''
		?>
			
		<button class="primary-button" type="submit" name="type" value="portfolio">Save</button>

	</form>

</section>
