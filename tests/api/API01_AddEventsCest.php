<?php

use ApiTester;
use Helper\Api;

class API01_AddEventsCest
{
    public function event1_is_created_with_description(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('event/add', [
          'name' => 'Test_API_01',
          'city' => 'Test city',
          'address' => 'Test address',
          'date' => '01-12-2020 14:30',
          'description' => 'This is a test description.'
        ]);

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'event' => [
                'name' => 'Test_API_01',
                'city' => 'Test city',
                'address' => 'Test address',
                'date' => '2020-12-01 14:30:00',
                'description' => 'This is a test description.'
            ],
            'members' => [
                'message' => 'No members found.'
            ],
            'message' => 'Event saved.'
        ]);

        $I->seeResponseMatchesJsonType([
            'event' => [
                'id' => 'string:>0',
                'created_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)',
                'updated_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)'
            ]
        ]);

        list(API::$eventId1) = $I->grabDataFromResponseByJsonPath('$.event.id');
    }

    public function event2_is_created_without_description(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('event/add', [
          'name' => 'Test_API_02',
          'city' => 'Test city',
          'address' => 'Test address',
          'date' => '31-01-2020 08:30',
          'description' => ''
        ]);

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'event' => [
                'name' => 'Test_API_02',
                'city' => 'Test city',
                'address' => 'Test address',
                'date' => '2020-01-31 08:30:00',
                'description' => ''
            ],
            'members' => [
                'message' => 'No members found.'
            ],
            'message' => 'Event saved.'
        ]);

        $I->seeResponseMatchesJsonType([
            'event' => [
                'id' => 'string:>0',
                'created_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)',
                'updated_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)'
            ]
        ]);
        
        list(API::$eventId2) = $I->grabDataFromResponseByJsonPath('$.event.id');
    }

    public function event_is_not_created_existing_event(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('event/add', [
            'name' => 'Test_API_01',
            'city' => 'Test city',
            'address' => 'Test address',
            'date' => '01-12-2020 14:30',
            'description' => 'This is a test description.'
        ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":"Event with name \'Test_API_01\' already exists."}');
    }

    public function event_is_not_created_missing_name(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('event/add', [
          'city' => 'Test city',
          'address' => 'Test address',
          'date' => '31-01-2020 08:30',
          'description' => ''
        ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"message":"Error 400 - Bad Request"}');
    }

    public function event_is_not_created_missing_city(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('event/add', [
            'name' => 'Test_API_01',
            'address' => 'Test address',
            'date' => '01-12-2020 14:30',
            'description' => ''
        ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"message":"Error 400 - Bad Request"}');
    }

    public function event_is_not_created_missing_address(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('event/add', [
            'name' => 'Test_API_01',
            'city' => 'Test city',
            'date' => '01-12-2020 14:30',
            'description' => ''
        ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"message":"Error 400 - Bad Request"}');
    }

    public function event_is_not_created_missing_date(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('event/add', [
            'name' => 'Test_API_01',
            'city' => 'Test city',
            'address' => 'Test address',
            'description' => ''
        ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"message":"Error 400 - Bad Request"}');
    }

    public function event_is_not_created_empty_data(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('event/add', [
            'name' => '',
            'city' => '',
            'address' => '',
            'date' => '',
            'description' => ''
        ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":{"name":"The field \'name\' is required.|The field \'name\' is too short. Minimum length is \'2\'.","city":"The field \'city\' is required.","address":"The field \'address\' is required.","date":"The field \'date\' is required.|The field \'date\' is not a valid datetime. Required format is DD-MM-YYYY HH:MM.","description":""}}');
    }
}