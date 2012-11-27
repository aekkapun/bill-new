<?php
class m121121_194539_rename_site_range_name_id extends DbMigration
{
    public function safeUp()
    {
        $this->dropForeignKey('site_range_range_name_name_id', 'site_range');

        $this->dropColumn('site_range', 'name_id', 'site_range_name_id');

        $this->addColumn('site_range', 'site_range_name_id', 'integer(10) unsigned');
    }

    public function safeDown()
    {

        $this->dropColumn('site_range', 'site_range_name_id');

        $this->addColumn('site_range', 'name_id', 'int(10) unsigned not null');

        $this->addForeignKey('site_range_range_name_name_id', 'site_range', 'name_id', 'site_range_name', 'id', 'CASCADE', 'RESTRICT');
    }
}