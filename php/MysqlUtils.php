<?php


class MysqlUtils {
    static $servername = "localhost";
    static $dbname = "address_book";
    static $username = "root";
    static $password = "root";

    public static function getConn() {
        try {
            $conn = new PDO("mysql:host=".self::$servername.";dbname=".self::$dbname, self::$username, self::$password);
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
            return $conn;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}



