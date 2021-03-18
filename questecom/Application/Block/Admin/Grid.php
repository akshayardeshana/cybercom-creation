<?php

mage::getBlock('Block_Core_Template');

class Block_Admin_Grid extends Block_Core_Template
{
    protected $admins = null;
    public function __construct()
    {
        $this->setTemplate('../View/Admin/admin.php');   
    }
    public function setAdmins($admins = null)
    {
        if($this->admins) {
            $this->admins = $admins;
        }
        if(!$admins) {
            $admins =Mage::getModel('Model_Admin');
            $rows = $admins->fetchAll();
            $this->admins = $rows;
        }
        return $this;
    }
    public function getAdmins()
    {
        if(!$this->admins) {
            $this->setAdmins();
        }
        return $this->admins;
    }
}
?>