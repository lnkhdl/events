<?php 

class UI11_DeleteEventCest
{
    public function delete_event_is_done(AcceptanceTester $I)
    {
        $I->amOnPage('/event/1');
        $I->seeResponseCodeIs(200);
        $I->click('.delete-btn');

        $I->see('Event deleted.');
        $I->dontSee('Event saved.');
        $I->dontSee('Member saved.');
        $I->dontSee('Event updated.');
        $I->see('Sorry, there are currently no events.');
    }
}
