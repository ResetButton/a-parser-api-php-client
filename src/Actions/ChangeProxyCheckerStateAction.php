<?php

namespace ResetButton\AparserPhpClient\Actions;

use ResetButton\AparserPhpClient\Enums\ChangeableTaskStatus;

class ChangeProxyCheckerStateAction extends Action
{
    const NAME = "changeProxyCheckerState";

    public function __construct(string $checker, bool $state)
    {
        $this->setDataValue('checker', $checker);
        $this->setDataValue('state', $state);
    }
}
