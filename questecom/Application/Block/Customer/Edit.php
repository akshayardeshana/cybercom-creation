<?php

mage::getBlock('Block_Core_Template');

class Block_Customer_Edit extends Block_Core_Template
{
    protected $customer = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('../View/Customer/form.php');   
    }
    public function getTabContent()
    {
        $tabBlock = Mage::getBlock('Block_Customer_Form_Tabs');
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
