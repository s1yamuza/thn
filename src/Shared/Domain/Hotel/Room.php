<?php

namespace THN\Shared\Domain\Hotel;

use THN\Shared\Domain\ValueObject\AbstractValueObject;

class Room extends AbstractValueObject
{
    private const MIN_FLOOR_TERRACE = 300;

    private string $number;

    public function __construct(string $number)
    {
        $this->number = $number;
        $this->hasTerrace = $this->hasTerrace();
    }

    public function value(): int
    {
        return (int) $this->number;
    }

    public function hasTerrace(): bool
    {
        if ($this->value() >= self::MIN_FLOOR_TERRACE) {
            return true;
        }

        return false;
    }

    public function __toString(): string
    {
        return (string) $this->value();
    }
}
