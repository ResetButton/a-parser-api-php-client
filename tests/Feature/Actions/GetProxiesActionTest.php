<?php

declare(strict_types=1);

namespace Tests\Feature\Actions;

use ResetButton\AparserPhpClient\Actions\GetProxiesAction;

class GetProxiesActionTest extends BaseActionTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testJson()
    {
        $expected = $this->prepareJson('GetProxiesAction.json');

        $action = new GetProxiesAction();
        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }

    public function testJsonStructureWithParams()
    {
        $expected = $this->prepareJson('GetProxiesActionWithParameters.json');

        $action = new GetProxiesAction();
        $action->setCheckers(["Elite proxies","free proxies"]);
        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }
}
