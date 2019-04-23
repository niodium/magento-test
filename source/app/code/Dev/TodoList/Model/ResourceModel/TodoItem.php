<?php
namespace Dev\TodoList\Model\ResourceModel;

class TodoItem extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('todo_table', 'todo_id');
    }
}