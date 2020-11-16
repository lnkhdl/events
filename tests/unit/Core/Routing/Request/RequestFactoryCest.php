<?php

namespace Core\Routing\Request;

use UnitTester;
use App\Core\Routing\Request\RequestFactory;
use App\Core\Routing\Request\Request;
use Exception;

class RequestFactoryCest
{
    public function _before(UnitTester $I)
    {
    }

    public function request_with_standard_method_is_created(UnitTester $I)
    {
        $_SERVER['REQUEST_URI'] = '/';
        $_SERVER['REQUEST_METHOD'] = 'get';
        $_REQUEST['_method'] = null;
        $_POST = null;
        $requestFactory = new RequestFactory;
        $request = $requestFactory->create();

        $I->assertInstanceOf(Request::class, $request);
        $I->assertSame($_SERVER['REQUEST_URI'], $request->getPath());
        $I->assertSame(strtoupper($_SERVER['REQUEST_METHOD']), $request->getMethod());
        $I->assertSame($_POST, $request->getPost());
    }

    public function request_with_special_method_is_created(UnitTester $I)
    {
        $_SERVER['REQUEST_URI'] = '/';
        $_REQUEST['_method'] = 'delete';
        $_SERVER['REQUEST_METHOD'] = null;
        $_POST = null;
        $requestFactory = new RequestFactory;
        $request = $requestFactory->create();

        $I->assertInstanceOf(Request::class, $request);
        $I->assertSame($_SERVER['REQUEST_URI'], $request->getPath());
        $I->assertSame(strtoupper($_REQUEST['_method']), $request->getMethod());
        $I->assertSame($_POST, $request->getPost());
    }

    public function request_with_post_data_is_created(UnitTester $I)
    {
        $_SERVER['REQUEST_URI'] = '/';
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_REQUEST['_method'] = null;
        $_POST = ['test1' => 'value1', 'test2' => ' value2 '];
        $requestFactory = new RequestFactory;
        $request = $requestFactory->create();

        $I->assertInstanceOf(Request::class, $request);
        $I->assertSame($_SERVER['REQUEST_URI'], $request->getPath());
        $I->assertSame(strtoupper($_SERVER['REQUEST_METHOD']), $request->getMethod());
        $I->assertSame(array_map('trim', $_POST), $request->getPost());
    }

    public function empty_request_uri_throws_exception(UnitTester $I)
    {
        $I->expectThrowable(new Exception('Cannot read REQUEST_URI.'), function() {
            $_SERVER['REQUEST_URI'] = null;
            $_SERVER['REQUEST_METHOD'] = 'GET';
            $_REQUEST['_method'] = null;
            $requestFactory = new RequestFactory;
            $request = $requestFactory->create();
        });
    }

    public function empty_request_method_throws_exception(UnitTester $I)
    {
        $I->expectThrowable(new Exception('Cannot read REQUEST_METHOD or _method.'), function() {
            $_SERVER['REQUEST_METHOD'] = null;
            $_REQUEST['_method'] = null;
            $_SERVER['REQUEST_URI'] = '/';
            $requestFactory = new RequestFactory;
            $request = $requestFactory->create();
        });
    }

    public function empty_post_data_in_post_request_throws_exception(UnitTester $I)
    {
        $I->expectThrowable(new Exception('Cannot read POST/PUT data.', 400), function() {
            $_SERVER['REQUEST_METHOD'] = 'POST';
            $_POST = null;
            $requestFactory = new RequestFactory;
            $request = $requestFactory->create();
        });
    }
}
