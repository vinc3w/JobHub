<form class="bg-white rounded-lg p-10 mt-8">

		<!-- keep current existing GET request parameters intact -->
		<input type="hidden" name="job-seeker-id" value="<?= isset($_GET['job-seeker-id']) ? $_GET['job-seeker-id'] : '' ?>">
		<input type="hidden" name="page" value="<?= isset($_GET['page']) ? $_GET['page'] : 1 ?>">
		<input type="hidden" name="order" value="<?= isset($_GET['order']) ? $_GET['order'] : 'asc' ?>">

		<div class="w-full flex gap-1">
			<?php
				view('input', [
					'label' => 'Username',
					'name' => 'username',
					'placeholder' => isset($_GET['username']) ? $_GET['username'] : '',
				])
			?>
			<?php
				view('input', [
					'label' => 'Preferred Position',
					'name' => 'preferred-position',
					'placeholder' => isset($_GET['preferred-position']) ? $_GET['preferred-position'] : '',
				])
			?>
			<?php
				view('input', [
					'label' => 'Preferred Location',
					'name' => 'preferred-location',
					'placeholder' => isset($_GET['preferred-location']) ? $_GET['preferred-location'] : '',
				])
			?>
			<button class="primary-button">Seek</button>
		</div>

	<div class="flex gap-2 mt-3">
			<?php
				view('select-checkbox', [
					'label' => 'Current Educational Level',
					'name' => 'current-educational-level',
					'placeholder' => isset($_GET['current-educational-level']) ? $_GET['current-educational-level'] : 'None',
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
				view('select-checkbox', [
					'label' => 'Preferred Work Type',
					'name' => 'preferred-work-type',
					'placeholder' => isset($_GET['preferred-work-type']) ? $_GET['preferred-work-type'] : 'None',
					'options' => [
						'Full Time' => 'Full Time',
						'Part Time' => 'Part Time',
						'Contract' => 'Contract',
						'Casual/Vacation' => 'Casual/Vacation',
					]
				])
			?>
			<?php
				view('select-checkbox', [
					'label' => 'Gender',
					'name' => 'gender',
					'placeholder' => isset($_GET['gender']) ? $_GET['gender'] : 'None',
					'options' => [
						'Male' => 'Male',
						'Female' => 'Female',
					]
				])
			?>
			<?php
				view('select-menu', [
					'label' => 'Sort By',
					'name' => 'sort-by',
					'placeholder' => isset($_GET['sort-by']) ? $_GET['sort-by'] : 'Date',
					'default_value' => isset($_GET['sort-by']) ? $_GET['sort-by'] : 'Date',
					'options' => [
						'Date' => 'Date',
						'Alphabetical' => 'Alphabetical',
					]
				])
			?>
	</div>

</form>