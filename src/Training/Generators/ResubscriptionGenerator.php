<?php


namespace Training\Generators;


use Faker\Factory;
use Training\Entities\Subscription;
use Training\Enums\DocumentTypeEnum;
use Training\VOs\Address;

/**
 * Class SubscriptionGenerator
 *
 * Gerador de inscrições
 *
 * @package Training\Generators
 */
class ResubscriptionGenerator
{

    public static function getFaker() {
        $faker = Factory::create();
        $faker->addProvider(new \Faker\Provider\pt_BR\Person($faker));
        $faker->addProvider(new \Faker\Provider\pt_BR\Company($faker));
        $faker->addProvider(new \Faker\Provider\pt_BR\Address($faker));

        return $faker;
    }

    /**
     * Method randomGenerate
     *
     * gera uma inscrição randomicamente
     *
     *
     * @return \Training\Entities\Subscription
     *
     * @throws \Training\Exceptions\ValidatorException
     */
    public static function randomGenerate() {
        $subscription = new Subscription();

        $faker = self::getFaker();

        $address = new Address(
            $faker->streetName,
            $faker->buildingNumber,
            $faker->city,
            $faker->postcode,
            $faker->state,
            'Brasil'
        );

        $locale = 'pt_BR';
        $documentType = (rand(0,1) == 1)? DocumentTypeEnum::CPF : DocumentTypeEnum::CNPJ;
        if ($documentType == DocumentTypeEnum::CPF) {
            $document = $faker->cpf;
        } else {
            $document = $faker->cnpj;
        }

        //$subscription->setId($faker->numberBetween($min = 1, $max = 100));
        $subscription->setUuid($faker->uuid);
        $subscription->setName($faker->name);
        $subscription->setEmail($faker->email);
        $subscription->setDocumentType($documentType);
        $subscription->setDocument($document);
        $subscription->setLocale($locale);
        $subscription->setPassword($faker->md5);
        $subscription->setAddress($address);

        return $subscription;
    }
    /**
     * Method randomGenerate
     *
     * gera uma inscrição randomicamente
     *
     *
     * @return \Training\Entities\Subscription
     *
     * @throws \Training\Exceptions\ValidatorException
     */
    public static function randomGenerateDup() {
        $subscription = new Subscription();

        $faker = self::getFaker();

        $address = new Address(
            $faker->streetName,
            $faker->buildingNumber,
            $faker->city,
            $faker->postcode,
            $faker->state,
            'Brasil'
        );

        $locale = 'pt_BR';
        $documentType = (rand(0,1) == 1)? DocumentTypeEnum::CPF : DocumentTypeEnum::CNPJ;
        if ($documentType == DocumentTypeEnum::CPF) {
            $document = $faker->cpf;
        } else {
            $document = $faker->cnpj;
        }

        //$subscription->setId($faker->numberBetween($min = 1, $max = 100));
        $subscription->setUuid($faker->uuid);
        $subscription->setName($faker->name);
        $subscription->setEmail($faker->email);
        $subscription->setDocumentType($documentType);
        $subscription->setDocument($document);
        $subscription->setLocale($locale);
        $subscription->setPassword($faker->md5);
        $subscription->setAddress($address);

        return $subscription;
    }
}