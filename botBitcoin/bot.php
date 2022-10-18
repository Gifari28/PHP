<?php
require("config.php");
require("Utils/MessageHandler.php");
require("Koneksi.php");
require("Session.php");
require("Controller/BTCController.php");
require("Controller/GeneralController.php");

Session::start();
$route = Session::getRoute();

switch($route){
    case "/getbydate":
        call_controller([
            "BTCController",
            "getByDate"
        ]);
        break;
    case "/current":
        call_controller([BTCController::class, 'current']);
        break;
    case "/last":
        call_controller([BTCController::class, 'last']);
        break;
    case "/help":
        call_controller([GeneralController::class, 'index']);
        break;
    case "/start":
        call_controller([GeneralController::class, 'index']);
        break;
    default:
        call_controller([GeneralController::class, 'not_found']);
        break;
}
?>