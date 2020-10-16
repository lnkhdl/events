<?php

namespace Event;

use ApiTester;
use Helper\Api;

class DeleteCest
{
    public function event1_is_removed(ApiTester $I)
    {
        $I->sendDELETE('event/' . API::$eventId1);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesXpath('/events');
    }

    public function event2_is_removed(ApiTester $I)
    {
        $I->sendDELETE('event/' . API::$eventId2);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesXpath('/events');
    }
}
