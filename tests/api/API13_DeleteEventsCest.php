<?php

use ApiTester;
use Helper\Api;

class API13_DeleteEventsCest
{
    public function event1_is_removed(ApiTester $I)
    {
        $I->sendDELETE('event/' . API::$eventId1);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContains('"message":"Event deleted."');

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

        $I->dontSeeResponseContainsJson([
            'events' => [
                'id' => API::$eventId1,
                'name' => 'Test_API_01 UP',
                'city' => 'Test city UP',
                'address' => 'Test address UP',
                'date' => '2021-11-02 08:30:00',
                'description' => 'This is a test description. UP'
            ]
        ]);
    }

    public function event2_is_removed(ApiTester $I)
    {
        $I->sendDELETE('event/' . API::$eventId2);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContains('"message":"Event deleted. No events found."');
        
        $I->dontSeeResponseContainsJson([
            'events' => [
                'id' => API::$eventId2,
                'name' => 'Test_API_02 UP2',
                'city' => 'Test city UP2',
                'address' => 'Test address UP2',
                'date' => '2019-05-01 23:59:00',
                'description' => '',
            ]
        ]);

        $I->dontSeeResponseContainsJson([
            'events' => [
                'id' => API::$eventId1,
                'name' => 'Test_API_01 UP',
                'city' => 'Test city UP',
                'address' => 'Test address UP',
                'date' => '2021-11-02 08:30:00',
                'description' => 'This is a test description. UP'
            ]
        ]);        
    }

    public function nonexisting_event_cannot_be_removed(ApiTester $I)
    {
        $I->sendDELETE('event/' . API::$eventId1);
        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"message":"Error 404 - The requested resource was not found."}');
    }
}
