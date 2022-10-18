<?php
define("TOKEN","5542606286:AAE98MN_-A0u2BifIvwotkPCg8o2EHZ64PQ");
define("API","https://api.telegram.org/bot".TOKEN."/");
define("DB_USER","id18446237_bitcoin2");
define("DB_HOST","localhost");
define("DB_PASS","Dimassp_2002");
define("DB_NAME","id18446237_bitcoin1");

function call_controller($call){
    $controller = $call[0];
    $method = $call[1];
    $controller = new $controller();
    $controller->$method();
}

?>
<?php
    /*
    private $token = "5542606286:AAE98MN_-A0u2BifIvwotkPCg8o2EHZ64PQ";
    private $host = "localhost";
    private $user = "id18446237_bitcoin2";
    private $pass = "Dimassp_2002"; 
    private $db  = "id18446237_bitcoin1";
    */
?>