<?php

Mage::getController('Controller_Core_Admin');

class Controller_Product extends Controller_Core_Admin
{
    private $products = [];
    public function products()
    {
        $query = "select * from product";
        $data = Mage::getModel('Model_Core_Adpater');
        $result = $data->fetchAll($query);
        $this->setProducts($result);
    }
    public function getProducts()
    {
        return $this->products;
    }
    public function setProducts($products)
    {
        $this->products = $products;
    }

    public function gridHtml()
    {
        $gridHtml = Mage::getBlock('Block_Product_Grid')->toHtml();
        $tabHtml = Mage::getBlock('Block_Product_Form_Tabs')->toHtml();
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
    public function index()
    {
        
        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $left = $layout->getChild('left');
        echo $layout->toHtml();

    }
    public function form()
    {
        try {
            $gridHtml = Mage::getBlock('Block_Product_Edit')->toHtml();
            $tabHtml = Mage::getBlock('Block_Product_Form_Tabs')->toHtml();
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
        try {
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Request");
            }
            $product = Mage::getModel('Model_Product');
            if ($id = $this->getRequest()->getGet('editId')) {
                $result = $product->fetchRow($id);
                if ($result) {
                    $this->getMessage()->setSuccess('Record Updated!');
                } else {
                    $this->getMessage()->setFailure('Record Not Updated!');
                }
                $product->updatedDate = date('Y-m-d h:i:s');
                $this->setProducts($result);
            }
            if (!$id) {
                $product->createdDate = date('Y-m-d h:i:s');

                $this->getMessage()->setSuccess('Record Inserted!');
            }
            $data = $this->getRequest()->getPost('product', null);
            $product->setData($data);
            $product->save();

         
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $gridHtml = Mage::getBlock('Block_Product_Grid')->toHtml();
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



    public function delete()
    {
        try {
            $id = $this->getRequest()->getGet('deleteId');
            if (!$id) {
                throw new Exception("Invalid Id");
            }
            $product = Mage::getModel('Model_Product');
            if ($product->delete($id)) {
                $this->getMessage()->setSuccess('Record Deleted!');
            } else {
                $this->getMessage()->setFailure('Record Not Deleted!');
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $gridHtml = Mage::getBlock('Block_Product_Grid')->toHtml();
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
    public function deleteMedia()
    {
        try {
            $id['deleteId'] = $this->getRequest()->getGet('deleteId');

            if (!$id) {
                throw new Exception("Invalid Id");
            }
            $product = Mage::getModel('Model_Media');
            if ($product->deleteByArray($id)) {

                $gridHtml = Mage::getBlock('Block_Product_Form_Tabs_Media')->toHtml();
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

                $this->getMessage()->setSuccess('Record Deleted!');
            } else {
                $this->getMessage()->setFailure('Record Not Deleted!');
            }
            $this->getMessage()->setSuccess('Record Deleted!');
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }
    public function select()
    {
        $selectId = $this->getRequest()->getGet('selectId');
        $id = $this->getRequest()->getGet('editId');
        $product = Mage::getModel('Model_Product');
        $product->select($id, $selectId);
        //   $this->redirect('show', 'product', null, true);
        $gridHtml = Mage::getBlock('Block_Product_Grid')->toHtml();
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

    public function addMedia()
    {
        $dir = 'images/';
        $tmpName = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];

        if (!file_exists("$dir{$this->getRequest()->getGet('editId')}")) {
            mkdir("$dir{$this->getRequest()->getGet('editId')}", 0777, true);
        }
        $result = move_uploaded_file($tmpName, "$dir{$this->getRequest()->getGet('editId')}/{$fileName}");
        if ($result) {

            $productMedia = Mage::getModel('Model_Media');
            $productMedia->image = "$dir{$this->getRequest()->getGet('editId')}/{$fileName}";
            $productMedia->productId = $this->getRequest()->getGet('editId');

            $productMedia->save();
            // $this->redirect('form','product');
            $gridHtml = Mage::getBlock('Block_Product_Form_Tabs_Media')->toHtml();
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
    public function updateMedia()
    {
        $gridHtml = Mage::getBlock('Block_Product_Form_Tabs_Media')->toHtml();
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
