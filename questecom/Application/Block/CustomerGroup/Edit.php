<?php

mage::getBlock('Block_Core_Template');

class Block_CustomerGroup_Edit extends Block_Core_Template
{
    protected $customer = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('../View/CustomerGroup/form.php');   
    }
    public function getTabContent()
    {
        $tabBlock = Mage::getBlock('Block_CustomerGroup_Form_Tabs');
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
