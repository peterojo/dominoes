<?php

namespace Dominos;

use Dominos\Artifact\Player;
use Dominos\Artifact\Tile;

class Game
{
    public $board = [];
    public $deck = [];
    public $players = [];

    public function initialize(): void
    {
        print "Initializing game...\n";
        $tiles = [];

        /* Build 28 unique tiles with all combinations from 0 to 6 */
        for ($x = 0; $x <= 6; $x++) {
            for ($y = $x; $y <= 6; $y++) {
                $tiles[] = new Tile($x, $y);
            }
        }

        shuffle($tiles);

        $this->deck = $tiles;
    }

    public function registerPlayer(Player $player): void
    {
        print "Welcome player {$player->name}!\n";
        $this->players[] = $player;
    }

    public function play(): void
    {
        while (!$this->isOver()) {
            $player = current($this->players);
            $player->play($this);
            next($this->players) ?: reset($this->players);
        }
    }

    public function getEdgesOfTheBoard(): array
    {
        $leftTile = reset($this->board);
        $rightTile = end($this->board);

        return [ reset($leftTile->numbers), end($rightTile->numbers) ];
    }

    public function placeTileOnBoard(Tile $tile, string $position): void
    {
        if (!$this->isValidTilePlacement($tile, $position)) {
            print "You're not allowed to do that!\n";
            exit(1);
        }

        $position === 'right' ? array_push($this->board, $tile) : array_unshift($this->board, $tile);
    }

    public function visitBoneyard(): Tile
    {
        if (0 === count($this->deck)) {
            exit("No more tiles in Boneyard. Game ends.\n");
        }

        return array_shift($this->deck);
    }

    public function displayTiles($tiles = null): string
    {
        $tiles = $tiles ?? $this->board;
        $display = '';
        foreach ($tiles as $tile) {
            $display .= $tile->display();
        }

        return $display;
    }

    private function isValidTilePlacement(Tile $tile, $position): bool
    {
        if ('right' === $position) {
            $rightEdgeTile = end($this->board);

            return end($rightEdgeTile->numbers) === reset($tile->numbers);
        } elseif ('left' === $position) {
            $leftEdgeTile = reset($this->board);

            return end($tile->numbers) === reset($leftEdgeTile->numbers);
        }

        return false;
    }

    public function isOver(): bool
    {
        if (empty($this->deck)) {
            print "No more tiles in Boneyard. Game ends.\n";
            return true;
        }

        foreach ($this->players as $player) {
            if ($player->wins()) {
                print "DOMINO!!! {$player->name} wins!\n";
                return true;
            }
        }

        return false;
    }
}

