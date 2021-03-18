<?php


Mage::loadFileByClassName('Block_Core_Template');
class Block_Payment_Form_Tabs_Form extends Block_Core_Template {
    
    protected $payment = null;
    
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('../View/Payment/Form/Tabs/Form.php');
    }
    public function setPayment($payment = null)
    {
        if ($this->payment) {
            $this->payment = $payment;
            return $this;
        }
        $payment = Mage::getModel('Model_Payment');
        $id = $this->getRequest()->getGet('editId');
        if ($id) {
            $payment = $payment->fetchRow($id);
        }
        $this->payment = $payment;
        return $this;
    }
    public function getPayment()
    {
        if (!$this->payment) {
            $this->setPayment();
        }
        return $this->payment;
    }
    public function getFormUrl()
    {
        return $this->getUrl()->getUrl('save');
    }
    public function getTitle()
    {
        return 'Payment Add/Edit';
    }
}

?>