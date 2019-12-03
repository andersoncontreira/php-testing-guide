<?php


namespace Training\Validators\Rules;


use Training\Enums\ValidationErrorsEnum;
use Training\Exceptions\ValidatorException;

/**
 * Class EmailValidatorRule
 *
 * @package Training\Validators\Rules
 */
class EmailValidatorRule  extends AbstractRule
{
    protected $errorCode = ValidationErrorsEnum::INVALID_EMAIL;

    protected $regex = '/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/';
    /**
     * Method validateRule
     *
     * @return boolean
     *
     * @throws \Training\Exceptions\ValidatorException
     */
    public function validateRule()
    {
        if ($this->ignore) {
            return true;
        }

        if (!preg_match($this->regex, $this->value)) {
            $errorMessage = ValidationErrorsEnum::getMessage($this->errorCode, $this->value);
            throw new ValidatorException($errorMessage, $this->errorCode);
        }

        return true;
    }
}