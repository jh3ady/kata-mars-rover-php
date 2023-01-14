<?php

declare(strict_types=1);

namespace Jh3ady\Kata\MarsRoverPhp\Test\Unit\Application\Interactor;

use Jh3ady\Kata\MarsRoverPhp\Application\Interactor\RoverHardware;
use Jh3ady\Kata\MarsRoverPhp\Domain\Entity\Mars;
use Jh3ady\Kata\MarsRoverPhp\Domain\Entity\Obstacle;
use Jh3ady\Kata\MarsRoverPhp\Domain\Entity\PlanetInterface;
use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Circle;
use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Position;
use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Direction;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class RoverHardwareTest extends TestCase
{
    private PlanetInterface $planet;

    private RoverHardware $driver;

    protected function setUp(): void
    {
        parent::setUp();

        $this->planet = new Mars(size: Circle::of(2));
        $this->driver = new RoverHardware();
    }

    public function testInitialize(): void
    {
        $position = Position::from(x: 0, y: 0);
        $direction = Direction::from('N');
        $initialized = $this->driver->initialize($this->planet, $position, $direction);

        $this->assertTrue($initialized);
        $this->assertTrue($position->equals($this->driver->getPosition()));
        $this->assertTrue($direction->equals($this->driver->getDirection()));
    }

    public function testShouldBeInitializedBeforeGettingPosition(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Rover not initialized');

        $this->driver->getPosition();
    }

    public function testShouldBeInitializedBeforeGettingDirection(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Rover not initialized');

        $this->driver->getDirection();
    }

    public function testRoverShouldDoNothingBecauseNoCommandProvided(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('N');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute([]);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($initialDirection));
    }

public function testRoverShouldMoveForwardFromNorth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $expectedPosition = Position::from(x: 0, y: 1);
        $initialDirection = Direction::from('N');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($initialDirection));
    }

    public function testRoverShouldMoveForwardFromEast(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $expectedPosition = Position::from(x: 1, y: 0);
        $initialDirection = Direction::from('E');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($initialDirection));
    }

    public function testRoverShouldMoveForwardFromSouth(): void
    {
        $initialPosition = Position::from(x: 0, y: 1);
        $expectedPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('S');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($initialDirection));
    }

    public function testRoverShouldMoveForwardFromWest(): void
    {
        $initialPosition = Position::from(x: 1, y: 0);
        $expectedPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('W');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($initialDirection));
    }

    public function testRoverShouldMoveBackwardFromNorth(): void
    {
        $initialPosition = Position::from(x: 0, y: 1);
        $expectedPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('N');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['b']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($initialDirection));
    }

    public function testRoverShouldMoveBackwardFromEast(): void
    {
        $initialPosition = Position::from(x: 1, y: 0);
        $expectedPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('E');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['b']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($initialDirection));
    }

    public function testRoverShouldMoveBackwardFromSouth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $expectedPosition = Position::from(x: 0, y: 1);
        $initialDirection = Direction::from('S');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['b']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($initialDirection));
    }

    public function testRoverShouldMoveBackwardFromWest(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $expectedPosition = Position::from(x: 1, y: 0);
        $initialDirection = Direction::from('W');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['b']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($initialDirection));
    }

    public function testRoverShouldTurnLeftFromNorth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('N');
        $expectedDirection = Direction::from('W');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldTurnLeftFromEast(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('E');
        $expectedDirection = Direction::from('N');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldTurnLeftFromSouth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('S');
        $expectedDirection = Direction::from('E');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldTurnLeftFromWest(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('W');
        $expectedDirection = Direction::from('S');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldTurnRightFromNorth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('N');
        $expectedDirection = Direction::from('E');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldTurnRightFromEast(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('E');
        $expectedDirection = Direction::from('S');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldTurnRightFromSouth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('S');
        $expectedDirection = Direction::from('W');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldTurnRightFromWest(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('W');
        $expectedDirection = Direction::from('N');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInSouthDirectionIfTurnedLeftTwoTimesFromNorth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('N');
        $expectedDirection = Direction::from('S');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInEastDirectionIfTurnedLeftThreeTimesFromNorth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('N');
        $expectedDirection = Direction::from('E');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'l', 'l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInNorthDirectionIfTurnedLeftFourTimesFromNorth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('N');
        $expectedDirection = Direction::from('N');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'l', 'l', 'l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInEastDirectionIfTurnedLeftTwoTimesFromWest(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('W');
        $expectedDirection = Direction::from('E');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInNorthDirectionIfTurnedLeftThreeTimesFromWest(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('W');
        $expectedDirection = Direction::from('N');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'l', 'l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInWestDirectionIfTurnedLeftFourTimesFromWest(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('W');
        $expectedDirection = Direction::from('W');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'l', 'l', 'l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInNorthDirectionIfTurnedLeftTwoTimesFromSouth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('S');
        $expectedDirection = Direction::from('N');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInWestDirectionIfTurnedLeftThreeTimesFromSouth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('S');
        $expectedDirection = Direction::from('W');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'l', 'l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInSouthDirectionIfTurnedLeftFourTimesFromSouth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('S');
        $expectedDirection = Direction::from('S');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'l', 'l', 'l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInWestDirectionIfTurnedLeftTwoTimesFromEast(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('E');
        $expectedDirection = Direction::from('W');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInSouthDirectionIfTurnedLeftThreeTimesFromEast(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('E');
        $expectedDirection = Direction::from('S');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'l', 'l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInEastDirectionIfTurnedLeftFourTimesFromEast(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('E');
        $expectedDirection = Direction::from('E');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'l', 'l', 'l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInSouthDirectionIfTurnedRightTwoTimesFromNorth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('N');
        $expectedDirection = Direction::from('S');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['r', 'r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInWestDirectionIfTurnedRightThreeTimesFromNorth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('N');
        $expectedDirection = Direction::from('W');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['r', 'r', 'r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInNorthDirectionIfTurnedRightFourTimesFromNorth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('N');
        $expectedDirection = Direction::from('N');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['r', 'r', 'r', 'r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInEastDirectionIfTurnedRightTwoTimesFromWest(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('W');
        $expectedDirection = Direction::from('E');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['r', 'r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInSouthDirectionIfTurnedRightThreeTimesFromWest(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('W');
        $expectedDirection = Direction::from('S');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['r', 'r', 'r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInWestDirectionIfTurnedRightFourTimesFromWest(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('W');
        $expectedDirection = Direction::from('W');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['r', 'r', 'r', 'r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInNorthDirectionIfTurnedRightTwoTimesFromSouth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('S');
        $expectedDirection = Direction::from('N');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['r', 'r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInEastDirectionIfTurnedRightThreeTimesFromSouth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('S');
        $expectedDirection = Direction::from('E');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['r', 'r', 'r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInSouthDirectionIfTurnedRightFourTimesFromSouth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('S');
        $expectedDirection = Direction::from('S');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['r', 'r', 'r', 'r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInWestDirectionIfTurnedRightTwoTimesFromEast(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('E');
        $expectedDirection = Direction::from('W');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['r', 'r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInNorthDirectionIfTurnedRightThreeTimesFromEast(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('E');
        $expectedDirection = Direction::from('N');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['r', 'r', 'r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInEastDirectionIfTurnedRightFourTimesFromEast(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('E');
        $expectedDirection = Direction::from('E');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['r', 'r', 'r', 'r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInNorthDirectionIfTurnedLeftOnceAndRightOnceFromNorth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('N');
        $expectedDirection = Direction::from('N');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInNorthDirectionIfTurnedRightOnceAndLeftOnceFromNorth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('N');
        $expectedDirection = Direction::from('N');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['r', 'l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInWestDirectionIfTurnedLeftOnceAndRightOnceFromWest(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('W');
        $expectedDirection = Direction::from('W');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInWestDirectionIfTurnedRightOnceAndLeftOnceFromWest(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('W');
        $expectedDirection = Direction::from('W');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['r', 'l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInSouthDirectionIfTurnedLeftOnceAndRightOnceFromSouth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('S');
        $expectedDirection = Direction::from('S');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInSouthDirectionIfTurnedRightOnceAndLeftOnceFromSouth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('S');
        $expectedDirection = Direction::from('S');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['r', 'l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInEastDirectionIfTurnedLeftOnceAndRightOnceFromEast(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('E');
        $expectedDirection = Direction::from('E');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInEastDirectionIfTurnedRightOnceAndLeftOnceFromEast(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('E');
        $expectedDirection = Direction::from('E');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['r', 'l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInEastDirectionIfTurnedLeftOnceAndRightTwiceFromNorth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('N');
        $expectedDirection = Direction::from('E');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'r', 'r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInNorthDirectionIfTurnedLeftOnceAndRightTwiceFromWest(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('W');
        $expectedDirection = Direction::from('N');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'r', 'r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInWestDirectionIfTurnedLeftOnceAndRightTwiceFromSouth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('S');
        $expectedDirection = Direction::from('W');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'r', 'r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInSouthDirectionIfTurnedLeftOnceAndRightTwiceFromEast(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('E');
        $expectedDirection = Direction::from('S');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'r', 'r']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInWestDirectionIfTurnedLeftOnceAndRightOnceAndLeftOnceFromNorth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('N');
        $expectedDirection = Direction::from('W');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'r', 'l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInSouthDirectionIfTurnedLeftOnceAndRightOnceAndLeftOnceFromWest(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('W');
        $expectedDirection = Direction::from('S');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'r', 'l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInEastDirectionIfTurnedLeftOnceAndRightOnceAndLeftOnceFromSouth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('S');
        $expectedDirection = Direction::from('E');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'r', 'l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeInNorthDirectionIfTurnedLeftOnceAndRightOnceAndLeftOnceFromEast(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('E');
        $expectedDirection = Direction::from('N');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'r', 'l']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldForwardToTopLeftCornerIfTurnedLeftOnceAndForwardedOnceAndTurnedRightOnceAndForwardedOnceFromNorth(): void
    {
        $initialPosition = Position::from(x: 1, y: 0);
        $expectedPosition = Position::from(x: 0, y: 1);
        $initialDirection = Direction::from('N');
        $expectedDirection = Direction::from('N');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'f', 'r', 'f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldForwardToTopLeftCornerIfForwardedOnceAndTurnedLeftOnceAndForwardedOnceFromNorth(): void
    {
        $initialPosition = Position::from(x: 1, y: 0);
        $expectedPosition = Position::from(x: 0, y: 1);
        $initialDirection = Direction::from('N');
        $expectedDirection = Direction::from('W');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['f', 'l', 'f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldForwardToTopRightCornerIfTurnedRightOnceAndForwardedOnceAndTurnedLeftOnceAndForwardedOnceFromNorth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('N');
        $expectedPosition = Position::from(x: 1, y: 1);
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['r', 'f', 'l', 'f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($initialDirection));
    }

    public function testRoverShouldForwardToTopRightCornerIfForwardedOnceAndTurnedRightOnceAndForwardedOnceFromNorth(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $expectedPosition = Position::from(x: 1, y: 1);
        $initialDirection = Direction::from('N');
        $expectedDirection = Direction::from('E');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['f', 'r', 'f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldForwardToBottomRightCornerIfTurnedLeftOnceAndForwardedOnceAndTurnedRightOnceAndForwardedOnceFromSouth(): void
    {
        $initialPosition = Position::from(x: 0, y: 1);
        $expectedPosition = Position::from(x: 1, y: 0);
        $initialDirection = Direction::from('S');
        $expectedDirection = Direction::from('S');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['l', 'f', 'r', 'f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldForwardToBottomRightCornerIfForwardedOnceAndTurnedLeftOnceAndForwardedOnceFromSouth(): void
    {
        $initialPosition = Position::from(x: 0, y: 1);
        $expectedPosition = Position::from(x: 1, y: 0);
        $initialDirection = Direction::from('S');
        $expectedDirection = Direction::from('E');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['f', 'l', 'f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldForwardToBottomLeftCornerIfTurnedRightOnceAndForwardedOnceAndTurnedLeftOnceAndForwardedOnceFromSouth(): void
    {
        $initialPosition = Position::from(x: 1, y: 1);
        $expectedPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('S');
        $expectedDirection = Direction::from('S');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['r', 'f', 'l', 'f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldForwardToBottomLeftCornerIfForwardedOnceAndTurnedRightOnceAndForwardedOnceFromSouth(): void
    {
        $initialPosition = Position::from(x: 1, y: 1);
        $expectedPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('S');
        $expectedDirection = Direction::from('W');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['f', 'r', 'f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($expectedDirection));
    }

    public function testRoverShouldBeWrappedToTopLeftCornerIfForwardedFromBottomLeftCorner(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $expectedPosition = Position::from(x: 0, y: 1);
        $initialDirection = Direction::from('S');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($initialDirection));
    }

    public function testRoverShouldBeWrappedToBottomLeftCornerIfForwardedFromTopLeftCorner(): void
    {
        $initialPosition = Position::from(x: 0, y: 1);
        $expectedPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('N');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($initialDirection));
    }

    public function testRoverShouldBeWrappedToTopRightCornerIfForwardedFromBottomRightCorner(): void
    {
        $initialPosition = Position::from(x: 1, y: 0);
        $expectedPosition = Position::from(x: 1, y: 1);
        $initialDirection = Direction::from('S');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($initialDirection));
    }

    public function testRoverShouldBeWrappedToBottomRightCornerIfForwardedFromTopRightCorner(): void
    {
        $initialPosition = Position::from(x: 1, y: 1);
        $expectedPosition = Position::from(x: 1, y: 0);
        $initialDirection = Direction::from('N');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($initialDirection));
    }

    public function testRoverShouldBeWrappedToTopLeftCornerIfForwardedFromTopRightCorner(): void
    {
        $initialPosition = Position::from(x: 1, y: 1);
        $expectedPosition = Position::from(x: 0, y: 1);
        $initialDirection = Direction::from('E');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($initialDirection));
    }

    public function testRoverShouldBeWrappedToTopRightCornerIfForwardedFromTopLeftCorner(): void
    {
        $initialPosition = Position::from(x: 0, y: 1);
        $expectedPosition = Position::from(x: 1, y: 1);
        $initialDirection = Direction::from('W');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($initialDirection));
    }

    public function testRoverShouldBeWrappedToBottomLeftCornerIfForwardedFromBottomRightCorner(): void
    {
        $initialPosition = Position::from(x: 1, y: 0);
        $expectedPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('E');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($initialDirection));
    }

    public function testRoverShouldBeWrappedToBottomRightCornerIfForwardedFromBottomLeftCorner(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $expectedPosition = Position::from(x: 1, y: 0);
        $initialDirection = Direction::from('W');
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($initialDirection));
    }

    public function testRoverShouldNotBeAbleToMoveIfObstacleIsInFront(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('N');
        $this->planet->addActor(Obstacle::class, Position::from(x: 0, y: 1));
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($initialDirection));
    }

    public function testRoverShouldNotBeAbleToMoveIfObstacleIsBehind(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('S');
        $this->planet->addActor(Obstacle::class, Position::from(x: 0, y: 1));
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($initialDirection));
    }

    public function testRoverShouldNotBeAbleToMoveIfObstacleIsOnTheLeft(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('W');
        $this->planet->addActor(Obstacle::class, Position::from(x: 1, y: 0));
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($initialDirection));
    }

    public function testRoverShouldNotBeAbleToMoveIfObstacleIsOnTheRight(): void
    {
        $initialPosition = Position::from(x: 0, y: 0);
        $initialDirection = Direction::from('E');
        $this->planet->addActor(Obstacle::class, Position::from(x: 1, y: 0));
        $this->driver->initialize($this->planet, $initialPosition, $initialDirection);
        $this->driver->execute(['f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($initialPosition));
        $this->assertTrue($direction->equals($initialDirection));
    }

    public function testRoverShouldMoveButStoppedByAnObstacle(): void
    {
        $planet = new Mars(size: Circle::of(5));
        $initialPosition = Position::from(x: 0, y: 0);
        $expectedPosition = Position::from(x: 3, y: 1);
        $initialDirection = Direction::from('N');
        $planet->addActor(Obstacle::class, Position::from(x: 3, y: 2));
        $this->driver->initialize($planet, $initialPosition, $initialDirection);
        $this->driver->execute(['f', 'r', 'f', 'f', 'f', 'l', 'f']);

        $position = $this->driver->getPosition();
        $direction = $this->driver->getDirection();
        $this->assertTrue($position->equals($expectedPosition));
        $this->assertTrue($direction->equals($initialDirection));
    }
}
