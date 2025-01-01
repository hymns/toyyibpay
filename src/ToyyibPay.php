<?php

namespace Hymns\ToyyibPay;

use GuzzleHttp\Client;
use Hymns\ToyyibPay\ToyyibPayEnterprise;

class ToyyibPay
{
    use ToyyibPayEnterprise;

    private $dev_toyyibpay_uri = 'https://dev.toyyibpay.com';
    private $prod_toyyibpay_uri = 'https://toyyibpay.com';
    private $toyyibpay_uri;

    private $client;
    private $user_secret_key;
    private $redirect_uri;

    /**
     * @param mixed $CLIENT_SECRET
     * @param mixed $REDIRECT_URI
     * @param mixed $PRODUCTION_MODE
     */
    public function __construct($CLIENT_SECRET, $REDIRECT_URI, $PRODUCTION_MODE = false)
    {
        $this->client = new Client();
        $this->user_secret_key = $CLIENT_SECRET;
        $this->redirect_uri = $REDIRECT_URI;
        $this->toyyibpay_uri = ($PRODUCTION_MODE) ? $this->prod_toyyibpay_uri : $this->dev_toyyibpay_uri;
    }

    /**
     * Get request method from guzzle client
     *
     * @param string $url
     * @param array $config
     * @return object
     */
    public function get($url, $config): object
    {
        $res = $this->client->get($url, $config);
        $result = json_decode($res->getBody()->getContents());

        return $result;
    }

    /**
     * Post request method from guzzle client
     *
     * @param string $url
     * @param array $config
     * @return object
     */
    public function post($url, $config): object
    {
        $res = $this->client->post($url, $config);
        $result = json_decode($res->getBody()->getContents());

        return $result;
    }

    /**
     * Create collection or category of bills
     *
     * @link https://toyyibpay.com/apireference/#cc
     * @param string $name collection name
     * @param string $description description for collection name
     * @return object
     */
    public function createCategory($name, $description): object
    {
        $data = [
            'form_params' => [
                'catname' => $name,
                'catdescription' => $description,
                'userSecretKey' => $this->user_secret_key
            ]
        ];

        $url = $this->toyyibpay_uri . '/index.php/api/createCategory';
        $res = $this->post($url, $data);

        return $res;
    }

    /**
     * Get the category or collection information
     *
     * @link https://toyyibpay.com/apireference/#gc
     * @param string $code category code
     * @return object
     */
    public function getCategory($code): object
    {
        $data = [
            'form_params' => [
                'categoryCode' => $code,
                'userSecretKey' => $this->user_secret_key,
            ]
        ];

        $url = $this->toyyibpay_uri . '/index.php/api/getCategoryDetails';
        $res = $this->post($url, $data);

        return $res;
    }

    /**
     * Create bill as an invoice to your customer with toyyibPay
     *
     * @link https://toyyibpay.com/apireference/#cb
     * @param string $code category code
     * @param object $bill_object bill parameters object
     * @return object
     */
    public function createBill($code, $bill_object): object
    {
        $data = [
            'form_params' => [
                'categoryCode' => $code,
                'userSecretKey' => $this->user_secret_key,
                'billName' => $bill_object->billName,
                'billDescription' => $bill_object->billDescription,
                'billPriceSetting' => $bill_object->billPriceSetting,
                'billPayorInfo' => $bill_object->billPayorInfo,
                'billAmount' => $bill_object->billAmount,
                'billReturnUrl' => $bill_object->billReturnUrl ?? $this->redirect_uri,
                'billCallbackUrl' => $bill_object->billCallbackUrl ?? $this->redirect_uri,
                'billExternalReferenceNo' => $bill_object->billExternalReferenceNo,
                'billTo' => $bill_object->billTo,
                'billEmail' => $bill_object->billEmail,
                'billPhone' => $bill_object->billPhone,
                'billSplitPayment' => $bill_object->billSplitPayment ?? 0,
                'billSplitPaymentArgs' => $bill_object->billSplitPaymentArgs ?? '',
                'billPaymentChannel' => $bill_object->billPaymentChannel ?? '0',
                'billContentEmail' => $bill_object->billContentEmail ?? '',
                'billChargeToCustomer' => $bill_object->billChargeToCustomer ?? 1,
            ]
        ];

        $url = $this->toyyibpay_uri . '/index.php/api/createBill';
        $res = $this->post($url, $data);

        return $res;
    }

    /**
     * Get the bill payment link / url
     *
     * @param string $bill_code
     * @return string
     */
    public function billPaymentLink($bill_code): string
    {
        return $this->toyyibpay_uri . '/' . $bill_code;
    }
}
