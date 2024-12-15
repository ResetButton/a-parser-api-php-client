<?php

namespace Tests\Feature;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use ResetButton\AparserPhpClient\Actions\GetTaskStateAction;
use ResetButton\AparserPhpClient\Exceptions\AparserApiAuthFailedException;
use ResetButton\AparserPhpClient\Exceptions\AparserApiException;
use ResetButton\AparserPhpClient\Exceptions\AparserApiInvalidArgumentException;
use Tests\BaseTestCase;

class AparserTest extends BaseTestCase
{
    protected function setUp(): void
    {
        $this->mockedAparser = new \Tests\Mocks\Aparser('http://url','password123');
        $this->action = new GetTaskStateAction([142]);
    }

    public function test200Response()
    {
        $expectedResponse = $this->mockResponse('Response200.json');

        $actualResponse = $this->mockedAparser->runAction($this->action);
        $this->assertEquals($expectedResponse['data'], $actualResponse);
    }

    public function test400Response()
    {
        $this->mockResponse('Response400.json');

        $this->expectException(AparserApiException::class);
        $this->expectExceptionCode(400);

        $this->mockedAparser->runAction($this->action);
    }

    public function test401Response()
    {
        $this->mockResponse('Response401.json');

        $this->expectException(AparserApiAuthFailedException::class);
        $this->expectExceptionCode(401);
        $this->expectExceptionMessage("Auth failed");

        $this->mockedAparser->runAction($this->action);
    }

    public function test422Response()
    {
        $this->mockResponse('Response422.json');

        $this->expectException(AparserApiInvalidArgumentException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage("Error: Task not exists");

        $this->mockedAparser->runAction($this->action);
    }

    public function testPassedRunJsonString()
    {
        $jsonRequest = file_get_contents('tests/Fixtures/Aparser/RequestDirectJson.json');
        $jsonResponse = file_get_contents('tests/Fixtures/Aparser/Response200.json');
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json; charset=utf-8'], $jsonResponse),
        ]);
        $handlerStack = HandlerStack::create($mock);
        $container = [];
        $history = Middleware::history($container);
        $handlerStack->push($history);
        $this->mockedAparser->mockHttpClient($handlerStack);
        $this->mockedAparser->runJsonString($jsonRequest);

        $this->assertJsonStringEqualsJsonString($jsonRequest, $container[0]['request']->getBody()->getContents());
    }

    private function mockResponse(string $jsonFile) : array
    {
        $jsonResponse = file_get_contents('tests/Fixtures/Aparser/'.$jsonFile);
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json; charset=utf-8'], $jsonResponse),
        ]);
        $handlerStack = HandlerStack::create($mock);
        $this->mockedAparser->mockHttpClient($handlerStack);

        return json_decode($jsonResponse, true);
    }
}