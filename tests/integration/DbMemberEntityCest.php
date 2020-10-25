<?php

use App\Model\Entity\MemberEntity;

class DbMemberEntityCest
{	
    private $eventId1;

    private function getTestEntity1(string $updatedText = null): MemberEntity
    {
        $testEntity = new MemberEntity;
        $testEntity->setFirstName('Integration Test First Name' . $updatedText)
                    ->setLastName('Integration Test Last Name' . $updatedText)
                    ->setEmail('integration@test.com' . $updatedText)
                    ->setEventId($this->eventId1);
        return $testEntity;
    }
    

    private function getTestEntity2(): MemberEntity
    {
        $testEntity = new MemberEntity;
        $testEntity->setFirstName('Integration Test First Name 2')
                    ->setLastName('Integration Test Last Name 2')
                    ->setEmail('integration2@test.com')
                    ->setEventId($this->eventId1);
        return $testEntity;
    }


    public function member1_is_inserted(IntegrationTester $I)
    {
        $I->insertEventEntity('Integration Test Event for Member1');
        $eventIds = $I->grabColumnFromDatabase('event', 'id', array('name' => 'Integration Test Event for Member1'));
        $this->eventId1 = $eventIds[0];
        
        $mapper = $I->createMapper('MemberMapper');
        $expectedEntity = $this->getTestEntity1();
        $expectedEntityArray = $expectedEntity->entityToArray(true);
        $result = $mapper->insert($expectedEntityArray);

        $I->assertIsInt($result);
        $I->assertSame(1, $result);

        $I->seeInDatabase('member', [
            'id' => '1',
            'first_name' => $expectedEntity->getFirstName(),
            'last_name' => $expectedEntity->getLastName(),
            'email' => $expectedEntity->getEmail(),
            'event_id' => $this->eventId1
        ]);
    }


    /**
     * @depends member1_is_inserted
     */
    public function member2_is_inserted(IntegrationTester $I)
    {
        $mapper = $I->createMapper('MemberMapper');
        $expectedEntity = $this->getTestEntity2();
        $expectedEntityArray = $expectedEntity->entityToArray(true);
        $result = $mapper->insert($expectedEntityArray);

        $I->assertIsInt($result);
        $I->assertSame(1, $result);

        $I->seeInDatabase('member', [
            'id' => '2',
            'first_name' => $expectedEntity->getFirstName(),
            'last_name' => $expectedEntity->getLastName(),
            'email' => $expectedEntity->getEmail(),
            'event_id' => $this->eventId1
        ]);
    }


    /**
     * @depends member1_is_inserted
     * @depends member2_is_inserted
     */
    public function arrry_of_entities_is_returned_when_fetching_by_existing_event_id(IntegrationTester $I)
    {
        $mapper = $I->createMapper('MemberMapper');
        $result = $mapper->fetchByEventId($this->eventId1);
        $expectedEntity1 = $this->getTestEntity1();
        $expectedEntity2 = $this->getTestEntity2();

        $I->assertIsArray($result);
        $I->assertSame(count($result), 2);

        $I->assertInstanceOf(get_class($expectedEntity1), $result[0]);
        $I->assertSame('1', $result[0]->getId());
        $I->assertSame($expectedEntity1->getFirstName(), $result[0]->getFirstName());
        $I->assertSame($expectedEntity1->getLastName(), $result[0]->getLastName());
        $I->assertSame($expectedEntity1->getEmail(), $result[0]->getEmail());
        $I->assertSame($expectedEntity1->getEventId(), $result[0]->getEventId());
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result[0]->getCreatedAt()), 'Y-m-d'));
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result[0]->getUpdatedAt()), 'Y-m-d'));

        $I->assertInstanceOf(get_class($expectedEntity2), $result[1]);
        $I->assertSame('2', $result[1]->getId());
        $I->assertSame($expectedEntity2->getFirstName(), $result[1]->getFirstName());
        $I->assertSame($expectedEntity2->getLastName(), $result[1]->getLastName());
        $I->assertSame($expectedEntity2->getEmail(), $result[1]->getEmail());
        $I->assertSame($expectedEntity2->getEventId(), $result[1]->getEventId());
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result[1]->getCreatedAt()), 'Y-m-d'));
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result[1]->getUpdatedAt()), 'Y-m-d'));
    }


    public function empty_array_is_returned_when_fetching_by_non_existing_event_id(IntegrationTester $I)
    {
        $mapper = $I->createMapper('MemberMapper');
        $result = $mapper->fetchByEventId(4);

        $I->assertIsArray($result);
        $I->assertEmpty($result);
    }


    /**
     * @depends member1_is_inserted
     */
    public function entity_is_returned_when_fetching_by_existing_member_and_event_ids(IntegrationTester $I)
    {
        $mapper = $I->createMapper('MemberMapper');
        $result = $mapper->fetchByIdAndEventId(1, $this->eventId1);
        $expectedEntity = $this->getTestEntity1();

        $I->assertInstanceOf(get_class($expectedEntity), $result);
        $I->assertSame('1', $result->getId());
        $I->assertSame($expectedEntity->getFirstName(), $result->getFirstName());
        $I->assertSame($expectedEntity->getLastName(), $result->getLastName());
        $I->assertSame($expectedEntity->getEmail(), $result->getEmail());
        $I->assertSame($expectedEntity->getEventId(), $result->getEventId());
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result->getCreatedAt()), 'Y-m-d'));
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result->getUpdatedAt()), 'Y-m-d'));
    }


    public function false_is_returned_when_fetching_by_non_existing_member_and_event_ids(IntegrationTester $I)
    {
        $mapper = $I->createMapper('MemberMapper');
        $result = $mapper->fetchByIdAndEventId(4, 4);

        $I->assertNotInstanceOf('App\Model\Entity\MemberEntity', $result);
        $I->assertFalse($result);
    }


    /**
     * @depends member1_is_inserted
     */
    public function existing_member_is_found_based_on_email(IntegrationTester $I)
    {
        $mapper = $I->createMapper('MemberMapper');
        $result = $mapper->doesEmailExists($this->eventId1, 'integration@test.com');

        $I->assertIsInt($result);
        $I->assertSame(1, $result);
    }


    public function non_existing_member_is_not_found_based_on_email(IntegrationTester $I)
    {
        $mapper = $I->createMapper('MemberMapper');
        $result = $mapper->doesEmailExists($this->eventId1, 'incorrect@test.com');

        $I->assertIsInt($result);
        $I->assertSame(0, $result);
    }


    /**
     * @depends member1_is_inserted
     */
    public function other_existing_member_is_found_based_on_email(IntegrationTester $I)
    {
        $mapper = $I->createMapper('MemberMapper');
        $result = $mapper->doesOtherMemberWithEmailExist($this->eventId1, 2, 'integration@test.com');

        $I->assertIsInt($result);
        $I->assertSame(1, $result);
    }


    /**
     * @depends member1_is_inserted
     */
    public function other_non_existing_member_is_not_found_based_on_email(IntegrationTester $I)
    {
        $mapper = $I->createMapper('MemberMapper');
        $result = $mapper->doesOtherMemberWithEmailExist($this->eventId1, 1, 'integration@test.com');

        $I->assertIsInt($result);
        $I->assertSame(0, $result);
    }


    /**
     * @depends member1_is_inserted
     */
    public function existing_member_is_updated(IntegrationTester $I)
    {
        $mapper = $I->createMapper('MemberMapper');
        $expectedEntity = $this->getTestEntity1(' UP');
        $expectedEntityArray = $expectedEntity->entityToArray(true);
        $expectedEntityArray['date'] = '2020-10-19 23:59:00';
        $expectedEntityArray['id'] = '1';
        $result = $mapper->update($expectedEntityArray);

        $I->assertIsInt($result);
        $I->assertSame(1, $result);

        $I->seeInDatabase('member', [
            'id' => '1',
            'first_name' => $expectedEntity->getFirstName(),
            'last_name' => $expectedEntity->getLastName(),
            'email' => $expectedEntity->getEmail(),
            'event_id' => $expectedEntity->getEventId()
        ]);
    }


    public function non_existing_member_is_not_updated(IntegrationTester $I)
    {
        $mapper = $I->createMapper('MemberMapper');
        $result = $mapper->update(array(
            'first_name' => '',
            'last_name' => '',
            'email' => '',
            'event_id' => '',
            'id' => ''
        ));

        $I->assertIsInt($result);
        $I->assertSame(0, $result);
    }


    /**
     * @depends existing_member_is_updated
     * @depends member2_is_inserted
     */
    public function arrry_of_entities_is_returned_when_fetching_by_existing_event_id_after_update(IntegrationTester $I)
    {
        $mapper = $I->createMapper('MemberMapper');
        $result = $mapper->fetchByEventId($this->eventId1);
        $expectedEntity1 = $this->getTestEntity1(' UP');
        $expectedEntity2 = $this->getTestEntity2();

        $I->assertIsArray($result);
        $I->assertSame(count($result), 2);

        $I->assertInstanceOf(get_class($expectedEntity1), $result[0]);
        $I->assertSame('1', $result[0]->getId());
        $I->assertSame($expectedEntity1->getFirstName(), $result[0]->getFirstName());
        $I->assertSame($expectedEntity1->getLastName(), $result[0]->getLastName());
        $I->assertSame($expectedEntity1->getEmail(), $result[0]->getEmail());
        $I->assertSame($expectedEntity1->getEventId(), $result[0]->getEventId());
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result[0]->getCreatedAt()), 'Y-m-d'));
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result[0]->getUpdatedAt()), 'Y-m-d'));

        $I->assertInstanceOf(get_class($expectedEntity2), $result[1]);
        $I->assertSame('2', $result[1]->getId());
        $I->assertSame($expectedEntity2->getFirstName(), $result[1]->getFirstName());
        $I->assertSame($expectedEntity2->getLastName(), $result[1]->getLastName());
        $I->assertSame($expectedEntity2->getEmail(), $result[1]->getEmail());
        $I->assertSame($expectedEntity2->getEventId(), $result[1]->getEventId());
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result[1]->getCreatedAt()), 'Y-m-d'));
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result[1]->getUpdatedAt()), 'Y-m-d'));
    }


    /**
     * @depends member1_is_inserted
     */
    public function existing_member_is_deleted(IntegrationTester $I)
    {
        $mapper = $I->createMapper('MemberMapper');
        $result = $mapper->deleteMember(1);

        $I->assertIsInt($result);
        $I->assertSame(1, $result);

        $I->dontSeeInDatabase('member', [
            'id' => '1'
        ]);
    }


    public function non_existing_event_is_not_deleted(IntegrationTester $I)
    {
        $mapper = $I->createMapper('MemberMapper');
        $result = $mapper->deleteMember(3);

        $I->assertIsInt($result);
        $I->assertSame(0, $result);
    }


    /**
     * @depends existing_member_is_deleted
     * @depends member2_is_inserted
     */
    public function arrry_of_entities_is_returned_when_fetching_by_existing_event_id_after_delete(IntegrationTester $I)
    {
        $mapper = $I->createMapper('MemberMapper');
        $result = $mapper->fetchByEventId($this->eventId1);
        $expectedEntity2 = $this->getTestEntity2();

        $I->assertIsArray($result);
        $I->assertSame(count($result), 1);

        $I->assertInstanceOf(get_class($expectedEntity2), $result[0]);
        $I->assertSame('2', $result[0]->getId());
        $I->assertSame($expectedEntity2->getFirstName(), $result[0]->getFirstName());
        $I->assertSame($expectedEntity2->getLastName(), $result[0]->getLastName());
        $I->assertSame($expectedEntity2->getEmail(), $result[0]->getEmail());
        $I->assertSame($expectedEntity2->getEventId(), $result[0]->getEventId());
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result[0]->getCreatedAt()), 'Y-m-d'));
        $I->assertSame(date('Y-m-d'), date_format(date_create_from_format('Y-m-d H:i:s', $result[0]->getUpdatedAt()), 'Y-m-d'));
    }
}
