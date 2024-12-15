<?php

namespace Tests\Feature\Actions;

use ResetButton\AparserPhpClient\Actions\AddTaskAction;
use ResetButton\AparserPhpClient\Parser;

class AddTaskActionTest extends BaseActionTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testWithParserMin()
    {
        $expected = $this->prepareJson('AddTaskActionMinWithParser.json');

        $parser = new Parser("SE::Google");

        $queries = [
            "test",
            "bla-bla"
        ];

        $action = AddTaskAction::withParser($parser, $queries);

        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }

    public function testWithPresetMin()
    {
        $expected = $this->prepareJson('AddTaskActionMinWithPreset.json');

        $queries = [
            "test",
            "bla-bla"
        ];

        $action = AddTaskAction::withPreset("savedPreset", $queries);

        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }

    public function testWithParserQueriesFromFile()
    {
        $expected = $this->prepareJson('AddTaskActionWithParserQueriesFromFile.json');

        $parser = new Parser("SE::Google");

        $queriesFiles = [
            "queries/file1.txt",
            "queries/file2.txt"
        ];

        $action = AddTaskAction::withParser($parser, $queriesFiles);
        $action->setQueriesFromFiles();

        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }

    public function testWithParserQueriesFromText()
    {
        $expected = $this->prepareJson('AddTaskActionMinWithParser.json');

        $parser = new Parser("SE::Google");

        $queries = [
            "test",
            "bla-bla"
        ];

        $action = AddTaskAction::withParser($parser, $queries);
        $action
            ->setQueriesFromFiles()
            ->setQueriesFromText();

        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }

    public function testTwoParsers()
    {
        $expected = $this->prepareJson('AddTaskActionWithTwoParsers.json');

        $parser1 = new Parser("SE::Google");
        $parser2 = new Parser("SE::Bing", "custom");
        $parser2->addOverride("proxyretries", "10");

        $queries = [
            "test",
            "bla-bla"
        ];

        $action = AddTaskAction::withParser($parser1, $queries);
        $action->addParser($parser2);

        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }

    public function testQueryBuilders()
    {
        $expected = $this->prepareJson('AddTaskActionWithQueryBuilders.json');

        $parser = new Parser("SE::Google");

        $queries = [
            "test",
            "bla-bla"
        ];

        $queryBuilders = [
            [
            "source" => "query",
            "type" => "stringSplit",
            "separator" => "|",
            "to" => ["query", "coord"],
            ],
            [
            "source" => "query",
            "type" => "!",
            "to" => "query"
            ]
        ];

        $action = AddTaskAction::withParser($parser, $queries);
        $action->addQueryBuilder($queryBuilders[0]);
        $action->addQueryBuilder($queryBuilders[1]);

        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }

    public function testResultBuilders()
    {
        $expected = $this->prepareJson('AddTaskActionWithResultBuilders.json');

        $parser = new Parser("SE::Google");

        $queries = [
            "test",
            "bla-bla"
        ];

        $resultBuilders = [
            [
                "source" => [
                  0,
                  "query"
                ],
                "type" => "extractTopDomain",
                "to" => "query"
            ],
            [
                "source" => [
                    0,
                    [
                        "ads",
                        "link"
                    ]
                ],
                "type" => "regex",
                "array" => "ads",
                "regex" => "ddd",
                "regexType" => "sg",
                "to" => [
                  "link"
                ]
            ]
        ];

        $action = AddTaskAction::withParser($parser, $queries);
        $action->addResultBuilder($resultBuilders[0]);
        $action->addResultBuilder($resultBuilders[1]);

        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }

    public function testAllImplementedSetters()
    {
        $expected = $this->prepareJson('AddTaskActionWithParserImplementedSetters.json');

        $parser = new Parser("SE::Google");

        $queries = [
            "test",
            "bla-bla"
        ];

        $action = AddTaskAction::withParser($parser, $queries);
        $action
            ->setResultsFilename("output1.txt")
            ->setResultsFormat('$query;$serp.totalcount')
            ->setResultsUnique()
            ->setSaveFailedQueries()
            ->setUniqueQueries();

        $this->assertJsonStringEqualsJsonString($this->aparser->getJsonString($action), $expected);
    }
}
