<?php

namespace Pishran\Zarinpal;

class Zarinpal
{
    /** @var int */
    private $amount;

    private $merchant_id;

    public function amount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function merchant_id(string $merchant_id): self
    {
        $this->merchant_id = $merchant_id;

        return $this;
    }

    public function request(): Request
    {
        return new Request($this->amount, $this->merchant_id);
    }

    public function verification(): Verification
    {
        return new Verification($this->amount, $this->merchant_id);
    }
}
