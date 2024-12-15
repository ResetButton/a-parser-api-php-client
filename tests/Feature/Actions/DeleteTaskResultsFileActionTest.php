<?php
declare(strict_types=1);

namespace Tests\Feature\Actions;

use ResetButton\AparserPhpClient\Actions\DeleteTaskResultsFileAction;

class DeleteTaskResultsFileActionTest extends BaseActionTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testJson()
    {
        $expected = $this->prepareJson('DeleteTaskResultsFileAction.json');

        $action = new DeleteTaskResultsFileAction(181);
        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }
}