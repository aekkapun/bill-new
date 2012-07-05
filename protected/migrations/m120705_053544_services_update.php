<?php
class m120705_053544_services_update extends DbMigration
{

    protected $tables = array(
        'banner_input',
        'context_input',
        'position_input',
        'subscription_input',
        'transition_input',
    );

    protected $statTables = array(
        'banner_period',
        'context_period',
        'position_period',
        'subscription_period',
        'transition_period',
    );

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {

        $this->createTable('banner_period', array(
            'site_id' => self::MYSQL_TYPE_UINT,
            'period_begin' => 'datetime',
            'period_end' => 'datetime',
            'period_name' => 'string',
            'avg_transition_price' => 'decimal(10,2)',
        ));

        foreach ($this->tables as $table) {
            $this->dropColumn($table, 'params');
            $this->addColumn($table, 'contract_id', self::MYSQL_TYPE_UINT);
        }

        foreach ($this->statTables as $table) {
            $this->addColumn($table, 'contract_id', self::MYSQL_TYPE_UINT);
        }
    }

    public function safeDown()
    {
        foreach ($this->tables as $table) {
            $this->addColumn($table, 'params', 'text');
            $this->dropColumn($table, 'contract_id');
        }

        foreach ($this->statTables as $table) {
            $this->dropColumn($table, 'contract_id');
        }

        $this->dropTable('banner_period');
    }
}