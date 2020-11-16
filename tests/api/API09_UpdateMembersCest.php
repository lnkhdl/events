<?php

use ApiTester;
use Helper\Api;

class API09_UpdateMembersCest
{
    public function member1_is_updated(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPUT('event/' . API::$eventId1 . '/member/' . API::$memberId1, [
            'first_name' => 'John UP',
            'last_name' => 'Smith UP',
            'email' => 'john.smith.up@email.com'
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
                    'first_name' => 'John UP',
                    'last_name' => 'Smith UP',
                    'email' => 'john.smith.up@email.com',
                    'event_id' => API::$eventId1,
                    'id' => API::$memberId1
                ],
                1 => [
                    'first_name' => 'Jane',
                    'last_name' => 'Fox',
                    'email' => 'jane.fox@email.com',
                    'event_id' => API::$eventId1,
                    'id' => API::$memberId2
                ],     
            ],
            'message' => 'Member updated.'
        ]);

        $I->seeResponseMatchesJsonType([
            'event' => [
                'created_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)',
                'updated_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)'
            ],
            'members' => [
                0 => [
                    'created_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)',
                    'updated_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)'
                ],
                1 => [
                    'created_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)',
                    'updated_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)'
                ]
            ]
        ]);
    }

    public function message_is_received_when_member1_is_updated_with_same_values(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPUT('event/' . API::$eventId1 . '/member/' . API::$memberId1, [
            'first_name' => 'John UP',
            'last_name' => 'Smith UP',
            'email' => 'john.smith.up@email.com'
        ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":"Nothing has changed."}');
    }

    public function member_is_not_updated_existing_member(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPUT('event/' . API::$eventId1 . '/member/' . API::$memberId2, [
            'first_name' => 'Jane',
            'last_name' => 'Fox',
            'email' => 'john.smith.up@email.com'
        ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":"Member with email \'john.smith.up@email.com\' already exists."}');
    }

    public function member_is_not_updated_missing_first_name(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPUT('event/' . API::$eventId1 . '/member/' . API::$memberId1, [
            'last_name' => 'Smith UP',
            'email' => 'john.smith.up@email.com'
        ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"message":"Error 400 - Bad Request"}');
    }

    public function member_is_not_updated_missing_last_name(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPUT('event/' . API::$eventId1 . '/member/' . API::$memberId1, [
            'first_name' => 'John UP',
            'email' => 'john.smith.up@email.com'
        ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"message":"Error 400 - Bad Request"}');
    }

    public function member_is_not_updated_missing_email(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPUT('event/' . API::$eventId1 . '/member/' . API::$memberId1, [
            'first_name' => 'John UP',
            'last_name' => 'Smith UP'
        ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"message":"Error 400 - Bad Request"}');
    }

    public function member_is_not_updated_empty_data(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPUT('event/' . API::$eventId1 . '/member/' . API::$memberId1, [
            'first_name' => '',
            'last_name' => '',
            'email' => ''
        ]);

        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"error":{"first_name":"The field \'first_name\' is required.|The field \'first_name\' is too short. Minimum length is \'2\'.","last_name":"The field \'last_name\' is required.|The field \'last_name\' is too short. Minimum length is \'2\'.","email":"The field \'email\' is required.|The field \'email\' is not a valid email address."}}');
    }

    public function correct_message_returned_when_updating_nonexisting_member(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('event/1/member/0/edit');
        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();
        $I->seeResponseEquals('{"message":"Error 404 - The requested resource was not found."}');
    }
}
