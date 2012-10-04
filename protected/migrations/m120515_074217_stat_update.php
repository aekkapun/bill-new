<?php
class m120515_074217_stat_update extends DbMigration
{

    public $tables = array(
        'subscription_period',
        'transition_period',
        'context_period',
        'position_period'
    );

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {

        foreach ($this->tables as $table) {
            $this->addColumn($table, 'period_name', 'string');
        }
    }

    public function safeDown()
    {
        foreach ($this->tables as $table) {
            $this->dropColumn($table, 'period_name');
        }
    }
}