<?php

namespace Core\Routing\Request;

use UnitTester;
use App\Core\Routing\Request\Request;

class RequestCest
{
    public function _before(UnitTester $I)
    {
    }

    public function request_path_is_set(UnitTester $I)
    {
        $request = new Request;
        $request->setPath('/index');
        $I->assertSame('/index', $request->getPath());
    }

    public function request_method_is_set(UnitTester $I)
    {
        $request = new Request;
        $request->setMethod('get');
        $I->assertSame('GET', $request->getMethod());
    }

    public function request_post_is_set(UnitTester $I)
    {
        $request = new Request;
        $request->setPost(['test1' => 'value1', 'test2' => ' value2 ']);
        $I->assertSame(['test1' => 'value1', 'test2' => 'value2'], $request->getPost());
    }

    public function request_parameters_is_set(UnitTester $I)
    {
        $request = new Request;
        $request->setParameters(['1', 'test1']);
        $I->assertSame(['1', 'test1'], $request->getParameters());
    }
}
