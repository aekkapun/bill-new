<?php
class m121017_181327_add_file_field_to_invoice_table extends DbMigration
{
    public function safeUp()
    {
        $this->addColumn('invoice', 'file', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn('invoice', 'file');
    }
}