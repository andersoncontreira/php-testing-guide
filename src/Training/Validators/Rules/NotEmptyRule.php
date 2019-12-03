<?php


namespace Training\Validators\Rules;


use Training\Enums\ValidationErrorsEnum;
use Training\Exceptions\ValidatorException;

/**
 * Class NotEmptyRule
 * @package Training\Validators\Rules
 */
class NotEmptyRule extends AbstractRule
{
    /**
     * @var int
     */
    protected $errorCode = ValidationErrorsEnum::EMPTY_VALUE;

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

        if(empty($this->value)) {

            $errorMessage = ValidationErrorsEnum::getMessage($this->errorCode, $this->value);
            throw new ValidatorException($errorMessage, $this->errorCode);
        }

        return true;
    }
}