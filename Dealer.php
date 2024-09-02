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
        $this->dealer = new Player('Dealer', $blackjack);
        $this->players[] = $this->dealer; 
    }

    public function addPlayer(Player $player): void
    {
        $this->players[] = $player;
    }

    public function playGame(): void
    {
        $this->dealInitialCards();

        while ($this->shouldContinuePlaying()) {
            $this->playRound();
        }

        $this->determineWinners();
    }

    private function dealInitialCards(): void
    {
        foreach ($this->players as $player) {
            $player->addCard($this->deck->drawCard());
            $player->addCard($this->deck->drawCard());
        }
    }

    private function shouldContinuePlaying(): bool
    {
        foreach ($this->players as $player) {
            if ($player !== $this->dealer && $player->wantsToDraw()) {
                return true;
            }
        }
        return $this->dealer->getScore() < 18;
    }

    private function playRound(): void
    {
        if ($this->dealer->getScore() < 18) {
            echo "Dealer draws a card...\n";
            $this->dealer->addCard($this->deck->drawCard());
            echo $this->dealer->showHand() . PHP_EOL;
        }

        foreach ($this->players as $player) {
            if ($player !== $this->dealer) {
                echo $player->getName() . "'s turn. " . $player->showHand() . ". 'draw' or 'stop'?... ";
                $choice = trim(fgets(STDIN));

                if (strtolower($choice) === 'draw') {
                    $player->addCard($this->deck->drawCard());
                    echo $player->showHand() . PHP_EOL;
                    $score = $player->getScore();
                    echo $score . PHP_EOL;

                    if ($score === "Busted" || $score === "Blackjack" || $score === "Twenty-One" || $score === "Five Card Charlie") {
                        break;
                    }
                } else {
                    $player->stop();
                }
            }
        }
    }

    private function determineWinners(): void
    {
        foreach ($this->players as $player) {
            if ($player !== $this->dealer) {
                if ($player->isBusted()) {
                    echo $player->getName() . " is busted! Dealer wins!\n";
                } elseif ($this->dealer->isBusted() || $player->getFinalScore() > $this->dealer->getFinalScore()) {
                    echo $player->getName() . " wins with " . $player->getFinalScore() . "!\n";
                } else {
                    echo "Dealer wins against " . $player->getName() . "!\n";
                }
            }
        }
    }
}

?>
