<?php


Mage::loadFileByClassName('Block_Core_Template');
class Block_Login_Login extends Block_Core_Template {
    
    protected $admin = null;
    
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('../View/Admin/Login/Login.php');
    }
    public function setAdmin($admin = null)
    {
        if ($this->admin) {
            $this->admin = $admin;
            return $this;
        }
        $admin = Mage::getModel('Model_Admin');
        $userName = $this->getRequest()->getPost('userName');
        $password = $this->getRequest()->getPost('password');
        if ($userName && $password) {
            $admin = $admin->login($userName, $password);
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
}

?>