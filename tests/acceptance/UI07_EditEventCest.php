<?php 

class UI07_EditEventCest
{
    private function goToUpdateEventPage(AcceptanceTester $I)
    {
        $I->amOnPage('/event/1');
        $I->seeResponseCodeIs(200);
        $I->click('Edit event');
        $I->seeResponseCodeIs(200);
        $I->see('Edit event');
    }

    public function update_event_is_loaded(AcceptanceTester $I)
    {
        $this->goToUpdateEventPage($I);
        
        $I->seeInFormFields('form[name=editEventForm]', [
            'name' => 'UI Test Event',
            'city' => 'UI Test City',
            'address' => 'UI Test Address',
            'date' => '2020-10-01T14:30',
            'description' => 'UI Test Description',
            ]);
        $I->seeElement('input', ['value' => 'Update event']);
        $I->dontSee("The field 'name' ");
        $I->dontSee("The field 'city' ");
        $I->dontSee("The field 'address' ");
        $I->dontSee("The field 'date' ");
    }

    public function update_event_shows_error_when_no_update_is_done(AcceptanceTester $I)
    {
        $this->goToUpdateEventPage($I);
        $I->click('Update event');
        $I->see('Nothing has changed.');
    }

    public function update_event_shows_error_on_empty_name_submission(AcceptanceTester $I)
    {
        $this->goToUpdateEventPage($I);
        $I->dontSee("The field 'name' is required.");
        $I->fillField('name','');
        $I->click('Update event');
        $I->see("The field 'name' is required.");
    }

    public function update_event_can_be_submitted(AcceptanceTester $I)
    {
        $this->goToUpdateEventPage($I);
        $I->fillField('name','UI Test Event UPDATED');
        $I->fillField('city','UI Test City UPDATED');
        $I->fillField('address','UI Test Address UPDATED');
        $I->fillField('date','2022-05-10T08:00');
        $I->fillField('description','UI Test Description UPDATED');
        $I->click('Update event');
        $I->see('Event updated.');
    }
}
