<?php


namespace Training\Factories;


use ReflectionClass;
use Training\Entities\Subscription;

/**
 * Class SubscriptionFactory
 *
 * Factory para a Entidade Subscription
 *
 * @package Training\Factories
 */
class SubscriptionFactory
{
    /**
     * Method factory
     *
     * Fabrica um objeto do tipo Subscription a partir dos parametros de um array
     *
     * @param array $data
     *
     * @return \Training\Entities\Subscription
     *
     */
    public function factory(array $data)
    {

        $subscription = new Subscription();

        $reflection = new ReflectionClass(Subscription::class);

        foreach ($data as $key => $value) {
            try {
                if ($reflection->hasProperty($key)) {
                    $property = $reflection->getProperty($key);
                    $property->setAccessible(true);
                    $property->setValue($subscription, $value);
                }
            } catch (\Exception $e) {
                // log error here...
            }

        }

        return $subscription;
    }
}