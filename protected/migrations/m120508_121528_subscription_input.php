<?php
class m120508_121528_subscription_input extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('subscription_input', array(
            'site_id' => self::MYSQL_TYPE_UINT,
            'link_count' => self::MYSQL_TYPE_UINT,
        ));
    }

    public function safeDown()
    {
        $this->dropTable('subscription_input');
    }
}