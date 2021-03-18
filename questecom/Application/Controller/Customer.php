<?php

mage::getController('Controller_Core_Admin');


class Controller_Customer extends Controller_Core_Admin
{
    private $Customers = [];
    private $addresses = [];

    public function Customers()
    {
        $query = "select * from customer";
        $data = Mage::getModel('Model_Core_Adpater');
        $result = $data->fetchAll($query);
        $this->setCustomers($result);
    }
    public function getCustomers()
    {
        return $this->Customers;
    }
    public function setCustomers($addresses)
    {
        $this->addresses = $addresses;
    }
    public function getAddresses()
    {
        return $this->addresses;
    }
    public function setAddresses($addresses)
    {
        $this->addresses = $addresses;
    }
    public function gridHtml()
    {
        $gridHtml = Mage::getBlock('Block_Customer_Grid')->toHtml();
        $tabHtml = Mage::getBlock('Block_Customer_Form_Tabs')->toHtml();
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
            $gridHtml = Mage::getBlock('Block_Customer_Edit')->toHtml();
            $tabHtml = Mage::getBlock('Block_Customer_Form_Tabs')->toHtml();
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
            $customer = Mage::getModel('Model_Customer');
            if ($id = $this->getRequest()->getGet('editId')) {
                $result = $customer->fetchRow($id);
                if ($result) {
                    $this->getMessage()->setSuccess('Record Updated!');
                } else {
                    $this->getMessage()->setFailure('Record Not Updated!');
                }
                $this->setCustomers($result);
                $customer->updatedDate = date('Y-m-d h:i:s');
            }
            if (!$id) {
                $customer->createdDate = date('Y-m-d h:i:s');
                $this->getMessage()->setSuccess('Record Inserted!');
            }
            $data = $this->getRequest()->getPost('customer', null);
            $customer->setData($data);
            $customer->save();
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $gridHtml = Mage::getBlock('Block_Customer_Grid')->toHtml();
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

    public function saveAddress()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Request");
            }
            $address = Mage::getModel('Model_CustomerAddress');
            if ($id = $this->getRequest()->getGet('editId')) {

                $result = $address->fetchRow($id);
                if ($result) {
                    $this->getMessage()->setSuccess('Record Updated!');
                } else {
                    $this->getMessage()->setFailure('Record Not Updated!');
                }
                $this->setAddresses($result);
            }
            if (!$id) {
                $this->getMessage()->setSuccess('Record Inserted!');
            }
            $data = $this->getRequest()->getPost('address', null);

            $address->setData($data);
            $address->customerId = $id;

            $address->saveAddress();
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $gridHtml = Mage::getBlock('Block_Customer_Grid')->toHtml();
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
    public function show()
    {
        $grid = Mage::getBlock('Block_Customer_Grid');
        $grid->setController($this);
        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $content->addChild($grid, 'grid');
        echo  $layout->toHtml();
    }
    public function delete()
    {
        try {
            $id = $this->getRequest()->getGet('deleteId');
            if (!$id) {
                throw new Exception("Invalid Id");
            }
            $customer = Mage::getModel('Model_Customer');
            if ($customer->delete($id)) {
                $this->getMessage()->setSuccess('Record Deleted!');
            } else {
                $this->getMessage()->setFailure('Record Not Deleted!');
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $gridHtml = Mage::getBlock('Block_Customer_Grid')->toHtml();
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
        $customer = Mage::getModel('Model_Customer');
        $customer->select($id, $selectId);

        $gridHtml = Mage::getBlock('Block_Customer_Grid')->toHtml();
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
