<?php

namespace Event;

use ApiTester;
use Helper\Api;

class AddCest
{
    public function event1_is_created_with_description(ApiTester $I)
    {
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
}