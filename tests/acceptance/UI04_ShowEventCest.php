<?php 

class UI04_ShowEventCest
{
    public function single_event_page_is_loaded(AcceptanceTester $I)
    {
        $I->amOnPage('/event/1');
        $I->seeResponseCodeIs(200);
        $I->see('UI Test Event');
        $I->see('UI Test City');
        $I->see('UI Test Address');
        $I->see('2020-10-01 14:30:00');
        $I->see('UI Test Description');

        $I->see('Add member', 'a');
        $I->see('Edit event', 'a');

        $I->see('List of Members');
        $I->see('There are currently no members registered to this event.');

        $I->dontSee('Event saved.');
        $I->dontSee('Member saved.');
        $I->dontSee('Event updated.');
        $I->dontSee('Member updated.');
    }

    public function event_is_on_main_page(AcceptanceTester $I)
    {
        $I->amOnPage('/events');
        $I->seeResponseCodeIs(200);
        $I->see('UI Test Event');
        $I->see('UI Test City');
        $I->see('2020-10-01 14:30:00');
        $I->dontSee('UI Test Address');
        $I->dontSee('UI Test Description');
    }

    public function event_is_on_latest_page(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
        $I->see('UI Test Event');
        $I->see('UI Test City');
        $I->see('2020-10-01 14:30:00');
        $I->dontSee('UI Test Address');
        $I->dontSee('UI Test Description');

        $I->see('Show all events');
    }
}
