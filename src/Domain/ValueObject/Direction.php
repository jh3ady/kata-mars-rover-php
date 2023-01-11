<?php

declare(strict_types=1);

namespace Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject;

enum Direction: string
{
    case North = 'N';
    case East = 'E';
    case South = 'S';
    case West = 'W';

    public function equals(Direction $other): bool
    {
        return $this->value === $other->value;
    }
}
