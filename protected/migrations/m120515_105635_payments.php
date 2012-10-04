<?php
class m120515_105635_payments extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->dropColumn('payment', 'period');
    }

    public function safeDown()
    {
        ;
    }
}