<?php

namespace ResetButton\AparserPhpClient\Actions;

use ResetButton\AparserPhpClient\Exceptions\AparserApiException;
use ResetButton\AparserPhpClient\Parser;
use ResetButton\AparserPhpClient\Traits\ConfigPresetTrait;

class AddTaskAction extends Action
{
    use ConfigPresetTrait;

    public const NAME = "addTask";

    private array $queries;

    protected array $data = [
        'configPreset' => 'default', // phpcs:ignore config Preset (threads) https://en.a-parser.com/docs/assets/images/tour_ru_2_task_editor_easy-en-9808b6f4044c8ea214edbdc94b526515.png
        'preset'       => 'default', // phpcs:ignore task preset https://en.a-parser.com/docs/assets/images/tour_ru_2_task_editor_easy-en-9808b6f4044c8ea214edbdc94b526515.png
        'parsers'      => [],
        'queriesFrom'  => 'text'
    ];

    //Class can be initialized in 2 methods 1
    //Method 1 - Provide at least minimum 1 parser with its configuration
    //Method 2 - Provide a taskPreset with saved configuration.
    private function __construct()
    {
    }

    //Method 1
    public static function withParser(Parser $parser, array $queries): static
    {
        $task = new static();
        $task
            ->addParser($parser)
            ->setQueries($queries);
        return $task;
    }

    //Method 2
    public static function withPreset(string $taskPreset, array $queries): static
    {
        $task = new static();
        $task
            ->setDataValue('preset', $taskPreset)
            ->setQueries($queries);
        unset($task->data['parsers']); //Remove parsers field, because it is ignored
        return $task;
    }

    public function addParser(Parser $parser): static
    {
         //Adding parser to preset that differs from 'default' makes no sense and fire and exception
        if ($this->getDataValue('preset') != 'default') {
            throw new AparserApiException("Adding parser to a non default task Preset will break it's logic", 422);
        }

        $this->data["parsers"][] = [
            $parser->name,
            $parser->preset,
            ...$parser->getConfiguration()
        ];

        return $this;
    }

    public function addQueryBuilder(array $queryBuilder): static
    {
        $this->data['queryBuilders'][] = $queryBuilder;
        return $this;
    }

    public function addResultBuilder(array $resultBuilder): static
    {
        $this->data['resultsBuilders'][] = $resultBuilder;
        return $this;
    }

    public function setQueries(array $queries): static
    {
        $this->queries = $queries;
        return $this;
    }

    public function getQueries(): array
    {
        return $this->queries;
    }

    public function setQueriesFromText(): static
    {
        return $this->setDataValue('queriesFrom', 'text');
    }

    public function setQueriesFromFiles(): static
    {
        return $this->setDataValue('queriesFrom', 'file');
    }


    public function getData(): array
    {
        $data = $this->data;

        if ($data['queriesFrom'] == 'text') {
            $data['queries'] = $this->queries;
        }
        if ($data['queriesFrom'] == 'file') {
            $data['queriesFile'] = $this->queries;
        }

        return $data;
    }

    //Implemented setters


    public function setResultsFilename(string $value): static
    {
        return $this->setDataValue('resultsFileName', $value);
    }

    public function setResultsFormat(string $value): static
    {
        return $this->setDataValue('resultsFormat', $value);
    }

    public function setResultsUnique(bool $value = true): static
    {
        $value = $value ? "string" : "no";
        return $this->setDataValue('resultsUnique', $value);
    }

    public function setSaveFailedQueries(bool $value = true): static
    {
        return $this->setDataValue('saveFailedQueries', $value);
    }

    public function setUniqueQueries(bool $value = true): static
    {
        return $this->setDataValue('uniqueQueries', $value);
    }
}
