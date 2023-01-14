<?php

declare(strict_types=1);

namespace Jh3ady\Kata\MarsRoverPhp\Test\Unit\Domain\Entity;

use Jh3ady\Kata\MarsRoverPhp\Domain\Entity\Mars;
use Jh3ady\Kata\MarsRoverPhp\Domain\Entity\Obstacle;
use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Circle;
use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Position;
use PHPUnit\Framework\TestCase;

class MarsTest extends TestCase
{
    private Mars $mars;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mars = new Mars(Circle::of(5));
    }

    public function testCannotAddObstacleIfPositionIsOutOfBounds(): void
    {
        $this->assertFalse($this->mars->addActor(Obstacle::class, Position::from(6, 6)));
    }

    public function testCanAddObstacleIfPositionIsInBounds(): void
    {
        $this->assertTrue($this->mars->addActor(Obstacle::class, Position::from(4, 4)));
    }

    public function testCannotAddObstacleIfPositionIsAlreadyAnObstacle(): void
    {
        $this->mars->addActor(Obstacle::class, Position::from(x: 4, y: 4));

        $this->assertFalse($this->mars->addActor(Obstacle::class, Position::from(x: 4, y: 4)));
    }
}
