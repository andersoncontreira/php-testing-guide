<?php


namespace Training\Enums;

/**
 * Class ValidationErrorsEnum
 *
 * Enum com os códigos e mensagens de erros para as validações
 *
 * @package Training\Enums
 */
class ValidationErrorsEnum
{
    const UNKNOWN = 0;

    const INVALID_CPF = 1;

    const INVALID_CNPJ = 2;

    const INVALID_EMAIL = 3;

    const MIN_LENGTH_ERROR = 4;

    const EMPTY_VALUE = 5;

    const UNKNOWN_PROPERTY = 99;



    /**
     * Method getMessage
     *
     * Retorna a mensagem de erro conforme o codigo informado
     *
     * @param $code
     * @param array ...$params
     *
     * @return string
     *
     */
    public static function getMessage($code, ...$params)
    {

        switch ($code) {
            default:
            case self::UNKNOWN:
                $errorMessage = "An unknown error occurs.";
                break;
            case self::INVALID_CPF:
                $errorMessage = "Invalid number (%s) for Brazilian CPF document.";
                break;
            case self::INVALID_CNPJ:
                $errorMessage = "Invalid number (%s) for Brazilian CNPJ document.";
                break;
            case self::INVALID_EMAIL:
                $errorMessage = "Invalid email (%s).";
                break;
            case self::UNKNOWN_PROPERTY:
                $errorMessage = "Unknown entity property (%s).";
                break;
            case self::MIN_LENGTH_ERROR:
                $errorMessage = "Value length (%s - %d) less than minimum required (%d).";
                break;
            case self::EMPTY_VALUE:
                $errorMessage = "Empty value.";
                break;
        }

        /**
         * Aplica os parametros (array) na mensagem
         */
        $errorMessage = vsprintf($errorMessage, $params);

        return $errorMessage;
    }
}