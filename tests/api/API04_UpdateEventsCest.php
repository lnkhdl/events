<?php

use ApiTester;
use Helper\Api;

class API04_UpdateEventsCest
{
    public function event1_is_updated_with_description(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPUT('event/' . API::$eventId1, [
            'name' => 'Test_API_01 UP',
            'city' => 'Test city UP',
            'address' => 'Test address UP',
            'date' => '2021-11-02T08:30',
            'description' => 'This is a test description. UP'
        ]);

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'event' => [
                'name' => 'Test_API_01 UP',
                'city' => 'Test city UP',
                'address' => 'Test address UP',
                'date' => '2021-11-02 08:30:00',
                'description' => 'This is a test description. UP',
                'id' => API::$eventId1
            ],
            'members' => [
                'message' => 'No members found.'
            ],
            'message' => 'Event updated.'
        ]);

        $I->seeResponseMatchesJsonType([
            'event' => [
                'created_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)',
                'updated_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)'
            ]
        ]);
    }

    public function event2_is_updated_without_description(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPUT('event/' . API::$eventId2, [
            'name' => 'Test_API_02 UP2',
            'city' => 'Test city UP2',
            'address' => 'Test address UP2',
            'date' => '2019-05-01T23:59',
            'description' => ''
        ]);

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'event' => [
                'name' => 'Test_API_02 UP2',
                'city' => 'Test city UP2',
                'address' => 'Test address UP2',
                'date' => '2019-05-01 23:59:00',
                'description' => '',
                'id' => API::$eventId2
            ],
            'members' => [
                'message' => 'No members found.'
            ],
            'message' => 'Event updated.'
        ]);

        $I->seeResponseMatchesJsonType([
            'event' => [
                'created_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)',
                'updated_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)'
            ]
        ]);
    }

    public function message_is_received_when_event1_is_updated_with_same_values(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPUT('event/' . API::$eventId1, [
            'name' => 'Test_API_01 UP',
            'city' => 'Test city UP',
            'address' => 'Test address UP',
            'date' => '2021-11-02T08:30',
            'description' => 'This is a test description. UP'
        ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":"Nothing has changed."}');
    }

    public function event_is_not_updated_existing_event(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPUT('event/' . API::$eventId2, [
            'name' => 'Test_API_01 UP',
            'city' => 'Test city',
            'address' => 'Test address',
            'date' => '2020-12-01T14:30',
            'description' => 'This is a test description.'
        ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":"Event with name \'Test_API_01 UP\' already exists."}');
    }

    public function event_is_not_updated_missing_name(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPUT('event/' . API::$eventId1, [
            'city' => 'Test city UP',
            'address' => 'Test address UP',
            'date' => '2021-11-02T08:30',
            'description' => ''
        ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"message":"Error 400 - Bad Request"}');
    }

    public function event_is_not_updated_missing_city(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPUT('event/' . API::$eventId1, [
            'name' => 'Test_API_01 UP',
            'address' => 'Test address UP',
            'date' => '2021-02-11T08:30',
            'description' => ''
          ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"message":"Error 400 - Bad Request"}');
    }

    public function event_is_not_updated_missing_address(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPUT('event/' . API::$eventId1, [
            'name' => 'Test_API_01 UP',
            'city' => 'Test city UP',
            'date' => '2021-02-11T08:30',
            'description' => ''
          ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"message":"Error 400 - Bad Request"}');
    }

    public function event_is_not_updated_missing_date(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPUT('event/' . API::$eventId1, [
            'name' => 'Test_API_01 UP',
            'city' => 'Test city UP',
            'address' => 'Test address UP',
            'description' => ''
          ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"message":"Error 400 - Bad Request"}');
    }

    public function event_is_not_updated_empty_data(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPUT('event/' . API::$eventId1, [
            'name' => '',
            'city' => '',
            'address' => '',
            'date' => '',
            'description' => ''
        ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":{"name":"The field \'name\' is required.|The field \'name\' is too short. Minimum length is \'2\'.","city":"The field \'city\' is required.","address":"The field \'address\' is required.","date":"The field \'date\' is required.|The field \'date\' is not a valid datetime.","description":""}}');
    }

    public function correct_message_returned_when_editing_nonexisting_event(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('event/0/edit');
        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"message":"Error 404 - The requested resource was not found."}');
    }
}
