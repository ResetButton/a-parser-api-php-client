<?php

namespace ResetButton\AparserPhpClient\Actions;

class DeleteTaskResultsFileAction extends Action
{
    const NAME = "deleteTaskResultsFile";

    public function __construct(int $id)
    {
        $this->data = ['taskUid' => $id];
    }
}
