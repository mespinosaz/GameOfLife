<?php

namespace mespinosaz\GameOfLife\Universe;

use mespinosaz\Utility\Position\Position2D;
use mespinosaz\GameOfLife\Universe\Exception\OutOfBoundariesException;
use mespinosaz\GameOfLife\Universe\Rule\BirthRule;
use mespinosaz\GameOfLife\Universe\Rule\DeathRule;
use mespinosaz\GameOfLife\Universe\Cell\Cell;
use mespinosaz\GameOfLife\Universe\Neighbourhood\Neighbourhood;

class Universe
{
    const BOARD_SIZE = 10;
    const FIRST_INDEX = 0;

    private $board;
    private $newBoard;
    private $rules;

    public function __construct()
    {
        $this->initializeBoard();
        $this->rules = array(
            Cell::DEAD => new BirthRule(),
            Cell::ALIVE => new DeathRule()
        );
    }

    private function initializeBoard()
    {
        $this->board = array_fill(self::FIRST_INDEX, self::BOARD_SIZE, array());
        $this->board = array_map(function () {
            return array_fill(self::FIRST_INDEX, self::BOARD_SIZE, 0);
        }, $this->board);
    }

    public function newCell(Position2D $position)
    {
        $this->checkPosition($position);
        $this->board[$position->x()][$position->y()] = Cell::ALIVE;
    }

    private function checkPosition(Position2D $position)
    {
        if ($position->x() < self::FIRST_INDEX || $position->x() >= self::BOARD_SIZE
            || $position->y() < self::FIRST_INDEX || $position->y() >= self::BOARD_SIZE) {
            throw new OutOfBoundariesException('Index outside universe '.$position);
        }
    }

    public function mutate()
    {
        $this->newBoard = $this->board;
        $this->checkRules();
        $this->board = $this->newBoard;
        $this->newBoard = null;
    }

    private function checkRules()
    {
        foreach ($this->board as $rowIndex => $row) {
            foreach ($row as $columnIndex => $cell) {
                $this->applyRulesToCell(new Position2D($rowIndex,$columnIndex));
            }
        }
    }

    private function applyRulesToCell(Position2D $cellPosition)
    {
        $neighbourhood = $this->cellNeighbourhood($cellPosition);
        $cell = $this->cellAtPosition($cellPosition);
        if ($this->rules[$cell]->match($neighbourhood)) {
            $this->newBoard[$cellPosition->x()][$cellPosition->y()] = $this->rules[$cell]->action();
        }
    }

    private function cellNeighbourhood($cellPosition)
    {
        $neighbourhoodStructure = array();
        for ($i=-1;$i<=1;$i++) {
            $row = array();
            for ($j=-1;$j<=1;$j++) {
                $aPosition = new Position2D($cellPosition->x()+$i, $cellPosition->y()+$j);
                $row[] = $this->cellAtPosition($aPosition);
            }
            $neighbourhoodStructure[] = $row;
        }
        $neighbourhood = new Neighbourhood($neighbourhoodStructure);

        return $neighbourhood;
    }

    private function cellAtPosition(Position2D $cellPosition)
    {   try {
            $this->checkPosition($cellPosition);
            return $this->board[$cellPosition->x()][$cellPosition->y()];
        } catch (OutOfBoundariesException $e) {
            return Cell::DEAD;
        }
    }
}
