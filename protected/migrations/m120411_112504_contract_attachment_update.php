<?php

class m120411_112504_contract_attachment_update extends CDbMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->addColumn('contract_attachment', 'name', 'string');
	}

	public function safeDown()
	{
        $this->dropColumn('contract_attachment', 'name');
	}
}