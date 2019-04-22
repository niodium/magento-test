<?php
namespace Dev\TodoList\Model;

class TodoItem extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'dev_todolist_todoitem';

	protected $_cacheTag = 'dev_todolist_todoitem';

	protected $_eventPrefix = 'dev_todolist_todoitem';

	protected function _construct()
	{
		$this->_init('Dev\TodoList\Model\ResourceModel\TodoItem');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}