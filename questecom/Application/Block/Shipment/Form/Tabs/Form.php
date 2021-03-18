<?php


Mage::loadFileByClassName('Block_Core_Template');
class Block_Shipment_Form_Tabs_Form extends Block_Core_Template {
    
    protected $shipment = null;
    
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('../View/Shipment/Form/Tabs/Form.php');
    }
    public function setShipment($shipment = null)
    {
        if ($this->shipment) {
            $this->shipment = $shipment;
            return $this;
        }
        $shipment = Mage::getModel('Model_Shipment');
        $id = $this->getRequest()->getGet('editId');
        if ($id) {
            $shipment = $shipment->fetchRow($id);
        }
        $this->shipment = $shipment;
        return $this;
    }
    public function getShipment()
    {
        if (!$this->shipment) {
            $this->setShipment();
        }
        return $this->shipment;
    }
    public function getFormUrl()
    {
        return $this->getUrl()->getUrl('save');
    }
    public function getTitle()
    {
        return 'Shipment Add/Edit';
    }
}

?>