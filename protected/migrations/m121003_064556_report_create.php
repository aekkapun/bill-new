<?php
class m121003_064556_report_create extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('report', array(
            'period_begin' => 'DATE NOT NULL',
            'period_end' => 'DATE NOT NULL',
            'client_id' => self::MYSQL_TYPE_UINT,
            'status' => 'smallint(5)',
            'contract_status' => 'smallint(5)',
        ));

        $this->addForeignKey('report_client_id_client_id', 'report', 'client_id', 'client', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('report_client_id_client_id', 'report');
        $this->dropTable('report');
    }
}