<?php


mage::getModel('Model_Core_Adapter');
mage::getModel('Model_Core_Table');


class Model_Media extends Model_Core_Table
{
    public function __construct()
    {
        $this->setTableName("media");
        $this->setPrimaryKey("mediaId");
    }

}
