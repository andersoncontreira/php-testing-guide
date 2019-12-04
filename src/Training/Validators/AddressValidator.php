<?php


namespace Training\Validators;


use Training\Validators\Rules\MinLengthRule;
use Training\Validators\Rules\NotEmptyRule;

/**
 * Class AddressValidator
 * @package Training\Validators
 */
class AddressValidator extends AbstractValidator
{

    /**
     * Method defineRules
     *
     * Método para definição de regras do validador
     *
     *
     */
    protected function defineRules()
    {
        $this->rules = [
            'street' => [
                NotEmptyRule::class, new MinLengthRule(5)
            ],
            'streetNumber' => [
                new MinLengthRule(1)
            ],
            'cityName' => [
                NotEmptyRule::class, new MinLengthRule(5)
            ],
            'postalCode' => [
                NotEmptyRule::class, new MinLengthRule(8)
            ],
            'stateOrProvince' => [
                NotEmptyRule::class, new MinLengthRule(2)
            ],
            'countryName' => [
                NotEmptyRule::class, new MinLengthRule(3)
            ],
        ];
    }
}