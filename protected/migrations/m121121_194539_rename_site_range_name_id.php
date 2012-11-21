<?php
class m121121_194539_rename_site_range_name_id extends DbMigration
{
    public function safeUp()
    {
        $this->dropForeignKey('site_range_range_name_name_id', 'site_range');

        $this->renameColumn('site_range', 'name_id', 'site_range_name_id');

        $this->addForeignKey('site_range_site_range_name_id', 'site_range', 'site_range_name_id', 'site_range_name', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('site_range_site_range_name_id', 'site_range');

        $this->renameColumn('site_range', 'site_range_name_id', 'name_id');

        $this->addForeignKey('site_range_range_name_name_id', 'site_range', 'name_id', 'site_range_name', 'id', 'CASCADE', 'RESTRICT');
    }
}