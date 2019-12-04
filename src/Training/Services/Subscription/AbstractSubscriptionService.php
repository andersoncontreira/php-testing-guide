<?php


namespace Training\Services\Subscription;


use Training\Entities\Subscription;
use Training\Exceptions\ServiceException;
use Training\Logger\ConsoleLogger;
use Training\Repositories\SubscriptionRepository;
use Training\Validators\SubscriptionValidator;

abstract class AbstractSubscriptionService
{

    /** @var \Training\Entities\Subscription */
    protected $subscription;

    /** @var  \Training\Repositories\SubscriptionRepository */
    protected $repository;

    /**
     * @var \Training\Logger\ConsoleLogger
     */
    protected $logger;

    /** @var \Training\Validators\SubscriptionValidator  */
    protected $validator;

    /**
     * @var \Exception
     */
    protected $exception;

    /**
     * SubscriptionService constructor.
     *
     * @param \Training\Repositories\SubscriptionRepository $repository
     * @param \Training\Logger\ConsoleLogger $logger
     */
    public function __construct(SubscriptionRepository $repository, ConsoleLogger $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger;
        $this->validator = new SubscriptionValidator();

    }

    /**
     * Method execute
     * @return bool
     *
     */
    abstract public function execute();

    /**
     * Method setSubscription
     *
     * Description
     *
     * @param \Training\Entities\Subscription $subscription
     *
     *
     */
    public function setSubscription(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * @param Subscription $subscription
     * @return bool
     */
    public function validate(Subscription $subscription)
    {
        $validation = $this->validator->validate($subscription);

        if (!$validation) {
            $this->exception = $this->validator->getException();
        }

        return $validation;
    }

    /**
     * @return \Exception
     */
    public function getException()
    {
        return $this->exception;
    }
}