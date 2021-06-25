<?php

namespace THN\Shared\Domain\ValueObject;

interface ValueObjectInterface
{
    public function isEqualTo(ValueObjectInterface $object): bool;
    public function value();
}
