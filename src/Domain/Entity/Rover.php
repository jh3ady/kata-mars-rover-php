<?php

declare(strict_types=1);

namespace Jh3ady\Kata\MarsRoverPhp\Domain\Entity;

use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Position;
use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Direction;

final class Rover implements ActorInterface
{
    private function __construct(private PlanetInterface $planet, private Position $position, private Direction $direction)
    {
    }

    public static function initialize(PlanetInterface $planet, Position $position, Direction $direction): self
    {
        return new self($planet, $position, $direction);
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
        $position = $this->wrap($this->position->moveForward($this->direction));

        if ($this->planet->isPositionOccupied($position)) {
            return false;
        }

        $this->position = $position;

        return true;
    }

    public function moveBackward(): bool
    {
        $position = $this->wrap($this->position->moveBackward($this->direction));

        if ($this->planet->isPositionOccupied($position)) {
            return false;
        }

        $this->position = $position;

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

    private function wrap(Position $position): Position
    {
        $size = $this->planet->getSize();
        $x = $position->x;
        $y = $position->y;

        if ($x < 0) {
            $x = $size->width - 1;
        }

        if ($x >= $size->width) {
            $x = 0;
        }

        if ($y < 0) {
            $y = $size->height - 1;
        }

        if ($y >= $size->height) {
            $y = 0;
        }

        return Position::from($x, $y);
    }
}
