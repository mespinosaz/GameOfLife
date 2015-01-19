<?php

namespace mespinosaz\GameOfLife\Universe\Rule;

use mespinosaz\GameOfLife\Universe\Neighbourhood\Neighbourhood;

abstract class Rule {
    abstract public function match(Neighbourhood $neighbourhood);

    public function action()
    {
        return static::RESULT;
    }
}