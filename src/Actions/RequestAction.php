<?php

namespace ResetButton\AparserPhpClient\Actions;

abstract class RequestAction extends Action
{
    public function setRawResults(bool $value = true) : static
    {
        return $this->setDataValue('rawResults', $value);
    }

    public function setNeedData(bool $value = true) : static
    {
        return $this->setDataValue('needData', $value);
    }

    public function setDoLog(bool $value = true) : static
    {
        return $this->setDataValue('doLog', $value);
    }

    public function setConfigPreset(string $name) : static
    {
        return $this->setDataValue('configPreset', $name);
    }
}