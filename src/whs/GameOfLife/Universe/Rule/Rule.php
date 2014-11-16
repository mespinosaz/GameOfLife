<?php

namespace whs\GameOfLife\Universe\Rule;

use whs\GameOfLife\Universe\Neighbourhood\Neighbourhood;

abstract class Rule {
    abstract public function match(Neighbourhood $neighbourhood);

    public function action()
    {
        return static::RESULT;
    }
}