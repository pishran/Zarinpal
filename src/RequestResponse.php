<?php

namespace Pishran\Zarinpal;

use Illuminate\Http\RedirectResponse;

class RequestResponse
{
    /** @var int */
    private $code;

    /** @var string|null */
    private $authority;

    /** @var string|null */
    private $feeType;

    /** @var int|null */
    private $fee;

    public function __construct(array $result)
    {
        $this->code = $result['data']['code'] ?? $result['errors']['code'];

        if ($this->success()) {
            $this->authority = $result['data']['authority'];
            $this->feeType = $result['data']['fee_type'];
            $this->fee = $result['data']['fee'];
        }
    }

    public function success(): bool
    {
        return $this->code === 100;
    }

    public function url(): string
    {
        if (! $this->success()) {
            return '';
        }

        $url = 'https://www.zarinpal.com/pg/StartPay/';

        return $url.$this->authority;
    }

    public function redirect(): ?RedirectResponse
    {
        $url = $this->url();

        return $url ? redirect($url) : null;
    }

    public function authority(): string
    {
        return $this->authority;
    }

    public function feeType(): string
    {
        return $this->feeType;
    }

    public function fee(): int
    {
        return $this->fee;
    }

    public function error(): Error
    {
        return new Error($this->code);
    }
}
