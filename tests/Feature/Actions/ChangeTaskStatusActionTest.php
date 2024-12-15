<?php
declare(strict_types=1);

namespace Tests\Feature\Actions;

use ResetButton\AparserPhpClient\Actions\ChangeTaskStatusAction;
use ResetButton\AparserPhpClient\Enums\ChangeableTaskStatus;

class ChangeTaskStatusActionTest extends BaseActionTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testJson()
    {
        $expected = $this->prepareJson('ChangeTaskStatusAction.json');

        $action = new ChangeTaskStatusAction(181, ChangeableTaskStatus::STARTING);
        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }
}