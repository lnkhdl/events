<?php 

class UI03_CreateEventCest
{
    private function goToCreateEventPage(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
        $I->click('Create event now');
        $I->seeResponseCodeIs(200);
        $I->see('Create event');
    }

    public function create_event_page_is_loaded(AcceptanceTester $I)
    {
        $this->goToCreateEventPage($I);
        $I->seeInFormFields('form[name=createEventForm]', [
            'name' => '',
            'city' => '',
            'address' => '',
            'date' => '',
            'description' => '',
            ]);
        $I->seeElement('input', ['value' => 'Save event']);
        $I->dontSee("The field 'name' ");
        $I->dontSee("The field 'city' ");
        $I->dontSee("The field 'address' ");
        $I->dontSee("The field 'date' ");
    }

    public function create_event_can_be_submit(AcceptanceTester $I)
    {
        $this->goToCreateEventPage($I);
        $I->fillField('name','UI Test Event');
        $I->fillField('city','UI Test City');
        $I->fillField('address','UI Test Address');
        $I->fillField('date','2020-10-01T14:30');
        $I->fillField('description','UI Test Description');
        $I->click('Save event');
        $I->see('Event saved.');
    }

    public function create_event_shows_error_when_submitting_same_event(AcceptanceTester $I)
    {
        $this->goToCreateEventPage($I);
        $I->dontSee("Event with name 'UI Test Event' already exists.");
        $I->fillField('name','UI Test Event');
        $I->fillField('city','UI Test City');
        $I->fillField('address','UI Test Address');
        $I->fillField('date','2020-10-01T14:30');
        $I->fillField('description','UI Test Description');
        $I->click('Save event');
        $I->see("Event with name 'UI Test Event' already exists.");
    }

    public function create_event_shows_errors_on_empty_submission(AcceptanceTester $I)
    {
        $this->goToCreateEventPage($I);
        $I->click('Save event');
        $I->seeInFormFields('form[name=createEventForm]', [
            'name' => '',
            'city' => '',
            'address' => '',
            'date' => '',
            'description' => '',
            ]);
        $I->see("The field 'name' ");
        $I->see("The field 'city' ");
        $I->see("The field 'address' ");
        $I->see("The field 'date' ");
    }
}
