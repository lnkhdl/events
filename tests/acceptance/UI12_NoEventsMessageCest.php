<?php 

class UI12_NoEventsMessageCest
{
    public function no_event_message_is_shown_on_main_page(AcceptanceTester $I)
    {
        $I->amOnPage('/events');
        $I->seeResponseCodeIs(200);
        $I->see('Sorry, there are currently no events.');
        $I->dontSee('UI Test Event UPDATED');
        $I->dontSee('UI Test City UPDATED');
        $I->dontSee('2022-05-10 08:00:00');
        $I->dontSee('UI Test Address UPDATED');
        $I->dontSee('UI Test Description UPDATED');
    }

    public function no_event_message_is_shown_on_latest_page(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
        $I->see('Sorry, there are currently no events.');
        $I->dontSee('UI Test Event UPDATED');
        $I->dontSee('UI Test City UPDATED');
        $I->dontSee('2022-05-10 08:00:00');
        $I->dontSee('UI Test Address UPDATED');
        $I->dontSee('UI Test Description UPDATED');

        $I->dontSee('Show all events');
    }
}
