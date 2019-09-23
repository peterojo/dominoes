<?php

namespace Dominos\Artifact;

use Dominos\Dominos;

class Player
{
    public $name;
    public $tiles;

    public function __construct(string $name, array $tiles)
    {
        $this->name = $name;
        $this->tiles = $tiles;
    }

    public function play (Dominos $game)
    {
        print "The board is ".$this->showTilesShallow($game->board)."\n";
        print "It is {$this->name}'s turn\n";
        list($left, $right) = $this->findEdgeNumbersOnBoard($game->board);
        print "{$this->name} has: ".$this->showTilesShallow($this->tiles)."\n";
        $validTile = $this->findSuitableTile($game, $left, $right);

        $position = $validTile->suitablePosition($left, $right);
        print "{$this->name} plays ".json_encode($validTile->numbers)." on the {$position} side\n";

        $game->placeTileOnBoard($validTile, $position);
    }

    private function findSuitableTile(Dominos $game, $left, $right): Tile
    {
        print "{$this->name} is now searching for a valid tile to play\n";

        $validTiles = array_filter($this->tiles, function (Tile $tile) use ($left, $right) {
            return $tile->has($left) || $tile->has($right);
        });

        if (empty($validTiles) && !$game->isOver()) {
            print "{$this->name} is picking a new tile from the deck.\n";
            $this->tiles[] = reset($game->drawTilesFromDeck(1));
            print "{$this->name} now has: ".$this->showTilesShallow($this->tiles)."\n";

            return $this->findSuitableTile($game, $left, $right);
        }

        $tile = reset($validTiles);

        $this->tiles = array_filter($this->tiles, function ($item) use ($tile) {
            return $item->numbers !== $tile->numbers;
        });

        return reset($validTiles);
    }

    private function findEdgeNumbersOnBoard(array $board): array
    {
        $firstTile = reset($board);
        $lastTile = end($board);

        print "Edges of board are ".json_encode([reset($firstTile->numbers), end($lastTile->numbers)])."\n";
        return [reset($firstTile->numbers), end($lastTile->numbers)];
    }

    private function showTilesShallow($tiles)
    {
        $numbers = [];
        foreach ($tiles as $tile) {
            $numbers[] = $tile->numbers;
        }

        return json_encode($numbers);
    }

    public function hasWon()
    {
        return empty($this->tiles);
    }
}