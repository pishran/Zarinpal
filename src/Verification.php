<?php

namespace Pishran\Zarinpal;

use Illuminate\Support\Facades\Http;

class Verification
{
    /** @var string */
    private $merchantId;

    /** @var int */
    private $amount;

    /** @var string */
    private $authority;

    public function __construct(string $merchantId, int $amount)
    {
        $this->merchantId = $merchantId;
        $this->amount = $amount;
    }

    public function send(): VerificationResponse
    {
        $url = 'https://api.zarinpal.com/pg/v4/payment/verify.json';

        $data = [
            'merchant_id' => $this->merchantId,
            'amount' => $this->amount,
            'authority' => $this->authority,
        ];

        $response = Http::asJson()->acceptJson()->post($url, $data);

        return new VerificationResponse($response->json());
    }

    public function authority(string $authority): self
    {
        $this->authority = $authority;

        return $this;
    }
}
