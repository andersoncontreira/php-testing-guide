<?php

namespace Training\Tests\Generators;

use Training\Entities\Subscription;
use Training\Generators\SubscriptionGenerator;
use Training\Tests\AbstractUnitTestCase;
use Training\VOs\Address;

/**
 * Class SubscriptionGeneratorTest
 *
 * Teste do Gerador de inscrições
 *
 * @package Training\Tests\Generators
 */
class SubscriptionGeneratorTest extends AbstractUnitTestCase
{
    /**
     * Method testRandomGenerate
     *
     * Valida se a geração de inscrições está funcionando corretamente
     *
     */
    public function testRandomGenerate() {

        $this->logger->info(sprintf("Testing the method %s with no parameters", __METHOD__));

        $subscription = SubscriptionGenerator::randomGenerate();

        //var_dump($subscription->getId());
        //var_dump($subscription->getName());
        var_dump(sprintf("subscription: %s",$subscription->toJson()));

        self::assertNotEmpty($subscription);
        self::assertInstanceOf(Subscription::class, $subscription);
        self::assertNotEmpty($subscription->getAddress());
        self::assertInstanceOf(Address::class, $subscription->getAddress());

    }
}
