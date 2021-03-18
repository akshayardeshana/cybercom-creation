<?php

class Model_Core_Url
{
    public function __construct()
    {
        $this->setRequest();   
    }
    public function setRequest()
    {
        $this->request = Mage::getModel('Model_Core_Request');
        return $this;
    }
    public function getRequest()
    {
        return $this->request;
    }
    public function getUrl($actionName = Null, $controllerName = Null, $params = Null, $resetParams = false)
    {
        $final = $_GET;
        if ($resetParams) {
            $final = [];
        }
        if ($actionName == Null) {
            $actionName = $_GET['a'];
        }
        if ($actionName == Null) {
            $actionName = $_GET['c'];
        }
        $final['c'] = $controllerName;
        $final['a'] = $actionName;

        if (is_array($params)) {
            $final = array_merge($final, $params);
        }
        $queryString = http_build_query($final);
        unset($final);
        $url = "http://localhost/project/Application/View/index.php?{$queryString}";
        return $url;
    }
    public function baseUrl($subUrl = null)
    {
        $url = "http://localhost/project/Application/";
        if($subUrl) {
            $url .= $subUrl;
        }
        return $url;
    }
}
