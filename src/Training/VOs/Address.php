<?php


namespace Training\VOs;

use Training\Exceptions\ValidatorException;
use Training\Utils\ObjectUtil;
use Training\Validators\AddressValidator;

/**
 * Class Address
 *
 * Value object for Address
 *
 * @package Training\VOs
 */
final class Address implements \JsonSerializable, ValueObject
{
    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $streetNumber;

    /**
     * @var string
     */
    private $cityName;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * @var string
     */
    private $stateOrProvince;

    /**
     * @var string
     */
    private $countryName;

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * @return string
     */
    public function getCityName()
    {
        return $this->cityName;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @return string
     */
    public function getStateOrProvince()
    {
        return $this->stateOrProvince;
    }

    /**
     * @return string
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * Address constructor.
     * @param $street
     * @param $streetNumber
     * @param $cityName
     * @param $postalCode
     * @param $stateOrProvince
     * @param $countryName
     * @throws ValidatorException
     */
    public function __construct($street, $streetNumber, $cityName, $postalCode, $stateOrProvince, $countryName)
    {
        $this->street = $street;
        $this->streetNumber = $streetNumber;
        $this->cityName = $cityName;
        $this->postalCode = $postalCode;
        $this->stateOrProvince = $stateOrProvince;
        $this->countryName = $countryName;

        $validator = new AddressValidator();
        if(!$validator->validate($this)) {
            throw $validator->getException();
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return ObjectUtil::toJson($this);
    }

    /**
     * Create an instance from an array data
     * @param array $data
     * @return Address
     * @throws ValidatorException
     */
    public static function fromArray(array $data):self {
        if (empty($data) || !is_array($data)) {

            throw new \InvalidArgumentException('The input data must be an array');

        } else {
            return new self(
                $data['street'],
                $data['streetNumber'],
                $data['cityName'],
                $data['postalCode'],
                $data['stateOrProvince'],
                $data['countryName']
            );
        }
    }

    /**
     * Convert the Object in an array with the values
     * @return array
     */
    public function toArray():array {
        return ObjectUtil::toArray($this);
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize():string
    {
        return ObjectUtil::toJson($this);
    }

    /**
     * @param Address $valueObject
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function equals($valueObject)
    {
        if (!$valueObject instanceof Address) {
            throw new \InvalidArgumentException(sprintf('The $valueObject must be an instance of %s', __CLASS__));
        }
        $eqCityName = $this->cityName === $valueObject->getCityName();
        $eqCountryName = $this->countryName === $valueObject->getCountryName();
        $eqPostalCode = $this->postalCode === $valueObject->getPostalCode();

        return $eqCityName && $eqCountryName && $eqPostalCode;
    }
}