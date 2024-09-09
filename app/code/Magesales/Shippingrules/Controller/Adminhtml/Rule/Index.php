<?php
namespace Magesales\Shippingrules\Controller\Adminhtml\Rule;

class Index extends \Magesales\Shippingrules\Controller\Adminhtml\Rule
{
    public function execute()
    {
		$this->_view->loadLayout();
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Magesales_Shippingrules::rule');
        $resultPage->getConfig()->getTitle()->prepend(__('Shipping Rules'));
        $resultPage->addBreadcrumb(__('Shipping Rules'), __('Shipping Rules'));
		$this->_addContent($this->_view->getLayout()->createBlock('\Magesales\Shippingrules\Block\Adminhtml\Rule'));
        
		$this->_view->renderLayout();
    }
}