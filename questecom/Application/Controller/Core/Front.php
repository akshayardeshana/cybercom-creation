<?php

mage::getModel('Model_Core_Request');


class Controller_Core_Front 
{
    public static function init() {
        $request = Mage::getModel('Model_Core_Request');
        $controllerName = ucfirst($request->getControllerName());
        $actionName = $_GET['a'];
        require_once "../Controller/{$controllerName}.php";
        $class = "Controller_{$controllerName}";
        $controller = new $class();
        $controller->$actionName();
    
    }
    
}

?>