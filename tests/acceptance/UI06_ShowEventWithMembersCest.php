<?php 

class UI06_ShowEventWithMembersCest
{
    public function single_event_page_with_members_is_loaded(AcceptanceTester $I)
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
        $I->seeElement('input', ['value' => 'Delete event']);

        $I->see('List of Members');
        $I->see('UI First Name');
        $I->see('UI Last Name');
        $I->see('UI First Name 02');
        $I->see('UI Last Name 02');
        $I->see('Edit', 'a');
        $I->seeElement('input', ['value' => 'Delete']);

        $I->dontSee('Event saved.');
        $I->dontSee('Member saved.');
        $I->dontSee('Event updated.');
        $I->dontSee('Member updated.');
    }
}
