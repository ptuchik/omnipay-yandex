<?php

namespace Omnipay\Yandex\Message;


/**
 * Class CompletePurchaseRequest
 * @package Omnipay\Yandex\Message
 */
class CompletePurchaseRequest extends PurchaseRequest
{

    /**
     * Send data and return response instance
     *
     * @param mixed $data
     *
     * @return \Omnipay\Common\Message\ResponseInterface|\Omnipay\Idram\Message\PurchaseResponse
     */
    public function sendData($data)
    {
        
        $response =  $this->yandex->capturePayment(['amount' => array_get($data, 'amount', [])], array_get($data, 'payment_method_id'));

        return $this->response = new CompletePurchaseResponse($this, $response);
    }
}