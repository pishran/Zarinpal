<?php

namespace Pishran\Zarinpal;

class VerificationResponse
{
    /** @var int */
    private $code;

    /** @var string|null */
    private $cardHash;

    /** @var string|null */
    private $cardPan;

    /** @var int|null */
    private $referenceId;

    /** @var string|null */
    private $feeType;

    /** @var int|null */
    private $fee;

    public function __construct(array $result)
    {
        $this->code = $result['data']['code'] ?? $result['errors']['code'];

        if ($this->success()) {
            $this->cardHash = $result['data']['card_hash'];
            $this->cardPan = $result['data']['card_pan'];
            $this->referenceId = $result['data']['ref_id'];
            $this->feeType = $result['data']['fee_type'];
            $this->fee = $result['data']['fee'];
        }
    }

    public function success(): bool
    {
        return $this->code === 100;
    }

    public function cardHash(): string
    {
        return $this->cardHash;
    }

    public function cardPan(): string
    {
        return $this->cardPan;
    }

    public function referenceId(): int
    {
        return $this->referenceId;
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
