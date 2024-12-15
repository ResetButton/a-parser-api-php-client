<?php

namespace ResetButton\AparserPhpClient\Actions;

use ResetButton\AparserPhpClient\Parser;
use ResetButton\AparserPhpClient\Traits\ConfigPresetTrait;

class BulkRequestAction extends RequestAction
{
    use ConfigPresetTrait;

    const NAME = "bulkRequest";

    public function __construct(readonly Parser $parser, array $queries)
    {
        $this->data = [
            'queries' => $queries,
            'parser' => $parser->name,
            'preset' => $parser->preset,
            'configPreset'  => 'default'
        ];

        if ($parser->getConfiguration()) {
            $this->data['options'] = $parser->getConfiguration();
        };
    }

    public function setThreads(int $treads) : static
    {
        return $this->setDataValue("threads", $treads);
    }
}