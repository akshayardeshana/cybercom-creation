<?php

class Block_Core_Template
{
    protected $controller;
    protected $template = null;
    protected $children = [];
    protected $url = null;
    protected $request = null;

    public function __construct()
    {
        $this->setUrl();   
    }
    public function setRequest($request = null)
    {
        $request = Mage::getModel('Model_Core_Request');
        $this->request = $request;
        return $this;
    }
    public function getRequest()
    {
        if (!$this->request) {
            $this->setRequest();
        }
        return $this->request;
    }
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }
    public function getTemplate()
    {
        return $this->template;
    }
    public function setController(Controller_Core_Admin $controller)
    {
        $this->controller = $controller;
        return $this;
    }
    public function getController()
    {
        return $this->controller;
    }
    public function setUrl($url = null)
    {
        if(!$url) {
            $url = Mage::getModel('Model_Core_Url');
        }
        $this->url = $url;
        return $this;
    }
    public function getUrl()
    {
        if(!$this->url) {
            $this->setUrl();
        }
        return $this->url;
    }
    public function toHtml()
    {
        ob_start();
        require_once $this->getTemplate();
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function setChildren(array $children = [])
    {
        $this->children = $children;
        return $this;
    }
    public function getChildren()
    {
        return $this->children;
    }
    public function addChild(Block_Core_Template $child, $key = null)
    {
        if (!$key) {
            $key = get_class($child);
        }
        $this->children[$key] = $child;
        return $this;
    }

    public function getChild($key)
    {
        if (!array_key_exists($key, $this->children)) {
            return null;
        }
        return $this->children[$key];
    }
    public function removeChild($key)
    {
        if (array_key_exists($key, $this->children)) {
            unset($this->children[$key]);
        }
        return $this;
    }
    public function createBlock($className)
    {
        return Mage::getBlock($className);
    }
    public function getMessage()
    {
        return Mage::getModel('Model_Admin_Message'); 
    }
    public function baseUrl ($subUrl = null)
    {  
        return $this->getUrl()->baseUrl($subUrl) ;
    }
}
