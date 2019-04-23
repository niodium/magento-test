<?php
namespace Dev\TodoList\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
        $installer = $setup;

        $installer->startSetup();

        if(version_compare($context->getVersion(), '1.0.0', '<')) {
            if (!$installer->tableExists('todo_table')) {
                $table = $installer->getConnection()->newTable(
                    $installer->getTable('todo_table')
                )
                    ->addColumn(
                        'todo_id',
                        Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'nullable' => false,
                            'primary'  => true,
                            'unsigned' => true
                        ],
                        'todo id'
                    )
                    ->addColumn(
                        'todo_text',
                        Table::TYPE_TEXT,
                        255,
                        ['nullable => true'],
                        'todo action'
                    )
                    ->addColumn(
                        'date_completed',
                        \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
                        null,
                        ['nullable' => true,],
                        'Date the item was completed'
                    )
                    ->addColumn(
                        'creation_time',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                        null,
                        [
                            'nullable' => false,
                            'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT
                        ],
                        'Creation Time'
                    )
                    ->addColumn(
                        'update_time',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                        null,
                        [
                            'nullable' => false,
                            'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE
                        ],
                        'Modification Time'
                    )
                    ->addColumn(
                        'is_active',
                        \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                        null,
                        [
                            'nullable' => false,
                            'default' => '1'
                        ],
                        'Is Active'
                    )
                    ->setComment('TODO Table');
                $installer->getConnection()->createTable($table);
            }
        }
        $installer->endSetup();
    }
}