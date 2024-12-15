<?php

namespace Tests\Feature\Actions;

use ResetButton\AparserPhpClient\Actions\BulkRequestAction;
use ResetButton\AparserPhpClient\Parser;

class BulkRequestActionTest extends BaseActionTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testJson()
    {
        $expected = $this->prepareJson('BulkRequestAction.json');

        $parser = new Parser("SE::Google", "Pages Count no Proxy");

        $queries = [
            "test1",
            "test2",
            "test3",
            "test4",
            "test5"
        ];

        $action = new BulkRequestAction($parser, $queries);
        $action
            ->setThreads(3)
            ->setRawResults(true);

        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }

    //No need to test other method, this class is almost the same as OneRequest
}
