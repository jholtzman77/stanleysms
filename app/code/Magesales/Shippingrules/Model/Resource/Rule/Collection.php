<?php
namespace Magesales\Shippingrules\Model\Resource\Rule;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Magesales\Shippingrules\Model\Rule', 'Magesales\Shippingrules\Model\Resource\Rule');
    }

    public function addStoreFilter($storeId)
    {
        $storeId = intVal($storeId);
        $this->getSelect()->where('stores="" OR stores LIKE "%,'.$storeId.',%"');

        return $this;
    }

    public function addCustomerGroupFilter($groupId)
    {
        $groupId = intVal($groupId);
        $this->getSelect()->where('cust_groups="" OR cust_groups LIKE "%,'.$groupId.',%"');

        return $this;
    }

    public function addDaysFilter()
    {
        $this->getSelect()->where('days="" OR days LIKE "%,'.date("N").',%"');
        return $this;
    }
}