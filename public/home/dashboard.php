<?php

require __DIR__ . '/../../src/bootstrap.php';

if (!is_user_logged_in()) {
	redirect_to('../auth/login.php');
}

$total_portfolio_count = count(get_all_portfolios($_GET));
$portfolios = get_portfolios(
	isset($_GET['page']) && $_GET['page'] !== '' ? $_GET['page'] : 1,
	$_GET
);
$job_seeker = get_user('id', isset($_GET['job-seeker-id']) && $_GET['job-seeker-id'] ? $_GET['job-seeker-id'] : $_SESSION['user']['id']);

?>
<?php

view('header', ['title' => 'Dashboard']);
require __DIR__ . '/partials/dashboard/seek.php';

?>

<div class="my-3 flex items-center gap-2">
	<div class="hover:scale-110 active:opacity-60 transition-all">
		<a href="?<?= add_to_url_params(['order' => isset($_GET['order']) && $_GET['order'] === 'desc' ? 'asc' : 'desc']) ?>">
			<i class="fa-solid fa-sort"></i>
		</a>
	</div>
	<div><?= $total_portfolio_count ?> Job Seekers</div>
</div>

<div class="flex gap-4">
	<?php

	require __DIR__ . '/partials/dashboard/job-seeker-list.php';
	require __DIR__ . (isset($job_seeker) ? '/partials/dashboard/job-seeker.php' : '/partials/dashboard/no-job-seeker.php');

	?>
</div>

<?php view('footer') ?>
