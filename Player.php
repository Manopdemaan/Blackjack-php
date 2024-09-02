<?php

class Player
{
    private string $name;
    private array $hand = [];
    private Blackjack $blackjack;
    private bool $stopped = false;

    public function __construct(string $name, Blackjack $blackjack)
    {
        $this->name = $name;
        $this->blackjack = $blackjack;
    }

    public function addCard(Card $card): void
    {
        $this->hand[] = $card;
    }

    public function getScore(): string
    {
        return $this->blackjack->scoreHand($this->hand);
    }

    public function showHand(): string
    {
        $cardsInHand = array_map(function (Card $card) {
            return $card->show();
        }, $this->hand);

        return $this->name . " has " . implode(" ", $cardsInHand);
    }

    public function stop(): void
    {
        $this->stopped = true;
    }

    public function wantsToDraw(): bool
    {
        return !$this->stopped && $this->getScore() !== "Busted";
    }

    public function isBusted(): bool
    {
        return $this->getScore() === "Busted";
    }

    public function getFinalScore(): int
    {
        $scoreString = $this->getScore();
        if (is_numeric($scoreString)) {
            return (int)$scoreString;
        }

        if ($scoreString === "Blackjack") {
            return 21;
        }

        return 0;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

?>
