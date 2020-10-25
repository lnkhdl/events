<?php

use App\Model\Entity\EventEntity;

class DbEventEntityCest
{
    private function getTestEntity1(string $updatedText = null): EventEntity
    {
        $testEntity = new EventEntity;
        $testEntity->setName('Integration Test Event' . $updatedText)
                    ->setCity('Integration Test City' . $updatedText)
                    ->setAddress('Integration Test Address' . $updatedText)
                    ->setDate('2020-08-01 14:30:59')
                    ->setDescription('Integration Test Description' . $updatedText);
        return $testEntity;
    }

    
    private function getTestEntity2(): EventEntity
    {
        $testEntity = new EventEntity;
        $testEntity->setName('Integration Test Event 2')
                    ->setCity('Integration Test City 2')
                    ->setAddress('Integration Test Address 2')
                    ->setDate('2020-12-31 08:59:59')
                    ->setDescription('Integration Test Description 2');
        return $testEntity;
    }


    public function false_is_returned_when_fetching_all_on_empty_table(IntegrationTester $I)
    {
        $mapper = $I->createMapper('EventMapper');
        $result = $mapper->fetchAll();

        $I->assertIsArray($result);
        $I->assertEmpty($result);
    }


    public function event1_is_inserted(IntegrationTester $I)
    {
        $mapper = $I->createMapper('EventMapper');
        $expectedEntity = $this->getTestEntity1();
        $expectedEntityArray = $expectedEntity->entityToArray(true);
        $result = $mapper->insert($expectedEntityArray);

        $I->assertIsInt($result);
        $I->assertSame(1, $result);

        $I->seeInDatabase('event', [
            'id' => '1',
            'name' => $expectedEntity->getName(),
            'city' => $expectedEntity->getCity(),
            'address' => $expectedEntity->getAddress(),
            'date' => $expectedEntity->getDate(),
            'description' => $expectedEntity->getDescription()
        ]);
    }


    public function event2_is_inserted(IntegrationTester $I)
    {
        $mapper = $I->createMapper('EventMapper');
        $expectedEntity = $this->getTestEntity2();
        $expectedEntityArray = $expectedEntity->entityToArray(true);
        $result = $mapper->insert($expectedEntityArray);

        $I->assertIsInt($result);
        $I->assertSame(1, $result);

        $I->seeInDatabase('event', [
            'id' => '2',
            'name' => $expectedEntity->getName(),
            'city' => $expectedEntity->getCity(),
            'address' => $expectedEntity->getAddress(),
            'date' => $expectedEntity->getDate(),
            'description' => $expectedEntity->getDescription()
        ]);
    }


    /**
     * @depends event1_is_inserted
     * @depends event2_is_inserted
     */
    public function events_are_returned_when_fetching_all(IntegrationTester $I)
    {
        $mapper = $I->createMapper('EventMapper');
        $result = $mapper->fetchAll();
        $expectedEntity1 = $this->getTestEntity1();
        $expectedEntity2 = $this->getTestEntity2();

        $I->assertIsArray($result);
        $I->assertSame(count($result), 2);

        $I->assertInstanceOf(get_class($expectedEntity1), $result[0]);
        $I->assertSame('1', $result[0]->getId());
        $I->assertSame($expectedEntity1->getName(), $result[0]->getName());
        $I->assertSame($expectedEntity1->getCity(), $result[0]->getCity());
        $I->assertSame($expectedEntity1->getAddress(), $result[0]->getAddress());
        $I->assertSame($expectedEntity1->getDate(), $result[0]->getDate());
        $I->assertSame($expectedEntity1->getDescription(), $result[0]->getDescription());
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result[0]->getCreatedAt()), 'Y-m-d'));
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result[0]->getUpdatedAt()), 'Y-m-d'));

        $I->assertInstanceOf(get_class($expectedEntity2), $result[1]);
        $I->assertSame('2', $result[1]->getId());
        $I->assertSame($expectedEntity2->getName(), $result[1]->getName());
        $I->assertSame($expectedEntity2->getCity(), $result[1]->getCity());
        $I->assertSame($expectedEntity2->getAddress(), $result[1]->getAddress());
        $I->assertSame($expectedEntity2->getDate(), $result[1]->getDate());
        $I->assertSame($expectedEntity2->getDescription(), $result[1]->getDescription());
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result[1]->getCreatedAt()), 'Y-m-d'));
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result[1]->getUpdatedAt()), 'Y-m-d'));
    }


    /**
     * @depends event1_is_inserted
     */
    public function entity_is_returned_when_fetching_by_existing_event_id(IntegrationTester $I)
    {
        $mapper = $I->createMapper('EventMapper');
        $result = $mapper->fetchById(1);
        $expectedEntity = $this->getTestEntity1();

        $I->assertInstanceOf(get_class($expectedEntity), $result);
        $I->assertSame('1', $result->getId());
        $I->assertSame($expectedEntity->getName(), $result->getName());
        $I->assertSame($expectedEntity->getCity(), $result->getCity());
        $I->assertSame($expectedEntity->getAddress(), $result->getAddress());
        $I->assertSame($expectedEntity->getDate(), $result->getDate());
        $I->assertSame($expectedEntity->getDescription(), $result->getDescription());
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result->getCreatedAt()), 'Y-m-d'));
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result->getUpdatedAt()), 'Y-m-d'));
    }


    public function false_is_returned_when_fetching_by_non_existing_event_id(IntegrationTester $I)
    {
        $mapper = $I->createMapper('EventMapper');
        $result = $mapper->fetchById(3);

        $I->assertNotInstanceOf('App\Model\Entity\EventEntity', $result);
        $I->assertFalse($result);
    }


    /**
     * @depends event1_is_inserted
     */
    public function entity_is_returned_when_fetching_by_existing_event_name(IntegrationTester $I)
    {
        $mapper = $I->createMapper('EventMapper');
        $result = $mapper->fetchByName('Integration Test Event');
        $expectedEntity = $this->getTestEntity1();

        $I->assertInstanceOf(get_class($expectedEntity), $result);
        $I->assertSame('1', $result->getId());
        $I->assertSame($expectedEntity->getName(), $result->getName());
        $I->assertSame($expectedEntity->getCity(), $result->getCity());
        $I->assertSame($expectedEntity->getAddress(), $result->getAddress());
        $I->assertSame($expectedEntity->getDate(), $result->getDate());
        $I->assertSame($expectedEntity->getDescription(), $result->getDescription());
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result->getCreatedAt()), 'Y-m-d'));
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result->getUpdatedAt()), 'Y-m-d'));
    }


    public function false_is_returned_when_fetching_by_non_existing_event_name(IntegrationTester $I)
    {
        $mapper = $I->createMapper('EventMapper');
        $result = $mapper->fetchByName('Incorrect Event Name');

        $I->assertNotInstanceOf('App\Model\Entity\EventEntity', $result);
        $I->assertFalse($result);
    }


    /**
     * @depends event1_is_inserted
     */
    public function name_is_returned_when_fetching_event_name_by_existing_event_id(IntegrationTester $I)
    {
        $mapper = $I->createMapper('EventMapper');
        $result = $mapper->fetchEventNameById('1');

        $I->assertIsString($result);
        $I->assertSame('Integration Test Event', $result);
    }


    public function false_is_returned_when_fetching_event_name_by_non_existing_event_id(IntegrationTester $I)
    {
        $mapper = $I->createMapper('EventMapper');
        $result = $mapper->fetchEventNameById(3);

        $I->assertIsBool($result);
        $I->assertFalse($result);
    }


    /**
     * @depends event1_is_inserted
     */
    public function existing_event_is_found_based_on_name(IntegrationTester $I)
    {
        $mapper = $I->createMapper('EventMapper');
        $result = $mapper->doesEventNameExist('Integration Test Event');

        $I->assertIsInt($result);
        $I->assertSame(1, $result);
    }


    public function non_existing_event_is_not_found_based_on_name(IntegrationTester $I)
    {
        $mapper = $I->createMapper('EventMapper');
        $result = $mapper->doesEventNameExist('Incorrect Event Name');

        $I->assertIsInt($result);
        $I->assertSame(0, $result);
    }


    /**
     * @depends event1_is_inserted
     */
    public function other_existing_event_is_found_based_on_name(IntegrationTester $I)
    {
        $mapper = $I->createMapper('EventMapper');
        $result = $mapper->doesOtherEventWithNameExist('Integration Test Event', 2);

        $I->assertIsInt($result);
        $I->assertSame(1, $result);
    }


    /**
     * @depends event1_is_inserted
     */
    public function other_non_existing_event_is_not_found_based_on_name(IntegrationTester $I)
    {
        $mapper = $I->createMapper('EventMapper');
        $result = $mapper->doesOtherEventWithNameExist('Integration Test Event', 1);

        $I->assertIsInt($result);
        $I->assertSame(0, $result);
    }


    /**
     * @depends event1_is_inserted
     */
    public function existing_event_is_updated(IntegrationTester $I)
    {
        $mapper = $I->createMapper('EventMapper');
        $expectedEntity = $this->getTestEntity1(' UP');
        $expectedEntityArray = $expectedEntity->entityToArray(true);
        $expectedEntityArray['date'] = '2020-10-19 23:59:00';
        $expectedEntityArray['id'] = '1';
        $result = $mapper->update($expectedEntityArray);

        $I->assertIsInt($result);
        $I->assertSame(1, $result);

        $I->seeInDatabase('event', [
            'id' => '1',
            'name' => $expectedEntity->getName(),
            'city' => $expectedEntity->getCity(),
            'address' => $expectedEntity->getAddress(),
            'date' => $expectedEntityArray['date'],
            'description' => $expectedEntity->getDescription()
        ]);
    }


    public function non_existing_event_is_not_updated(IntegrationTester $I)
    {
        $mapper = $I->createMapper('EventMapper');
        $result = $mapper->update(array(
            'name' => '',
            'city' => '',
            'address' => '',
            'date' => '',
            'description' => '',
            'id' => ''
        ));

        $I->assertIsInt($result);
        $I->assertSame(0, $result);
    }


    /**
     * @depends existing_event_is_updated
     * @depends event2_is_inserted
     */
    public function events_are_returned_when_fetching_all_after_update(IntegrationTester $I)
    {
        $mapper = $I->createMapper('EventMapper');
        $result = $mapper->fetchAll();
        $expectedEntity1 = $this->getTestEntity1();
        $expectedEntity1->setDate('2020-10-19 23:59:00');
        $expectedEntity2 = $this->getTestEntity2();

        $I->assertIsArray($result);
        $I->assertSame(count($result), 2);

        $I->assertInstanceOf(get_class($expectedEntity1), $result[0]);
        $I->assertSame('1', $result[0]->getId());
        $I->assertSame($expectedEntity1->getName() . ' UP', $result[0]->getName());
        $I->assertSame($expectedEntity1->getCity() . ' UP', $result[0]->getCity());
        $I->assertSame($expectedEntity1->getAddress() . ' UP', $result[0]->getAddress());
        $I->assertSame($expectedEntity1->getDate(), $result[0]->getDate());
        $I->assertSame($expectedEntity1->getDescription() . ' UP', $result[0]->getDescription());
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result[0]->getCreatedAt()), 'Y-m-d'));
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result[0]->getUpdatedAt()), 'Y-m-d'));

        $I->assertInstanceOf(get_class($expectedEntity2), $result[1]);
        $I->assertSame('2', $result[1]->getId());
        $I->assertSame($expectedEntity2->getName(), $result[1]->getName());
        $I->assertSame($expectedEntity2->getCity(), $result[1]->getCity());
        $I->assertSame($expectedEntity2->getAddress(), $result[1]->getAddress());
        $I->assertSame($expectedEntity2->getDate(), $result[1]->getDate());
        $I->assertSame($expectedEntity2->getDescription(), $result[1]->getDescription());
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result[1]->getCreatedAt()), 'Y-m-d'));
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result[1]->getUpdatedAt()), 'Y-m-d'));
    }


    /**
     * @depends event1_is_inserted
     */
    public function existing_event_is_deleted(IntegrationTester $I)
    {
        $mapper = $I->createMapper('EventMapper');
        $result = $mapper->delete(1);

        $I->assertIsBool($result);
        $I->assertTrue($result);

        $I->dontSeeInDatabase('event', [
            'id' => '1'
        ]);
    }


    public function non_existing_event_is_not_deleted(IntegrationTester $I)
    {
        $mapper = $I->createMapper('EventMapper');
        $result = $mapper->delete(3);

        $I->assertIsBool($result);
        $I->assertFalse($result);
    }


    /**
     * @depends existing_event_is_deleted
     * @depends event2_is_inserted
     */
    public function event_is_returned_when_fetching_all_after_delete(IntegrationTester $I)
    {
        $mapper = $I->createMapper('EventMapper');
        $result = $mapper->fetchAll();
        $expectedEntity2 = $this->getTestEntity2();

        $I->assertIsArray($result);
        $I->assertSame(count($result), 1);

        $I->assertInstanceOf(get_class($expectedEntity2), $result[0]);
        $I->assertSame('2', $result[0]->getId());
        $I->assertSame($expectedEntity2->getName(), $result[0]->getName());
        $I->assertSame($expectedEntity2->getCity(), $result[0]->getCity());
        $I->assertSame($expectedEntity2->getAddress(), $result[0]->getAddress());
        $I->assertSame($expectedEntity2->getDate(), $result[0]->getDate());
        $I->assertSame($expectedEntity2->getDescription(), $result[0]->getDescription());
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result[0]->getCreatedAt()), 'Y-m-d'));
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result[0]->getUpdatedAt()), 'Y-m-d'));
    }
}
