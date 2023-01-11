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

    public function turnLeft(): self
    {
        return match ($this) {
            self::North => self::West,
            self::East => self::North,
            self::South => self::East,
            self::West => self::South
        };
    }

    public function turnRight(): self
    {
        return match ($this) {
            self::North => self::East,
            self::East => self::South,
            self::South => self::West,
            self::West => self::North
        };
    }
}
