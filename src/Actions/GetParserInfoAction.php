<?php

namespace ResetButton\AparserPhpClient\Actions;

use ResetButton\AparserPhpClient\Parser;

class GetParserInfoAction extends Action
{

    const NAME = "getParserInfo";

    public function __construct(Parser $parser)
    {
        $this->data['parser'] = $parser->name;
    }
}