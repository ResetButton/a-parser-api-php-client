```php

require_once('vendor/autoload.php');

const API_URL = 'http://0.0.0.0:9091/API';
const PASSWORD = 'your-password';

$aparser = new \ResetButton\AparserPhpClient\Aparser(API_URL,PASSWORD);
$parser = new \ResetButton\AparserPhpClient\Parser("Net::HTTP");
$parser->addOverride("useproxy", false);
$parser->addOverride("formatresult", '$code');

echo "A-parser demo run sequence start".lineBreak().lineBreak();

$action = new \ResetButton\AparserPhpClient\Actions\PingAction();
renderResult($aparser, $action);

$action = new \ResetButton\AparserPhpClient\Actions\InfoAction();
renderResult($aparser, $action);

$action = new \ResetButton\AparserPhpClient\Actions\GetParserPresetAction($parser);
renderResult($aparser, $action);

$action = new \ResetButton\AparserPhpClient\Actions\GetProxiesAction();
renderResult($aparser, $action);

$action = new \ResetButton\AparserPhpClient\Actions\GetProxiesAction();
renderResult($aparser, $action);

$action = new \ResetButton\AparserPhpClient\Actions\GetTasksListAction();
renderResult($aparser, $action);

$action = new \ResetButton\AparserPhpClient\Actions\GetParserInfoAction($parser);
renderResult($aparser, $action);

//This method will break a-parser, if you have 0 accounts in base
//$action = new \ResetButton\AparserPhpClient\Actions\GetAccountsCountAction();
//renderResult($aparser, $action);

$action = new \ResetButton\AparserPhpClient\Actions\ChangeProxyCheckerStateAction("default", true);
renderResult($aparser, $action);

//Requests
$action = new \ResetButton\AparserPhpClient\Actions\OneRequestAction($parser, "https://a-parser.com");
renderResult($aparser, $action);

$action = new \ResetButton\AparserPhpClient\Actions\BulkRequestAction($parser, ["https://a-parser.com"]);
renderResult($aparser, $action);

//Task
$parser->addOverride('requestdelay', 15);
$action = \ResetButton\AparserPhpClient\Actions\AddTaskAction::withParser($parser, ["https://a-parser.com"]);

/* @var int $taskNumber */
$taskNumber = $aparser->runAction($action);
echo $action::NAME.": ".json_encode($taskNumber).lineBreak().lineBreak();

$action = new ResetButton\AparserPhpClient\Actions\MoveTaskAction($taskNumber, \ResetButton\AparserPhpClient\Enums\MoveTaskDirection::START);
renderResult($aparser, $action);

$action = new ResetButton\AparserPhpClient\Actions\GetTaskConfAction($taskNumber);
renderResult($aparser, $action);

$action = new ResetButton\AparserPhpClient\Actions\GetTaskStateAction([$taskNumber]);
////Wait task for complete
do {
    sleep(1);
    $taskStateResult = $aparser->runAction($action);
    echo $action::NAME.": ".$taskStateResult[0]['status'].lineBreak();
} while ($taskStateResult[0]['status'] != "completed");
echo lineBreak();

$action = new ResetButton\AparserPhpClient\Actions\GetTaskResultsFileAction($taskNumber);
renderResult($aparser, $action);

$action = new ResetButton\AparserPhpClient\Actions\DeleteTaskResultsFileAction($taskNumber);
renderResult($aparser, $action);

$action = new ResetButton\AparserPhpClient\Actions\ChangeTaskStatusAction($taskNumber, \ResetButton\AparserPhpClient\Enums\ChangeableTaskStatus::DELETING);
renderResult($aparser, $action);

echo "A-parser demo run sequence end".lineBreak().lineBreak();

function renderResult(\ResetButton\AparserPhpClient\Aparser $aparser, \ResetButton\AparserPhpClient\Actions\Action $action)
{
    $result = $aparser->runAction($action);
    echo $action::NAME.": ".json_encode($result).lineBreak().lineBreak();
}

function lineBreak() : string
{
    return (PHP_SAPI === 'cli') ? PHP_EOL : '<br />';
}
```