<?php
class m120514_141058_context_period_create extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('context_period', array(
            'site_id' => self::MYSQL_TYPE_UINT,
            'period_begin' => 'datetime',
            'period_end' => 'datetime',
            'transitions_sum' => 'decimal(10,2)',
        ));

        $this->addColumn('context_input', 'params', 'text');
    }

    public function safeDown()
    {
        $this->dropTable('context_period');
        $this->dropColumn('context_input', 'params');
    }
}