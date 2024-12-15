<?php

declare(strict_types=1);

namespace Tests\Feature\Actions;

use ResetButton\AparserPhpClient\Actions\InfoAction;

class ActionTest extends BaseActionTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testDataSetterGetter()
    {
        $action = new InfoAction();
        $action->setDataValue('stringKey', 'stringValue');
        $action->setDataValue('intKey', 10);
        $action->setDataValue('boolKey', false);

        $this->assertEquals($action->getDataValue('stringKey'), 'stringValue');
        $this->assertEquals($action->getDataValue('intKey'), 10);
        $this->assertEquals($action->getDataValue('boolKey'), false);
    }
}
