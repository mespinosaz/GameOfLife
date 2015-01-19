<?php

namespace mespinosaz\GameOfLife\Universe\Rule;

use mespinosaz\GameOfLife\Universe\Neighbourhood\Neighbourhood;
use mespinosaz\GameOfLife\Universe\Cell\Cell;

class BirthRule extends Rule {
    const RESULT = 1;
    const NEIGHBOURS_TO_BIRTH = 3;

    public function match(Neighbourhood $neighbourhood)
    {
        return ($neighbourhood->center() == Cell::DEAD
            && $neighbourhood->numberOfNeighbours() == self::NEIGHBOURS_TO_BIRTH);
    }
}