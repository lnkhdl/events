<?php

use ApiTester;
use Helper\Api;

class API11_DeleteMembersCest
{
    public function member1_is_removed(ApiTester $I)
    {
        $I->sendDELETE('event/' . API::$eventId1 . '/member/' . API::$memberId1);
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
                    'first_name' => 'Jane',
                    'last_name' => 'Fox',
                    'email' => 'jane.fox@email.com',
                    'event_id' => API::$eventId1,
                    'id' => API::$memberId2
                ],     
            ],
            'message' => 'Member deleted.'
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
            ]
        ]);

        $I->dontSeeResponseContainsJson([
            'members' => [
                0 => [
                    'first_name' => 'John UP',
                    'last_name' => 'Smith UP',
                    'email' => 'john.smith.up@email.com',
                    'event_id' => API::$eventId1,
                    'id' => API::$memberId1
                ]     
            ]
        ]);
    }

    public function member2_is_removed(ApiTester $I)
    {
        $I->sendDELETE('event/' . API::$eventId1 . '/member/' . API::$memberId2);
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
            'message' => 'Member deleted.'
        ]);

        $I->seeResponseMatchesJsonType([
            'event' => [
                'created_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)',
                'updated_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)'
            ]
        ]);

        $I->dontSeeResponseContainsJson([
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
            ]
        ]);

        $I->dontSeeResponseContainsJson([
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
            ]
        ]);
    }

    public function nonexisting_member_cannot_be_removed(ApiTester $I)
    {
        $I->sendDELETE('event/' . API::$eventId1 . '/member/' . API::$memberId2);
        $I->seeResponseCodeIs(404);
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
            'error' => 'Member does not exist.'
        ]);

        $I->seeResponseMatchesJsonType([
            'event' => [
                'created_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)',
                'updated_at' => 'string:regex(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)'
            ]
        ]);
    }
}
