<?php
namespace Magesales\Shippingrules\Model\Grid;
class CalcOptions implements \Magento\Framework\Option\ArrayInterface
{
    protected $_helper;

    public function __construct(\Magesales\Shippingrules\Helper\Data $helper)
    {
        $this->_helper = $helper;
    }

    public function toOptionArray()
    {
        return $this->_helper->getCalculations();
    }
}