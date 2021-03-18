<?php

mage::getBlock('Block_Core_Template');

class Block_CustomerGroup_Grid extends Block_Core_Template
{
    protected $customerGroups = null;

    public function __construct()
    {
        $this->setTemplate('../View/CustomerGroup/customerGroup.php');
    }
    public function getCustomerGroups()
    {
        if (!$this->customerGroups) {
            $this->setCustomerGroups();
        }
        return $this->customerGroups;
    }

    public function setCustomerGroups($customerGroups = null)
    {
        if ($this->customerGroups) {
            $this->customerGroups = $customerGroups;
        }
        if (!$customerGroups) {
            $customerGroups = Mage::getModel('Model_CustomerGroup');
            $rows = $customerGroups->fetchAll();
            $this->customerGroups = $rows;
        }
        return $this;
    }
}
