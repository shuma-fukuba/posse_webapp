<?php
session_start();
define('DSN', 'mysql:host=posse_webapp_db_1;dbname=posse_webapp;charset=utf8mb4');
define('DB_USER', 'root');
define('DB_PASS', 'password');
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);

use MyApp\Database;
use MyApp\Token;

spl_autoload_register(function ($class) {
    $prefix = 'MyApp\\';
    if (strpos($class, $prefix) === 0) {
        $file_name = sprintf(__DIR__ . '/%s.php', substr($class, strlen($prefix)));
        if (file_exists($file_name)) {
            require($file_name);
        } else {
            echo 'File not found ' . $file_name;
            exit;
        }
    }
});

Token::create();

$db = Database::getInstance();
