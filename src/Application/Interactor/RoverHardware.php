<?php

declare(strict_types=1);

namespace Jh3ady\Kata\MarsRoverPhp\Application\Interactor;

use Exception;
use Jh3ady\Kata\MarsRoverPhp\Domain\Entity\Rover;
use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Position;
use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Direction;
use Jh3ady\Kata\MarsRoverPhp\Interface\RoverDriverInterface;
use RuntimeException;

final class RoverHardware implements RoverDriverInterface
{
    private ?Rover $rover = null;

    public function initialize(Position $position, Direction $direction): bool
    {
        $this->rover = Rover::initialize($position, $direction);

        return true;
    }

    public function getPosition(): Position
    {
        $this->ensureRoverIsInitialized();

        return $this->rover->getPosition();
    }

    public function getDirection(): Direction
    {
        $this->ensureRoverIsInitialized();

        return $this->rover->getDirection();
    }

    private function ensureRoverIsInitialized(): void
    {
        if ($this->rover) {
            return;
        }

        throw new RuntimeException('Rover not initialized');
    }
}
