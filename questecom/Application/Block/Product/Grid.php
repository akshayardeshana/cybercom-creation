<?php

mage::getBlock('Block_Core_Template');

class Block_Product_Grid extends Block_Core_Template
{
    protected $products = null;

    public function __construct()
    {
        $this->setTemplate('../View/Product/product.php');   
    }
    public function setProducts($products = null)
    {
        if($this->products) {
            $this->products = $products;
        }
        if(!$products) {
            $product = Mage::getModel('Model_Product');
            $rows = $product->fetchAll();
            $this->products = $rows;
        }
        return $this;
    }
    public function getProducts()
    {
        if(!$this->products) {
            $this->setProducts();
        }
        return $this->products;
    }
}
?>