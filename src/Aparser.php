<?php

namespace ResetButton\AparserPhpClient;

use GuzzleHttp\Client;
use ResetButton\AparserPhpClient\Actions\Action;
use ResetButton\AparserPhpClient\Exceptions\AparserApiAuthFailedException;
use ResetButton\AparserPhpClient\Exceptions\AparserApiException;
use ResetButton\AparserPhpClient\Exceptions\AparserApiInvalidArgumentException;

class Aparser
{
    protected Client $httpClient;

    public function __construct(readonly string $apiUrl, readonly string $password)
    {
        $this->httpClient = new Client();
    }

    public function getJsonString(Action $action) : string
    {
        $payload = [
            'password' => $this->password,
            'action' => $action::NAME
        ];

        //If data is not empty, add it to payload
        if ($action->getData()) {
            $payload["data"] = $action->getData();
        }

        return json_encode($payload, JSON_UNESCAPED_UNICODE);
    }

    public function runAction(Action $apiAction) : array|string
    {
        return $this->runJsonString($this->getJsonString($apiAction));
    }

    public function runJsonString(string $jsonString)
    {
        $result = $this->httpClient->post($this->apiUrl, [
                'body' =>  $jsonString,
                'headers' => [
                    'accept'     => 'application/json',
                    'content-type' => 'application/json'
                ]
            ]
        );
        $result = json_decode($result->getBody(), true, JSON_UNESCAPED_UNICODE);

        //If response doesn't have  "success" - this is an error
        if (!isset($result["success"])) {
            throw new AparserApiException("Malformed answer, no 'success' section in A-parser response", 400);
        }

        //If response has "msg" - this is an error
        if (isset($result["msg"])) {
            match (true) {
                $result["msg"] == "Auth failed" => throw new AparserApiAuthFailedException($result["msg"]),
                default => throw new AparserApiInvalidArgumentException($result["msg"]),
            };
        }

        //changeProxyCheckerState doesn't have data section, so OK it is a patch for it
        return $result["data"] ?? "OK";
    }

}
