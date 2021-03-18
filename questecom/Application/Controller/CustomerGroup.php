<?php

mage::getController('Controller_Core_Admin');


class Controller_CustomerGroup extends Controller_Core_Admin
{
    private $customerGroups = [];

    public function customerGroups()
    {
        $query = "select * from cgroup";
        $data = Mage::getModel('Model_Core_Adpater');
        $result = $data->fetchAll($query);
        $this->setCustomerGroups($result);
    }
    public function getCustomerGroups()
    {
        return $this->customerGroups;
    }
    public function setCustomerGroups($customerGroups)
    {
        $this->customerGroups = $customerGroups;
    }
    public function gridHtml()
    {
        $gridHtml = Mage::getBlock('Block_CustomerGroup_Grid')->toHtml();
        $tabHtml = Mage::getBlock('Block_CustomerGroup_Form_Tabs')->toHtml();
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
            $gridHtml = Mage::getBlock('Block_CustomerGroup_Edit')->toHtml();
            $tabHtml = Mage::getBlock('Block_CustomerGroup_Form_Tabs')->toHtml();
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
            $customer = Mage::getModel('Model_CustomerGroup');
            if ($id = $this->getRequest()->getGet('editId')) {
                $result = $customer->fetchRow($id);
                if ($result) {
                    $this->getMessage()->setSuccess('Record Updated!');
                } else {
                    $this->getMessage()->setFailure('Record Not Updated!');
                }
            }
            if (!$id) {
                $customer->createdDate = date('Y-m-d h:i:s');
                $this->getMessage()->setSuccess('Record Inserted!');
            }
            $data = $this->getRequest()->getPost('customerGroup', null);
            $customer->setData($data);
            $customer->save();
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $gridHtml = Mage::getBlock('Block_CustomerGroup_Grid')->toHtml();
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
            $customer = Mage::getModel('Model_CustomerGroup');
            if ($customer->delete($id)) {
                $this->getMessage()->setSuccess('Record Deleted!');
            } else {
                $this->getMessage()->setFailure('Record Not Deleted!');
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $gridHtml = Mage::getBlock('Block_CustomerGroup_Grid')->toHtml();
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
