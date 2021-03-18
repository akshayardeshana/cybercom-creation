<?php

mage::getModel('Model_Core_Adapter');
mage::getModel('Model_Core_Table');

class Model_Admin extends Model_Core_Table
{
    const STATUS_ENABLE = 1;
    const STATUS_DESABLED = 0;
    public function __construct()
    {
        $this->setTableName("admin");
        $this->setPrimaryKey("adminId");
    }
    public function getStatusOptions()
    {
        return [
            self::STATUS_DESABLED=>"Disable", //or use self::
            self::STATUS_ENABLE=>"Enable"
        ];
    }
}
