<?php

namespace ResetButton\AparserPhpClient\Actions;

class GetProxiesAction extends Action
{
    public const NAME = "getProxies";

    public function setCheckers(array $checkers): static
    {
        return $this->setDataValue("checkers", $checkers);
    }
}
