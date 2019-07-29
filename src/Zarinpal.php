<?php

namespace Pishran\Zarinpal;

class Zarinpal
{
    private $merchantId = '';
    private $sandbox = false;
    private $amount = 0;

    public function __construct()
    {
        $this->merchantId = config('zarinpal.merchant_id');
    }

    public function request()
    {
        return new Request($this->merchantId, $this->sandbox, $this->amount);
    }

    public function verification()
    {
        return new Verification($this->merchantId, $this->sandbox, $this->amount);
    }

    public function sandbox(): self
    {
        $this->sandbox = true;
        $this->merchantId = '00000000-0000-0000-0000-000000000000';

        return $this;
    }

    public function amount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
