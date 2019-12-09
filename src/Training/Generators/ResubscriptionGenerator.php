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

    const TODAY = '<p>your order will ship today</p>';
    const TOMORROW = '<p>your order will ship tomorrow</p>';
    const MONDAY = '<p>your order will ship monday</p>';
    
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

    public function xitaMethod()
    {

        $message = "";
        $current_time = date("H:i");
        $d = date("N");

        if ($d > 3) {
            $message = ('<p>your order will ship monday</p>');
        }
        else {

            if ($d < 4 && $current_time >= "10:00") {
                if ($d = 1 && $current_time <= "10:00" || $d = 2 && $current_time <= "10:00") {
                    $message = ('<p>your order will ship today.</p>');
                    $time = date('Hi');
                    switch (date('l')) {
                        case 'Monday':
                        case 'Tuesday':
                            if ($time < 1000)
                                echo self::TODAY;
                            else
                                echo self::TOMORROW;
                            break;
                        case 'Wednesday':
                            if ($time < 1000)
                                echo self::TODAY;
                            else
                                echo self::MONDAY;
                            break;
                        default:
                            $time = date("Hi");
                            $day = date("N"); //sets a numeric value monday = 1 etc
                            echo self::MONDAY;


                            switch ($day) {
                                case 1:
                                    if ($time < 1000)
                                    {echo "Your order will ship today";}
                                    else
                                    {echo "Your order will ship tomorrow";}
                                    break;
                                case 2:
                                    if ($time < 1000)
                                    {echo "Your order will ship today";}
                                    else
                                    {echo "Your order will ship tomorrow";}
                                    break;
                                case 3:
                                    if ($time < 1000)
                                    {echo "Your order will ship today";}
                                    else
                                    {echo "Your order will ship Monday";}
                                    break;
                                default:
                                    echo "Your order will ship Monday"; //if none of the above match
                            }

                            break;
                    }
                }
            }

            if ($d = 1 && $current_time >= "10:01" || $d = 2 && $current_time >= "10:01") {
                $message = ('<p>your order will ship tomorrow.</p>');

                if ($d > 10) {
                    $message =  "xita";
                }
            }

            if ($d = 3 && $current_time <= "10:00") {
                $message = ('<p>your order will ship monday.</p>');
            }

        }

    }
}