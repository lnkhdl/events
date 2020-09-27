<?php

namespace PageLoadingTests;

use AcceptanceTester;

class NotExistingPageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function notExistingPageIsLoadedTest(AcceptanceTester $I)
    {
        $I->wantTo('Test the response code of non-existing page.');
        $I->amOnPage('/not_exist');
        $I->seeResponseCodeIs(404);
        $I->seePageNotFound();
        $I->see('EVENT APP');
        $I->see('Error 404 - page not found');
    }
}
