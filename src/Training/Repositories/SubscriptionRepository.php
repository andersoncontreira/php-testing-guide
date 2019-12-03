<?php


namespace Training\Repositories;


use Training\Entities\Subscription;

/**
 * Class SubscriptionRepository
 *
 * @package Training\Repositories
 */
class SubscriptionRepository
{

    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * SubscriptionRepository constructor.
     *
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Method create
     *
     * Cria uma inscrição
     *
     * @param \Training\Entities\Subscription $subscription
     *
     * @return bool
     *
     */
    public function create(Subscription $subscription) {

        $ref = new \ReflectionClass($subscription);
        $properties = $ref->getProperties();

        $fields = [];
        $params = [];
        $values = [];
        foreach ($properties as $property) {
            $property->setAccessible(true);

            $value = $property->getValue($subscription);
            if (!empty($value)) {
                $key = ":".$property->getName();
                $fields[] = $property->getName();
                $params[] = $key;
                $values[$key] = $value;
            }

        }

        $sql = sprintf("INSERT INTO subscription (%s) VALUES (%s)", join(",", $fields), join(",", $params));

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($values);

        $result = ($stmt->rowCount())?true:false;

        return $result;
    }
}