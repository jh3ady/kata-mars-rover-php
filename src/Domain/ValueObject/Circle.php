<?php

declare(strict_types=1);

namespace Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject;

final class Circle extends Size
{
    public static function of(int $radius): self
    {
        return new self($radius, $radius);
    }
}
