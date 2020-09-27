<?php

namespace PageLoadingTests\Events;

use AcceptanceTester;

class EventsPageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function eventsPageIsLoaded(AcceptanceTester $I)
    {
        $I->wantTo('Test the response code of /events page.');
        $I->amOnPage('/events');
        $I->seeResponseCodeIs(200);
        $I->see('EVENT APP');
        $I->see('Events - Index');
    }
}
