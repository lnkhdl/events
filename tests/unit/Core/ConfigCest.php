<?php

namespace Core;

use UnitTester;
use App\Core\Config;
use Exception;
use Helper\Unit;

class ConfigCest
{
    public function _before(UnitTester $I)
    {
        $_SERVER['DOCUMENT_ROOT'] = Unit::$documentRoot;
    }

    public function config_parameters_are_available(UnitTester $I)
    {
        $definedRoutes = require_once Config::get('ROUTES_FILE');
        $I->assertIsArray($definedRoutes);
        $I->assertNotEmpty($definedRoutes);
    }

    public function incorrect_config_parameter_throws_exception(UnitTester $I)
    {
        $I->expectThrowable(new Exception('Undefined index: incorrect_file', 8), function() {
            $incorrectFile = require_once Config::get('incorrect_file');
        });
    }
}
