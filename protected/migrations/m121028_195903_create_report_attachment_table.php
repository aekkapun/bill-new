<?php
class m121028_195903_create_report_attachment_table extends DbMigration
{
    public function safeUp()
    {
        $this->createTable('report_attachment', array(
            'report_id' => self::MYSQL_TYPE_UINT,
            'class_name' => 'string NOT NULL',
            'class_name_id' => self::MYSQL_TYPE_UINT,
        ));

        $this->addForeignKey('report_attachment_report_id', 'report_attachment', 'report_id', 'report', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('report_attachment_report_id', 'report_attachment');

        $this->dropTable('report_attachment');
    }
}