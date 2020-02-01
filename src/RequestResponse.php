<?php

namespace Pishran\Zarinpal;

use Illuminate\Http\RedirectResponse;

class RequestResponse
{
    private $status = 0;
    private $authority = '';
    private $zarin = '';

    public function __construct(bool $zarin, string $result)
    {
        $this->zarin = $zarin ? '/ZarinGate' : '';

        $response = json_decode($result);
        if ($response === null || ! isset($response->Status, $response->Authority)) {
            return;
        }

        $this->status = $response->Status;
        $this->authority = $response->Authority;
    }

    public function success(): bool
    {
        return $this->status === 100 && strlen($this->authority) === 36;
    }

    public function redirect(): ?RedirectResponse
    {
        $url = $this->url();

        return $url ? redirect($url) : null;
    }

    public function url(): ?string
    {
        if (! $this->success()) {
            return null;
        }

        $url = config('zarinpal.sandbox_enabled')
            ? 'https://sandbox.zarinpal.com/pg/StartPay/'
            : 'https://www.zarinpal.com/pg/StartPay/';

        return $url.$this->authority.$this->zarin;
    }

    public function authority(): string
    {
        return $this->authority;
    }

    public function error(): Error
    {
        return new Error($this->status);
    }
}
