<?=
	count($notifications) ? 
		'
			<form class="mt-4" method="post">
				<button class="danger-button" name="type" value="delete-all">
					<i class="fa-solid fa-trash"></i>&nbsp;&nbsp;Delete all (' . count($notifications) . ')
				</button>
			</form>
			<a href="dashboard.php" class="block mt-1 mb-4 text-sm opacity-70 hover:underline">Back to Dashboard</a>
		' :
		''
?>