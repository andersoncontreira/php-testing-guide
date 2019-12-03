<?php


namespace Training\Utils;


use ReflectionClass;

/**
 * Class EntityHelper
 *
 * Helper para entidade
 *
 * @package Training\Helpers
 */
class ObjectUtil
{

    /**
     * Method toArray
     *
     * Converte uma entidade em um array
     *
     * @param $object
     *
     * @return array
     *
     */
    public static function toArray($object)
    {
        $class = get_class($object);
        $data = [];
        $reflection = new ReflectionClass($class);
        $properties = $reflection->getProperties();
        foreach ($properties as $property) {
            $property->setAccessible(true);
            $name = $property->getName();
            $value = $property->getValue($object);

            if (is_object($value)) {
                $data[$name] = self::toArray($value);
            } else {
                $data[$name] = $value;
            }

        }

        return $data;
    }

    public static function toJson($object) {
        return json_encode(self::toArray($object));
    }
}