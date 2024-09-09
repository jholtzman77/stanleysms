<?php
namespace Magesales\Shippingrules\Controller\Adminhtml\Rule;
class Edit extends \Magesales\Shippingrules\Controller\Adminhtml\Rule
{
	public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create('Magesales\Shippingrules\Model\Rule');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This item no longer exists.'));
                $this->_redirect('*/*');
                return;
            }
        }
        
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        } else {
            $this->_prepareForEdit($model);
        }
        $this->_coreRegistry->register('current_magesales_shippingrules_rule', $model);
        $this->_initAction();
        if($model->getId()) {
            $title = __('Edit Shipping Rule `%1`', $model->getName());
        } else {
            $title = __("Add new Shipping Rule");
        }
        $this->_view->getPage()->getConfig()->getTitle()->prepend($title);
		$this->_view->renderLayout();
    }

    public function _prepareForEdit(\Magesales\Shippingrules\Model\Rule $model)
    {
        $fields = array('stores', 'cust_groups', 'carriers', 'days');
        foreach ($fields as $f){
            $val = $model->getData($f);
            if (!is_array($val)){
                $model->setData($f, explode(',', $val));
            }
        }

        $model->getConditions()->setJsFormObject('rule_conditions_fieldset');
        return true;
    }
}