<?php

use ApiTester;
use Helper\Api;

class API03_GetEventsCest
{
    public function event1_is_returned(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('event/' . API::$eventId1);

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'event' => [
                'id' => API::$eventId1,
                'name' => 'Test_API_01',
                'city' => 'Test city',
                'address' => 'Test address',
                'date' => '2020-12-01 14:30:00',
                'description' => 'This is a test description.'
            ],
            'members' => [
                'message' => 'No members found.'
            ]
        ]);

        $I->seeResponseMatchesJsonType([
            'event' => [
                'created_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)',
                'updated_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)'
            ]
        ]);
    }

    public function event2_is_returned(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('event/' . API::$eventId2);

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'event' => [
                'id' => API::$eventId2,
                'name' => 'Test_API_02',
                'city' => 'Test city',
                'address' => 'Test address',
                'date' => '2020-01-31 08:30:00',
                'description' => ''
            ],
            'members' => [
                'message' => 'No members found.'
            ]
        ]);

        $I->seeResponseMatchesJsonType([
            'event' => [
                'created_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)',
                'updated_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)'
            ]
        ]);
    }

    public function correct_message_returned_when_getting_nonexisting_event(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('event/0');
        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"message":"Error 404 - The requested resource was not found."}');
    }
}
