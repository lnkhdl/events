<?php

namespace Core\Routing;

use UnitTester;
use App\Core\Routing\Route;

class RouteCest
{
    public function _before(UnitTester $I)
    {
    }

    public function route_method_is_set(UnitTester $I)
    {
        $route = new Route;
        $route->setMethod('get');
        $I->assertSame('GET', $route->getMethod());
    }

    public function route_pattern_is_set(UnitTester $I)
    {
        $route = new Route;
        $route->setPattern('/event/{int}/edit');
        $I->assertSame('/event/{int}/edit', $route->getPattern());
    }

    public function route_controller_is_set(UnitTester $I)
    {
        $route = new Route;
        $route->setController('EventController');
        $I->assertSame('EventController', $route->getController());
    }

    public function route_action_is_set(UnitTester $I)
    {
        $route = new Route;
        $route->setAction('edit');
        $I->assertSame('edit', $route->getAction());
    }
}
