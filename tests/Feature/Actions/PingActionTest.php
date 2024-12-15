<?php
declare(strict_types=1);

namespace Tests\Feature\Actions;

use ResetButton\AparserPhpClient\Actions\PingAction;

class PingActionTest extends BaseActionTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testJson()
    {
        $expected = $this->prepareJson('PingAction.json');

        $action = new PingAction();
        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }
}

