<?php
namespace Magesales\Shippingrules\Controller\Adminhtml\Rule;

class NewConditionHtml extends \Magesales\Shippingrules\Controller\Adminhtml\Rule
{
    public function execute()
    {
        $this->newConditions('conditions');
    }
}