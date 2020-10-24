<?php

namespace Core\Routing;

use UnitTester;
use App\Core\Routing\RouteFactory;
use App\Core\Routing\Route;
use Exception;

class RouteFactoryCest
{
    public function _before(UnitTester $I)
    {
    }

    public function routes_are_created_based_on_defined_array(UnitTester $I)
    {
        $definedRoutes = [
            'get|/|PageController|index',
            'delete|/api/event/{int}/member/{int}|MemberController|destroy'
        ];

        $routeFactory = new RouteFactory;
        $routes = $routeFactory->create($definedRoutes);

        $I->assertIsArray($routes);
        $I->assertNotEmpty($routes);

        $I->assertInstanceOf(Route::class, $routes[0]);
        $I->assertSame('GET', $routes[0]->getMethod());
        $I->assertSame('/', $routes[0]->getPattern());
        $I->assertSame('PageController', $routes[0]->getController());
        $I->assertSame('index', $routes[0]->getAction());

        $I->assertInstanceOf(Route::class, $routes[1]);
        $I->assertSame('DELETE', $routes[1]->getMethod());
        $I->assertSame('/api/event/{int}/member/{int}', $routes[1]->getPattern());
        $I->assertSame('MemberController', $routes[1]->getController());
        $I->assertSame('destroy', $routes[1]->getAction());
    }
}
