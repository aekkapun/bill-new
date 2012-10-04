<?php
class m120510_105600_subscription_stat extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('subscription_period', array(
            'site_id' => self::MYSQL_TYPE_UINT,
            'period_begin' => 'datetime',
            'period_end' => 'datetime',
            'avg_link_price' => 'decimal(10,2)',
        ));
    }

    public function safeDown()
    {
        $this->dropTable('subscription_period');
    }
}