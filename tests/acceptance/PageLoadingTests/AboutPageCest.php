<?php

namespace PageLoadingTests;

use AcceptanceTester;

class AboutPageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function aboutPageIsLoaded(AcceptanceTester $I)
    {
        $I->wantTo('Test the response code of /about page.');
        $I->amOnPage('/about');
        $I->seeResponseCodeIs(200);
        $I->see('EVENT APP');
        $I->see('About');
    }
}
