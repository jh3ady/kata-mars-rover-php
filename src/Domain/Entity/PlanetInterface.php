<?php

declare(strict_types=1);

namespace Jh3ady\Kata\MarsRoverPhp\Domain\Entity;

use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Position;
use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Size;

interface PlanetInterface
{
    public function getSize(): Size;

    public function addActor(string $actorClassName, Position $position): bool;

    public function isPositionOccupied(Position $position): bool;
}
