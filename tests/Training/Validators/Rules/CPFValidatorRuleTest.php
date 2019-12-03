<?php

namespace Training\Tests\Validators\Rules;

use Training\Exceptions\ValidatorException;
use Training\Tests\AbstractUnitTestCase;
use Training\Validators\Rules\CPFValidatorRule;

/**
 * Class CPFValidatorRuleTest
 *
 * @package Training\Tests\Training\Validators\Rules
 */
class CPFValidatorRuleTest extends AbstractUnitTestCase
{

    /** @var  CPFValidatorRule */
    protected $rule;

    /**
     * Method setUp
     *
     */
    public function setUp()
    {
        parent::setUp();
        $this->rule = new CPFValidatorRule();
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
     * Success data provider
     *
     *
     * @return array
     *
     */
    public function getDataForValidate() {
        return [
            ['494.165.270-33'],
            ['517.969.730-17'],
            ['871.722.480-23'],
        ];
    }

    /**
     * Method getDataForValidate
     *
     * Error data provider
     *
     *
     * @return array
     *
     */
    public function getDataForValidateError() {
        return [
            ['494.165.270-35'],
            ['517.969.730-16'],
            ['871.722.480-27'],
        ];
    }
}
