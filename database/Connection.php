<?php
/**
 * Created by PhpStorm.
 * User: kazafy
 * Date: 25/02/17
 * Time: 12:41 م
 */

namespace database;

use PDO;


class Connection
{
    static $dsn = "mysql:host=localhost;dbname=blog";
    static $username = "kazafy";
    static $password = "";
    static function  getConnection(){
        $db = new PDO(self::$dsn, self::$username, self::$password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }

}