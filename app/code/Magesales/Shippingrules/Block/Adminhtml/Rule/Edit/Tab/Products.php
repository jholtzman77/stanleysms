<?php
namespace Magesales\Shippingrules\Block\Adminhtml\Rule\Edit\Tab;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;


class Products extends Generic implements TabInterface
{
    protected $_rendererFieldset;

    protected $_actions;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Rule\Block\Actions $actions,
        \Magento\Backend\Block\Widget\Form\Renderer\Fieldset $rendererFieldset        
    ) {
        $this->_rendererFieldset = $rendererFieldset;
        $this->_actions = $actions;
        parent::__construct($context, $registry, $formFactory);
    }

    public function getTabLabel()
    {
        return __('Products Conditions');
    }

    public function getTabTitle()
    {
        return __('Products Conditions');
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
        
        $renderer = $this->_rendererFieldset->setTemplate(
            'Magento_CatalogRule::promo/fieldset.phtml'
        )->setNewChildUrl(
            $this->getUrl('*/*/newActionHtml/form/rule_actions_fieldset')
        );

        $fieldset = $form->addFieldset(
            'rule_actions_fieldset',
            [
                'legend' => __(
                    'Select products or leave blank for all products.'
                )
            ]
        )->setRenderer(
            $renderer
        );

        $fieldset->addField(
            'actions',
            'text',
            ['name' => 'actions', 'label' => __('Conditions'), 'title' => __('Conditions')]
        )->setRule(
            $model
        )->setRenderer(
            $this->_actions
        );

        $form->setValues($model->getData());
        $form->addValues(['id'=>$model->getId()]);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}