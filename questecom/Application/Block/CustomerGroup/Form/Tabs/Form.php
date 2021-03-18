<?php


Mage::loadFileByClassName('Block_Core_Template');
class Block_CustomerGroup_Form_Tabs_Form extends Block_Core_Template {
    
    protected $customerGroup = null;
    
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('../View/customerGroup/Form/Tabs/Form.php');
    }
    public function getCustomerGroups()
    {
        if (!$this->customerGroup) {
            $this->setCustomerGroups();
        }
        return $this->customerGroup;
    }
    public function getFormUrl()
    {
        return $this->getUrl()->getUrl('save');
    }
    public function getTitle()
    {
        return 'Customer Group Add/Edit';
    }
    public function setCustomerGroups($customerGroup = null)
    {
        if ($this->customerGroup) {
            $this->customerGroup = $customerGroup;
            return $this;
        }
        $customerGroup = Mage::getModel('Model_CustomerGroup');
        $id = $this->getRequest()->getGet('editId');
        if ($id) {
            $customerGroup = $customerGroup->fetchRow($id);
        }
        $this->customerGroup = $customerGroup;
        return $this;
    }
   
}

?>