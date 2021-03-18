<?php

Mage::loadFileByClassName('Model_Admin_Session');

class Model_Admin_Message extends Model_Admin_Session
{

    public function __construct()
    {
        parent::__construct();
    }

    public function setSuccess($message)
    {
        $this->success = $message;
        return $this->success;
    }
    public function getSuccess()
    {
        return $this->success;
    }
    public function setFailure($message)
    {
        $this->failure = $message; 
        return $this->failure;
    }
    public function getFailure()
    {  
        return $this->failure;
    }
    public function clearMessage()
    {
        unset($this->success);
        unset($this->failure);
        return $this;
    }
}
