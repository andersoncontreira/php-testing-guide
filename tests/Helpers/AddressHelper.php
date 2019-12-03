<?php


namespace Helpers;


use Training\Generators\AddressGenerator;

/**
 * Class AddressHelper
 * @package Helpers
 */
class AddressHelper
{

    /**
     * @return \Faker\Generator
     */
    public static function getFaker()
    {
        return AddressGenerator::getFaker();
    }

    /**
     * @return \Training\VOs\Address
     * @throws \Training\Exceptions\ValidatorException
     */
    public static function createRandomAddress() {
        return AddressGenerator::randomGenerate();
    }

    /**
     * @return array
     */
    public static function createAddressArrayData()
    {
        $faker = self::getFaker();
        return
            [
                $faker->streetName,
                $faker->buildingNumber,
                $faker->city,
                $faker->postcode,
                $faker->state,
                "Brasil"
            ];
    }
}