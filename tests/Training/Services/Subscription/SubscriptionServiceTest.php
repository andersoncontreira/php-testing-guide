<?php

namespace Training\Tests\Services\Subscription;

use PHPUnit\Framework\MockObject\MockObject;
use Training\Entities\Subscription;
use Training\Generators\SubscriptionGenerator;
use Training\Logger\ConsoleLogger;
use Training\Repositories\SubscriptionRepository;
use Training\Services\Subscription\SubscriptionService;
use Training\Tests\AbstractUnitTestCase;
use Training\Tests\Helpers\SubscriptionHelper;

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

        /**
         * Neste caso eu uso um mock para não precisar criar o registro no banco de dados de fato
         */
        $repository = $this->getRepositoryMock();

        $this->service = new SubscriptionService($repository, $this->logger);
    }

    /**
     * @dataProvider getDataForTest
     * @param Subscription $subscription
     * @param $expectedResult
     */
    public function testExecute(Subscription $subscription, $expectedResult) {

        $this->logger->info(sprintf("Testing the method %s with parameters: %s", __METHOD__, json_encode($subscription)));

        $this->service->setSubscription($subscription);

        $result = false;
        if ($this->service->validate($subscription)) {
            $result = $this->service->execute();
        }
        self::assertEquals($result, $expectedResult);

    }

    /**
     * @dataProvider getDataForTest
     * @param Subscription $subscription
     * @param $expectedResult
     */
    public function testValidate(Subscription $subscription, $expectedResult) {

        $this->logger->info(sprintf("Testing the method %s with parameters: %s", __METHOD__, json_encode($subscription)));

        $result = $this->service->validate($subscription);

        self::assertEquals($expectedResult, $result);
    }

    /**
     * Data provider
     * @return array
     */
    public function getDataForTest() {
        try {
            $sub1 = SubscriptionGenerator::randomGenerate();
            $sub2 = SubscriptionGenerator::randomGenerate();
            $sub3 = SubscriptionGenerator::randomGenerate();
            $sub3->setEmail('invalid@email@in');

            $data = [
                [$sub1, true],
                [$sub2, true],
                [$sub3, false]
            ];
        } catch (\Exception $exception) {

            $logger = ConsoleLogger::getInstance();
            $logger->error($exception->getMessage());
            exit(sprintf('Error: %s', $exception->getTraceAsString()));
        }

        return $data;

    }

    /**
     * @return SubscriptionRepository
     */
    private function getRepositoryMock()
    {
        /** @var MockObject|SubscriptionRepository $repository */
        $repository = parent::createMock(SubscriptionRepository::class);
        /**
         * Neste caso eu uso um mock para não precisar criar o registro no banco de dados de fato
         */
        $repository->method('create')->willReturn(true);
        return $repository;
    }
}
