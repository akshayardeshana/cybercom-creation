<?php


mage::getBlock('Block_Core_Template');

class Block_Dashboard_Index extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate('../View/Dashboard/dashboard.php');   
    }
}
?>