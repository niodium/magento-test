<?php

namespace Dev\TodoList\Controller\Adminhtml\Item;

class Index extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Dev_TodoList::todo_list';

    protected $pageFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\pageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Manager: Todo Items')));
        $resultPage->setActiveMenu('Dev_TodoList::todo_list');
        return $resultPage;
    }
}
