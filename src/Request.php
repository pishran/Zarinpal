<?php

namespace Pishran\Zarinpal;

use Illuminate\Support\Facades\Http;

class Request
{
    /** @var string */
    private $merchantId;

    /** @var int */
    private $amount;

    /** @var string */
    private $description;

    /** @var string */
    private $callbackUrl;

    /** @var string */
    private $mobile;

    /** @var string */
    private $email;

    public function __construct(string $merchantId, int $amount)
    {
        $this->merchantId = $merchantId;
        $this->amount = $amount;
    }

    public function send(): RequestResponse
    {
        $url = 'https://api.zarinpal.com/pg/v4/payment/request.json';

        $metadata = [];
        
        if ($this->mobile) {
            $metadata['mobile'] = $this->mobile;
        }
        
        if ($this->email) {
            $metadata['email'] = $this->email;
        }

        $data = [
            'merchant_id' => $this->merchantId,
            'currency' => config('zarinpal.currency'),
            'amount' => $this->amount,
            'description' => $this->description,
            'callback_url' => $this->callbackUrl,
            'metadata' => $metadata,
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
