<?php
class m120831_114126_contract_update extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->addColumn('contract', 'type_of_payment', 'VARCHAR(255)');
    }

    public function safeDown()
    {
        $this->dropColumn('contract', 'type_of_payment');
    }
}