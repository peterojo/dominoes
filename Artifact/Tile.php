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

    public function isSuitableToPlay($leftEdge, $rightEdge): bool
    {
        return $this->has($leftEdge) || $this->has($rightEdge);
    }

    public function suitablePosition($leftEdge, $rightEdge): string
    {
        if (!$this->isSuitableToPlay($leftEdge, $rightEdge)) {
            throw new \Exception("This tile matches neither of the edge numbers on the board.\n");
        }

        if (reset($this->numbers) === $rightEdge) {
            return 'right';
        } elseif (end($this->numbers) === $leftEdge) {
            return 'left';
        } else {
            $this->numbers = array_reverse($this->numbers);
            return $this->suitablePosition($leftEdge, $rightEdge);
        }
    }

    public function display(): string
    {
        return '[' . $this->numbers[0] . ':' . $this->numbers[1] . ']';
    }
}