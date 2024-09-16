<?php

class Player
{
    private string $name;
    private array $hand = [];
    private bool $stopped = false;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addCard(Card $card): void
    {
        $this->hand[] = $card;
    }

    public function getScore(Blackjack $blackjack): string
    {
        return $blackjack->scoreHand($this->hand);
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
        return !$this->stopped && $this->getScore(new Blackjack()) !== "Busted";
    }

    public function isBusted(): bool
    {
        return $this->getScore(new Blackjack()) === "Busted";
    }

    public function getFinalScore(Blackjack $blackjack): int
    {
        $scoreString = $this->getScore($blackjack);
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
