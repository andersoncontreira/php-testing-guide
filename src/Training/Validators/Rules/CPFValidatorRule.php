<?php


namespace Training\Validators\Rules;


use Training\Enums\ValidationErrorsEnum;
use Training\Exceptions\ValidatorException;

/**
 * Class CPFValidatorRule
 *
 * @package Training\Validators\Rules
 */
class CPFValidatorRule extends AbstractRule
{

    protected $errorCode = ValidationErrorsEnum::INVALID_CPF;

    protected $regex = '/[0-9]{3}\.?[0-9]{3}\.?[0-9]{3}\-?[0-9]{2}/';

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

    private function validate($cpf)
    {

        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }

        return true;
    }

}