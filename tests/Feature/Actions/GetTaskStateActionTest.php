<?php

declare(strict_types=1);

namespace Tests\Feature\Actions;

use ResetButton\AparserPhpClient\Actions\GetTaskStateAction;

class GetTaskStateActionTest extends BaseActionTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testJsonSingleId()
    {
        $expected = $this->prepareJson('GetTaskStateActionSingleId.json');

        $action = new GetTaskStateAction(181);
        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }

    public function testJsonArrayOfIds()
    {
        $expected = $this->prepareJson('GetTaskStateActionArrayOfIds.json');

        $action = new GetTaskStateAction([22,23,31]);
        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }
}
