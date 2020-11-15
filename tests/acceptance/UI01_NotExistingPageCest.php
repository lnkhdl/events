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
}
