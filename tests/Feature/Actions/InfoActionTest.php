<?php

declare(strict_types=1);

namespace Tests\Feature\Actions;

use ResetButton\AparserPhpClient\Actions\InfoAction;

class InfoActionTest extends BaseActionTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testJson()
    {
        $expected = $this->prepareJson('InfoAction.json');

        $action = new InfoAction();
        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }
}
