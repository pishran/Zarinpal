<?php

namespace Pishran\Zarinpal;

class Zarinpal
{
    /** @var int */
    private $amount;

    public function amount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function request(): Request
    {
        return new Request($this->amount);
    }

    public function verification(): Verification
    {
        return new Verification($this->amount);
    }
}
