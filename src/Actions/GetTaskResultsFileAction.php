<?php

namespace ResetButton\AparserPhpClient\Actions;

class GetTaskResultsFileAction extends Action
{
    public const NAME = "getTaskResultsFile";

    public function __construct(int $id)
    {
        $this->data = ['taskUid' => $id];
    }
}
