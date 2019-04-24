<?php

namespace Dev\TodoList\Controller\Adminhtml\Item;

class NewAction extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Dev_TodoList::todo_list';
    
    protected $forwardFactory;
    
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\View\Result\ForwardFactory $forwardFactory
    ) {
        $this->forwardFactory = $forwardFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        return $this->forwardFactory->create()->forward('edit');
    }
}
