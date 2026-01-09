<?php
// config/database.php
class Database {
    private static $pdo;

    public static function connect() {
        if (!isset(self::$pdo)) {
            self::$pdo = new PDO('mysql:host=localhost;dbname=système_banque;charset=utf8', 'root', '');
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
}
?>