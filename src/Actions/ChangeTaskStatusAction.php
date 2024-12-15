<?php

namespace ResetButton\AparserPhpClient\Actions;

use ResetButton\AparserPhpClient\Enums\ChangeableTaskStatus;

class ChangeTaskStatusAction extends Action
{
    const NAME = "changeTaskStatus";

    public function __construct(int $id, ChangeableTaskStatus $status)
    {
        $this->setDataValue('taskUid', $id);
        $this->setDataValue('toStatus', $status->value);
    }
}
