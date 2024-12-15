<?php

namespace Tests\Feature\Actions;

use ResetButton\AparserPhpClient\Actions\GetParserPresetAction;
use ResetButton\AparserPhpClient\Actions\OneRequestAction;
use ResetButton\AparserPhpClient\Parser;

class OneRequestActionTest extends BaseActionTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testMinimumPayload()
    {
        $expected = $this->prepareJson('OneRequestActionMinPayload.json');

        $parser = new Parser("SE::Google", "Pages Count use Proxy");

        $action = new OneRequestAction($parser, "test");
        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }

    public function testMaximumPayload()
    {
        $expected = $this->prepareJson('OneRequestActionMaxPayload.json');

        $parser = new Parser("SE::Google", "Pages Count use Proxy");

        $action = new OneRequestAction($parser, "test");
        $action
            ->setConfigPreset("100Threads")
            ->setRawResults(true)
            ->setDoLog(true)
            ->setNeedData(true);

        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }

    public function testMaximumPayloadWithParserConfiguration()
    {
        $expected = $this->prepareJson('OneRequestActionMaxPayloadWithParserConfiguration.json');

        $parser = new Parser("SE::Google", "Pages Count use Proxy");
        $parser
            ->addOverride("pagecount", 1)
            ->addOption("parseLevel", 20, ["limit" => "0"]);

        $action = new OneRequestAction($parser, "test");
        $action
            ->setConfigPreset("100Threads")
            ->setRawResults(true)
            ->setDoLog(true)
            ->setNeedData(true);

        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }
}
