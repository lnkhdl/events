<?php 

class UI10_DeleteMemberCest
{
    public function delete_member_is_done(AcceptanceTester $I)
    {
        $I->amOnPage('/event/1');
        $I->seeResponseCodeIs(200);
        $I->click('.member-delete-btn');

        $I->see('Member deleted.');
        $I->dontSee('Event saved.');
        $I->dontSee('Member saved.');
        $I->dontSee('Event updated.');

        $I->see('Add member', 'a');
        $I->see('Edit event', 'a');
        $I->seeElement('input', ['value' => 'Delete event']);

        $I->see('List of Members');
        $I->dontSee('UI First Name UPDATED');
        $I->dontSee('UI Last Name UPDATED');
        $I->see('UI First Name 02');
        $I->see('UI Last Name 02');
        $I->see('Edit', 'a');
        $I->seeElement('input', ['value' => 'Delete']);
    }
}
