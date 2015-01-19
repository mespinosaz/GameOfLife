<?php

namespace whs\GameOfLife\Tests\Universe;

use mespinosaz\GameOfLife\Universe\Universe;
use mespinosaz\Utility\Position\Position2D;

class UniverseTest extends \PHPUnit_Framework_TestCase
{
    public function testEmpty()
    {
        $universe = new Universe();
        $universe->mutate();
        $expectedUniverse = new Universe();
        $this->assertEquals($expectedUniverse, $universe);
    }

    public function testOneCellShouldDie()
    {
        $universe = new Universe();
        $universe->newCell(new Position2D(0, 0));
        $universe->mutate();
        $expectedUniverse = new Universe();
        $this->assertEquals($expectedUniverse, $universe);
    }

    public function testOneCellShouldSurviveAndOneShouldLiveOneShouldBirth()
    {
        $universe = new Universe();
        $universe->newCell(new Position2D(0, 1));
        $universe->newCell(new Position2D(0, 0));
        $universe->newCell(new Position2D(0, 2));
        $universe->mutate();
        $expectedUniverse = new Universe();
        $expectedUniverse->newCell(new Position2D(1, 1));
        $expectedUniverse->newCell(new Position2D(0, 1));
        $this->assertEquals($expectedUniverse, $universe);
    }

    public function testOneCellShouldSurviveTwoShouldDieTwoShouldBirth()
    {
        $universe = new Universe();
        $universe->newCell(new Position2D(1, 1));
        $universe->newCell(new Position2D(1, 0));
        $universe->newCell(new Position2D(1, 2));
        $universe->mutate();
        $expectedUniverse = new Universe();
        $expectedUniverse->newCell(new Position2D(1, 1));
        $expectedUniverse->newCell(new Position2D(0, 1));
        $expectedUniverse->newCell(new Position2D(2, 1));
        $this->assertEquals($expectedUniverse, $universe);
    }

    public function testUniverseStillness()
    {
        $universe = new Universe();
        $universe->newCell(new Position2D(1, 1));
        $universe->newCell(new Position2D(2, 1));
        $universe->newCell(new Position2D(1, 2));
        $universe->newCell(new Position2D(2, 2));
        $expectedUniverse = clone $universe;
        $universe->mutate();
        $this->assertEquals($expectedUniverse, $universe);
    }

    public function testEverythingDies()
    {
        $universe = new Universe();
        $universe->newCell(new Position2D(1, 1));
        $universe->newCell(new Position2D(2, 1));
        $universe->newCell(new Position2D(1, 5));
        $universe->newCell(new Position2D(7, 3));
        $universe->mutate();
        $expectedUniverse = new Universe();
        $this->assertEquals($expectedUniverse, $universe);
    }
}
