<?php

namespace Core\Controllers;

use UnitTester;
use App\Controllers\ControllerValidator;
use Exception;


class ControllerValidatorCest
{
    public function _before(UnitTester $I)
    {
    }

    public function correct_controller_does_not_throw_exception(UnitTester $I)
    {
        $validator = new ControllerValidator;
        $validator->validate('EventController', 'show', ['1']);
        $I->assertTrue(true);
    }

    public function incorrect_controller_name_throws_exception(UnitTester $I)
    {
        $I->expectThrowable(new Exception('Class \App\Controllers\IncorrectName does not exist'), function() {
            $validator = new ControllerValidator;
            $validator->validate('IncorrectName', 'incorrect', ['param1']);
        });
    }

    public function incorrect_action_name_throws_exception(UnitTester $I)
    {
        $I->expectThrowable(new Exception('Method App\Controllers\EventController::incorrect() does not exist'), function() {
            $validator = new ControllerValidator;
            $validator->validate('EventController', 'incorrect', ['param1']);
        });
    }

    public function incorrect_number_of_parameters_throws_exception(UnitTester $I)
    {
        $I->expectThrowable(new Exception("Number of parameters from the path does not match number of parameters expected in the Controller's method."), function() {
            $validator = new ControllerValidator;
            $validator->validate('EventController', 'show', ['param1', 'param2']);
        });
    }
}
