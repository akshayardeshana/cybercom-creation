<?php

mage::getController('Controller_Core_Admin');

class Controller_Index  extends Controller_Core_Admin
{
    public function index()
    {
        $form = Mage::getBlock('Block_Dashboard_Index');
        $form->setController($this);
        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $content->addChild($form, 'form');
        echo $layout->toHtml();
    }
}
