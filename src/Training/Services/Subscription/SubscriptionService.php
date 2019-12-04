<?php


namespace Training\Services\Subscription;


use Training\Exceptions\ServiceException;

/**
 * Class SubscriptionService
 *
 * Serviço de criação de uma inscrição
 *
 * @package Training\Services\Subscription
 */
class SubscriptionService extends AbstractSubscriptionService
{

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
}