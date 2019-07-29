<?php

namespace Pishran\Zarinpal;

class VerificationResponse
{
    private $sandbox = false;
    private $status = 0;
    private $refId = 0;

    public function __construct(bool $sandbox, string $result)
    {
        $this->sandbox = $sandbox;

        $response = json_decode($result);
        if ($response === null || !isset($response->Status, $response->RefID)) {
            return;
        }

        $this->status = $response->Status;
        $this->refId = $response->RefID;
    }

    public function success(): bool
    {
        return $this->status === 100 && $this->refId > 0;
    }

    public function refId(): int
    {
        return $this->refId;
    }

    public function error(): Error
    {
        return new Error($this->status);
    }
}
