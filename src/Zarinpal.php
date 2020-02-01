<?php

namespace Pishran\Zarinpal;

class Zarinpal
{
    private $merchantId = '';
    private $amount = 0;

    public function __construct()
    {
        $this->merchantId = config('zarinpal.merchant_id');
    }

    public function request(): Request
    {
        return new Request($this->merchantId, $this->amount);
    }

    public function verification(): Verification
    {
        return new Verification($this->merchantId, $this->amount);
    }

    public function amount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
