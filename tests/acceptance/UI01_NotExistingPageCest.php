<?php

class UI01_NotExistingPageCest
{
    public function not_existing_page_shows_404_error(AcceptanceTester $I)
    {
        $I->amOnPage('/not_exist');
        $I->seeResponseCodeIs(404);
        $I->seePageNotFound();
        $I->see('Error 404 - Page not found');
        $I->see('Home Page', "//main/section/a");
    }

    public function editing_not_existing_event_returns_404_error(AcceptanceTester $I)
    {
        $I->amOnPage('/event/0/edit');
        $I->seeResponseCodeIs(404);
        $I->seePageNotFound();
        $I->see('Error 404 - Page not found');
        $I->see('Home Page', "//main/section/a");
    }

    public function adding_member_to_nonexisting_event_returns_404_error(AcceptanceTester $I)
    {
        $I->amOnPage('event/0/member/create');
        $I->seeResponseCodeIs(404);
        $I->seePageNotFound();
        $I->see('Error 404 - Page not found');
        $I->see('Home Page', "//main/section/a");
    }

    public function updating_nonexisting_member_returns_404_error(AcceptanceTester $I)
    {
        $I->amOnPage('event/1/member/0/edit');
        $I->seeResponseCodeIs(404);
        $I->seePageNotFound();
        $I->see('Error 404 - Page not found');
        $I->see('Home Page', "//main/section/a");
    }
}
