<?php

namespace ResetButton\AparserPhpClient\Actions;

abstract class Action
{
    public const NAME = '';
    protected array $data = [];

    public function getData(): array
    {
        return $this->data;
    }

    public function setDataValue(string $dataNode, string|int|array|bool $dataValue): static
    {
        $this->data[$dataNode] = $dataValue;
        return $this;
    }

    public function getDataValue(string $dataValue): string|array|int|null
    {
        return $this->data[$dataValue] ?? null;
    }
}
