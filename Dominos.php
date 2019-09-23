<?php

namespace Dominos;
require 'autoload.php';

use Dominos\Artifact\Player;
use Dominos\Artifact\Tile;

class Dominos
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

    public function drawTilesFromDeck(int $number): array
    {
        print "Drawing {$number} tiles from deck.\n";
        if (0 === count($this->deck)) {
            exit("Game Over! No more tiles.");
        }
        return array_splice($this->deck, 0, $number);
    }

    public function placeTileOnBoard(Tile $tile, string $position): void
    {
        if (!$this->isValid($tile, $position)) {
            throw new \Exception("Invalid tile");
        }

        $position === 'right' ? array_push($this->board, $tile) : array_unshift($this->board, $tile);

        print 'Board is now: '.$this->showTilesShallow($this->board)."\n";
    }

    private function isValid(Tile $tile, $position): bool
    {
        if (0 === count($this->board)) {
            return true;
        }

        print "Checking whether tile is allowed on {$position} of board.\n";
        if ('right' === $position) {
            $last = end($this->board);

            return end($last->numbers) === reset($tile->numbers);
        } elseif ('left' === $position) {
            $first = reset($this->board);

            return end($tile->numbers) === reset($first->numbers);
        }

        return false;
    }

    public function play()
    {
        while (!$this->isOver()) {
            $player = next($this->players) ?: reset($this->players);
            $player->play($this);
        }
    }

    public function isOver()
    {
        if (empty($this->deck)) {
            print "No more tiles in Boneyard.\n";
            return true;
        }

        foreach ($this->players as $player) {
            if ($player->hasWon()) {
                print "DOMINO!!! {$player->name} won!\n";
                return true;
            }
        }
    }

    private function showTilesShallow($tiles)
    {
        $numbers = [];
        foreach ($tiles as $tile) {
            $numbers[] = $tile->numbers;
        }

        return json_encode($numbers);
    }
}
$game = new Dominos();

$game->initialize();

$game->registerPlayer(
    new Player('Donald Trump', $game->drawTilesFromDeck(7))
);
$game->registerPlayer(
    new Player('Xi Jinping', $game->drawTilesFromDeck(7))
);

 /* Pick next tile from shuffled deck to start */
$game->board = array_splice($game->deck, 0, 1);

$game->play();
