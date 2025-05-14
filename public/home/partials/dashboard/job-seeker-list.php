<div class="w-72 min-w-72 flex items-center flex-col gap-3">
	
	<?php

		foreach($portfolios as $portfolio) {

			echo '
				<a class="bg-white rounded-lg p-6 w-full cursor-pointer hover:scale-105 hover:border-2 text-left border-gray-200 transition-transform" href="?' . add_to_url_params(['job-seeker-id' => $portfolio['id']]) . '">
					<div class="text-xl font-semibold line-clamp-2" title="Preferred Position">' .
						($portfolio['preferred_position'] ?? 'None') .
						'<span class="ml-1 font-normal text-sm opacity-80" title="Preferred Location">' . $portfolio['preferred_work_type'] . '</span>' .
					'</div>
					<div class="line-clamp-2">' .
						$portfolio['username'] .
						'<span class="ml-1 font-normal text-sm opacity-80">' . $portfolio['gender'] . '</span>' .
					'</div>
					<div class="text-sm opacity-80 line-clamp-1" title="Preferred Location">' . $portfolio['preferred_location'] . '</div>
					<div class="text-sm opacity-80 line-clamp-1" title="Current Educational Level">' . $portfolio['current_educational_level'] . '</div>
					<div class="text-sm my-2 line-clamp-4">' . ($portfolio['about'] ?? 'No About me') . '</div>
					<div class="text-xs opacity-70" time="Time Joined">joined ' . get_time_ago($portfolio['date_joined']) . '</div>
				</a>
			';

		}

		require 'pagination.php';

	?>

</div>
