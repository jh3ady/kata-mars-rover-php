<?php

declare(strict_types=1);

namespace Jh3ady\Kata\MarsRoverPhp\Domain\Entity;

use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Position;

final class Obstacle implements ActorInterface
{
    public function __construct(private PlanetInterface $planet, private Position $position)
    {
    }

    public function getPlanet(): PlanetInterface
    {
        return $this->planet;
    }

    public function getPosition(): Position
    {
        return $this->position;
    }
}
