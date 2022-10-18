<?php

class MessageHandler{
    private $message;
    private $chatID;
    private $text;
    private static $instance;

    public function __construct($message){
        $this->message = $message;
        $this->chatID = $message['chat']['id'];
        $this->text = $message['text'];
    }

    private static function getInstance(): MessageHandler{
        if(!self::$instance){
            $content = file_get_contents("php://input");
            $message = json_decode($content,TRUE);
            self::$instance = new MessageHandler($message['message']);         
        }
        return self::$instance;
    }
    
    public static function sendMessage($text){
        self::getInstance();
        $keyboard = [
            "remove_keyboard"=>true
        ];
        $keyboard = json_encode($keyboard, true);
        $url = API."sendMessage?chat_id=".self::$instance->chatID."&parse_mode=MarkDown&reply_markup=$keyboard&text=".urlencode($text);
        file_get_contents($url);
    }

    public static function sendButton($keyboard,$text){
        $keyboard = json_encode($keyboard, true);
        $url = API."sendMessage?chat_id=".self::$instance->chatID."&parse_mode=MarkDown&reply_markup=$keyboard&text=". urlencode($text);
        file_get_contents($url);
    }
    
    public static function getRoute(){
        self::getInstance();
        $text = self::$instance->text;
        $route = explode(" ",$text);
        return isset($route[0]) ? $route[0] : "";
    }

    public static function getParameter($pos,$default = null){
        self::getInstance();
        $text = self::$instance->text;
        $route = explode(" ",$text);
        if(isset($route[$pos])){
            return $route[$pos];
        }else{
            return $default;
        }
    }


    public static function getUserId(){
        self::getInstance();
        return self::$instance->chatID;
    }


    public static function getText(){
        self::getInstance();
        return self::$instance->text;
    }
}