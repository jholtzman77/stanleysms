<?php
namespace Magesales\Shippingrules\Block\Adminhtml\Rule\Edit\Tab;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;


class Rates extends Generic implements TabInterface
{
    public function getTabLabel()
    {
        return __('Shipping Rates');
    }

    public function getTabTitle()
    {
        return __('Shipping Rates');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }

    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('current_magesales_shippingrules_rule');

        $object = \Magento\Framework\App\ObjectManager::getInstance();
        $hlp = $object->get('Magesales\Shippingrules\Helper\Data');

        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('rule_');

        $fldRate = $form->addFieldset('rate', array('legend'=> __('Shipping Rates')));
        $fldRate->addField('calc', 'select', array(
            'label'     => __('Rate Calculation Type'),
            'name'      => 'calc',
            'options'   => $hlp->getCalculations(),
        ));
        $fldRate->addField('rate_base', 'text', array(
            'label'     => __('Shipping Rate Per Order'),
            'name'      => 'rate_base',
        ));
        $fldRate->addField('rate_fixed', 'text', array(
            'label'     => __('Fixed Shipping Rate per Product'),
            'name'      => 'rate_fixed',
        ));

        $fldRate->addField('rate_percent', 'text', array(
            'label'     => __('Percentage Shipping Rate per Product'),
            'name'      => 'rate_percent',
            'note'      => __('Without discounts percentage of original product cart price is taken.'),
        ));

        $fldRate->addField('handling', 'text', array(
            'label'     => __('Handling Shipping Rate in Percentage'),
            'name'      => 'handling',
            'note'      => __('The percentage will be added or deducted from the shipping rate.'),
        ));

        $form->setValues($model->getData());
        $form->addValues(['id'=>$model->getId()]);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}