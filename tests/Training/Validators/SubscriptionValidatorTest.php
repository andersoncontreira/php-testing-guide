<?php

namespace Training\Tests\Validators;

use Training\Entities\Subscription;
use Training\Tests\AbstractUnitTestCase;
use Training\Tests\Helpers\SubscriptionHelper;
use Training\Validators\SubscriptionValidator;

/**
 * Class SubscriptionValidatorTest
 *
 * Teste unitário para o validador de inscrições
 *
 * @package Training\Tests\Validators
 */
class SubscriptionValidatorTest extends AbstractUnitTestCase
{
    /**
     * @var SubscriptionValidator
     */
    protected $validator;

    /**
     * Method setUp
     *
     *
     */
    public function setUp()
    {
        parent::setUp();
        $this->validator = new SubscriptionValidator();
    }

    /**
     * Method testValidate
     *
     * Description
     *
     * @param \Training\Entities\Subscription $subscription
     *
     * @dataProvider getData
     */
    public function testValidate(Subscription $subscription) {

        $this->logger->info(sprintf("Testing the method %s with parameters: %s", __METHOD__, $subscription));

        $result = $this->validator->validate($subscription);

        if (!$result) {
            $this->logger->error($this->validator->getException()->getMessage());
        }

        self::assertTrue($result);

    }

    /**
     * Method testValidateError
     *
     * Description
     *
     * @param \Training\Entities\Subscription $subscription
     *
     * @dataProvider getDataError
     */
    public function testValidateError(Subscription $subscription) {

        $this->logger->info(sprintf("Testing the method %s with parameters: %s", __METHOD__, $subscription));

        $result = $this->validator->validate($subscription);

        var_dump($subscription->getDocumentType());
        var_dump($subscription->getDocument());
        var_dump($subscription->getEmail());

        if (!$result) {
            $this->logger->error($this->validator->getException()->getMessage());
        }

        self::assertFalse($result);

    }

    /**
     * Method getData
     *
     * Data provider
     *
     *
     * @return array
     *
     */
    public function getData() {
        return SubscriptionHelper::createRandomSubscription(5);
    }

    /**
     * Method getDataError
     *
     * Data provider for error
     *
     *
     * @return \Training\Entities\Subscription[][]
     *
     */
    public function getDataError() {
        return SubscriptionHelper::createRandomSubscriptionWithErrors(5);
    }

}
