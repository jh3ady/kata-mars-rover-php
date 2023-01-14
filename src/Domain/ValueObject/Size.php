<?php

declare(strict_types=1);

namespace Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject;

class Size
{
    protected function __construct(public readonly int $width, public readonly int $height)
    {
    }

    public static function from(int $width, int $height): self
    {
        return new self($width, $height);
    }
}
