<?php

mage::getBlock('Block_Core_Template');

class Block_Category_Edit extends Block_Core_Template
{
    protected $category = null;
    
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('../View/Category/form.php');   
    }
    public function getTabContent()
    {
        $tabBlock = Mage::getBlock('Block_Category_Form_Tabs');
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
