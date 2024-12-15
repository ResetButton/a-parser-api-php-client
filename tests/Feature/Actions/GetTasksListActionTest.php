<?php

declare(strict_types=1);

namespace Tests\Feature\Actions;

use ResetButton\AparserPhpClient\Actions\GetTasksListAction;

class GetTasksListActionTest extends BaseActionTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testJson()
    {
        $expected = $this->prepareJson('GetTasksListAction.json');

        $action = new GetTasksListAction();
        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }

    public function testJsonStructureWithParams()
    {
        $expected = $this->prepareJson('GetTasksListActionWithParameters.json');

        $action = new GetTasksListAction();
        $action->setCompleted(true);
        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }
}
