<?php
class Koneksi {
    public $conn;
    private static $instance;
    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    public static function getConnection():mysqli{
        self::getInstance();
        return self::$instance->conn;
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Koneksi();
        }
        return self::$instance;
    }

    public static function execute($query){
        self::getInstance();
        $result= self::$instance->conn->query($query);
        return $result;
    }

}