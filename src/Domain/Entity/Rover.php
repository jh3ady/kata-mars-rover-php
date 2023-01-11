<?php

declare(strict_types=1);

namespace Jh3ady\Kata\MarsRoverPhp\Domain\Entity;

use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Position;
use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Direction;

final class Rover
{
    private function __construct(private Position $position, private Direction $direction)
    {
    }

    public static function initialize(Position $position, Direction $direction): self
    {
        return new self($position, $direction);
    }

    public function getPosition(): Position
    {
        return $this->position;
    }

    public function getDirection(): Direction
    {
        return $this->direction;
    }

    public function moveForward(): bool
    {
        $this->position = $this->position->moveForward($this->direction);

        return true;
    }

    public function moveBackward(): bool
    {
        $this->position = $this->position->moveBackward($this->direction);

        return true;
    }

    public function turnLeft(): bool
    {
        $this->direction = $this->direction->turnLeft();

        return true;
    }

    public function turnRight(): bool
    {
        $this->direction = $this->direction->turnRight();

        return true;
    }
}
