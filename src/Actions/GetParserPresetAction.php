<?php

namespace ResetButton\AparserPhpClient\Actions;

use ResetButton\AparserPhpClient\Parser;

class GetParserPresetAction extends Action
{
    const NAME = "getParserPreset";
    public function __construct(Parser $parser)
    {
        $this->data['parser'] = $parser->name;
        $this->data['preset'] = $parser->preset;
    }
}