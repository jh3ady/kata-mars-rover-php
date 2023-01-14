<?php

declare(strict_types=1);

namespace Jh3ady\Kata\MarsRoverPhp\Test\Unit\Domain\ValueObject;

use InvalidArgumentException;
use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Position;
use PHPUnit\Framework\TestCase;

class PositionTest extends TestCase
{
    public function testCanHaveNegativeXOrdinate(): void
    {
        $position = Position::from(x: -1, y: 0);

        $this->assertSame(-1, $position->x);
    }

    public function testCanHaveZeroXOrdinate(): void
    {
        $position = Position::from(x: 0, y: 0);

        $this->assertSame(0, $position->x);
    }

    public function testCanHavePositiveXOrdinate(): void
    {
        $position = Position::from(x: 1, y: 0);

        $this->assertSame(1, $position->x);
    }

    public function testCanHaveNegativeYOrdinate(): void
    {
        $position = Position::from(x: 0, y: -1);

        $this->assertSame(-1, $position->y);
    }

    public function testCanHaveZeroYOrdinate(): void
    {
        $position = Position::from(x: 0, y: 0);

        $this->assertSame(0, $position->y);
    }

    public function testCanHavePositiveYOrdinate(): void
    {
        $position = Position::from(x: 0, y: 1);

        $this->assertSame(1, $position->y);
    }
}
