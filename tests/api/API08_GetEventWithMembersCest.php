<?php

use ApiTester;
use Helper\Api;

class API08_GetEventWithMembersCest
{
    public function event1_is_returned_with_members(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('event/' . API::$eventId1);

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
}
