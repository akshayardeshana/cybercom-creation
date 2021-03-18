<?php


Mage::loadFileByClassName('Block_Core_Template');
class Block_Product_Form_Tabs_Categories extends Block_Core_Template {
    public function __construct()
    {
        $this->setTemplate('../View/Product/Form/Tabs/Categories.php');   
    }
}

?>