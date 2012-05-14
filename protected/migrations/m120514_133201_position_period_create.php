<?php
class m120514_133201_position_period_create extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('position_period', array(
            'site_id' => self::MYSQL_TYPE_UINT,
            'period_begin' => 'datetime',
            'period_end' => 'datetime',
            'phrases' => 'text',
            'sum' => 'decimal(10,2)',
        ));

        $this->addColumn('position_input', 'params', 'text');
    }

    public function safeDown()
    {
        $this->dropTable('position_period');
        $this->dropColumn('position_input', 'params');
    }
}