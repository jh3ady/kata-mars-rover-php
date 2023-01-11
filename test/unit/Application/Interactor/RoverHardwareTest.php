<?php

declare(strict_types=1);

namespace Jh3ady\Kata\MarsRoverPhp\Test\Unit\Application\Interactor;

use Jh3ady\Kata\MarsRoverPhp\Application\Interactor\RoverHardware;
use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Position;
use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Direction;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class RoverHardwareTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->driver = new RoverHardware();
    }

    public function testInitialize(): void
    {
        $position = Position::from(x: 0, y: 0);
        $direction = Direction::from('N');
        $initialized = $this->driver->initialize($position, $direction);

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
}
