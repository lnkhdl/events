<?php

namespace Core\Routing;

use UnitTester;
use App\Core\Routing\Route;
use App\Core\Routing\Router;
use App\Core\Routing\Request\Request;
use Exception;

class RouterCest
{
    public function _before(UnitTester $I)
    {
    }

    public function current_get_route_is_found(UnitTester $I)
    {
        $routes = array();
        $routes[0] = new Route;
        $routes[0]->setMethod('post');
        $routes[0]->setPattern('/event/add');
        $routes[0]->setController('EventController');
        $routes[0]->setAction('add');
        $routes[1] = new Route;
        $routes[1]->setMethod('get');
        $routes[1]->setPattern('/event/{int}');
        $routes[1]->setController('EventController');
        $routes[1]->setAction('show');

        $request = new Request;
        $request->setPath('/event/1');
        $request->setMethod('get');

        $router = new Router;
        $currentRoute = $router->getCurrentRoute($request, $routes);

        $I->assertSame('GET', $currentRoute->getMethod());
        $I->assertSame('/event/{int}', $currentRoute->getPattern());
        $I->assertSame('EventController', $currentRoute->getController());
        $I->assertSame('show', $currentRoute->getAction());
    }

    public function current_post_route_is_found(UnitTester $I)
    {
        $routes = array();
        $routes[0] = new Route;
        $routes[0]->setMethod('get');
        $routes[0]->setPattern('/event/{int}');
        $routes[0]->setController('EventController');
        $routes[0]->setAction('show');
        $routes[1] = new Route;
        $routes[1]->setMethod('post');
        $routes[1]->setPattern('/event/add');
        $routes[1]->setController('EventController');
        $routes[1]->setAction('add');

        $request = new Request;
        $request->setPath('/event/add');
        $request->setMethod('post');

        $router = new Router;
        $currentRoute = $router->getCurrentRoute($request, $routes);

        $I->assertSame('POST', $currentRoute->getMethod());
        $I->assertSame('/event/add', $currentRoute->getPattern());
        $I->assertSame('EventController', $currentRoute->getController());
        $I->assertSame('add', $currentRoute->getAction());
    }

    public function current_route_is_not_defined(UnitTester $I)
    {
        $I->expectThrowable(new Exception('Page not found', 404), function() {
            $routes = array();
            $routes[0] = new Route;
            $routes[0]->setMethod('get');
            $routes[0]->setPattern('/event/{int}');
            $routes[0]->setController('EventController');
            $routes[0]->setAction('show');

            $request = new Request;
            $request->setPath('/event/add');
            $request->setMethod('post');

            $router = new Router;
            $currentRoute = $router->getCurrentRoute($request, $routes);
        });
    }

    public function correct_parameters_are_returned_different_types(UnitTester $I)
    {
        $requestPath = '/test/core/1234567890/config/test123';
        $routePattern = '/test/core/{int}/config/{string}';

        $router = new Router;

        $params = $router->getParameters($requestPath, $routePattern);

        $I->assertSame(array('1234567890','test123'), $params);
    }

    public function correct_parameters_are_returned_integers(UnitTester $I)
    {
        $requestPath = '/test/1234567890/9876543210';
        $routePattern = '/test/{int}/{int}';

        $router = new Router;

        $params = $router->getParameters($requestPath, $routePattern);

        $I->assertSame(array('1234567890','9876543210'), $params);
    }

    public function correct_parameters_are_returned_strings(UnitTester $I)
    {
        $requestPath = '/test/123test/test123';
        $routePattern = '/test/{string}/{string}';

        $router = new Router;

        $params = $router->getParameters($requestPath, $routePattern);

        $I->assertSame(array('123test','test123'), $params);
    }

    public function empty_parameters_are_returned(UnitTester $I)
    {
        $requestPath = '/test';
        $routePattern = '/test';

        $router = new Router;

        $params = $router->getParameters($requestPath, $routePattern);

        $I->assertSame([], $params);
    }
}
