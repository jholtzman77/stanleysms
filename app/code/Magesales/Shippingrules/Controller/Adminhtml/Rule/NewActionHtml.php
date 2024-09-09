<?php
namespace Magesales\Shippingrules\Controller\Adminhtml\Rule;

class NewActionHtml extends \Magesales\Shippingrules\Controller\Adminhtml\Rule
{
    public function execute()
    {
        $this->newConditions('actions');
    }
}