<?php

namespace Dev\TodoList\Controller\Adminhtml\Item;

use Magento\Backend\App\Action;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Dev_ToDoList::todo_list';

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            if (isset($data['is_active']) && $data['is_active'] === 'true') {
                $data['is_active'] = Dev\TodoList\Model\TodoItem::STATUS_ENABLED;
            }
            if (empty($data['todo_id'])) {
                $data['todo_id'] = null;
            }

            /** @var Dev\TodoList\Model\TodoItem $model */
            $model = $this->_objectManager->create('Dev\TodoList\Model\TodoItem');

            $id = $this->getRequest()->getParam('todo_id');
            if ($id) {
                $model->load($id);
            }

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('You saved the thing.'));
                $this->dataPersistor->clear('dev_todolist_todoitem');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['todo_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            $this->dataPersistor->set('dev_todolist_todoitem', $data);
            return $resultRedirect->setPath('*/*/edit', ['todo_id' => $this->getRequest()->getParam('todo_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
