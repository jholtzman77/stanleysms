<?php
namespace Magesales\Shippingrules\Controller\Adminhtml\Rule;
use Magento\Framework\App\ResponseInterface;

class Delete extends \Magesales\Shippingrules\Controller\Adminhtml\Rule
{
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $model = $this->_objectManager->create('Magesales\Shippingrules\Model\Rule');
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('You have successfully deleted the item.'));
                $this->_redirect('*/*/');
                return;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
                $this->_redirect('*/*/');
                return;
            } catch (\Exception $e) {
                $this->messageManager->addError(
                    __('We can\'t delete item right now. Please review the log and try again.')
                );
                $this->_redirect('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
                return;
            }
        }
        $this->messageManager->addError(__('We can\'t find a item to delete.'));
        $this->_redirect('*/*/');
    }
}