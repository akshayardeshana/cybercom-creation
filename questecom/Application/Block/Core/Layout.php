<?php

Mage::getBlock('Block_Core_Layout_Content');
Mage::getBlock('Block_Core_Layout_Header');
Mage::getBlock('Block_Core_Layout_Left');
Mage::getBlock('Block_Core_Layout_Footer');

class Block_Core_Layout extends Block_Core_Template
{
    public function __construct(Controller_Core_Admin $controller = null)
    {
        $this->setTemplate("../View/Core/Layout/threeColumn.php");
        $this->prepareChildren();
    }
    public function prepareChildren()
    {
        $this->addChild(Mage::getBlock('Block_Core_Layout_Content'), 'content');
        $this->addChild(Mage::getBlock('Block_Core_Layout_Header'), 'header');
        $this->addChild(Mage::getBlock('Block_Core_Layout_Left'), 'left');
        $this->addChild(Mage::getBlock('Block_Core_Layout_Footer'), 'footer');
    }
    public function getcontent()
    {
        return $this->getChild('content');
    }
    public function getHeader()
    {
        return $this->getChild('header');
    }
    public function getLeft()
    {
        return $this->getChild('left');
    }
}
