<?php

declare(strict_types=1);

namespace Jh3ady\Kata\MarsRoverPhp\Interface;

use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Position;
use Jh3ady\Kata\MarsRoverPhp\Domain\ValueObject\Direction;

interface RoverDriverInterface
{
    public function initialize(Position $position, Direction $direction): bool;
}
