<?php

namespace ResetButton\AparserPhpClient\Actions;

use ResetButton\AparserPhpClient\Parser;
use ResetButton\AparserPhpClient\Traits\ConfigPresetTrait;

class OneRequestAction extends RequestAction
{

    use ConfigPresetTrait;

    const NAME = "oneRequest";

    public function __construct(readonly Parser $parser, string $query)
    {
        $this->data = [
            'query' => $query,
            'parser' => $parser->name,
            'preset' => $parser->preset,
            'configPreset'  => 'default',
        ];

        if ($parser->getConfiguration()) {
            $this->data['options'] = $parser->getConfiguration();
        };
    }
}