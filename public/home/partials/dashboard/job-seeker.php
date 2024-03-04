<div class="bg-white p-7 rounded-lg w-full h-fit mb-4 overflow-auto sticky top-[80px] max-h-[calc(100vh-96px)]">

	<div class="flex justify-between">
		<div class="bg-red bg-center bg-cover bg-no-repeat h-32 w-32" style="background-image: url('<?= $job_seeker['profile_picture']  ? $job_seeker['profile_picture'] : '../assets/pfp.png' ?>');"></div>
		<?php
			$href;
			if ($job_seeker['id'] === $_SESSION['user']['id']) {
				$href = 'profile.php';
			} else if ($_SESSION['user']['is_admin']) {
				$href = '../admin/profile.php?user-id=' . $job_seeker['id'];
			}
			echo isset($href) ? '
				<a class="text-xl rounded-full flex justify-center items-center hover:scale-110 h-fit active:opacity-60" href="' . $href . '">
					<i class="fa-solid fa-pen-to-square"></i>
				</a>' : '';
		?>
	</div>

	<div class="text-4xl font-semibold mt-2"><?= $job_seeker['preferred_position'] ?></div>

	<div class="text-xl"><?= $job_seeker['username'] ?></div>

	<div class="text-xs opacity-70 mb-2" time="Time Joined">joined <?= get_time_ago($job_seeker['date_joined']) ?></div>

	<table>
		<tr title="Preferred Lcoation">
			<td class="text-center"><i class="fa-solid fa-location-dot"></i></td>
			<td class="pl-2"><?= $job_seeker['preferred_location'] ?></td>
		</tr>
		<tr title="Preferred Work Type">
			<td class="text-center"><i class="fa-solid fa-clock"></i></td>
			<td class="pl-2"><?= $job_seeker['preferred_work_type'] ?></td>
		</tr>
		<tr>
			<td class="text-center"><i class="fa-solid fa-person"></i></td>
			<td class="pl-2"><?= $job_seeker['gender'] ?></td>
		</tr>
		<tr>
			<td class="text-center"><i class="fa-solid fa-cake-candles"></i></td>
			<td class="pl-2"><?= $job_seeker['date_of_birth'] ?></td>
		</tr>
	</table>

	<a class="inline-block primary-button [&]:px-7 mt-3" href="mailto:<?= $job_seeker['email'] ?>" target="_blank">Contact</a>

	<div class="font-bold mt-3">About:</div>
	<div><?= $job_seeker['about'] ?></div>

	<div class="font-bold mt-3">Ability:</div>
	<div><?= $job_seeker['ability'] ?></div>

	<div class="font-bold mt-3">Knowledge:</div>
	<div><?= $job_seeker['knowledge'] ?></div>

	<div class="font-bold mt-3">Education:</div>
	<div><?= $job_seeker['current_educational_level'] ?></div>
	<div><?= $job_seeker['educational_background'] ?></div>

	<?=
		count($job_seeker['skills']) ? '
			<div class="font-bold mt-3">Skills:</div>
			<div>' . join(', ', $job_seeker['skills']) . '</div>
		' :
		''
	?>

	<div class="font-bold mt-3">More Info:</div>
	<div><?= $job_seeker['more_info'] ?></div>

</div>