<?php
namespace Dev\TodoList\Block;

class Display extends \Magento\Framework\View\Element\Template
{
    protected $_todoItemFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Dev\TodoList\Model\TodoItemFactory $todoItemFactory
    )

    {
        $this->_todoItemFactory = $todoItemFactory;
        parent::__construct($context);
    }

    public function getTodoItemCollection(){
        $todoItem = $this->_todoItemFactory->create();
        return $todoItem->getCollection();
    }
}