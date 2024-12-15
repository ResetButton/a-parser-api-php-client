<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use ResetButton\AparserPhpClient\Parser;

class ParserTest extends TestCase
{
    public function testAddOverride(): void
    {
        $parser = new Parser("SE::Google");
        $parser->addOverride("proxyChecker", "premium");

        $expected = [
            [
              "type" => "override",
              "id" => "proxyChecker",
              "value" => "premium"
            ]
        ];

        $this->assertEquals($parser->getConfiguration(), $expected);
    }

    public function testAddOption(): void
    {
        $parser = new Parser("SE::Google");
        $parser->addOption("parseLevel", 20);

        $expected = [
            [
              "type" => "options",
              "id" => "parseLevel",
              "value" => 20
            ]
        ];

        $this->assertEquals($parser->getConfiguration(), $expected);
    }

    public function testAddOptionWithAdditional(): void
    {
        $parser = new Parser("SE::Google");
        $parser->addOption("parseLevel", 20, ["limit" => 0]);

        $expected = [
            [
              "type" => "options",
              "id" => "parseLevel",
              "value" => 20,
              "additional" => ["limit" => 0]
            ]
        ];

        $this->assertEquals($parser->getConfiguration(), $expected);
    }

    public function testAddFilter(): void
    {
        $parser = new Parser("SE::Google");
        $parser->addFilter("registered", "==", "0", "sens");

        $expected = [
            [
              "type" => "filter",
              "result" => "registered",
              "filterType" => "==",
              "value" => "0",
              "option" => "sens"
            ]
        ];

        $this->assertEquals($parser->getConfiguration(), $expected);
    }

    public function testAddUnique(): void
    {
        $parser = new Parser("SE::Google");
        $parser->addUnique("query", "string", true);

        $expected = [
            [
                "type" => "unique",
                "result" => "query",
                "uniqueType" => "string",
                "uniqueGlobal" => true
            ]
        ];

        $this->assertEquals($parser->getConfiguration(), $expected);
    }

    public function testComplexConfiguration(): void
    {
        $parser = new Parser("SE::Google");
        $parser
            ->addOverride("proxyChecker", "premium")
            ->addOption("parseLevel", 20)
            ->addOption("parseLevel", 20, ["limit" => 0])
            ->addFilter("registered", "==", "0", "sens")
            ->addUnique("query", "string", true);

        $expected = [
           [
              "type" => "override",
              "id" => "proxyChecker",
              "value" => "premium"
           ],
            [
              "type" => "options",
              "id" => "parseLevel",
              "value" => 20
            ],
            [
              "type" => "options",
              "id" => "parseLevel",
              "value" => 20,
              "additional" => ["limit" => 0]
            ],
            [
              "type" => "filter",
              "result" => "registered",
              "filterType" => "==",
              "value" => "0",
              "option" => "sens"
            ],
            [
                "type" => "unique",
                "result" => "query",
                "uniqueType" => "string",
                "uniqueGlobal" => true
            ]

        ];

        $this->assertEquals($parser->getConfiguration(), $expected);
    }
}
