<?php

mage::getBlock('Block_Core_Template');

class Block_Shipment_Grid extends Block_Core_Template
{
    protected $shipments = null;

    public function __construct()
    {
        $this->setTemplate('../View/Shipment/shipment.php');   
    }
    public function setShipments($shipments = null)
    {
        if($this->shipments) {
            $this->shipments = $shipments;
        }
        if(!$shipments) {
            $shipment = Mage::getModel('Model_Shipment');
            $rows = $shipment->fetchAll();
            $this->shipments = $rows;
        }
        return $this;
    }
    public function getShipments()
    {
        if(!$this->shipments) {
            $this->setshipments();
        }
        return $this->shipments;
    }
}
?>