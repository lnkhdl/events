<?php

namespace PageLoadingTests\Events;

use AcceptanceTester;

class EditEventPageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function editEventPageIsLoaded(AcceptanceTester $I)
    {
        $I->wantTo('Test the response code of /event/2/edit page.');
        $I->amOnPage('/event/2/edit');
        $I->seeResponseCodeIs(200);
        $I->see('EVENT APP');
        $I->see('Edit event');
    }
}
