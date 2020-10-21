<?php

namespace Core;

use UnitTester;
use App\Core\DependencyInjector;
use Exception;
use Helper\Unit;

class DependencyInjectorCest
{
    public function dependency_injector_is_set(UnitTester $I)
    {
        $injector = new DependencyInjector;
        $injector->set('injector', $injector);
        $result = $injector->get('injector');

        $I->assertIsObject($result);
        $I->assertNotEmpty($result);
    }

    public function incorrect_dependency_injector_throws_exception(UnitTester $I)
    {
        $I->expectThrowable(new Exception('Undefined index: incorrect_injector', 8), function() {
            $injector = new DependencyInjector;
            $incorrectInjector = $injector->get('incorrect_injector');
        });
    }
}
