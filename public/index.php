<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
require_once __DIR__ . '/../config/reporting_handler.php';

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

App\Core\App::boot();