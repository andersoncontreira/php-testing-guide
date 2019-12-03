<?php


namespace Training\Validators;


use Training\Entities\Subscription;
use Training\Enums\DocumentTypeEnum;
use Training\Enums\ValidationErrorsEnum;
use Training\Validators\Rules\AbstractRule;
use Training\Validators\Rules\CNPJValidatorRule;
use Training\Validators\Rules\CPFValidatorRule;
use Training\Validators\Rules\EmailValidatorRule;

/**
 * Class SubscriptionValidator
 *
 * Validador de inscrições
 *
 * @package Training\Validators
 */
class SubscriptionValidator extends AbstractValidator
{
    /** @var  \Training\Exceptions\ValidatorException */
    protected $exception;


    /**
     * Method defineRules
     *
     * Define as regras de validação a serem aplicadas
     *
     *
     *
     */
    public function defineRules()
    {

        $this->rules = [
            'document' => [
                CPFValidatorRule::class, CNPJValidatorRule::class
            ],
            'email' => [
                EmailValidatorRule::class//, RequiredValidatorRule
            ]
        ];
    }

    /**
     * Method validate
     *
     * Valida os dados de uma entidade Subscription
     *
     * @param \Training\Entities\Subscription $target
     *
     * @return bool
     *
     */
    public function validate($target)
    {
        $result = true;
        try {
            $reflection = new \ReflectionClass($target);
        } catch (\Exception $e) {
            $this->exception = $e;
            return false;
        }


        foreach ($this->rules as $key => $rules) {

            try {

                if ($reflection->hasProperty($key)) {

                    $property = $reflection->getProperty($key);
                    $property->setAccessible(true);
                    $value = $property->getValue($target);

                    array_map(function($class) use ($value, $target) {

                        /** @var AbstractRule $rule */
                        $rule = new $class();

                        if ($rule instanceof CPFValidatorRule) {
                            /**
                             *  Se não for um documento do tipo cpf ignora então
                             */
                            if ($target->getDocumentType() !== DocumentTypeEnum::CPF) {
                                $rule->ignoreValidation(true);
                            }

                        } else if ($rule instanceof CNPJValidatorRule) {
                            /**
                             *  Se não for um documento do tipo cpf ignora então
                             */
                            if ($target->getDocumentType() !== DocumentTypeEnum::CNPJ) {
                                $rule->ignoreValidation(true);
                            }
                        }

                        $rule->setValue($value);
                        return $rule->validateRule();

                    }, $rules);
                } else {
                    throw new \Exception(ValidationErrorsEnum::getMessage(ValidationErrorsEnum::UNKNOWN_PROPERTY, $key));
                }

            } catch (\Exception $exception) {
                $this->exception = $exception;
                $result = false;

                break;
            }
        }


        return $result;

    }


}