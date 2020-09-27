<?php

namespace PageLoadingTests;

use AcceptanceTester;

class ContactPageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function contactPageIsLoadedTest(AcceptanceTester $I)
    {
        $I->wantTo('Test the response code of /contact page.');
        $I->amOnPage('/contact');
        $I->seeResponseCodeIs(200);
        $I->see('EVENT APP');
        $I->see('Contact');
    }
}
