<?php

mage::getBlock('Block_Core_Template');

class Block_Payment_Grid extends Block_Core_Template
{
    protected $payments = null;
    public function __construct()
    {
        $this->setTemplate('../View/Payment/payment.php');   
    }
    public function setPayments($payments = null)
    {
        if($this->payments) {
            $this->payments = $payments;
        }
        if(!$payments) {
            $payments = Mage::getModel('Model_Payment');
            $rows = $payments->fetchAll();
            $this->payments = $rows;
        }
        return $this;
    }
    public function getPayments()
    {
        if(!$this->payments) {
            $this->setPayments();
        }
        return $this->payments;
    }
}
?>