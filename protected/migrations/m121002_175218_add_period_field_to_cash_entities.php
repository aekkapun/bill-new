<?php
class m121002_175218_add_period_field_to_cash_entities extends DbMigration
{
    public function safeUp()
    {
        $this->alterColumn( 'act', 'period', 'date NOT NULL DEFAULT "0000-00-00"' );
        $this->alterColumn( 'bill', 'period', 'date NOT NULL DEFAULT "0000-00-00"' );
        $this->alterColumn( 'invoice', 'period', 'date NOT NULL DEFAULT "0000-00-00"' );
        $this->addColumn( 'transaction', 'period', 'date NOT NULL DEFAULT "0000-00-00"' );
    }


    public function safeDown()
    {
        $this->alterColumn( 'act', 'period', 'timestamp NOT NULL DEFAULT "0000-00-00 00:00:00"' );
        $this->alterColumn( 'bill', 'period', 'timestamp NOT NULL DEFAULT "0000-00-00 00:00:00"' );
        $this->alterColumn( 'invoice', 'period', 'timestamp NOT NULL DEFAULT "0000-00-00 00:00:00"' );
        $this->dropColumn( 'transaction', 'period' );
    }
}