<?php


namespace Training\Validators\Rules;


use Training\Enums\ValidationErrorsEnum;
use Training\Exceptions\ValidatorException;

/**
 * Class CNPJValidatorRule
 *
 * @package Training\Validators\Rules
 */
class CNPJValidatorRule extends AbstractRule
{
    protected $errorCode = ValidationErrorsEnum::INVALID_CNPJ;

    protected $regex = "/[0-9]{2}\.?[0-9]{3}\.?[0-9]{3}\/?[0-9]{4}\-?[0-9]{2}/";

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

        if (!preg_match($this->regex, $this->value) || !$this->validate($this->value)) {
            $errorMessage = ValidationErrorsEnum::getMessage($this->errorCode, $this->value);
            throw new ValidatorException($errorMessage, $this->errorCode);
        }

        return true;
    }

    /**
     * Method validate
     *
     * @param $cnpj
     *
     * @return bool
     *
     */
    private function validate($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string)$cnpj);
        // Valida tamanho
        if (strlen($cnpj) != 14) {
            return false;
        }
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto)) {
            return false;
        }
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;

        return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
    }
}