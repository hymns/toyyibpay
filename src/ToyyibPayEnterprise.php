<?php

namespace Hymns\ToyyibPay;

trait ToyyibPayEnterprise
{
    /**
     * Create toyyibPay user account
     * @param array $userData
     * @link https://toyyibpay.com/apireference/#gu
     * @return object
     */
    public function createUser($userData): object
    {
        $data = [
            'form_params' => $userData
        ];

        $url = $this->toyyibpay_uri . '/index.php/api/createAccount';
        $res = $this->post($url, $data);

        return $res;
    }

    /**
     * Get user account status either inactive, pending approval or active
     *
     * @param array $credential content of username and enterpriseUserSecretKey
     * @link https://toyyibpay.com/apireference/#gus
     * @return object
     */
    public function getUserStatus($credential): object
    {
        $data = [
            'form_params' => $credential
        ];

        $url = $this->toyyibpay_uri . '/index.php/api/getUserStatus';
        $res = $this->post($url, $data);

        return $res;
    }

    /**
     * Get bank accepted to be use with toyyibPay
     *
     * @link https://toyyibpay.com/apireference/#gb
     * @return object
     */
    public function getBanks(): object
    {
        $url = $this->toyyibpay_uri . '/index.php/api/getBank';
        $res = $this->get($url, []);

        return $res;
    }

    /**
     * Get FPX code to be use with toyyibPay
     *
     * @link https://toyyibpay.com/apireference/#gb
     * @return object
     */
    public function getBanksFPX(): object
    {
        $url = $this->toyyibpay_uri . '/index.php/api/getBankFPX';
        $res = $this->get($url, []);

        return $res;
    }

    /**
     * Get package to be use with toyyibPay
     *
     * @link https://toyyibpay.com/apireference/#gb
     * @return object
     */
    public function getPackages(): object
    {
        $url = $this->toyyibpay_uri . '/index.php/api/getPackage';
        $res = $this->get($url, []);

        return $res;
    }

    /**
     * Get settlement summary from toyyibPay
     *
     * @param array $credential content of username and userSecretKey
     * @link https://toyyibpay.com/apireference/#gus
     * @return object
     */
    public function getSettlementSummary($credential): object
    {
        $data = [
            'form_params' => $credential
        ];

        $url = $this->toyyibpay_uri . '/index.php/api/getSettlementSummary';
        $res = $this->post($url, $data);

        return $res;
    }
}
