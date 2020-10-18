<?php

use ApiTester;
use Helper\Api;

class API05_GetAllEventsAfterUpdateCest
{
    public function event1_is_in_all_events_after_update(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('events');

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'events' => [
                'id' => API::$eventId1,
                'name' => 'Test_API_01 UP',
                'city' => 'Test city UP',
                'address' => 'Test address UP',
                'date' => '2021-11-02 08:30:00',
                'description' => 'This is a test description. UP'
            ]
        ]);

        $I->seeResponseMatchesJsonType([
            'created_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)',
            'updated_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)'
        ], '$..events[(@.length-2)]');
    }

    public function event2_is_in_all_events_after_update(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('events');

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'events' => [
                'id' => API::$eventId2,
                'name' => 'Test_API_02 UP2',
                'city' => 'Test city UP2',
                'address' => 'Test address UP2',
                'date' => '2019-05-01 23:59:00',
                'description' => '',
            ]
        ]);

        $I->seeResponseMatchesJsonType([
            'created_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)',
            'updated_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)'
        ], '$..events[(@.length-1)]');
    }
}
