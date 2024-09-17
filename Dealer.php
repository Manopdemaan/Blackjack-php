<?php
class Dealer {
    private $blackjack;
    private $deck;
    private $players = [];
    private $dealer;

    public function __construct(Blackjack $blackjack, Deck $deck) {
        $this->blackjack = $blackjack;
        $this->deck = $deck;
        $this->dealer = new Player('Dealer');
        $this->players[] = $this->dealer;
    }

    public function addPlayer(Player $player) {
        $this->players[] = $player;
    }

    public function playGame() {
        $this->dealInitialCards();
        $this->playTurns();
        $this->evaluateGame();
    }

    private function dealInitialCards() {
        foreach ($this->players as $player) {
            for ($i = 0; $i < 2; $i++) {
                $player->addCard($this->deck->drawCard());
            }
        }

        echo "Kaart van de dealer is: " . $this->dealer->getHand()[1] . "\n";
    }

    private function playTurns() {
        $playerCount = count($this->players);
        $allPlayersTurn = true;

        while ($allPlayersTurn) {
            foreach ($this->players as $index => $player) {
                if ($player === $this->dealer) {
                    if ($this->blackjack->getScore($this->dealer->getHand()) < 18) {
                        $this->dealer->addCard($this->deck->drawCard());
                        echo "Dealer neemt kaart: ";
                        $this->printHand($this->dealer->getHand());
                    }
                } else {
                    echo $player->getName() . ", je hand is: ";
                    $this->printHand($player->getHand());
                    echo "Score: " . $this->blackjack->getScore($player->getHand()) . "\n";
                    echo "Wil je door? (D/S): ";
                    $choice = trim(fgets(STDIN));

                    if ($choice === 'h') {
                        $player->addCard($this->deck->drawCard());
                        if ($this->blackjack->getScore($player->getHand()) > 21) {
                            echo "Busted! Je hand: ";
                            $this->printHand($player->getHand());
                            echo "Score: " . $this->blackjack->getScore($player->getHand()) . "\n";
                            $allPlayersTurn = false;
                            break;
                        }
                    } else {
                        $allPlayersTurn = false;
                    }
                }
            }
        }

        if ($this->blackjack->getScore($this->dealer->getHand()) < 18) {
            $this->dealerTurn();
        }
    }

    private function dealerTurn() {
        echo "Dealer's Laatste hand: ";
        $this->printHand($this->dealer->getHand());
        while ($this->blackjack->getScore($this->dealer->getHand()) < 18) {
            $this->dealer->addCard($this->deck->drawCard());
            echo "Dealer Neemt kaart. Nieuwe hand: ";
            $this->printHand($this->dealer->getHand());
        }
    }

    private function printHand($hand) {
        foreach ($hand as $card) {
            echo $card . " ";
        }
        echo "\n";
    }

    private function evaluateGame() {
        $dealerScore = $this->blackjack->getScore($this->dealer->getHand());
        echo "Dealer's final hand: ";
        $this->printHand($this->dealer->getHand());
        echo "Dealer's final score: " . $dealerScore . "\n";

        foreach ($this->players as $player) {
            if ($player === $this->dealer) continue;

            $playerScore = $this->blackjack->getScore($player->getHand());
            echo $player->getName() . "'s final hand: ";
            $this->printHand($player->getHand());
            echo $player->getName() . "'s final score: " . $playerScore . "\n";

            if ($playerScore > 21) {
                echo $player->getName() . " busts! Dealer wins.\n";
            } elseif ($dealerScore > 21 || $playerScore > $dealerScore) {
                echo $player->getName() . " wins!\n";
            } elseif ($playerScore < $dealerScore) {
                echo "Dealer wins tegen " . $player->getName() . ".\n";
            } else {
                echo "It's a tie with " . $player->getName() . ".\n";
            }

            $player->clearHand();
        }
    }
}
?>
