<?php

namespace Training\Tests\Validators\Rules;

use Training\Exceptions\ValidatorException;
use Training\Tests\AbstractUnitTestCase;
use Training\Validators\Rules\CNPJValidatorRule;

/**
 * Class CNPJValidatorRuleTest
 *
 * @package Training\Tests\Validators\Rules
 */
class CNPJValidatorRuleTest extends AbstractUnitTestCase
{
    /** @var  CNPJValidatorRule */
    protected $rule;

    /**
     * Method setUp
     *
     */
    public function setUp()
    {
        parent::setUp();
        $this->rule = new CNPJValidatorRule();
    }

    /**
     * Method testValidateRule
     *
     * Validate the success scenario
     *
     * @param $value
     *
     * @dataProvider getDataForValidate
     */
    public function testValidateRule($value) {

        $this->logger->info(sprintf("Testing the method %s with parameters: %s", __METHOD__, $value));
        $this->rule->setValue($value);
        $result = $this->rule->validateRule();
        self::assertTrue($result);

        $this->logger->info("Validation OK");
    }

    /**
     * Method testValidateRuleError
     *
     * Validate the error scenario
     *
     * @param $value
     *
     * @dataProvider getDataForValidateError
     */
    public function testValidateRuleError($value) {

        $this->logger->info(sprintf("Testing the method %s with parameters: %s", __METHOD__, $value));

        $this->rule->setValue($value);

        self::expectException(ValidatorException::class);

        $this->rule->validateRule();

    }

    /**
     * Method testValidateRule
     *
     * Validate the success scenario
     *
     * @param $value
     *
     * @dataProvider getDataForValidateError
     */
    public function testValidateRuleWithIgnore($value) {

        $this->rule->ignoreValidation(true);
        $this->logger->info(sprintf("Testing the method %s with parameters: %s", __METHOD__, $value));
        $this->rule->setValue($value);
        $result = $this->rule->validateRule();
        self::assertTrue($result);
    }

    /**
     * Method getDataForValidate
     *
     * Success Data provider
     *
     *
     * @return array
     *
     */
    public function getDataForValidate() {
        return [
            ['63.355.506/0001-33'],
            ['13.622.012/0001-08'],
            ['31.888.426/0001-57'],
        ];
    }

    /**
     * Method getDataForValidateError
     *
     * Error data provider
     *
     *
     * @return array
     *
     */
    public function getDataForValidateError() {
        return [
            ['31.888.426/0001-60'],
            ['31.888.426/0001-22'],
            ['31.888.426/0002-67'],
        ];
    }
}
