<?php

namespace Pishran\Zarinpal;

class VerificationResponse
{
    private $status = 0;
    private $referenceId = 0;

    public function __construct(string $result)
    {
        $response = json_decode($result);
        if ($response === null || ! isset($response->Status, $response->RefID)) {
            return;
        }

        $this->status = $response->Status;
        $this->referenceId = $response->RefID;
    }

    public function success(): bool
    {
        return $this->status === 100 && $this->referenceId > 0;
    }

    public function referenceId(): int
    {
        return $this->referenceId;
    }

    public function error(): Error
    {
        return new Error($this->status);
    }
}
