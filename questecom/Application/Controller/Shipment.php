<?php
Mage::getController('Controller_Core_Admin');

class Controller_Shipment extends Controller_Core_Admin
{
    private $shipments = [];
    public function shipments()
    {
        $query = "select * from shipment";
        $data = Mage::getModel('Model_Core_Admin');
        $result = $data->fetchAll($query);
        $this->setShipments($result);
    }
    public function getShipments()
    {
        return $this->shipments;
    }
    public function setShipments($shipments)
    {
        $this->shipments = $shipments;
    }
    public function gridHtml()
    {
        $gridHtml = Mage::getBlock('Block_Shipment_Grid')->toHtml();
        $tabHtml = Mage::getBlock('Block_Shipment_Form_Tabs')->toHtml();
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
            $gridHtml = Mage::getBlock('Block_Shipment_Edit')->toHtml();
            $tabHtml = Mage::getBlock('Block_Shipment_Form_Tabs')->toHtml();
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
            $shipment = Mage::getModel('Model_Shipment');
            if ($id = $this->getRequest()->getGet('editId')) {
                $result = $shipment->fetchRow($id);
                if ($result) {
                    $this->getMessage()->setSuccess('Record Updated!');
                } else {
                    $this->getMessage()->setFailure('Record Not Updated!');
                }
                
                $this->setShipments($result);
            }
            if (!$id) {
                $shipment->createdDate = date('Y-m-d h:i:s');
                $this->getMessage()->setSuccess('Record Inserted!');
                
            }
            $data = $this->getRequest()->getPost('shipment', null);
            $shipment->setData($data);
            $shipment->save();
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $gridHtml = Mage::getBlock('Block_Shipment_Grid')->toHtml();
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
        $grid = Mage::getBlock('Block_Shipment_Grid');
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
            $shipment = Mage::getModel('Model_Shipment');
            if ($shipment->delete($id)) {
                $this->getMessage()->setSuccess('Record Deleted!');
            } else {
                $this->getMessage()->setFailure('Record Not Deleted!');
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $gridHtml = Mage::getBlock('Block_Shipment_Grid')->toHtml();
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
        $shipment = Mage::getModel('Model_Shipment');
        $shipment->select($id, $selectId);
        $gridHtml = Mage::getBlock('Block_Shipment_Grid')->toHtml();
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
