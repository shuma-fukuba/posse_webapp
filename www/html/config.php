<?php
session_start();
define('DSN', 'mysql:host=posse_webapp_db_1;dbname=posse_webapp;charset=utf8mb4');
define('DB_USER', 'root');
define('DB_PASS', 'password');
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);
Token::create();
