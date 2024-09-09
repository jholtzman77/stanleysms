<?php
namespace Magesales\Shippingrules\Controller\Adminhtml\Rule;
use Magento\Framework\App\ResponseInterface;

class NewAction extends \Magesales\Shippingrules\Controller\Adminhtml\Rule
{
	 public function execute()
    {
        $this->_forward('edit');
    }
}