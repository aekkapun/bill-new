<?php
class m120514_084045_subscription_input_update extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->addColumn('subscription_input', 'params', 'text');
    }

    public function safeDown()
    {
    }
}