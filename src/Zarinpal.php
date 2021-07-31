<?php

namespace Pishran\Zarinpal;

class Zarinpal
{
    /** @var string */
    private $merchantId;

    /** @var int */
    private $amount;

    public function merchantId(string $merchantId): self
    {
        $this->merchantId = $merchantId;

        return $this;
    }

    public function amount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function request(): Request
    {
        $merchantId = $this->merchantId ?: config('zarinpal.merchant_id');
        return new Request($merchantId, $this->amount);
    }

    public function verification(): Verification
    {
        $merchantId = $this->merchantId ?: config('zarinpal.merchant_id');
        return new Verification($merchantId, $this->amount);
    }
}
