<?php

namespace Dominos\Artifact;

use Dominos\Game;

class Player
{
    public $name;
    public $tiles;

    public function __construct(string $name, array $tiles)
    {
        $this->name = $name;
        $this->tiles = $tiles;
    }

    public function play (Game $game)
    {
        print "It is {$this->name}'s turn\n";
        print "{$this->name} has: ".$game->displayTiles($this->tiles)."\n";

        list($leftEdge, $rightEdge) = $game->getEdgesOfTheBoard();
        $tile = $this->findSuitableTile($game, $leftEdge, $rightEdge);
        $position = $tile->suitablePosition($leftEdge, $rightEdge);

        print "{$this->name} plays " . $tile->display() . " on the {$position} side\n";

        $game->placeTileOnBoard($tile, $position);
        print "The board is: ".$game->displayTiles($game->board)."\n";
    }

    private function findSuitableTile(Game $game, $leftEdge, $rightEdge)
    {
        $suitableTiles = array_filter($this->tiles, function (Tile $tile) use ($leftEdge, $rightEdge) {
            return $tile->isSuitableToPlay($leftEdge, $rightEdge);
        });

        if (empty($suitableTiles)) {
            print "{$this->name} has to reach for the boneyard.\n";

            if ($newPickedTile = $game->visitBoneyard()) {
                $this->tiles[] = $newPickedTile;
                print "{$this->name} now has: ".$game->displayTiles($this->tiles)."\n";
            }

            return $this->findSuitableTile($game, $leftEdge, $rightEdge);
        }

        return $this->giveUpTile(reset($suitableTiles));
    }

    public function hasWon()
    {
        return empty($this->tiles);
    }

    private function giveUpTile(Tile $tile)
    {
        $this->tiles = array_filter($this->tiles, function ($item) use ($tile) {
            return $item->numbers !== $tile->numbers;
        });

        return $tile;
    }
}