<?php

use ApiTester;
use Helper\Api;

class API07_AddMembersCest
{
    public function member1_is_added_to_event1(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('event/' . API::$eventId1 . '/member/add', [
            'first_name' => 'John',
            'last_name' => 'Smith',
            'email' => 'john.smith@email.com'
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
                0 => [
                    'first_name' => 'John',
                    'last_name' => 'Smith',
                    'email' => 'john.smith@email.com',
                    'event_id' => API::$eventId1
                ],       
            ],
            'message' => 'Member saved.'
        ]);

        $I->seeResponseMatchesJsonType([
            'event' => [
                'created_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)',
                'updated_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)'
            ],
            'members' => [
                0 => [
                    'id' => 'string:>0',
                    'created_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)',
                    'updated_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)'
                ]
            ]
        ]);

        list(API::$memberId1) = $I->grabDataFromResponseByJsonPath('$.members.0.id');
    }

    public function member2_is_added_to_event1(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('event/' . API::$eventId1 . '/member/add', [
            'first_name' => 'Jane',
            'last_name' => 'Fox',
            'email' => 'jane.fox@email.com'
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
                0 => [
                    'first_name' => 'John',
                    'last_name' => 'Smith',
                    'email' => 'john.smith@email.com',
                    'event_id' => API::$eventId1
                ],
                1 => [
                    'first_name' => 'Jane',
                    'last_name' => 'Fox',
                    'email' => 'jane.fox@email.com',
                    'event_id' => API::$eventId1
                ],     
            ],
            'message' => 'Member saved.'
        ]);

        $I->seeResponseMatchesJsonType([
            'event' => [
                'created_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)',
                'updated_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)'
            ],
            'members' => [
                0 => [
                    'id' => 'string:>0',
                    'created_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)',
                    'updated_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)'
                ],
                1 => [
                    'created_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)',
                    'updated_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)'
                ]
            ]
        ]);

        list(API::$memberId2) = $I->grabDataFromResponseByJsonPath('$.members.1.id');
    }

    public function member_is_not_created_existing_member(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('event/' . API::$eventId1 . '/member/add', [
            'first_name' => 'John',
            'last_name' => 'Smith',
            'email' => 'john.smith@email.com'
        ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":"Member with email \'john.smith@email.com\' already exists."}');
    }

    public function member_is_not_created_missing_first_name(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('event/' . API::$eventId1 . '/member/add', [
            'last_name' => 'Smith',
            'email' => 'john.smith@email.com'
        ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"message":"Error 400 - Bad Request"}');
    }

    public function member_is_not_created_missing_last_name(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('event/' . API::$eventId1 . '/member/add', [
            'first_name' => 'John',
            'email' => 'john.smith@email.com'
        ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"message":"Error 400 - Bad Request"}');
    }

    public function member_is_not_created_missing_email(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('event/' . API::$eventId1 . '/member/add', [
            'first_name' => 'John',
            'last_name' => 'Smith'
        ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"message":"Error 400 - Bad Request"}');
    }

    public function member_is_not_created_empty_data(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('event/' . API::$eventId1 . '/member/add', [
            'first_name' => '',
            'last_name' => '',
            'email' => ''
        ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":{"first_name":"The field \'first_name\' is required.|The field \'first_name\' is too short. Minimum length is \'2\'.","last_name":"The field \'last_name\' is required.|The field \'last_name\' is too short. Minimum length is \'2\'.","email":"The field \'email\' is required.|The field \'email\' is not a valid email address."}}');
    }
}
