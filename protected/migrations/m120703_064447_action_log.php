<?php
class m120703_064447_action_log extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('action_log', array(
            'user' => 'string NOT NULL',
            'action' => 'text NOT NULL',
            'site_id' => 'int',
            'contract_id' => 'int',
        ));
    }

    public function safeDown()
    {
        $this->dropTable('action_log');
    }
}