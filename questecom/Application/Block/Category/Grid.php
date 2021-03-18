<?php

mage::loadFileByClassName('Block_Core_Template');

class Block_Category_Grid extends Block_Core_Template
{
    protected $categories = null;
    protected $categoriesOptions = null;

    public function __construct()
    {
        $this->setTemplate('../View/Category/category.php');
    }

    public function setcategories($categories = null)
    {
        if ($this->categories) {
            $this->categories = $categories;
        }
        if (!$categories) {
            $query = "SELECT * from `category` ORDER BY `path` ASC;";
            $categories = Mage::getModel('Model_Category')->fetchAll($query);
        }
        $this->categories = $categories;
        return $this;
    }
    public function getcategories()
    {
        if (!$this->categories) {
            $this->setCategories();
        }
        return $this->categories;
    }
    public function getCategoriesOptions()
    {
        if ($this->categoriesOptions) {
            return $this->categoriesOptions;
        }
        $query = "SELECT `categoryId`, `name` from category;";
        $categories = Mage::getModel('Model_Category')->fetchAll($query);
        if ($categories) {
            foreach ($categories->getdata() as $category) {
                $this->categoriesOptions[$category->categoryId] = $category->name;
            }
        }
        return $this->categoriesOptions;
    }
    public function getName($category)
    {
        $categoriesData = $this->getCategoriesOptions();
        $path = explode('=', $category->path);
        foreach ($path as &$id) {
            if (array_key_exists($id, $categoriesData)) {
                $id = $categoriesData[$id];
            }
        }
        return implode('=>', $path);
    }
}
