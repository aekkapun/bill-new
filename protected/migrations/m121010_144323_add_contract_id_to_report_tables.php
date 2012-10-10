<?php
class m121010_144323_add_contract_id_to_report_tables extends DbMigration
{
    public function safeUp()
    {
    	$this->addColumn('report_banner', 'contract_id', 'int UNSIGNED NOT NULL');
    	$this->addColumn('report_context', 'contract_id', 'int UNSIGNED NOT NULL');
    	$this->addColumn('report_custom', 'contract_id', 'int UNSIGNED NOT NULL');
    	$this->addColumn('report_position', 'contract_id', 'int UNSIGNED NOT NULL');
    	$this->addColumn('report_subscription', 'contract_id', 'int UNSIGNED NOT NULL');
    }

    public function safeDown()
    {
		$this->dropColumn('report_banner', 'contract_id');
    	$this->dropColumn('report_context', 'contract_id');
    	$this->dropColumn('report_custom', 'contract_id');
    	$this->dropColumn('report_position', 'contract_id');
    	$this->dropColumn('report_subscription', 'contract_id');
    }
}