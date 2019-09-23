<?php

namespace Dominos\Artifact;

class Tile
{
    public $numbers = [];

    public function __construct($x, $y)
    {
        $this->numbers[] = $x;
        $this->numbers[] = $y;
    }

    public function has(int $number): bool
    {
        return in_array($number, $this->numbers);
    }

    public function suitablePosition($left, $right)
    {
        if (!$this->has($left) && !$this->has($right)) {
            throw new \Exception("This tile does not match any of the edge numbers.\n");
        }

        if (reset($this->numbers) === $right) {
            return 'right';
        } elseif (end($this->numbers) === $left) {
            return 'left';
        } else {
            $this->numbers = array_reverse($this->numbers);
            return $this->suitablePosition($left, $right);
        }
    }
}