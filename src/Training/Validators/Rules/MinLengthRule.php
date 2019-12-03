<?php


namespace Training\Validators\Rules;


use Training\Enums\ValidationErrorsEnum;
use Training\Exceptions\ValidatorException;

/**
 * Class MinLengthRule
 * @package Training\Validators\Rules
 */
class MinLengthRule extends AbstractRule
{
    /**
     * @var int
     */
    protected $errorCode = ValidationErrorsEnum::MIN_LENGTH_ERROR;

    /**
     * @var int
     */
    private $ruleValue = 1;

    /**
     * MinLengthRule constructor.
     * @param int $ruleValue
     */
    public function __construct(int $ruleValue)
    {
        $this->ruleValue = $ruleValue;
    }

    /**
     * Method validateRule
     *
     * @return boolean
     *
     * @throws ValidatorException
     */
    public function validateRule()
    {
        if ($this->ignore) {
            return true;
        }

        $length = strlen($this->value);

        if ($length < $this->ruleValue) {

            $errorMessage = ValidationErrorsEnum::getMessage($this->errorCode, $this->value, $length, $this->ruleValue);
            throw new ValidatorException($errorMessage, $this->errorCode);

        }

        return true;
    }
}