<?php

mage::getModel('Model_Core_Adapter');
mage::getModel('Model_Core_Table');


class Model_CustomerGroup extends Model_Core_Table
{ 
    public function __construct()
    {
        $this->setTableName("cgroup");
        $this->setPrimaryKey("groupId");
    }
}
