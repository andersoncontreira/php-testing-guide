<?php


namespace Training\VOs;

/**
 * Interface ValueObject
 * @package Training\VOs
 */
interface ValueObject
{

    /**
     * @param array $data
     * @return ValueObject
     */
    public static function fromArray(array $data);

    /**
     * @return array
     */
    public function toArray();

    /**
     * @param $valueObject
     * @return boolean
     */
    public function equals($valueObject);


}