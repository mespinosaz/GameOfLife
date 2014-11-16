<?php

namespace whs\Util\Position;

class Position2D
{
    private $x;
    private $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function x()
    {
        return $this->x;
    }

    public function y()
    {
        return $this->y;
    }

    public function __toString()
    {
        return 'X: '.$this->x.' Y: '.$this->y;
    }
}
