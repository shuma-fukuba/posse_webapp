<?php

class Database
{
    private static $instance;
    
    public static function getInstance()
    {
        try {
            if (!isset(self::$instance)) {
                self::$instance = new PDO(
                    DSN,
                    DB_USER,
                    DB_PASS,
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,]
                );
            }
            return self::$instance;
        } catch (PDOException $e) {
            print('DB接続エラー:' . $e->getMessage());
        }
    }
}
