<?php


Mage::loadFileByClassName('Block_Core_Template');
class Block_Category_Form_Tabs_Images extends Block_Core_Template {
    public function __construct()
    {
        $this->setTemplate('../View/Category/Form/Tabs/Images.php');   
        
    }
}

?>