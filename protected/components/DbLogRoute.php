<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 11/15/11
 * Time: 4:14 PM
 * To change this template use File | Settings | File Templates.
 */

class DbLogRoute extends CDbLogRoute
{
    /**
     * Creates the DB table for storing log messages.
     * @param CDbConnection $db the database connection
     * @param string $tableName the name of the table to be created
     */
    protected function createLogTable($db, $tableName)
    {
        $driver = $db->getDriverName();
        if ($driver === 'mysql')
            $logID = 'id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY';
        else if ($driver === 'pgsql')
            $logID = 'id SERIAL PRIMARY KEY';
        else
            $logID = 'id INTEGER NOT NULL PRIMARY KEY';

        $sql = "
CREATE TABLE $tableName
(
	$logID,
	user_id INTEGER UNSIGNED,
	username VARCHAR(128),
	level VARCHAR(128),
	category VARCHAR(128),
	logtime TIMESTAMP,
	message TEXT
)";
        $db->createCommand($sql)->execute();
    }

    /**
     * Stores log messages into database.
     * @param array $logs list of log messages
     */
    protected function processLogs($logs)
    {
        $sql = "
INSERT INTO {$this->logTableName}
(level, category, logtime, message, user_id, username) VALUES
(:level, :category, :logtime, :message, :user_id, :username)
";
        $command = $this->getDbConnection()->createCommand($sql);
        foreach ($logs as $log)
        {
            $logtime = date_format(date_create(date('Y-m-d H:i:s', (int)$log[3])), 'Y-m-d H:i:s');

            $command->bindValue(':level', $log[1]);
            $command->bindValue(':category', $log[2]);
            $command->bindValue(':logtime', $logtime);
            $command->bindValue(':message', $log[0]);
            $command->bindValue(':user_id', Yii::app()->user->id);
            $command->bindValue(':username', Yii::app()->user->name);
            $command->execute();
        }
    }
}
