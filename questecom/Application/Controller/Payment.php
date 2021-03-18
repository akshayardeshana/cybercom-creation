<?php
Mage::getController('Controller_Core_Admin');
class Controller_Payment extends Controller_Core_Admin
{
    private $payments = [];
    public function payments()
    {
        $query = "select * from payment";
        $data = Mage::getModel('Model_Core_Adpater');
        $result = $data->fetchAll($query);
        $this->setpayments($result);
    }
    public function getpayments()
    {
        return $this->payments;
    }
    public function setpayments($payments)
    {
        $this->payments = $payments;
    }
    public function gridHtml()
    {
        $gridHtml = Mage::getBlock('Block_Payment_Grid')->toHtml();
        $tabHtml = Mage::getBlock('Block_Payment_Form_Tabs')->toHtml();
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
            $gridHtml = Mage::getBlock('Block_Payment_Edit')->toHtml();
            $tabHtml = Mage::getBlock('Block_Payment_Form_Tabs')->toHtml();
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
            $payment = Mage::getModel('Model_Payment');
            if ($id = $this->getRequest()->getGet('editId')) {
                $result = $payment->fetchRow($id);
                if ($result) {
                    $this->getMessage()->setSuccess('Record Updated!');
                } else {
                    $this->getMessage()->setFailure('Record Not Updated!');
                }
                $this->setpayments($result);
                
            }
            if (!$id) {
                $this->getMessage()->setSuccess('Record Inserted!');
                $payment->createdDate = date('Y-m-d h:i:s');
            }
            $data = $this->getRequest()->getPost('payment', null);
            $payment->setData($data);
            $payment->save();
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $gridHtml = Mage::getBlock('Block_Payment_Grid')->toHtml();
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
        $grid = Mage::getBlock('Block_Payment_Grid');
        $grid->setController($this);
        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $content->addChild($grid, 'grid');
        echo $layout->toHtml();
    }
    public function delete()
    {
        try {
            $id = $this->getRequest()->getGet('deleteId');
            if (!$id) {
                throw new Exception("Invalid Id");
            }
            $payment = Mage::getModel('Model_Payment');
            if ($payment->delete($id)) {
                $this->getMessage()->setSuccess('Record Deleted!');
            } else {
                $this->getMessage()->setFailure('Record Not Deleted!');
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $gridHtml = Mage::getBlock('Block_Payment_Grid')->toHtml();
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
        $payment = Mage::getModel('Model_Payment');
        $payment->select($id, $selectId);
        $gridHtml = Mage::getBlock('Block_Payment_Grid')->toHtml();
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
