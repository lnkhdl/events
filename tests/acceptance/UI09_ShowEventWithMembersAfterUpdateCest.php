<?php 

class UI09_ShowEventWithMembersAfterUpdateCest
{
    public function single_event_page_with_members_after_update_is_loaded(AcceptanceTester $I)
    {
        $I->amOnPage('/event/1');
        $I->seeResponseCodeIs(200);
        $I->see('UI Test Event UPDATED');
        $I->see('UI Test City UPDATED');
        $I->see('UI Test Address UPDATED');
        $I->see('2022-05-10 08:00:00');
        $I->see('UI Test Description UPDATED');

        $I->see('Add member', 'a');
        $I->see('Edit event', 'a');
        $I->seeElement('input', ['value' => 'Delete event']);

        $I->see('List of Members');
        $I->see('UI First Name UPDATED');
        $I->see('UI Last Name UPDATED');
        $I->see('UI First Name 02');
        $I->see('UI Last Name 02');
        $I->see('Edit', 'a');
        $I->seeElement('input', ['value' => 'Delete']);

        $I->dontSee('Event saved.');
        $I->dontSee('Member saved.');
        $I->dontSee('Event updated.');
        $I->dontSee('Member updated.');
    }

    public function event_is_updated_on_main_page(AcceptanceTester $I)
    {
        $I->amOnPage('/events');
        $I->seeResponseCodeIs(200);
        $I->see('UI Test Event UPDATED');
        $I->see('UI Test City UPDATED');
        $I->see('2022-05-10 08:00:00');
        $I->dontSee('UI Test Address UPDATED');
        $I->dontSee('UI Test Description UPDATED');
    }

    public function event_is_updated_on_latest_page(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
        $I->see('UI Test Event UPDATED');
        $I->see('UI Test City UPDATED');
        $I->see('2022-05-10 08:00:00');
        $I->dontSee('UI Test Address UPDATED');
        $I->dontSee('UI Test Description UPDATED');

        $I->see('Show all events');
    }
}
