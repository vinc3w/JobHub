<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

require_once __DIR__ . '/../config/variables.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/smtp.php';

require_once __DIR__ . '/libs/helpers/auth.php';
require_once __DIR__ . '/libs/helpers/route.php';
require_once __DIR__ . '/libs/helpers/email.php';
require_once __DIR__ . '/libs/helpers/time.php';
require_once __DIR__ . '/libs/helpers/string.php';
require_once __DIR__ . '/libs/helpers/notification.php';
require_once __DIR__ . '/libs/helpers/portfolio.php';

require_once __DIR__ . '/libs/flash.php';
require_once __DIR__ . '/libs/sanitization.php';
require_once __DIR__ . '/libs/validation.php';
require_once __DIR__ . '/libs/filter.php';
