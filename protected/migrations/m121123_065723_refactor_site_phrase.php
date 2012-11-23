<?php
class m121123_065723_refactor_site_phrase extends DbMigration
{
    public function safeUp()
    {
        // Create `site_phrase_group` table
        $this->createTable('site_phrase_group', array(
            'name' => 'varchar(255) not null',
            'site_id' => 'integer(10) unsigned',
        ));

        $this->addForeignKey('site_phrase_group_site_id', 'site_phrase_group', 'site_id', 'site', 'id', 'CASCADE', 'RESTRICT');


        // Alter `site_phrase` table
        $this->addColumn('site_phrase', 'site_phrase_group_id', 'integer(10) unsigned');
        $this->addForeignKey('site_phrase_site_phrase_group_id', 'site_phrase', 'site_phrase_group_id', 'site_phrase_group', 'id', 'CASCADE', 'RESTRICT');


        // Alter `report_transition` table
        $this->addColumn('report_transition', 'site_phrase_group_id', 'integer(10) unsigned');
        $this->addForeignKey('report_transition_site_phrase_group_id', 'report_transition', 'site_phrase_group_id', 'site_phrase_group', 'id', 'CASCADE', 'RESTRICT');


        // Alter `site_range_name` table
        $this->addColumn('site_range_name', 'site_phrase_group_id', 'integer(10) unsigned');
        $this->addForeignKey('site_range_name_site_phrase_group_id', 'site_range_name', 'site_phrase_group_id', 'site_phrase_group', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $siteId = $this->getExistId('site');


        // Alter `site_range_name` table
        $this->dropForeignKey('site_range_name_site_phrase_group_id', 'site_range_name');
        $this->dropColumn('site_range_name', 'site_phrase_group_id');


        // Alter `report_transition` table
        $this->dropForeignKey('report_transition_site_phrase_group_id', 'report_transition');
        $this->dropColumn('report_transition', 'site_phrase_group_id');


        // Alter `site_phrase` table
        $this->dropForeignKey('site_phrase_site_phrase_group_id', 'site_phrase');
        $this->dropColumn('site_phrase', 'site_phrase_group_id');


        // Drop `site_phrase_group` table
        $this->dropForeignKey('site_phrase_group_site_id', 'site_phrase_group');
        $this->dropTable('site_phrase_group');
    }

}