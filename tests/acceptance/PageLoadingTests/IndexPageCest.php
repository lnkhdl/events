<?php

namespace PageLoadingTests;

use AcceptanceTester;

class IndexPageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function testMainPageIsLoaded(AcceptanceTester $I)
    {
        $I->wantTo('Test the response code of / page.');
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
        $I->see('EVENT APP');
        $I->see('Index');
    }

    public function testIndexPageIsLoaded(AcceptanceTester $I)
    {
        $I->wantTo('Test the response code of /index page.');
        $I->amOnPage('/index');
        $I->seeResponseCodeIs(200);
        $I->see('EVENT APP');
        $I->see('Index');
    }
}
