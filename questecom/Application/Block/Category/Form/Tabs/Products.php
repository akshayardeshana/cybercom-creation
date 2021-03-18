<?php


Mage::loadFileByClassName('Block_Core_Template');
class Block_Category_Form_Tabs_Products extends Block_Core_Template {
    public function __construct()
    {
        $this->setTemplate('../View/Category/Form/Tabs/Products.php');   
    }
}

?>