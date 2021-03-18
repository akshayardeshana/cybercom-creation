<?php


Mage::loadFileByClassName('Block_Core_Template');
class Block_Customer_Form_Tabs_Form extends Block_Core_Template {
    
    protected $customer = null;
    protected $groupOptions = null;
    
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('../View/Customer/Form/Tabs/Form.php');
    }
    public function setCustomer($customer = null)
    {
        if ($this->customer) {
            $this->customer = $customer;
            return $this;
        }
        $customer = Mage::getModel('Model_Customer');
        $id = $this->getRequest()->getGet('editId');
        if ($id) {
            $customer = $customer->fetchRow($id);
        }
        $this->customer = $customer;
        return $this;
    }
    public function getGroupOptions(){
        if(!$this->groupOptions){
        $query = "SELECT `groupId`,`name` from `cgroup`";
        $this->groupOptions = $this->getCustomer()->getAdapter()->fetchPairs($query);
        }
        return $this->groupOptions;
        }
    
    public function getCustomer()
    {
        if (!$this->customer) {
            $this->setCustomer();
        }
        return $this->customer;
    }



    public function getFormUrl()
    {
        return $this->getUrl()->getUrl('save');
    }
    public function getTitle()
    {
        return 'Customer Add/Edit';
    }
}

?>