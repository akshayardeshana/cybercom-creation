<?php

mage::loadFileByClassName('Model_Core_Adapter');
mage::loadFileByClassName('Model_Core_Table');

class Model_Category extends Model_Core_Table
{
    const STATUS_ENABLE = 1;
    const STATUS_DESABLED = 0;
    public function __construct()
    {
        $this->setTableName("category");
        $this->setPrimaryKey("categoryId");
    }
    public function getStatusOptions()
    {
        return [
            self::STATUS_DESABLED => "Disable", 
            self::STATUS_ENABLE => "Enable"
        ];
    }

    
    public function updatePathId()
    {
        if (!$this->parentId) {
            $path = $this->categoryId;
        } else {
            $parent = Mage::getModel('Model_Category')->fetchRow($this->parentId);
            if (!$parent) {
                throw new Exception("Unable to load parent");
            }
            $path = $parent->path . "=" . $this->categoryId;
        }
        $this->path = $path;
        return $this->save();
    }
    public function updateChildrenPathIds($categoryPathId, $parentId = null)
    {
        //MANAGE CHILDREN
        $categoryPathId = $categoryPathId . "=";

        $query = "SELECT * FROM `category` WHERE `path` LIKE '{$categoryPathId}%' ORDER BY `path` ASC";
        $categories = $this->getAdapter()->fetchAll($query);
        if ($categories) {
            foreach ($categories as $key => $row) {
                $row = Mage::getModel('Model_Category')->fetchRow($row['categoryId']);
                if($parentId != null){
                    $row->parentId = $parentId;
                }
                $row->updatePathId();
            }
        }
    }
}
