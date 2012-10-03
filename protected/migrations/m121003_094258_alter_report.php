<?php
class m121003_094258_alter_report extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->addColumn('report', 'name', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn('report', 'name');
    }
}