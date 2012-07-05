<?php
class m120514_115142_position_period_create extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('transition_period', array(
            'site_id' => self::MYSQL_TYPE_UINT,
            'period_begin' => 'datetime',
            'period_end' => 'datetime',
            'transition_count' => self::MYSQL_TYPE_UINT,
            'transition_sum' => 'decimal(10,2)',
        ));

        $this->addColumn('transition_input', 'params', 'text');
    }

    public function safeDown()
    {
        $this->dropTable('transition_period');
        $this->dropColumn('transition_input', 'params');
    }
}