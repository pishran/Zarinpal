<?php

namespace Pishran\Zarinpal;

class RequestResponse
{
    private $sandbox = false;
    private $status = 0;
    private $authority = '';
    private $zarin = '';

    public function __construct(bool $sandbox, bool $zarin, string $result)
    {
        $this->sandbox = $sandbox;
        $this->zarin = $zarin ? '/ZarinGate' : '';

        $response = json_decode($result);
        if ($response === null || !isset($response->Status, $response->Authority)) {
            return;
        }

        $this->status = $response->Status;
        $this->authority = $response->Authority;
    }

    public function success(): bool
    {
        return $this->status === 100 && strlen($this->authority) === 36;
    }

    public function redirect()
    {
        $url = $this->url();

        return $url ? redirect($url) : null;
    }

    public function url()
    {
        if (!$this->success()) {
            return null;
        }

        $url = $this->sandbox
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
