<?php
declare(strict_types=1);

namespace Tests\Feature\Actions;

use ResetButton\AparserPhpClient\Actions\ChangeProxyCheckerStateAction;

class ChangeProxyCheckerStateActionTest extends BaseActionTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testJson()
    {
        $expected = $this->prepareJson('ChangeProxyCheckerStateAction.json');

        $action = new ChangeProxyCheckerStateAction("Elite proxies", true);
        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }


}
