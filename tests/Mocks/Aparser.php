<?php

namespace Tests\Mocks;

use GuzzleHttp\Client;
use ResetButton\AparserPhpClient\Aparser as BaseAparser;
use GuzzleHttp\HandlerStack;

class Aparser extends BaseAparser
{
    public function mockHttpClient(HandlerStack $handlerStack) : void
    {
        $this->httpClient = new Client(['handler' => $handlerStack]);
    }
}