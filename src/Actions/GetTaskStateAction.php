<?php

namespace ResetButton\AparserPhpClient\Actions;

class GetTaskStateAction extends Action
{
    public const NAME = "getTaskState";

    /**
    * @param int|int[] $ids
    */

    public function __construct(int|array $ids)
    {
        $this->data = ['taskUid' => $ids];
    }
}
