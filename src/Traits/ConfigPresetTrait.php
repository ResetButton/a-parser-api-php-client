<?php

namespace ResetButton\AparserPhpClient\Traits;

trait ConfigPresetTrait
{
    public function setConfigPreset(string $configPreset): static
    {
        return $this->setDataValue('configPreset', $configPreset);
    }
}
