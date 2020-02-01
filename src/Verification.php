<?php

namespace Pishran\Zarinpal;

class Verification extends Http
{
    private $merchantId = '';
    private $amount = 0;
    private $authority = '';

    public function __construct(string $merchantId, int $amount)
    {
        $this->merchantId = $merchantId;
        $this->amount = $amount;
    }

    public function send(): VerificationResponse
    {
        $data = [
            'MerchantID' => $this->merchantId,
            'Amount' => $this->amount,
            'Authority' => $this->authority,
        ];

        $url = config('zarinpal.sandbox_enabled')
            ? 'https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentVerification.json'
            : 'https://www.zarinpal.com/pg/rest/WebGate/PaymentVerification.json';

        $result = $this->postJson($url, $data);

        return new VerificationResponse($result);
    }

    public function authority(string $authority): self
    {
        $this->authority = $authority;

        return $this;
    }
}
