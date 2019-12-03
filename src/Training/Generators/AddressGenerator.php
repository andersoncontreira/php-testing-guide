<?php


namespace Training\Generators;


use Faker\Factory;
use Training\VOs\Address;

/**
 * Class AddressGenerator
 * @package Training\Generators
 */
class AddressGenerator
{
    /**
     * @return \Faker\Generator
     */
    public static function getFaker() {
        $faker = Factory::create();
        $faker->addProvider(new \Faker\Provider\pt_BR\Address($faker));

        return $faker;
    }

    /**
     * @return Address
     * @throws \Training\Exceptions\ValidatorException
     */
    public static function randomGenerate() {

        $faker = self::getFaker();

        $address = new Address(
            $faker->streetName,
            $faker->buildingNumber,
            $faker->city,
            $faker->postcode,
            $faker->state,
            "Brasil"
        );

        return $address;
    }
}