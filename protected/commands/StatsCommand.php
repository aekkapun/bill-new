<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 5/10/12
 * Time: 11:38 AM
 * To change this template use File | Settings | File Templates.
 */
class StatsCommand extends CConsoleCommand
{

    public function actionCount($target)
    {
        switch ($target) {
            case 'subscription':
                $this->processSubscription();
                break;
        }
    }

    public function processSubscription()
    {

    }


    public function getHelp()
    {
        return <<<EOD
USAGE
  stats [action] [options]

DESCRIPTION
  This command provides stats counter interface. The optional
  'action' parameter specifies which specific counter task to perform.
  It can take these values: count.
  If the 'action' parameter is not given, it defaults to 'count'.
  Each action takes parameter --target.

EXAMPLES
 * stats count --target=all
   Counts all stats (aggregate)

 * stats count --target=subscribe

EOD;
    }
}
