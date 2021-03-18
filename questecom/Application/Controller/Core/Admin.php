<?php


mage::loadFileByClassName('Model_Core_Request');
mage::loadFileByClassName('Model_Admin_Message');
mage::loadFileByClassName('Block_Core_Layout');

class Controller_Core_Admin 
{
    protected $request = null;
    protected $message = null;
    protected $layout = null;
    protected $session = null;
    public function __construct()
    {
        $this->setRequest();
        $this->setMessage();
        $this->setLayout();
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
    public function setMessage()
    {
        $this->message = Mage::getModel('Model_Admin_Message');
        return $this;
    }
    public function getMessage()
    {
        return $this->message;
    }
    public function setLayout(Block_Core_Layout $layout = null)
    {
        if(!$layout) {
            $layout = Mage::getBlock('Block_Core_Layout');
        }
        $this->layout = $layout;
        return $this;
    }
    public function getLayout()
    {

        if(!$this->layout) {
            $layout = $this->setLayout();
        }
        return $this->layout;
    }
    public function renderLayout()
    {
        echo $this->getLayout()->toHtml();
    }
    public function redirect($actionName = Null, $controllerName = Null, $params = Null, $resetParams = false)
    {
        $url = $this->getUrl($actionName, $controllerName, $params, $resetParams);
        header("Location: {$url}");
        exit(0);
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
        if ($controllerName == Null) {
            $controllerName = $_GET['c'];
        }
        $final['c'] = $controllerName;
        $final['a'] = $actionName;

        if(is_array($params)){
            $final = array_merge($final, $params);
        }
        
        $queryString = http_build_query($final);
        unset($final);
        $url = "http://localhost/project/Application/View/index.php?{$queryString}";
        return $url;
    }
}
