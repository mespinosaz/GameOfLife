<?php

namespace mespinosaz\GameOfLife\Universe\Neighbourhood;

class Neighbourhood
{
    const CENTER_X = 1;
    const CENTER_Y = 1;
    private $structure;

    public function __construct (array $structure)
    {
        $this->structure = $structure;
    }

    public function center()
    {
        return $this->structure[self::CENTER_X][self::CENTER_Y];
    }

    public function numberOfNeighbours()
    {
        $numberOfNeighbours = 0;
        foreach($this->structure as $rowIndex => $row) {
            foreach($row as $columnIndex => $value) {
                if ($rowIndex == self::CENTER_X && $columnIndex == self::CENTER_Y) {
                    continue;
                }
                $numberOfNeighbours += $value;
            }
        }
        return $numberOfNeighbours;
    }
}