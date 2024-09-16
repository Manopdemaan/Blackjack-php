<?php

require_once 'Player.php';
require_once 'Blackjack.php';
require_once 'Deck.php';

class Dealer
{
    private array $players = [];
    private Player $dealer;
    private Blackjack $blackjack;
    private Deck $deck;

    public function __construct(Blackjack $blackjack, Deck $deck)
    {
        $this->blackjack = $blackjack;
        $this->deck = $deck;
        $this->dealer = new Player('Dealer');
        $this->players[] = $this->dealer; 
    }

    public function addPlayer(Player $player): void
    {
        $this->players[] = $player;
    }

    public function playGame(): void
    {
        $this->dealInitialCards();
        $gameActive = true;

        while ($gameActive) {
            foreach ($this->players as $player) {
                if ($player !== $this->dealer && !$player->isBusted()) {
                    $this->playPlayerTurn($player);
                }
            }

            if (!$this->dealer->isBusted()) {
                $this->playDealerTurn();
            }

            $gameActive = $this->anyPlayerWantsToContinue();
        }

        $this->determineWinners();
    }

    private function dealInitialCards(): void
    {
        $this->dealer->addCard($this->deck->drawCard());
        $this->dealer->addCard($this->deck->drawCard());

        foreach ($this->players as $player) {
            if ($player !== $this->dealer) {
                $player->addCard($this->deck->drawCard());
                $player->addCard($this->deck->drawCard());
            }
        }
    }

    private function playPlayerTurn(Player $player): void
    {
        echo $player->getName() . "'s turn. " . $player->showHand() . ". 'draw' or 'stop'?... ";
        $choice = trim(fgets(STDIN));

        if (strtolower($choice) === 'draw') {
            $player->addCard($this->deck->drawCard());
            echo $player->showHand() . PHP_EOL;
            $score = $player->getScore($this->blackjack);
            echo "Score: " . $score . PHP_EOL;

            if ($score === "Busted" || $score === "Blackjack" || $score === "Twenty-One" || $score === "Five Card Charlie") {
                $player->stop();
            }
        } else {
            $player->stop();
        }
    }

    private function playDealerTurn(): void
    {
        echo "Dealer's turn...\n";
        while ($this->dealer->getScore($this->blackjack) < 18) {
            echo "Dealer draws a card...\n";
            $this->dealer->addCard($this->deck->drawCard());
            echo $this->dealer->showHand() . PHP_EOL;
        }
    }

    private function anyPlayerWantsToContinue(): bool
    {
        foreach ($this->players as $player) {
            if ($player !== $this->dealer && !$player->isBusted()) {
                echo $player->getName() . " wants to continue. Press 'y' to continue or any other key to stop: ";
                $choice = trim(fgets(STDIN));
                if (strtolower($choice) === 'y') {
                    return true;
                }
            }
        }
        return false;
    }

    private function determineWinners(): void
    {
        $dealerScore = $this->dealer->getFinalScore($this->blackjack);
        echo "Dealer's final score: " . $dealerScore . PHP_EOL;

        foreach ($this->players as $player) {
            if ($player !== $this->dealer) {
                $playerScore = $player->getFinalScore($this->blackjack);
                echo $player->getName() . "'s final score: " . $playerScore . PHP_EOL;

                if ($player->isBusted()) {
                    echo $player->getName() . " is busted! Dealer wins!\n";
                } elseif ($this->dealer->isBusted() || $playerScore > $dealerScore) {
                    echo $player->getName() . " wins with " . $playerScore . "!\n";
                } else {
                    echo "Dealer wins against " . $player->getName() . "!\n";
                }
            }
        }
    }
}

?>
