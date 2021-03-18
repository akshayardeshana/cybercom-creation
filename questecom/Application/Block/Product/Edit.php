<?php

mage::getBlock('Block_Core_Template');

class Block_Product_Edit extends Block_Core_Template
{
    protected $product = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('../View/Product/form.php');   
    }
    public function getTabContent()
    {
        $tabBlock = Mage::getBlock('Block_Product_Form_Tabs');
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
