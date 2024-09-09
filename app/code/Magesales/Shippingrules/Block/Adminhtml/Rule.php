<?php
namespace Magesales\Shippingrules\Block\Adminhtml;

class Rule extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_rule';
		$this->_blockGroup = 'Magesales_Shippingrules';
        $this->_headerText = __('Shipping Rules');
        $this->_addButtonLabel = __('Add Rule');
        parent::_construct();
    }
}