<?php

mage::getBlock('Block_Core_Template');

class Block_Shipment_Edit extends Block_Core_Template
{
    protected $shipment = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('../View/Shipment/form.php');   
    }
    public function getTabContent()
    {
        $tabBlock = Mage::getBlock('Block_Shipment_Form_Tabs');
        $tabs = $tabBlock->getTabs();
        
        $tab = $this->getRequest()->getGet('tab', $tabBlock->getDefaultTab());
        
        if(!array_key_exists($tab, $tabs)) {
            return null;
        }        
        $blockClassName = $tabs[$tab]['block'];        
        $block = Mage::getBlock($blockClassName);
        echo $block->toHtml();
        
    }
}
