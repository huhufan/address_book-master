<?php
namespace mysql;

class MysqlUtils {
    const servername = "localhost";
    const username = "root";
    const password = "root";

    public static function getConn($dbname) {
        try {
            $conn = new PDO("mysql:host=".self::$servername.";dbname=address_book", self::$username, self::$password);
            echo "连接成功";
            return $conn;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}



