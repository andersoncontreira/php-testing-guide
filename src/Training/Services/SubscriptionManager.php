<?php


namespace Training\Services;


use Training\Entities\Subscription;
use Training\Exceptions\ServiceException;
use Training\Logger\ConsoleLogger;
use Training\Repositories\SubscriptionRepository;
use Training\Services\Subscription\SubscriptionService;
use Training\Services\Subscription\UnsubscriptionService;
use Training\Validators\SubscriptionValidator;

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

        } catch (ServiceException $exception) {
            $this->exception = $exception;
        }

        return $result;
    }

    public function unsubscribe() {
        $service = new UnsubscriptionService();
        $service->execute();
    }

    /**
     * @return \Training\Validators\SubscriptionValidator
     */
    public
    function getValidator()
    {
        return $this->validator;
    }

    /**
     * @return \Exception
     */
    public function getException()
    {
        return $this->exception;
    }

    public function updateSubscription($subscription)
    {
    }


}