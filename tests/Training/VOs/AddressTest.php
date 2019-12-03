<?php

namespace Training\VOs;


use Helpers\AddressHelper;
use Training\Exceptions\ValidatorException;
use Training\Tests\AbstractUnitTestCase;

/**
 * Class AddressTest
 * @package Training\VOs
 */
class AddressTest extends AbstractUnitTestCase
{

    /**
     * @throws ValidatorException
     */
    public function testNewInstance()
    {
        $this->logger->info(sprintf("Testing the method %s with parameters: %s", __METHOD__, null));

        $faker = AddressHelper::getFaker();
        $instance = new Address(
            $faker->streetName,
            $faker->buildingNumber,
            $faker->city,
            $faker->postcode,
            $faker->state,
            'Brasil'
        );

        self::assertNotEmpty($instance->getCityName());

    }

    /**
     * @param $street
     * @param $streetNumber
     * @param $cityName
     * @param $postalCode
     * @param $stateOrProvince
     * @param $countryName
     *
     * @throws \Exception
     * @throws Training\Exceptions\ValidatorException
     *
     * @dataProvider getErrorDataForTest
     * O nome da exception tem de ser completo
     * @expectedException Training\Exceptions\ValidatorException
     *
     */
    public function testNewInstanceError($street, $streetNumber, $cityName, $postalCode, $stateOrProvince, $countryName)
    {
        $this->logger->info(sprintf("Testing the method %s with parameters: %s", __METHOD__, null));

        try {
            new Address($street, $streetNumber, $cityName, $postalCode, $stateOrProvince, $countryName);
        } catch (\Exception $exception) {
            $this->logger->error(sprintf('Exception class: %s', get_class($exception)));
            $this->logger->error($exception->getMessage());
            throw $exception;
        }

    }

    /**
     * @param $street
     * @param $streetNumber
     * @param $cityName
     * @param $postalCode
     * @param $stateOrProvince
     * @param $countryName
     *
     * @dataProvider getDataForTest
     * @throws ValidatorException
     */
    public function testFromArray($street, $streetNumber, $cityName, $postalCode, $stateOrProvince, $countryName)
    {
        $arrayData = [
            'street' => $street,
            'streetNumber' => $streetNumber,
            'cityName' => $cityName,
            'postalCode' => $postalCode,
            'stateOrProvince' => $stateOrProvince,
            'countryName' => $countryName
        ];
        $this->logger->info(sprintf("Testing the method %s with parameters: %s", __METHOD__, json_encode($arrayData)));

        $address = Address::fromArray($arrayData);

        self::assertNotEmpty($address->getStreet());
        self::assertNotEmpty($address->getStreetNumber());
        self::assertNotEmpty($address->getCityName());

    }

    /**
     * @param $street
     * @param $streetNumber
     * @param $cityName
     * @param $postalCode
     * @param $stateOrProvince
     * @param $countryName
     *
     * @dataProvider getDataForTest
     * @throws ValidatorException
     */
    public function testEquals($street, $streetNumber, $cityName, $postalCode, $stateOrProvince, $countryName)
    {
        $arrayData = [
            'street' => $street,
            'streetNumber' => $streetNumber,
            'cityName' => $cityName,
            'postalCode' => $postalCode,
            'stateOrProvince' => $stateOrProvince,
            'countryName' => $countryName
        ];

        $this->logger->info(sprintf("Testing the method %s with parameters: %s", __METHOD__, json_encode($arrayData)));

        $address = new Address($street, $streetNumber, $cityName, $postalCode, $stateOrProvince, $countryName);

        self::assertTrue($address->equals(Address::fromArray($arrayData)));
    }

    /**
     * @param $street
     * @param $streetNumber
     * @param $cityName
     * @param $postalCode
     * @param $stateOrProvince
     * @param $countryName
     *
     * @dataProvider getDataForTest
     * @throws ValidatorException
     * @throws \Exception
     * @expectedException \InvalidArgumentException
     */
    public function testEqualsError($street, $streetNumber, $cityName, $postalCode, $stateOrProvince, $countryName)
    {
        $arrayData = [
            'street' => $street,
            'streetNumber' => $streetNumber,
            'cityName' => $cityName,
            'postalCode' => $postalCode,
            'stateOrProvince' => $stateOrProvince,
            'countryName' => $countryName
        ];

        $this->logger->info(sprintf("Testing the method %s with parameters: %s", __METHOD__, json_encode($arrayData)));

        $address = new Address($street, $streetNumber, $cityName, $postalCode, $stateOrProvince, $countryName);

        $otherVO = new \stdClass();
        try {
            $address->equals($otherVO);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());

            throw  $e;
        }

    }

    /**
     * Array data provider
     * @return array
     */
    public function getDataForTest()
    {
        return [
            AddressHelper::createAddressArrayData(),
            AddressHelper::createAddressArrayData()
        ];
    }

    /**
     * Data provider
     * @return array
     */
    public function getErrorDataForTest()
    {
        return [
            [null, null, null, null, null, null, null],
            ["", "", "", "", "", "", ""],
            ["a", "a", "a", "a", "a", "a", "a"]
        ];
    }
}
