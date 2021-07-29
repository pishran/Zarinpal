<?php

namespace Pishran\Zarinpal;

use Illuminate\Support\Facades\Http;

class Request
{
    /** @var int */
    private $amount;

    private $merchant_id;

    /** @var string */
    private $description;

    /** @var string */
    private $callbackUrl;

    /** @var string */
    private $mobile;

    /** @var string */
    private $email;

    public function __construct(int $amount, $merchant_id)
    {
        $this->amount = $amount;
        $this->merchant_id = $merchant_id;
    }

    public function send(): RequestResponse
    {
        $url = config('zarinpal.sandbox_enabled')
            ? 'https://sandbox.zarinpal.com/pg/v4/payment/request.json'
            : 'https://api.zarinpal.com/pg/v4/payment/request.json';

        $data = [
            'merchant_id' => $this->merchant_id,
            'currency' => config('zarinpal.currency'),
            'amount' => $this->amount,
            'description' => $this->description,
            'callback_url' => $this->callbackUrl,
            'metadata' => [
                'mobile' => $this->mobile,
                'email' => $this->email,
            ],
        ];

        $response = Http::asJson()->acceptJson()->post($url, $data);

        return new RequestResponse($response->json());
    }

    public function description(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function callbackUrl(string $callbackUrl): self
    {
        $this->callbackUrl = $callbackUrl;

        return $this;
    }

    public function mobile(string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function email(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
