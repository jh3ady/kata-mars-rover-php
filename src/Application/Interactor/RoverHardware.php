<?php

declare(strict_types=1);

namespace Jh3ady\Kata\MarsRoverPhp\Application\Interactor;

use Jh3ady\Kata\MarsRoverPhp\Domain\Entity\PlanetInterface;
use Jh3ady\Kata\MarsRoverPhp\Domain\Entity\Rover;
use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Position;
use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Direction;
use Jh3ady\Kata\MarsRoverPhp\Interface\RoverDriverInterface;
use RuntimeException;

final class RoverHardware implements RoverDriverInterface
{
    private const COMMAND_FORWARD = 'f';
    private const COMMAND_BACKWARD = 'b';
    private const COMMAND_TURN_LEFT = 'l';
    private const COMMAND_TURN_RIGHT = 'r';
    private ?Rover $rover = null;

    public function initialize(PlanetInterface $planet, Position $position, Direction $direction): bool
    {
        $this->rover = Rover::initialize($planet, $position, $direction);

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

    public function execute(array $commands): void
    {
        $this->ensureRoverIsInitialized();

        foreach ($commands as $command) {
            $this->executeCommand($command);
        }
    }

    private function executeCommand(string $command): bool
    {
        return match ($command) {
            self::COMMAND_FORWARD => $this->rover->moveForward(),
            self::COMMAND_BACKWARD => $this->rover->moveBackward(),
            self::COMMAND_TURN_LEFT => $this->rover->turnLeft(),
            self::COMMAND_TURN_RIGHT => $this->rover->turnRight(),
            default => throw new RuntimeException(sprintf('Invalid command "%s"', $command)),
        };
    }
}
