<?php
class m120510_105600_subscription_stat extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('subscription_stat', array(
            'site_id' => self::MYSQL_TYPE_UINT,
            'avg_link_price' => 'decimal(10,2) NOT NULL',
        ));
    }

    public function safeDown()
    {
        $this->dropTable('subscription_stat');
    }
}