<?php


namespace Training\Services;


use Training\Entities\Subscription;
use Training\Logger\ConsoleLogger;
use Training\Repositories\SubscriptionRepository;
use Training\Services\Subscription\SubscriptionService;
use Training\Services\Subscription\UpdateSubscriptionService;
use Training\Validators\SubscriptionValidator;

/**
 * Class SubscriptionManager
 * @package Training\Services
 */
class SubscriptionManager
{


    /**
     * @var \Exception
     */
    protected $exception;

    /**
     * @var \Training\Repositories\SubscriptionRepository
     */
    protected $repository;

    /**
     * @var \Training\Logger\ConsoleLogger
     */
    protected $logger;

    public function __construct(\PDO $pdo, ConsoleLogger $logger)
    {
        $this->repository = new SubscriptionRepository($pdo);
        $this->logger = $logger;

    }

    /**
     * Method subscribe
     *
     * Realiza uma inscrição
     *
     * @param \Training\Entities\Subscription $subscription
     *
     * @return bool
     *
     */
    public function subscribe(Subscription $subscription)
    {

        $result = false;

        try {

            $service = new SubscriptionService($this->repository, $this->logger);
            $service->setSubscription($subscription);

            if ($service->validate($subscription)) {
                $result = $service->execute();
            }

            if ($result == false) {
                $this->exception = $service->getException();
            }

        } catch (\Exception $exception) {
            $this->exception = $exception;
        }

        return $result;
    }

    /**
     * @param $subscription
     * @return bool
     */
    public function updateSubscription(Subscription $subscription)
    {
        $result = false;

        try {
            $service = new UpdateSubscriptionService($this->repository, $this->logger);
            $service->setSubscription($subscription);

            if ($service->validate($subscription)) {
                $result = $service->execute();
            }

            if ($result == false) {
                $this->exception = $service->getException();
            }
        } catch (\Exception $exception) {
            $this->exception = $exception;
        }

        return $result;
    }



    public function unsubscribe(Subscription $subscription) {
//        $service = new UnsubscriptionService($this->repository, $this->logger);
//        $service->setSubscription($subscription);
//        $service->execute();
    }

    /**
     * @return \Training\Validators\SubscriptionValidator
     */
    public function getValidator()
    {
        return new SubscriptionValidator();
    }

    /**
     * @return \Exception
     */
    public function getException()
    {
        return $this->exception;
    }




}