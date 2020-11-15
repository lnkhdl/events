<?php 

class UI05_AddMemberCest
{
    private function goToAddMemberPage(AcceptanceTester $I)
    {
        $I->amOnPage('/event/1');
        $I->seeResponseCodeIs(200);
        $I->click('Add member');
        $I->seeResponseCodeIs(200);
        $I->see('Create a member for event UI Test Event');
    }

    public function create_member_page_is_loaded(AcceptanceTester $I)
    {
        $this->goToAddMemberPage($I);
        $I->seeInFormFields('form[name=createMemberForm]', [
            'first_name' => '',
            'last_name' => '',
            'email' => ''
            ]);
        $I->seeElement('input', ['value' => 'Add member']);
        $I->dontSee("The field 'first_name' ");
        $I->dontSee("The field 'last_name' ");
        $I->dontSee("The field 'email' ");
    }

    public function create_member_shows_errors_on_empty_submission(AcceptanceTester $I)
    {
        $this->goToAddMemberPage($I);
        $I->click('Add member');
        $I->seeInFormFields('form[name=createMemberForm]', [
            'first_name' => '',
            'last_name' => '',
            'email' => ''
            ]);
        $I->see("The field 'first_name' ");
        $I->see("The field 'last_name' ");
        $I->see("The field 'email' ");
    }

    public function create_member_can_be_submit_member1(AcceptanceTester $I)
    {
        $this->goToAddMemberPage($I);
        $I->fillField('first_name','UI First Name');
        $I->fillField('last_name','UI Last Name');
        $I->fillField('email','ui1@email.com');
        $I->click('Add member');
        $I->see('Member saved.');
    }

    public function create_member_can_be_submit_member2(AcceptanceTester $I)
    {
        $this->goToAddMemberPage($I);
        $I->fillField('first_name','UI First Name 02');
        $I->fillField('last_name','UI Last Name 02');
        $I->fillField('email','ui2@email.com');
        $I->click('Add member');
        $I->see('Member saved.');
    }

    public function create_event_shows_error_when_submitting_same_event(AcceptanceTester $I)
    {
        $this->goToAddMemberPage($I);
        $I->fillField('first_name','UI First Name');
        $I->fillField('last_name','UI Last Name');
        $I->fillField('email','ui1@email.com');
        $I->click('Add member');
        $I->see("Member with email 'ui1@email.com' already exists.");
    }
}
