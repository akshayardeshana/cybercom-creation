<?php

Mage::loadFileByClassName('Block_Core_Template');

class Block_CustomerGroup_Form_Tabs extends Block_Core_Template
{
    protected $tabs = [];
    protected $defaultTab = null;

    public function __construct()
    {
        $this->setTemplate('../View/CustomerGroup/Form/Tabs.php');
        $this->prepareTab();
    }
    public function getTabs()
    {
        return $this->tabs;
    }
    public function addTab($key, $tab = [])
    {
        $this->tabs[$key] = $tab;
        return $this;
    }
    public function getTab($key)
    {
        if (!array_key_exists($key, $this->tabs)) {
            return null;
        }
        return $this->tabs[$key];
    }
    public function removeTab($key)
    {
        if (array_key_exists($key, $this->tabs)) {
            unset($this->tabs[$key]);
        }
    }

    public function prepareTab()
    {
        $this->addTab('Form', ['label' => 'Form', 'block' => 'Block_CustomerGroup_Form_Tabs_Form']);
        $this->setDefaultTab('Form');
        return $this;
    }
    public function getDefaultTab()
    {
        return $this->defaultTab;
    }
    public function setDefaultTab($defaultTab)
    {
        $this->defaultTab = $defaultTab;
        return $this;
    }
    public function setTabs(array $tabs = [])
    {
        $this->tabs = $tabs;
        return $this;
    }
}
