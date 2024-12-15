<?php

namespace ResetButton\AparserPhpClient\Actions;

use ResetButton\AparserPhpClient\Enums\ChangeableTaskStatus;
use ResetButton\AparserPhpClient\Enums\MoveTaskDirection;

class MoveTaskAction extends Action
{
    const NAME = "moveTask";

    public function __construct(int $id, MoveTaskDirection $direction)
    {
        $this->data['taskUid'] = $id;
        $this->data['direction'] = $direction->value;
    }
}
