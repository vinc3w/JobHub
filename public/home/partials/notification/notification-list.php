<?php 

foreach($notifications as $notification) {

	$time_ago = get_time_ago($notification['time_created']);
	$profile_picture = $notification['profile_picture'] || '../assets/pfp.png';

	echo '
		<div class="flex items-stretch gap-4 bg-white shadow rounded-lg mt-2 p-4">

			<div class="h-20 min-w-20 bg-red bg-center bg-cover bg-no-repeat" style="background-image: url(\'' . $notification['profile_picture'] . '\');"></div>
		
			<div class="h-full w-full">
				<div><b>' . $notification['username'] . '</b> ' . $notification['message'] . '</div>
				<div class="text-gray-600 text-sm leading-[13px] my-1">' . $notification['description'] . '</div>
				<div class="text-gray-600 text-xs">' . $time_ago . '</div>
			</div>
		
			<form class="flex items-center" method="post">
				<button class="ml-auto px-3 hover:opacity-80 active:opacity-60 transition-opacity" name="type" value="delete:' . $notification['id'] . '">
					<i class="fa-solid fa-circle-xmark"></i>
				</button>
			</form>
		
		</div>
	';
	
}