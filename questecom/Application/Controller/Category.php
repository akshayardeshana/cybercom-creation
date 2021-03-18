<?php

mage::loadFileByClassName('Controller_Core_Admin');

class Controller_Category extends Controller_Core_Admin
{
    private $categories = [];
    private $parentCategoryName = [];

    public function getCategories()
    {
        return $this->categories;
    }
    public function setCategories($Categories)
    {
        $this->categories = $Categories;
    }

    public function getParentCategoryName()
    {
        return $this->parentCategoryName;
    }
    public function setParentCategoryName($parentCategoryName)
    {
        $this->parentCategoryName = $parentCategoryName;
    }
    public function gridHtml()
    {
        $gridHtml = Mage::getBlock('Block_Category_Grid')->toHtml();
        $tabHtml = Mage::getBlock('Block_Category_Form_Tabs')->toHtml();
        $response = [
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html' => $gridHtml
                ],
                [
                    'selector' => '#leftHtml',
                    'html' => null
                ]
            ]
        ];
        header("Content-type:appliction/json; charset=utf-8");
        echo json_encode($response);
    }
    public function form()
    {
        try {
            $gridHtml = Mage::getBlock('Block_Category_Edit')->toHtml();
            $tabHtml = Mage::getBlock('Block_Category_Form_Tabs')->toHtml();
            $response = [
                'status' => 'success',
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html' => $gridHtml
                    ],
                    [
                        'selector' => '#leftHtml',
                        'html' => $tabHtml
                    ]
                ]
            ];
            header("Content-type:appliction/json; charset=utf-8");
            echo json_encode($response);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
    public function save()
    {
        $category = Mage::getModel('Model_Category');
        if ($categoryId = $this->getRequest()->getGet('editId')) {
            $categoryData = $category->fetchRow($categoryId);
            if (!$categoryData) {
                throw new Exception("Invalid Id");
            }
        }
        $categoryPathId = $category->path;
        $categoryData = $this->getRequest()->getPost('category');
        $category->setData($categoryData);
        if (!$categoryId) {
            $category->createdDate = date('Y-m-d h:i:s');
        }
        $category->save();
        $category->updatePathId();
        $category->updateChildrenPathIds($categoryPathId);
        $gridHtml = Mage::getBlock('Block_Category_Grid')->toHtml();
        $response = [
            'status' => 'success',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html' => $gridHtml
                ]
            ]
        ];
        header("Content-type:appliction/json; charset=utf-8");
        echo json_encode($response);
    }



    public function index()
    {
        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $left = $layout->getChild('left');
        echo $layout->toHtml();
    }
    public function show()
    {
        $grid = Mage::getBlock('Block_Category_Grid');
        $grid->setController($this);
        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $content->addChild($grid, 'grid');
        echo $layout->toHtml();
    }
    public function delete()
    {
        $category = Mage::getModel('Model_Category');
        if ($categoryId = $this->getRequest()->getGet('deleteId')) {
            $category = $category->fetchRow($categoryId);
            if (!$category) {
                throw new Exception("Invalid Id");
            }
        }
        $path = $category->path;
        $parentId = $category->parentId;
        $category->updateChildrenPathIds($path, $parentId);
        $category->delete($categoryId);

        $gridHtml = Mage::getBlock('Block_Category_Grid')->toHtml();
        $response = [
            'status' => 'success',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html' => $gridHtml
                ]
            ]
        ];
        header("Content-type:appliction/json; charset=utf-8");
        echo json_encode($response);
    }
    public function select()
    {

        $selectId = $this->getRequest()->getGet('selectId');
        $id = $this->getRequest()->getGet('editId');
        $category = Mage::getModel('Model_Category');
        $category->select($id, $selectId);

        $gridHtml = Mage::getBlock('Block_Category_Grid')->toHtml();
        $response = [
            'status' => 'success',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html' => $gridHtml
                ]
            ]
        ];
        header("Content-type:appliction/json; charset=utf-8");
        echo json_encode($response);
    }
}
