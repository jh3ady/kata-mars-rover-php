<?php

declare(strict_types=1);

namespace Jh3ady\Kata\MarsRoverPhp\Domain\Entity;

use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Position;
use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Size;

final class Mars implements PlanetInterface
{
    private array $data;

    public function __construct(private readonly Size $size)
    {
        $this->buildData();
    }

    /**
     * @return Size
     */
    public function getSize(): Size
    {
        return $this->size;
    }

    public function addActor(string $actorClassName, Position $position): bool
    {
        if ($this->isPositionOccupied($position)) {
            return false;
        }

        $actor = new $actorClassName($this, $position);

        $this->data[$position->x][$position->y] = $actor;

        return true;
    }

    public function isPositionOccupied(Position $position): bool
    {
        if (!$this->isInBounds($position)) {
            return true;
        }

        return isset($this->data[$position->x][$position->y]);
    }

    private function buildData(): void
    {
        $this->data = [];

        for ($x = 0; $x < $this->size->width; $x++) {
            for ($y = 0; $y < $this->size->height; $y++) {
                $this->data[$x][$y] = null;
            }
        }
    }

    private function isInBounds(Position $position): bool
    {
        return $position->x >= 0 && $position->x < $this->size->width && $position->y >= 0 && $position->y < $this->size->height;
    }
}
