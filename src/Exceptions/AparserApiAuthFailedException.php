<?php

namespace ResetButton\AparserPhpClient\Exceptions;

class AparserApiAuthFailedException extends AparserApiException
{
    public function __construct(string $message)
    {
        parent::__construct($message, 401);
    }
}
