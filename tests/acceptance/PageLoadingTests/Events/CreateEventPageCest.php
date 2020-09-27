<?php

namespace PageLoadingTests\Events;

use AcceptanceTester;

class CreateEventPageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function createEventPageIsLoaded(AcceptanceTester $I)
    {
        $I->wantTo('Test the response code of /event/create page.');
        $I->amOnPage('/event/create');
        $I->seeResponseCodeIs(200);
        $I->see('EVENT APP');
        $I->see('Create event');
        $I->seeInFormFields('form[name=createEventForm]', [
            'name' => '',
            'city' => '',
            'address' => '',
            'date' => '',
            'description' => '',
            ]);
        //$I->seeElement('submit');
    }
}
