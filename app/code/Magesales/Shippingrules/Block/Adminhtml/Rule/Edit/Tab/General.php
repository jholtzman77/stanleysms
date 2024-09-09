<?php
namespace Magesales\Shippingrules\Block\Adminhtml\Rule\Edit\Tab;
use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Form;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Registry;
use Magento\Store\Model\System\Store as SystemStore;

class General extends Form
{
 	/**
     * @var SystemStore
     */
    protected $systemStore;
	/**
     * @var FormFactory
     */
    protected $formFactory;
	/**
     * @var Registry
     */
    protected $registry;
	/**
     * @var Context
     */
    protected $context;
	
	protected $_helper;

    /**
     * {@inheritdoc}
     * @param SourceType  $sourceType
     * @param SystemStore $systemStore
     * @param FormFactory $formFactory
     * @param Registry    $registry
     * @param Context     $context
     */
    public function __construct(
        SystemStore $systemStore,
        FormFactory $formFactory,
        Registry $registry,
        Context $context		
    ) {
        $this->systemStore = $systemStore;
        $this->formFactory = $formFactory;
        $this->registry = $registry;
        $this->context = $context;
		parent::__construct($context);
    }
	
    public function getTabLabel()
    {
        return __('General');
    }

    public function getTabTitle()
    {
        return __('General');
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
        $model = $this->registry->registry('current_magesales_shippingrules_rule');
        $object = \Magento\Framework\App\ObjectManager::getInstance();
        $hlp = $object->get('Magesales\Shippingrules\Helper\Data');

        $form = $this->formFactory->create();
        $form->setHtmlIdPrefix('rule_');

        $fieldset = $form->addFieldset('general', ['legend' => __('General')]);
        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }
        $fieldset->addField(
            'name',
            'text',
            ['name' => 'name', 'label' => __('Rule Name'), 'title' => __('Rule Name'), 'required' => true]
        );

        $fieldset->addField(
            'is_active',
            'select',
            [
                'label'     => __('Rule Status'),
                'title'     => __('Rule Status'),
                'name'      => 'is_active',
                'options'    => $hlp->getStatuses(),
            ]
        );
        $fieldset->addField('carriers', 'multiselect', array(
            'label'     => __('Shipping Carriers'),
            'title'     => __('Shipping Carriers'),
            'name'      => 'carriers[]',
            'values'    => $hlp->getAllCarriers(),
        ));

        $fieldset->addField('methods', 'textarea', array(
            'label'     => __('Shipping Methods'),
            'title'     => __('Shipping Methods'),
            'name'      => 'methods',
            'note'      => __('One method name per line, e.g Next Day Air'),
        ));
		
		$fieldset->addField('stores', 'multiselect', array(
            'label'     => __('Stores'),
            'name'      => 'stores[]',
            'values'    => $this->systemStore->getStoreValuesForForm(),
            'note'      => __('Leave empty or select all to apply the rule to any'),
        ));

        $fieldset->addField('cust_groups', 'multiselect', array(
            'name'      => 'cust_groups[]',
            'label'     => __('Customer Groups'),
            'values'    => $hlp->getAllGroups(),
            'note'      => __('Leave empty or select all to apply the rule to any group'),
        ));

        $fieldset->addField('pos', 'text', array(
            'label'     => __('Priority'),
            'name'      => 'pos',
            'note'      => __('If a product matches several rules, the first rule will be applied only.'),
        ));

        $form->setValues($model->getData());
        $form->addValues(['id'=>$model->getId()]);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}