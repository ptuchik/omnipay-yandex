<?php

namespace Omnipay\Yandex\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Yandex\Helpers\ParametersTrait;
use YandexCheckout\Model\PaymentStatus;

/**
 * Class PurchaseResponse
 * @package Omnipay\Yandex\Message
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    use ParametersTrait;

    /**
     * Get amount
     * @return mixed
     */
    public function getAmount()
    {
        return $this->data->getAmount()->getValue();
    }

    /**
     * Get transaction reference
     * @return null|string
     */
    public function getTransactionReference()
    {
        return $this->data->getId();
    }

    /**
     * Get transaction data
     * @return mixed|object
     */
    public function getData()
    {
        return (object) ['transaction' => $this->data];
    }

    public function isRedirect()
    {
        if ($this->isPending()) {
            return true;
        }

        return false;
    }

    public function getRedirectUrl()
    {
        return $this->data->getConfirmation()->confirmationUrl;
    }

    /**
     * Get successful status
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->data->getStatus() == PaymentStatus::SUCCEEDED;
    }

    public function isPending()
    {
        return $this->data->getStatus() == PaymentStatus::PENDING;
    }
}