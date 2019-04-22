<?php
namespace Dev\TodoList\Model\ResourceModel\TodoItem;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'todo_id';
    protected $_eventPrefix = 'dev_todolist_todoitem_collection';
    protected $_eventObject = 'todoitem_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Dev\TodoList\Model\TodoItem', 'Dev\TodoList\Model\ResourceModel\TodoItem');
    }

}