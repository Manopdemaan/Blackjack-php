<?php

class Dealer 
{
    private $blackjack;
    private $deck;
    private $players = [];
    private $dealer;

    public function __construct(Blackjack $blackjack, Deck $deck) 
    {
        $this->blackjack = $blackjack;
        $this->deck = $deck;
        $this->dealer = new Player('Dealer');
        $this->players[] = $this->dealer;
    }

    public function addPlayer(Player $player) 
    {
        $this->players[] = $player;
    }

    public function playGame() 
    {
        $this->dealInitialCards();
        $this->playTurns();
        $this->evaluateGame();
    }

    private function dealInitialCards() 
    {
        foreach ($this->players as $player) {
            for ($i = 0; $i < 2; $i++) {
                $player->addCard($this->deck->drawCard());
            }
        }

        echo "Kaart van de dealer is: " . $this->dealer->getHand()[1] . "\n";
    }

    private function playTurns() 
    {
        foreach ($this->players as $player) {
            if ($player === $this->dealer) {
                echo "Dealer's hand: ";
                $this->printHand($this->dealer->getHand());
                echo "Score: " . $this->blackjack->getScore($this->dealer->getHand()) . "\n";
            } else {
                $this->playerTurn($player);
            }
        }

        if ($this->blackjack->getScore($this->dealer->getHand()) < 18) {
            $this->dealerTurn();
        }
    }

    private function playerTurn(Player $player) 
    {
        $continuePlaying = true;
        
        while ($continuePlaying) {
            echo $player->getName() . ", je hand is: ";
            $this->printHand($player->getHand());
            $score = $this->blackjack->getScore($player->getHand());
            echo "Score: " . $score . "\n";
            
            if ($score >= 21) {
                if ($score > 21) {
                    echo "Busted! Je hand: ";
                } else {
                    echo "Je hebt 21 bereikt! ";
                }
                break;
            }
            
            echo "Wil je door? (D/S): ";
            $choice = trim(fgets(STDIN));

            if ($choice === 'd') {
                $player->addCard($this->deck->drawCard());
                $score = $this->blackjack->getScore($player->getHand());
                echo "Nieuwe hand: ";
                $this->printHand($player->getHand());
                echo "Score: " . $score . "\n";
            } else {
                $continuePlaying = false;
            }
        }
    }

    private function dealerTurn() 
    {
        echo "Dealer's Laatste hand: ";
        $this->printHand($this->dealer->getHand());
        
        while ($this->blackjack->getScore($this->dealer->getHand()) < 18) {
            $this->dealer->addCard($this->deck->drawCard());
            echo "Dealer Neemt kaart. Nieuwe hand: ";
            $this->printHand($this->dealer->getHand());
            echo "Score: " . $this->blackjack->getScore($this->dealer->getHand()) . "\n";
        }
    }

    private function printHand($hand) 
    {
        foreach ($hand as $card) {
            echo $card . " ";
        }
        echo "\n";
    }

    private function evaluateGame() 
    {
        $dealerScore = $this->blackjack->getScore($this->dealer->getHand());
        $bestScore = 0;
        $bestPlayers = [];

        echo "Dealer's final hand: ";
        $this->printHand($this->dealer->getHand());
        echo "Dealer's final score: " . $dealerScore . "\n";

        foreach ($this->players as $player) {
            if ($player === $this->dealer) continue;

            $playerScore = $this->blackjack->getScore($player->getHand());
            echo $player->getName() . "'s final hand: ";
            $this->printHand($player->getHand());
            echo $player->getName() . "'s final score: " . $playerScore . "\n";

            if ($playerScore <= 21) {
                if ($playerScore > $bestScore) {
                    $bestScore = $playerScore;
                    $bestPlayers = [$player];
                } elseif ($playerScore == $bestScore) {
                    $bestPlayers[] = $player;
                }
            }

            if ($playerScore > 21) {
                echo $player->getName() . " busts!\n";
            }
        }

        if ($dealerScore > 21) {
            echo "Dealer busts! ";
            if (!empty($bestPlayers)) {
                if (count($bestPlayers) === 1) {
                    echo $bestPlayers[0]->getName() . " wins!\n";
                } else {
                    echo "It's a tie between: ";
                    foreach ($bestPlayers as $player) {
                        echo $player->getName() . " ";
                    }
                    echo "\n";
                }
            } else {
                echo "Geen winnaar, iedereen heeft gebust.\n";
            }
        } else {
            if (!empty($bestPlayers)) {
                if ($bestScore > $dealerScore) {
                    if (count($bestPlayers) === 1) {
                        echo $bestPlayers[0]->getName() . " wins!\n";
                    } else {
                        echo "It's a tie between: ";
                        foreach ($bestPlayers as $player) {
                            echo $player->getName() . " ";
                        }
                        echo "\n";
                    }
                } else {
                    echo "Dealer wins!\n";
                }
            } else {
                echo "Dealer wins!\n";
            }
        }

        foreach ($this->players as $player) {
            $player->clearHand();
        }
    }
}

?>
