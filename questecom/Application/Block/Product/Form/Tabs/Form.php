<?php


Mage::loadFileByClassName('Block_Core_Template');
class Block_Product_Form_Tabs_Form extends Block_Core_Template {
    
    protected $product = null;
    
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('../View/Product/Form/Tabs/Form.php');
    }
    public function setProduct($product = null)
    {
        if ($product) {
            $this->product = $product;
            return $this;
        }
        $product = Mage::getModel('Model_Product');
        $id = $this->getRequest()->getGet('editId');
        if ($id) {
            $product = $product->fetchRow($id);
        }
        $this->product = $product;
        return $this;
    }
    public function getProduct()
    {
        if (!$this->product) {
            $this->setProduct();
        }
        return $this->product;
    }
    public function getFormUrl()
    {
        return $this->getUrl()->getUrl('save');
    }
    public function getTitle()
    {
        return 'Product Add/Edit';
    }
}

?>