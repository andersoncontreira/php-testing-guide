<?php

namespace Training\Tests\Services;

use Training\Entities\Subscription;
use Training\Services\SubscriptionManager;
use Training\Tests\AbstractUnitTestCase;
use Training\Tests\Helpers\DatabaseHelper;
use Training\Tests\Helpers\SubscriptionHelper;

/**
 * Class SubscriptionManagerTest
 *
 * Gerenciador de inscrições
 *
 * @package Training\Tests\Services
 */
class SubscriptionManagerTest extends AbstractUnitTestCase
{
    /**
     * @var SubscriptionManager
     */
    protected $manager;

    /**
     * Method setUpBeforeClass
     *
     * Executa uma unica vez
     *
     *
     *
     */
    public static function setUpBeforeClass()
    {
        $table = 'subscription';
        DatabaseHelper::createTableIfNotExists($table);
        DatabaseHelper::truncateTable($table);
    }

    /**
     * Executa a cada teste
     * Method setUp
     *
     */
    public function setUp()
    {
        parent::setUp();

        $this->manager = new SubscriptionManager($this->getConnection(), $this->logger);
    }


    public function getDataSet() {

    }

    /**
     * Method testSubscribe
     *
     * Description
     *
     * @param \Training\Entities\Subscription $subscription
     *
     * @dataProvider getData
     */
    public function testSubscribe(Subscription $subscription)
    {
        $this->logger->info(sprintf("Testing the method %s with parameters: %s", __METHOD__, $subscription));

        $result = $this->manager->subscribe($subscription);

        self::assertTrue($result);
    }

    /**
     * Method testSubscribeError
     *
     * Description
     *
     * @param \Training\Entities\Subscription $subscription
     *
     * @dataProvider getDataWithError
     */
    public function testSubscribeError(Subscription $subscription)
    {
        $this->logger->info(sprintf("Testing the method %s with parameters: %s", __METHOD__, $subscription));

        $result = $this->manager->subscribe($subscription);

        self::assertFalse($result);

        //self::assertInstanceOf(\Exception::class, $this->manager->getException());

        $exception = $this->manager->getException();
        $this->logger->info(sprintf("Error: %d - %s", $exception->getCode(), $exception->getMessage()));


    }


    /**
     * Method testUpdateSubscription
     *
     * Description
     *
     * @depends testSubscribe
     *
     * @param \Training\Entities\Subscription $subscription
     *
     * @dataProvider getData
     */
    public function testUpdateSubscription(Subscription $subscription) {
        $this->manager->updateSubscription($subscription);
    }


    /**
     * Method getData
     *
     * Data Provider
     *
     *
     * @return \Training\Entities\Subscription[][]
     *
     */
    public function getData() {
        return SubscriptionHelper::createRandomSubscription(5);
    }

    /**
     * Method getDataWithError
     *
     * Errors Data Provider
     *
     *
     * @return \Training\Entities\Subscription[][]
     *
     */
    public function getDataWithError() {
        return SubscriptionHelper::createRandomSubscriptionWithErrors(5);
    }

}
