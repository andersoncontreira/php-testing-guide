<?php

namespace Training\Tests\Factories;

use Training\Entities\Subscription;
use Training\Factories\SubscriptionFactory;
use Training\Tests\AbstractUnitTestCase;
use Training\Tests\Helpers\CsvDatasourceFileIterator;

/**
 * Class SubscriptionFactoryTest
 *
 * @package Training\Tests\Factories
 */
class SubscriptionFactoryTest extends AbstractUnitTestCase
{

    /**
     * Method testFactory
     *
     * Description
     *
     * @param $data
     *
     * @dataProvider getDataFromCsv
     */
    public function testFactory($data) {


        $factory = new SubscriptionFactory();
        $subscription = $factory->factory($data);

        self::assertInstanceOf(Subscription::class, $subscription);
        self::assertNotEmpty($subscription->getEmail());

        var_dump(sprintf("data: %s",json_encode($data)));
        var_dump(sprintf("subscription: %s",$subscription->toJson()));

    }

    /**
     * Method testFactory
     *
     * Description
     *
     * @param $name
     * @param $locale
     * @param $document
     * @param $documentType
     * @param $email
     * @param $password
     *
     * @dataProvider getDataFromIterator
     */
    public function testFactoryFromIterator($name, $locale, $document, $documentType, $email, $password) {

        if ($name == 'name') {
            $this->logger->info("Cenário ignorado...");
            $this->markTestSkipped();
        }

        $data = [
            'name' => $name,
            'locale' => $locale,
            'document' => $document,
            'documentType' => $documentType,
            'email' => $email,
            'password' => $password
        ];

        $factory = new SubscriptionFactory();
        $subscription = $factory->factory($data);

        self::assertInstanceOf(Subscription::class, $subscription);
        self::assertNotEmpty($subscription->getEmail());

        var_dump(sprintf("data: %s",json_encode($data)));
        var_dump(sprintf("subscription: %s",$subscription->toJson()));

    }

    /**
     * Method getDataFromCsv
     *
     * Data provider
     *
     *
     * @return array
     *
     */
    public function getDataFromCsv() {
        $data = [];
        $iterator = new CsvDatasourceFileIterator('subscriptions.csv');
        $iterator->next();
        $columns = $iterator->current();
        while ($iterator->valid()) {

            $iterator->next();
            $row = $iterator->current();

            if (is_array($row)) {
                $data[] = [array_combine($columns, $row)];
            }


        }
        return $data;
    }

    /**
     * Method getDataFromIterator
     *
     * Data provider from file iterator
     *
     *
     * @return \Training\Tests\Helpers\CsvDatasourceFileIterator
     *
     */
    public function getDataFromIterator() {
        return new CsvDatasourceFileIterator('subscriptions.csv');

    }
}
