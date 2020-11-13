<?php

use ApiTester;
use Helper\Api;

class API14_GetAllEventsAfterRemovedEventsCest
{
    public function removed_events_are_not_returned(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('events');

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $I->seeResponseContains('"message":"No events found."');

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
    }

    public function removed_events_are_not_returned_in_latest_events(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('latest-events');

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $I->seeResponseContains('"message":"No events found."');

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
    }
}
