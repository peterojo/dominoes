<?php

namespace Dominos;
require 'autoload.php';

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

    public function visitBoneyard()
    {
        if (0 === count($this->deck)) {
            exit("No more tiles in Boneyard. Game ends.\n");
        }

        return array_shift($this->deck);
    }

    public function placeTileOnBoard(Tile $tile, string $position): void
    {
        if (!$this->isValid($tile, $position)) {
            print "You're not allowed to do that!\n";
            exit(1);
        }

        $position === 'right' ? array_push($this->board, $tile) : array_unshift($this->board, $tile);
    }

    private function isValid(Tile $tile, $position): bool
    {
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
            $player = current($this->players);
            $player->play($this);
            next($this->players) ?: reset($this->players);
        }
    }

    public function isOver()
    {
        if (empty($this->deck)) {
            print "No more tiles in Boneyard. Game ends.\n";
            return true;
        }

        foreach ($this->players as $player) {
            if ($player->hasWon()) {
                print "DOMINO!!! {$player->name} won!\n";
                return true;
            }
        }
    }

    public function displayTiles($tiles)
    {
        $display = '';
        foreach ($tiles as $tile) {
            $display .= $tile->display();
        }

        return $display;
    }
}

$game = new Game();

$game->initialize();

$game->registerPlayer(
    new Player('Donald Trump', array_splice($game->deck, 0, 7))
);
$game->registerPlayer(
    new Player('Xi Jinping', array_splice($game->deck, 0, 7))
);

 /* Pick next tile from shuffled deck to start */
$game->board = array_splice($game->deck, 0, 1);
$game->displayTiles($game->board);

$game->play();
