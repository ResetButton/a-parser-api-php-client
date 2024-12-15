<?php

declare(strict_types=1);

namespace Tests\Feature\Actions;

use ResetButton\AparserPhpClient\Actions\GetParserPresetAction;
use ResetButton\AparserPhpClient\Parser;

class GetParserPresetActionTest extends BaseActionTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testJson()
    {
        $expected = $this->prepareJson('GetParserPresetAction.json');

        $parser = new Parser("SE::Google");

        $action = new GetParserPresetAction($parser);
        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }
}
