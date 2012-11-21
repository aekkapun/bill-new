<?php
class m121121_183211_report_transition extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('report_transition', array(
            'report_id' => 'integer',
            'site_id' => 'integer',
            'contract_id' => 'integer',
            'transition_count' => 'integer',
            'transition_price' => 'integer',
            'transition_sum' => 'integer',
            'site_range_name_id' => 'integer',
        ));
    }

    public function safeDown()
    {
        $this->dropTable('report_transition');
    }
}