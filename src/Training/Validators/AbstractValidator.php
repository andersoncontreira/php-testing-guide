<?php


namespace Training\Validators;


use Training\Exceptions\ValidatorException;
use Training\Validators\Rules\AbstractRule;

abstract class AbstractValidator
{
    /**
     * @var AbstractRule[][]
     */
    protected $rules = [];

    /**
     * @var ValidatorException
     */
    protected $exception;

    /**
     * AbstractValidator constructor.
     */
    public function __construct()
    {
        /**
         * Carrega as regras
         */
        $this->defineRules();
    }

    /**
     * Method defineRules
     *
     * Método para definição de regras do validador
     *
     *
     */
    abstract protected function defineRules();

    /**
     * Method getException
     *
     * @return ValidatorException
     *
     */
    public function getException():ValidatorException
    {
        return $this->exception;
    }

    public function validate($target) {
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

                        if (is_object($class)) {
                            /** @var AbstractRule $rule */
                            $rule = $class;
                        } else {
                            /** @var AbstractRule $rule */
                            $rule = new $class();
                        }


                        $rule->setValue($value);
                        return $rule->validateRule();

                    }, $rules);
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