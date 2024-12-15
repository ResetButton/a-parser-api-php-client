<?php

namespace ResetButton\AparserPhpClient\Actions;

use ResetButton\AparserPhpClient\Parser;

class GetParserInfoAction extends Action
{
    public const NAME = "getParserInfo";

    public function __construct(Parser $parser)
    {
        $this->data['parser'] = $parser->name;
    }
}
