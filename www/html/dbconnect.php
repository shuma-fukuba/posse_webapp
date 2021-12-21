<?php
define('DSN', 'mysql:host=posse_webapp_db_1;dbname=posse_webapp;charset=utf8mb4');
define('DB_USER', 'root');
define('DB_PASS', 'password');

try {
    $db = new PDO(DSN, DB_USER, DB_PASS,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,]
);
} catch(PDOException $e){
    print('DB接続エラー:' . $e->getMessage());
}
