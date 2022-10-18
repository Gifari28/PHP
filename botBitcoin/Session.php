<?php
class Session {
    public static $hasSession = false;
    private static $session_id;

    public static function start(){
        // create table session if not exists
        $sql = "CREATE TABLE IF NOT EXISTS `session` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `user_id` int(11) NOT NULL,
            `session_id` varchar(255) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
        Koneksi::execute($sql);   
    }


    public static function getSessionId(){
        if(!self::$hasSession){
            self::session_id();
        }
        return self::$session_id;
    }


    public static function getRequest(){
        return MessageHandler::getText();
    }

    private static function session_id(){
        $user_id = MessageHandler::getUserId();
        $sql = "SELECT * FROM session WHERE user_id = $user_id";
        $result = Koneksi::execute($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $session_id = $row['session_id'];
            self::$hasSession = true;
        }else{
            // get session from message
            $session_id = MessageHandler::getText();
        }
        self::$session_id = $session_id;
    }

    
    public static function getRoute(){
        $session_id = self::getSessionId();
        $route = explode(" ",$session_id);
        return isset($route[0]) ? $route[0] : "";
    }

    public static function getParameter($pos,$default = null){
        $session_id = self::getSessionId();
        $route = explode(" ",$session_id);
        if(isset($route[$pos])){
            return $route[$pos];
        }else{
            return $default;
        }
    }

    public static function setSessionId(){
        $user_id = MessageHandler::getUserId();
        $session_id = self::getSessionId();
        $sql = "INSERT INTO session (user_id, session_id) VALUES ($user_id, '$session_id')";
        Koneksi::execute($sql);
    }

    // delete session
    public static function deleteSessionId(){
        $user_id = MessageHandler::getUserId();
        $sql = "DELETE FROM session WHERE user_id = $user_id";
        Koneksi::execute($sql);
    }
}