<?php
/**
 * Created by JetBrains PhpStorm.
 * User: boldinov
 * Date: 6/20/11
 * Time: 1:06 PM
 */

class DbMigration extends CDbMigration
{
    const MYSQL_TYPE_UINT = 'int UNSIGNED NOT NULL';
    const MYSQL_TYPE_BOOLEAN = 'tinyint(1) DEFAULT 0';
    const MYSQL_TYPE_MONEY = 'decimal(20,2)';

    protected $options = 'engine=InnoDB;';

    public function createTable($table, $columns, $options = null)
    {
        if ($options != null) {
            $this->options .= $options;
        }

        $columns = CMap::mergeArray(array(
            'id' => 'int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
        ), $columns);

        parent::createTable($table, $columns, $this->options);

        $this->addColumn($table, 'created_at', 'TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP');
        $this->addColumn($table, 'updated_at', 'TIMESTAMP');
    }

    public function getExistId( $table )
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