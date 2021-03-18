<?php

mage::getBlock('Block_Core_Template');

class Block_Customer_Grid extends Block_Core_Template
{
    protected $customers = null;
    protected $address = null;
    protected $customerGroups = null;
    protected $customersOptions = null;

    public function __construct()
    {
        $this->setTemplate('../View/Customer/customer.php');
    }
    public function setCustomers($customers = null)
    {
        if ($this->customers) {
            $this->customers = $customers;
        }
        if (!$customers) {
            $customers = Mage::getModel('Model_Customer');
            $rows = $customers->fetchAll();
            $this->customers = $rows;
        }
        return $this;
    }
    public function getCustomers()
    {
        if (!$this->customers) {
            $this->setCustomers();
        }
        return $this->customers;
    }
    public function getCustomerOptions()
    {
        if ($this->customersOptions) {
            return $this->customersOptions;
        }
        $query = "SELECT `groupId`, `name` from cgroup;";
        $customers = Mage::getModel('Model_customer')->fetchAll($query);
        if ($customers) {
            foreach ($customers->getdata() as $customer) {
                $this->customersOptions[$customer->groupId] = $customer->name;
            }
        }
        return $this->customersOptions;
    }
    public function getName($customer)
    {
        return $this->getCustomerOptions();
    }
  }
