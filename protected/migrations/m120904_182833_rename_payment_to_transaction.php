<?php
class m120904_182833_rename_payment_to_transaction extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
		// Rename table
		$this->renameTable( 'payment', 'transaction' );
		
		// Delete waste columns
		$this->dropForeignKey( 'payment_client_id', 'transaction' );
		$this->dropColumn( 'transaction', 'client_id' );
		
		// Add new column
		$this->addColumn( 'transaction', 'type', self::MYSQL_TYPE_UINT );
		
		// Update exists rows
		$updatedRows =  $this->update( 'transaction', array('type' => 1));
		
		echo "   *\n";
		echo "      If 'transaction' table isn't empty, you need to update 'transaction.type' neccesarily !!!\n";
		echo "   *\n";
	}

    public function safeDown()
    {
		echo "   You can not revert migration " . get_class($self) . ", because it's impossible to create a foreign key 'payment_client_id' !!!\n";
		return false;
		
		/*
		// Rename table
		$this->renameTable( 'transaction', 'payment' );
		
		// Delete waste columns
		$this->dropColumn( 'payment', 'type' );
		
		// Add new column
		$this->addColumn( 'payment', 'client_id', self::MYSQL_TYPE_UINT );
		$this->truncateTable( 'payment' );
		$this->addForeignKey( 'payment_client_id', 'payment', 'client_id', 'client', 'id', 'CASCADE', 'RESTRICT' );
		*/
	}
}