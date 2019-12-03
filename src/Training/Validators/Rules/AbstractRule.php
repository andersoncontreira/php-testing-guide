<?php


namespace Training\Validators\Rules;

use Training\Enums\ValidationErrorsEnum;

/**
 * Class AbstractRule
 *
 * @package Training\Validators\Rules
 */
abstract class AbstractRule
{
    /**
     * Codigo de erro
     * @var int
     */
    protected $errorCode = ValidationErrorsEnum::UNKNOWN;

    /**
     * Valor a ser testado pela regra
     * @var mixed
     */
    protected $value;

    /**
     * Define se a validação deve ou não ser ignorada
     * @var bool
     */
    protected $ignore = false;

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }



    /**
     * Method validateRule
     *
     * @return boolean
     *
     * @throws \Training\Exceptions\ValidatorException
     */
    abstract public function validateRule();

    /**
     * Method ignoreValidation
     *
     * Define se é para ignorar a validação (em caso de não haver a necessidade de validar um campo não obrigatorio)
     *
     * @param $ignore
     *
     */
    public function ignoreValidation($ignore)
    {
        $this->ignore = $ignore;
    }
}