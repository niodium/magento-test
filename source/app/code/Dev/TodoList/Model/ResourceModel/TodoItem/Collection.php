<?php
namespace Dev\TodoList\Model\ResourceModel\TodoItem;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Dev\TodoList\Model\TodoItem', 'Dev\TodoList\Model\ResourceModel\TodoItem');
    }

}