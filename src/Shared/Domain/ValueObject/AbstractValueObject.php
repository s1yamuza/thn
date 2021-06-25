<?php

namespace THN\Shared\Domain\ValueObject;

abstract class AbstractValueObject implements ValueObjectInterface
{

    public function isEqualTo(ValueObjectInterface $object): bool
    {
        if ($this->value() === $object->value()) {
            return true;
        }

        return false;
    }

    abstract public function value();
}
