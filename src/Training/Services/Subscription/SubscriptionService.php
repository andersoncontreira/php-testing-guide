<?php


namespace Training\Services\Subscription;


use Psr\Log\AbstractLogger;
use Training\Entities\Subscription;
use Training\Exceptions\ServiceException;
use Training\Logger\ConsoleLogger;
use Training\Repositories\SubscriptionRepository;
use Training\Validators\SubscriptionValidator;

/**
 * Class SubscriptionService
 *
 * Serviço de criação de uma inscrição
 *
 * @package Training\Services\Subscription
 */
class SubscriptionService
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
     *
     * Cria uma inscrição
     *
     *
     * @return bool
     *
     */
    public function execute()
    {
        $result = false;

        try {
            $result = $this->repository->create($this->subscription);

        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            $this->exception = new ServiceException($e->getMessage(), $e->getCode(), $e);
        }


        return $result;
    }

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

    public function validate(Subscription $subscription)
    {
        $validation = $this->validator->validate($subscription);

        if (!$validation) {
            $this->exception = $this->validator->getException();
        }

        return $validation;
    }

    public function getException()
    {
        return $this->exception;
    }
}