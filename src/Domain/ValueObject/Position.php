<?php

declare(strict_types=1);

namespace Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject;

use InvalidArgumentException;

final class Position
{
    private function __construct(public readonly int $x, public readonly int $y)
    {
        if ($x < 0) {
            throw new InvalidArgumentException('X ordinate must be greater than or equal to 0');
        }

        if ($y < 0) {
            throw new InvalidArgumentException('Y ordinate must be greater than or equal to 0');
        }
    }

    public static function from(int $x, int $y): self
    {
        return new self($x, $y);
    }

    public function equals(Position $other): bool
    {
        return $this->x === $other->x && $this->y === $other->y;
    }

    public function moveForward(Direction $direction): self
    {
        return match ($direction) {
            Direction::North => self::from($this->x, $this->y + 1),
            Direction::South => self::from($this->x, $this->y - 1),
            Direction::East => self::from($this->x + 1, $this->y),
            Direction::West => self::from($this->x - 1, $this->y)
        };
    }

    public function moveBackward(Direction $direction): self
    {
        return match ($direction) {
            Direction::North => self::from($this->x, $this->y - 1),
            Direction::South => self::from($this->x, $this->y + 1),
            Direction::East => self::from($this->x - 1, $this->y),
            Direction::West => self::from($this->x + 1, $this->y)
        };
    }
}
