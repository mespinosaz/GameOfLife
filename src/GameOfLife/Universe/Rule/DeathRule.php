<?php

namespace mespinosaz\GameOfLife\Universe\Rule;

use mespinosaz\GameOfLife\Universe\Neighbourhood\Neighbourhood;
use mespinosaz\GameOfLife\Universe\Cell\Cell;

class DeathRule extends Rule {
    const RESULT = 0;
    const MAXIMUM_NEIGHBOURS_TO_LIVE = 3;
    const MINIMUM_NEIGHBOURS_TO_LIVE = 2;

    public function match(Neighbourhood $neighbourhood)
    {
        return (
            $neighbourhood->center() == Cell::ALIVE
            && (
                $neighbourhood->numberOfNeighbours() > self::MAXIMUM_NEIGHBOURS_TO_LIVE
                || $neighbourhood->numberOfNeighbours() < self::MINIMUM_NEIGHBOURS_TO_LIVE
            )
        );
    }
}
