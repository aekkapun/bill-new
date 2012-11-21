<?php
class m121121_181837_alter_range_name_table extends DbMigration
{
    public function safeUp()
    {
        // Rename table
        $this->renameTable( 'range_name', 'site_range_name' );

        // Add site_id column
        $siteId = $this->_getExistId('site');
        $this->addColumn('site_range_name', 'site_id', 'int(10) unsigned not null');
        $this->update('site_range_name', array('site_id' => $siteId));
        $this->addForeignKey('site_range_name_site_id', 'site_range_name', 'site_id', 'site', 'id', 'CASCADE', 'RESTRICT');

        // Add contract_id column
        $contractId = $this->_getExistId('contract');
        $this->addColumn('site_range_name', 'contract_id', self::MYSQL_TYPE_UINT);
        $this->update('site_range_name', array('contract_id' => $contractId));
        $this->addForeignKey('site_range_name_contract_id', 'site_range_name', 'contract_id', 'contract', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        // Drop site_id column
        $this->dropForeignKey('site_range_name_site_id', 'site_range_name');
        $this->dropColumn('site_range_name', 'site_id');

        // Drop contract_id column
        $this->dropForeignKey('site_range_name_contract_id', 'site_range_name');
        $this->dropColumn('site_range_name', 'contract_id');

        // Rename table
        $this->renameTable( 'site_range_name', 'range_name' );
    }


    private function _getExistId( $table )
    {
        $IDs = Yii::app()->db->createCommand("SELECT id FROM $table ORDER BY id LIMIT 1;")->queryColumn();

        if( !count($IDs) )
        {
            echo "   *\n";
            echo "      Table `$table` can't be empty!";
            echo "   *\n";
            die();
        }

        return $IDs[0];
    }

}