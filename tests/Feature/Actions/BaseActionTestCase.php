<?php

namespace Tests\Feature\Actions;

use Tests\BaseTestCase;

abstract class BaseActionTestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function prepareJson(string $filename): string
    {
        $jsonData = file_get_contents('tests/Fixtures/Actions/'.$filename);

        $replacements = [
            '{{PASSWORD}}' => $this->aparser->password,
        ];

        return str_replace(array_keys($replacements), array_values($replacements), $jsonData);
    }
}