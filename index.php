<?php

require __DIR__ . '/src/bootstrap.php';

if (is_user_logged_in()) {
	redirect_to('public/home/dashboard.php');
}

?>
<?php view('header', ['title' => APP_NAME]) ?>

<div class="text-[200px] font-mono font-bold -ml-4 mt-12 leading-[180px]">JobHub</div>

<div class="text-7xl font-mono font-semibold">
    Your Future
    <span class="text-red-500">Blown</span>
    Wide Open!
</div>

<div class="text-5xl mt-7 font-semibold">
	Join 👉 <a class="primary-button" href="./public/auth/register.php">here</a> 👈
</div>

<div class="text-xl font-sans mt-20 mb-10 text-justify">
	<span class="text-3xl font-bold">JobHub</span>, an innovative employment app, redefines job hunting by seamlessly connecting users with diverse opportunities. 
	The user-friendly interface provides personalized job recommendations based on skills, ensuring efficient matchmaking. With dynamic profiles, 
	real-time notifications, and interactive features, 
	JobHub empowers users to navigate their career journey easily, fostering meaningful connections and making growth an exciting experience.
</div>

<?php view('footer') ?>
