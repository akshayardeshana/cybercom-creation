<?php

Mage::loadFileByClassName('Model_Core_Session');

class Model_Core_Message extends Model_Core_Session{

  
    public function setSuccess($message)
    {
        $this->success = $message;
        return $this;
    }
    public function getSuccess()
    {
        return $this->success;
    }
    public function setFailure($message)
    {
        $this->success = $message;
        return $this;
    }
    public function getFailure()
    {
        return $this->success;
    }
    
 
}
?>