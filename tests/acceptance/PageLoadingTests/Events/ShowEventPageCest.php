<?php

namespace PageLoadingTests\Events;

use AcceptanceTester;

class ShowEventPageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function showEventPageIsLoaded(AcceptanceTester $I)
    {
        $I->wantTo('Test the response code of /event/2 page.');
        $I->amOnPage('/event/2');
        $I->seeResponseCodeIs(200);
        $I->see('EVENT APP');
        $I->see('Show event');
    }
}
