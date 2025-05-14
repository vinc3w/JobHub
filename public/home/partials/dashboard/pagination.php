<div class="flex justify-center bg-white rounded-lg px-5">
	<?php
		$total_page_count = (int)ceil($total_portfolio_count / 10);
		$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

		if ($total_page_count !== 1 && $total_portfolio_count !== 0) {

			$button = fn($direction) => '
				<a class="flex justify-center items-center py-1 px-3 my-2 rounded hover:bg-orange-200 active:bg-orange-300 transition-colors" href="?' . add_to_url_params(['page' => $current_page - ($direction === 'left' ?  1 : -1)]) . '">
					<i class="fa-solid fa-caret-' . $direction . '"></i>
				</a>
			';
			$page = fn($page_number) => '
				<a class="py-1 px-3 rounded hover:bg-orange-200 active:bg-orange-300 transition-colors ' . ($page_number === $current_page ? 'bg-orange-300' : '') . '" href="?' . add_to_url_params(['page' => $page_number]) . '">
					' . $page_number . '
				</a>
			';
	
			if ($current_page === 1) {
	
				echo '<div class="flex justify-center my-2">';
	
				echo $page($current_page);
				if ($current_page + 1 <= $total_page_count) {
					echo $page($current_page + 1);
				}
				if ($current_page + 2 <= $total_page_count) {
					echo $page($current_page + 2);
				}
	
				echo '</div>';
	
				echo $button('right');
	
			} else if ($current_page === $total_page_count) {
	
				echo $button('left');
	
				echo '<div class="flex justify-center my-2">';
				
				if ($current_page - 2 >= 1) {
					echo $page($current_page - 2);
				}
				if ($current_page - 1 >= 1) {
					echo $page($current_page - 1);
				}
				echo $page($current_page);
	
				echo '</div>';
	
			} else {
	
				echo $button('left');
	
				echo '<div class="flex justify-center my-2">';
	
				echo $page($current_page - 1);
				echo $page($current_page);
				echo $page($current_page + 1);
	
				echo '</div>';
	
				echo $button('right');
	
			}
			
		}


	?>
</div>