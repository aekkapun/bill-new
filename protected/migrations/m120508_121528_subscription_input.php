<?php
class m120508_121528_subscription_input extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('subscription_input', array(
            'site_id' => self::MYSQL_TYPE_UINT,
            'sum' => 'decimal(10,2) NOT NULL',
            'link_count' => self::MYSQL_TYPE_UINT,
            'avg_link_price' => 'decimal(10,2) NOT NULL',
        ));
    }

    public function safeDown()
    {
        $this->dropTable('subscription_input');
    }
}