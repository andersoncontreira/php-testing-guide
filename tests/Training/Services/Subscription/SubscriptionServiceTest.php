<?php

namespace Training\Tests\Services\Subscription;

use Training\Entities\Subscription;
use Training\Services\Subscription\SubscriptionService;
use Training\Tests\AbstractUnitTestCase;

/**
 * Class SubscriptionServiceTest
 *
 * Cenário de testes com Mockups
 *
 * @package Training\Tests\Services\Subscription
 */
class SubscriptionServiceTest extends AbstractUnitTestCase
{

    /**
     * @var \Training\Services\Subscription\SubscriptionService
     */
    protected $service;

    public function setUp()
    {
        parent::setUp();

        $this->service = $this->createServiceMock();
    }

    public function createServiceMock()
    {
        $mock = parent::createMock(SubscriptionService::class);
        //
        $mock->method('execute')->willReturn(true);
        // retorna o próprio metodo de validação
        $mock->method('validate')->willReturnSelf();
        //->with()

        return $mock;
    }


    public function testExecute() {

        $this->service->execute();
    }

    public function testValidate(Subscription $subscription) {
        $this->service->validate($subscription);
    }
}
