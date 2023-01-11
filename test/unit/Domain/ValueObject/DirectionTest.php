<?php

declare(strict_types=1);

namespace Jh3ady\Kata\MarsRoverPhp\Test\Unit\Domain\ValueObject;

use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Direction;
use PHPUnit\Framework\TestCase;

final class DirectionTest extends TestCase
{
    public function testNorthDirection(): void
    {
        $direction = Direction::from('N');

        $this->assertEquals('N', $direction->value);
        $this->assertSame(Direction::North, $direction);
    }

    public function testEastDirection(): void
    {
        $direction = Direction::from('E');

        $this->assertEquals('E', $direction->value);
        $this->assertSame(Direction::East, $direction);
    }

    public function testSouthDirection(): void
    {
        $direction = Direction::from('S');

        $this->assertEquals('S', $direction->value);
        $this->assertSame(Direction::South, $direction);
    }

    public function testWestDirection(): void
    {
        $direction = Direction::from('W');

        $this->assertEquals('W', $direction->value);
        $this->assertSame(Direction::West, $direction);
    }
}
