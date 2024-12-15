<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use ResetButton\AparserPhpClient\Aparser;

abstract class BaseTestCase extends TestCase
{
    protected Aparser $aparser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->aparser = new Aparser('http://url', 'password123');
    }
}
