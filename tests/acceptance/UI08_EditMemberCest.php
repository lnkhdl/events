<?php 

class UI08_EditMemberCest
{
    private function goToUpdateMemberPage(AcceptanceTester $I)
    {
        $I->amOnPage('/event/1');
        $I->seeResponseCodeIs(200);
        $I->click('Edit');
        $I->seeResponseCodeIs(200);
        $I->see('Edit member');
    }

    public function update_member_is_loaded(AcceptanceTester $I)
    {
        $this->goToUpdateMemberPage($I);
        
        $I->seeInFormFields('form[name=editMemberForm]', [
            'first_name' => 'UI First Name',
            'last_name' => 'UI Last Name',
            'email' => 'ui1@email.com'
            ]);
        $I->seeElement('input', ['value' => 'Update member']);
        $I->dontSee("The field 'first_name' ");
        $I->dontSee("The field 'last_name' ");
        $I->dontSee("The field 'email' ");
    }

    public function update_member_shows_error_when_no_update_is_done(AcceptanceTester $I)
    {
        $this->goToUpdateMemberPage($I);
        $I->click('Update member');
        $I->see('Nothing has changed.');
    }

    public function update_member_shows_error_on_empty_email_submission(AcceptanceTester $I)
    {
        $this->goToUpdateMemberPage($I);
        $I->dontSee("The field 'first_name' is required.");
        $I->dontSee("The field 'last_name' is required.");
        $I->dontSee("The field 'email' is required.");
        $I->fillField('first_name','');
        $I->fillField('last_name','');
        $I->fillField('email','');
        $I->click('Update member');
        $I->see("The field 'first_name' is required.");
        $I->see("The field 'last_name' is required.");
        $I->see("The field 'email' is required.");
    }

    public function update_member_shows_error_when_updating_email_to_existing_one(AcceptanceTester $I)
    {
        $this->goToUpdateMemberPage($I);
        $I->dontSee("Member with email 'ui2@email.com' already exists.");
        $I->fillField('email','ui2@email.com');
        $I->click('Update member');
        $I->see("Member with email 'ui2@email.com' already exists.");
    }

    public function update_member_can_be_submitted(AcceptanceTester $I)
    {
        $this->goToUpdateMemberPage($I);
        $I->fillField('first_name','UI First Name UPDATED');
        $I->fillField('last_name','UI Last Name UPDATED');
        $I->fillField('email','ui1UPDATE@email.com');
        $I->click('Update member');
        $I->see('Member updated.');
    }
}
