<?php

use ApiTester;
use Helper\Api;

class API02_GetAllEventsCest
{
    public function event1_is_in_all_events(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('events');

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'events' => [
                'id' => API::$eventId1,
                'name' => 'Test_API_01',
                'city' => 'Test city',
                'address' => 'Test address',
                'date' => '2020-12-01 14:30:00',
                'description' => 'This is a test description.'
            ]
        ]);

        $I->seeResponseMatchesJsonType([
            'created_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)',
            'updated_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)'
        ], '$..events[(@.length-2)]');
    }

    public function event2_is_in_all_events(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('events');

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'events' => [
                'id' => API::$eventId2,
                'name' => 'Test_API_02',
                'city' => 'Test city',
                'address' => 'Test address',
                'date' => '2020-01-31 08:30:00',
                'description' => ''
            ]
        ]);

        $I->seeResponseMatchesJsonType([
            'created_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)',
            'updated_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)'
        ], '$..events[(@.length-1)]');
    }
}
