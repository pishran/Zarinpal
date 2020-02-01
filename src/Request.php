<?php

namespace Pishran\Zarinpal;

class Request extends Http
{
    private $merchantId = '';
    private $amount = 0;
    private $zarin = false;
    private $callback = '';
    private $description = '';
    private $email = '';
    private $mobile = '';

    public function __construct(string $merchantId, int $amount)
    {
        $this->merchantId = $merchantId;
        $this->amount = $amount;
    }

    public function send(): RequestResponse
    {
        $data = [
            'MerchantID' => $this->merchantId,
            'Amount' => $this->amount,
            'CallbackURL' => $this->callback,
            'Description' => $this->description,
        ];

        if ($this->email) {
            $data['Email'] = $this->email;
        }

        if ($this->mobile) {
            $data['Mobile'] = $this->mobile;
        }

        $url = config('zarinpal.sandbox_enabled')
            ? 'https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentRequest.json'
            : 'https://www.zarinpal.com/pg/rest/WebGate/PaymentRequest.json';

        $result = $this->postJson($url, $data);

        return new RequestResponse($this->zarin, $result);
    }

    public function zarin(): self
    {
        $this->zarin = true;

        return $this;
    }

    public function callback(string $url): self
    {
        $this->callback = $url;

        return $this;
    }

    public function description(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function email(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function mobile(string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }
}
