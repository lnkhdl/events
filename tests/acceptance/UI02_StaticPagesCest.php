<?php

class UI02_StaticPagesCest
{
    public function static_page_contact_is_shown(AcceptanceTester $I)
    {
        $I->amOnPage('/contact');
        $I->seeResponseCodeIs(200);
        $I->see('Contact');
        $I->see('Lorem ipsum', "//main/section/p");
    }
}
