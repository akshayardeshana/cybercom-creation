<?php


Mage::loadFileByClassName('Block_Core_Template');
class Block_Customer_Form_Tabs_CustomerAddress extends Block_Core_Template
{

    protected $address = null;

    public function __construct()
    {
        $this->setTemplate('../View/Customer/Form/Tabs/CustomerAddress.php');
    }

    public function setAddress($address = null)
    {
        if ($this->address) {
            $this->address = $address;
            return $this;
        }
        $address = Mage::getModel('Model_CustomerAddress');
        $customerId = $this->getRequest()->getGet('editId');

        if ($customerId) {
            $query = 'SELECT addressId from customer_Address WHERE customerId = ' . $customerId;
            $addressArray = $address->fetchRowByQuery($query);
            if ($addressArray) {
                $addressId = $address->addressId;
                $customerAddress = $address->fetchRow($addressId);
                if ($customerAddress) {
                    $id = $customerAddress->addressId;
                    $address = $address->fetchRow($id);
                }
            }
        }
        $this->address = $address;
        return $this;
    }
    public function getAddress()
    {
        if (!$this->address) {
            $this->setAddress();
        }
        return $this->address;
    }
    public function getFormUrl()
    {
        return $this->getUrl()->getUrl('saveAdress');
    }
    public function getTitle()
    {
        return 'Address Add/Edit';
    }
}
