<?php

namespace ResetButton\AparserPhpClient;


class Parser
{
    private array $configuration = [];

    public function __construct(readonly string $name, readonly string $preset = 'default')
    {}

    public function addOption(string $id, array|int|string|null $value, mixed $additional = []): static
    {
        $id = [
            "type"  => "options",
            "id"    => $id,
            "value" => $value
        ];

        if($additional) {
           $id['additional'] = $additional;
        }

        $this->configuration[]  = $id;

        return $this;
    }

    public function addOverride(string $id, mixed $value): static
    {
        $this->configuration[] = [
            "type"  => "override",
            "id"    => $id,
            "value" => $value
        ];

        return $this;
    }

    public function addFilter(string|array $result, string $filterType, string $value, string $option): static
    {
        $this->configuration[] = [
            "type" => "filter",
            "result" => $result,
            "filterType" => $filterType,
            "value" => $value,
            "option" => $option
        ];

        return $this;
    }

    public function addUnique(string $result, string $uniqueType, bool $uniqueGlobal = false): static
    {
        $this->configuration[] = [
            "type" => "unique",
            "result" => $result,
            "uniqueType" => $uniqueType,
            "uniqueGlobal" => $uniqueGlobal
        ];

        return $this;
    }

    public function setConfiguration(array $configuration) : static
    {
        $this->configuration = $configuration;
        return $this;
    }

    public function getConfiguration() : array
    {
        return $this->configuration;
    }

}
