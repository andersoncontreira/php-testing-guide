<?php


namespace Training\Tests\Helpers;


use Training\Generators\SubscriptionGenerator;

/**
 * Class SubscriptionHelper
 *
 * Helper para o Validador
 *
 * @package Training\Tests\Helpers
 */
class SubscriptionHelper
{

    /**
     * Method createRandomSubscription
     *
     * Cria um determinado de inscrições randomicas
     *
     * @param int $total
     *
     * @return \Training\Entities\Subscription[][]
     *
     */
    public static function createRandomSubscription($total = 10)
    {
        $data = [];
        for ($i = 0; $i < $total; $i++) {
            $data[] = [SubscriptionGenerator::randomGenerate()];
        }

        return $data;
    }

    /**
     * Method createRandomSubscriptionWithErrors
     *
     * Gera inscrições com erros
     *
     * @param int $total
     *
     * @return \Training\Entities\Subscription[][]
     *
     */
    public static function createRandomSubscriptionWithErrors($total = 10)
    {
        $faker = SubscriptionGenerator::getFaker();
        $data = self::createRandomSubscription($total);

        foreach ($data as $item) {
            $subscription = $item[0];
            $rnd = rand(0,3);

            //CPF (0) ou CNPJ (1)
            if ($rnd <= 1) {

                $doc = $subscription->getDocument();
                //$randomNumber1 = $faker->numberBetween(10,30);
                //$randomNumber2 = $faker->numberBetween(10,99);
                //$doc = substr($doc,0, -2) . $randomNumber1;
                //$doc = $randomNumber2. substr($doc,2, strlen($doc));

                $doc = substr($doc,0, -1);
                $subscription->setDocument($doc);
            } else {
                $subscription->setEmail('invalid@email@in');
            }

        }

        return $data;
    }
}