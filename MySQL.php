<?php

class MySQL {
    private static $c;
    private const DATABASE = "xiteb_db";
    private const USERNAME = "root";
    private const PASSWORD = "HasithaNavod1380!";

    private static function createConnection() {
        if (self::$c == null) {
            self::$c = new mysqli("localhost", self::USERNAME, self::PASSWORD, self::DATABASE);
            if (self::$c->connect_error) {
                die("Connection failed: " . self::$c->connect_error);
            }
        }
        return self::$c;
    }

    public static function iud($query) {
        try {
            self::createConnection()->query($query);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function search($query) {
        try {
            return self::createConnection()->query($query);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

?>