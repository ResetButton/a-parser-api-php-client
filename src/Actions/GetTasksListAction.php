<?php

namespace ResetButton\AparserPhpClient\Actions;

class GetTasksListAction extends Action
{

    const NAME = "getTasksList";

    public function setCompleted(bool $completed) : static
    {
        return $this->setDataValue("completed", $completed);
    }
}