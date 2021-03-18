<?php


Mage::loadFileByClassName('Block_Core_Template');
class Block_Admin_Form_Tabs_Form extends Block_Core_Template {
    
    protected $admin = null;
    
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('../View/Admin/Form/Tabs/Form.php');
    }
    public function setAdmin($admin = null)
    {
        if ($this->admin) {
            $this->admin = $admin;
            return $this;
        }
        $admin = Mage::getModel('Model_Admin');
        $id = $this->getRequest()->getGet('editId');
        if ($id) {
            $admin = $admin->fetchRow($id);
        }
        $this->admin = $admin;
        return $this;
    }
    public function getAdmin()
    {
        if (!$this->admin) {
            $this->setAdmin();
        }
        return $this->admin;
    }
    public function getFormUrl()
    {
        return $this->getUrl()->getUrl('save');
    }
    public function getTitle()
    {
        return 'Admin Add/Edit';
    }
}

?>