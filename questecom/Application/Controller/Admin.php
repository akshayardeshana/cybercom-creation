<?php

mage::getController('Controller_Core_Admin');


class Controller_Admin extends Controller_Core_Admin
{
    private $admins = [];

    public function admins()
    {
        $query = "select * from admin";
        $data = Mage::getModel('Model_Core_Adpater');
        $result = $data->fetchAll($query);
        $this->setadmins($result);
    }
    public function getadmins()
    {
        return $this->admins;
    }
    public function setadmins($admins)
    {
        $this->admins = $admins;
    }
    public function gridHtml()
    {
        $gridHtml = Mage::getBlock('Block_Admin_Grid')->toHtml();
        $tabHtml = Mage::getBlock('Block_Admin_Form_Tabs')->toHtml();
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
            $gridHtml = Mage::getBlock('Block_Admin_Edit')->toHtml();
            $tabHtml = Mage::getBlock('Block_Admin_Form_Tabs')->toHtml();
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
    public function delete()
    {
        try {
            $id = $this->getRequest()->getGet('deleteId');
            if (!$id) {
                throw new Exception("Invalid Id");
            }
            $admin = Mage::getModel('Model_Admin');
            if ($admin->delete($id)) {
                $this->getMessage()->setSuccess('Record Deleted!');
            } else {
                $this->getMessage()->setFailure('Record Not Deleted!');
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $gridHtml = Mage::getBlock('Block_Admin_Grid')->toHtml();
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

    public function save()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Request");
            }
            $admin = Mage::getModel('Model_Admin');
            if ($id = $this->getRequest()->getGet('editId')) {
                $result = $admin->fetchRow($id);
                if ($result) {
                    $this->getMessage()->setSuccess('Record Updated!');
                } else {
                    $this->getMessage()->setFailure('Record Not Updated!');
                }
                $this->setadmins($result);
            }
            if (!$id) {
                $admin->createdDate = date('Y-m-d h:i:s');
                $this->getMessage()->setSuccess('Record Inserted!');
            }
            $data = $this->getRequest()->getPost('admin', null);
            $admin->setData($data);
            $admin->save();

            $gridHtml = Mage::getBlock('Block_Admin_Grid')->toHtml();
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
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }
    public function show()
    {
        $grid = Mage::getBlock('Block_Admin_Grid');
        $grid->setController($this);
        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $content->addChild($grid, 'grid');
        echo $layout->toHtml();
    }
    public function select()
    {

        $selectId = $this->getRequest()->getGet('selectId');
        $id = $this->getRequest()->getGet('editId');
        $admin = Mage::getModel('Model_Admin');
        $admin->select($id, $selectId);
        $gridHtml = Mage::getBlock('Block_Admin_Grid')->toHtml();
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
