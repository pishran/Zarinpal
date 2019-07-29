<?php

namespace Pishran\Zarinpal;

class Verification extends Http
{
    private $merchantId = '';
    private $sandbox = false;
    private $amount = 0;
    private $authority = '';

    public function __construct(string $merchantId, bool $sandbox, int $amount)
    {
        $this->merchantId = $merchantId;
        $this->sandbox = $sandbox;
        $this->amount = $amount;
    }

    public function send()
    {
        $data = [
            'MerchantID' => $this->merchantId,
            'Amount' => $this->amount,
            'Authority' => $this->authority,
        ];

        $url = $this->sandbox
            ? 'https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentVerification.json'
            : 'https://www.zarinpal.com/pg/rest/WebGate/PaymentVerification.json';

        $result = $this->postJson($url, $data);

        return new VerificationResponse($this->sandbox, $result);
    }

    public function authority(string $authority): self
    {
        $this->authority = $authority;

        return $this;
    }
}
