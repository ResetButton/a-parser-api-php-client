<?php

namespace ResetButton\AparserPhpClient\Actions;

class GetTaskStateAction extends Action
{
    public const NAME = "getTaskState";

    public function __construct(array $ids)
    {
        $this->data = ['taskUid' => $ids];
    }
}
